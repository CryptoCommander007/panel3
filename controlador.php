<?php
// Incluir la configuración de la base de datos y JWT
include 'db_config.php';
require_once 'config_jwt.php'; // Configuración del JWT

// Verificar si el token JWT está presente en la cookie
if (!isset($_COOKIE['auth_token'])) {
    header("Location: login_form.php");
    exit();
}

// Verificar y decodificar el token JWT
$token = $_COOKIE['auth_token'];
$user_data = verifyJWT($token);

if ($user_data === null) {
    header("Location: login_form.php");
    exit();
}

// Obtener el ID externo del usuario del token JWT
$usuario_externo_id = $user_data['external_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $tipo = $_POST['tipo']; // Hilo o Encuesta

    // Validar que si el tipo es "POLL", se ingresen al menos 2 opciones
    if ($tipo === 'POLL') {
        $opcion1 = $_POST['opcion1'] ?? null;
        $opcion2 = $_POST['opcion2'] ?? null;
        $opcion3 = $_POST['opcion3'] ?? null;
        $opcion4 = $_POST['opcion4'] ?? null;
        $opcion5 = $_POST['opcion5'] ?? null;

        // Asegurarse de que al menos 2 opciones no estén vacías
        $opciones = array_filter([$opcion1, $opcion2, $opcion3, $opcion4, $opcion5]);
        if (count($opciones) < 2) {
            die("Debes ingresar al menos 2 opciones para la encuesta.");
        }
    }

    // Generar un hash para la ruta base de los recursos
    $THD_RESOURCE_BASE_PATH = sha1(uniqid(rand(), true));

    // Crear la carpeta de destino para las imágenes si no existe
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Manejar la subida de imágenes y almacenar los nombres como hashes
    $imagenes_names = [];
    $imagenes_binaries = [];
    if (!empty($_FILES['imagenes']['name'][0])) {
        for ($i = 0; $i < count($_FILES['imagenes']['name']); $i++) {
            if ($i < 7) { // Limitar a 7 imágenes
                // Generar un hash de 64 caracteres (SHA-256) para el nombre de la imagen
                $imagen_hash_name = hash('sha256', uniqid(rand(), true));
                $imagenes_names[] = $imagen_hash_name;

                // Convertir la imagen en binario para guardarla en la base de datos
                $imagen_binario = file_get_contents($_FILES['imagenes']['tmp_name'][$i]);
                $imagenes_binaries[] = $imagen_binario;

                // Guardar la imagen en el servidor
                $destination = $upload_dir . $imagen_hash_name . ".png";
                if (!move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $destination)) {
                    throw new Exception('Error al subir la imagen ' . ($i + 1));
                }
            }
        }
    }

    // Recibir videos de YouTube
    $videos = $_POST['videos'];
    $videos = array_filter($videos); // Filtrar entradas vacías
    $video1 = $videos[0] ?? null;
    $video2 = $videos[1] ?? null;
    $video3 = $videos[2] ?? null;

    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Llamar al procedimiento almacenado para obtener el ID interno
        $stmt_sp = $pdo->prepare("CALL SP_GLOBAL_GET_ID_INTERNAL_USER(:usuario_externo_id, @usuario_interno_id)");
        $stmt_sp->bindValue(':usuario_externo_id', $usuario_externo_id);
        $stmt_sp->execute();

        // Obtener el ID interno del usuario
        $result = $pdo->query("SELECT @usuario_interno_id AS usuario_interno_id")->fetch(PDO::FETCH_ASSOC);
        $usuario_interno_id = $result['usuario_interno_id'];
        if ($usuario_interno_id == 0) {
            throw new Exception('Usuario no encontrado.');
        }

        // Generar IDs externos e internos del hilo
        $THD_EXTERNAL_ID = sha1("BASE_ID_EXTERNO" . rand() . microtime(true));
        $THD_INTERNAL_ID = sha1("BASE_ID_INTERNO" . rand() . microtime(true));

        // Inserción del hilo o encuesta
        if ($tipo === 'POLL') {
            $sql_thread = "INSERT INTO THREADS (
                THD_TITLE, THD_CONTENT, THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, THD_CREATOR_INTERNAL_ID,
                THD_EXTERNAL_ID, THD_INTERNAL_ID, THD_RESOURCE_BASE_PATH, THD_TYPE,
                THD_IMAGE_1_NAME, THD_IMAGE_1, THD_IMAGE_2_NAME, THD_IMAGE_2, THD_IMAGE_3_NAME, THD_IMAGE_3,
                THD_IMAGE_4_NAME, THD_IMAGE_4, THD_IMAGE_5_NAME, THD_IMAGE_5, THD_IMAGE_6_NAME, THD_IMAGE_6, THD_IMAGE_7_NAME, THD_IMAGE_7,
                THD_VIDEO_URL_1, THD_VIDEO_URL_2, THD_VIDEO_URL_3, THD_POLL_OPTION_1, THD_POLL_OPTION_2, THD_POLL_OPTION_3, THD_POLL_OPTION_4, THD_POLL_OPTION_5)
                VALUES (
                :titulo, :contenido, :categoria, :subcategoria, :usuario_interno_id,
                :THD_EXTERNAL_ID, :THD_INTERNAL_ID, :THD_RESOURCE_BASE_PATH, :tipo,
                :imagen1_name, :imagen1_blob, :imagen2_name, :imagen2_blob, :imagen3_name, :imagen3_blob,
                :imagen4_name, :imagen4_blob, :imagen5_name, :imagen5_blob, :imagen6_name, :imagen6_blob, :imagen7_name, :imagen7_blob,
                :video1, :video2, :video3, :opcion1, :opcion2, :opcion3, :opcion4, :opcion5)";
            
            $stmt_thread = $pdo->prepare($sql_thread);
            $stmt_thread->bindValue(':opcion1', $opcion1);
            $stmt_thread->bindValue(':opcion2', $opcion2);
            $stmt_thread->bindValue(':opcion3', $opcion3);
            $stmt_thread->bindValue(':opcion4', $opcion4);
            $stmt_thread->bindValue(':opcion5', $opcion5);
        } else {
            $sql_thread = "INSERT INTO THREADS (
                THD_TITLE, THD_CONTENT, THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, THD_CREATOR_INTERNAL_ID,
                THD_EXTERNAL_ID, THD_INTERNAL_ID, THD_RESOURCE_BASE_PATH, THD_TYPE,
                THD_IMAGE_1_NAME, THD_IMAGE_1, THD_IMAGE_2_NAME, THD_IMAGE_2, THD_IMAGE_3_NAME, THD_IMAGE_3,
                THD_IMAGE_4_NAME, THD_IMAGE_4, THD_IMAGE_5_NAME, THD_IMAGE_5, THD_IMAGE_6_NAME, THD_IMAGE_6, THD_IMAGE_7_NAME, THD_IMAGE_7,
                THD_VIDEO_URL_1, THD_VIDEO_URL_2, THD_VIDEO_URL_3)
                VALUES (
                :titulo, :contenido, :categoria, :subcategoria, :usuario_interno_id,
                :THD_EXTERNAL_ID, :THD_INTERNAL_ID, :THD_RESOURCE_BASE_PATH, :tipo,
                :imagen1_name, :imagen1_blob, :imagen2_name, :imagen2_blob, :imagen3_name, :imagen3_blob,
                :imagen4_name, :imagen4_blob, :imagen5_name, :imagen5_blob, :imagen6_name, :imagen6_blob, :imagen7_name, :imagen7_blob,
                :video1, :video2, :video3)";
            
            $stmt_thread = $pdo->prepare($sql_thread);
        }

        // Vinculación de los parámetros comunes a ambos tipos (THREAD y POLL)
        $stmt_thread->bindValue(':titulo', $titulo);
        $stmt_thread->bindValue(':contenido', $contenido);
        $stmt_thread->bindValue(':categoria', $categoria);
        $stmt_thread->bindValue(':subcategoria', $subcategoria);
        $stmt_thread->bindValue(':usuario_interno_id', $usuario_interno_id);
        $stmt_thread->bindValue(':THD_EXTERNAL_ID', $THD_EXTERNAL_ID);
        $stmt_thread->bindValue(':THD_INTERNAL_ID', $THD_INTERNAL_ID);
        $stmt_thread->bindValue(':THD_RESOURCE_BASE_PATH', $THD_RESOURCE_BASE_PATH);
        $stmt_thread->bindValue(':tipo', $tipo);
        
        // Guardar las imágenes como BLOBs y hashes
        $stmt_thread->bindValue(':imagen1_name', $imagenes_names[0] ?? null);
        $stmt_thread->bindValue(':imagen1_blob', $imagenes_binaries[0] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen2_name', $imagenes_names[1] ?? null);
        $stmt_thread->bindValue(':imagen2_blob', $imagenes_binaries[1] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen3_name', $imagenes_names[2] ?? null);
        $stmt_thread->bindValue(':imagen3_blob', $imagenes_binaries[2] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen4_name', $imagenes_names[3] ?? null);
        $stmt_thread->bindValue(':imagen4_blob', $imagenes_binaries[3] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen5_name', $imagenes_names[4] ?? null);
        $stmt_thread->bindValue(':imagen5_blob', $imagenes_binaries[4] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen6_name', $imagenes_names[5] ?? null);
        $stmt_thread->bindValue(':imagen6_blob', $imagenes_binaries[5] ?? null, PDO::PARAM_LOB);
        $stmt_thread->bindValue(':imagen7_name', $imagenes_names[6] ?? null);
        $stmt_thread->bindValue(':imagen7_blob', $imagenes_binaries[6] ?? null, PDO::PARAM_LOB);

        $stmt_thread->bindValue(':video1', $video1);
        $stmt_thread->bindValue(':video2', $video2);
        $stmt_thread->bindValue(':video3', $video3);

        $stmt_thread->execute();

        echo "Hilo o encuesta creado exitosamente.";

    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
