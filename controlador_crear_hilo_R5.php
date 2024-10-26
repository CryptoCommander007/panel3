<?php
// Incluir la configuración de la base de datos y JWT
include 'db_config.php';
require_once 'config_jwt.php'; // Configuración del JWT

// Verificar si el token JWT está presente en la cookie
if (!isset($_COOKIE['auth_token'])) {
    // Si no existe el token, redirigir al login
    header("Location: login_form.php");
    exit();
}

// Verificar y decodificar el token JWT
$token = $_COOKIE['auth_token'];
$user_data = verifyJWT($token);

if ($user_data === null) {
    // Si el token no es válido, redirigir al login
    header("Location: login_form.php");
    exit();
}

// Obtener el ID externo del usuario del token JWT
$usuario_externo_id = $user_data['external_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $contenido = $_POST['contenido'];
    $tipo = $_POST['tipo'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];

    // Recibir videos de YouTube
    $videos = $_POST['videos'];
    $videos = array_filter($videos); // Filtrar entradas vacías

    // Variables individuales para los videos
    $video1 = $videos[0] ?? null;
    $video2 = $videos[1] ?? null;
    $video3 = $videos[2] ?? null;

    // Manejar subida de imágenes y generar rutas con hashes aleatorios
    $imagenes = [];
    $imagenes_paths = [];
    if (!empty($_FILES['imagenes']['name'][0])) {
        for ($i = 0; $i < count($_FILES['imagenes']['name']); $i++) {
            if ($i < 7) { // Limitar a 7 imágenes
                $imagenes[] = file_get_contents($_FILES['imagenes']['tmp_name'][$i]);
                $hash_imagen = sha1(uniqid(rand(), true));
                $imagenes_paths[] = "img/" . $hash_imagen . ".png";
            }
        }
    }

    // Conectar a la base de datos
    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Llamar al procedimiento almacenado para obtener el ID interno
        $stmt_sp = $pdo->prepare("CALL SP_GLOBAL_GET_ID_INTERNAL_USER(:usuario_externo_id, @usuario_interno_id)");
        $stmt_sp->bindParam(':usuario_externo_id', $usuario_externo_id);
        $stmt_sp->execute();

        // Obtener el valor de @usuario_interno_id
        $result = $pdo->query("SELECT @usuario_interno_id AS usuario_interno_id")->fetch(PDO::FETCH_ASSOC);
        $usuario_interno_id = $result['usuario_interno_id'];

        if ($usuario_interno_id == 0) {
            throw new Exception('Usuario no encontrado.');
        }

        // Generar THD_EXTERNAL_ID_THREADS y THD_INTERNAL_ID_THREADS como hashes
        $THD_EXTERNAL_ID_THREADS = sha1("BASE_ID_EXTERNO" . rand() . microtime(true));
        $THD_INTERNAL_ID_THREADS = sha1("BASE_ID_INTERNO" . rand() . microtime(true));

        $THD_RESOURCE_BASE_PATH = "resources/" . sha1(uniqid(rand(), true)) . "/";

        // Insertar el hilo en la tabla
        $sql_thread = "INSERT INTO THREADS (
            THD_TITLE, THD_CONTENT, THD_TIP, THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, 
            THD_VIDEO_URL_1, THD_VIDEO_URL_2, THD_VIDEO_URL_3, 
            THD_IMAGE_1, THD_IMAGE_1_PATH, THD_IMAGE_2, THD_IMAGE_2_PATH, THD_IMAGE_3, THD_IMAGE_3_PATH, 
            THD_IMAGE_4, THD_IMAGE_4_PATH, THD_IMAGE_5, THD_IMAGE_5_PATH, THD_IMAGE_6, THD_IMAGE_6_PATH, 
            THD_IMAGE_7, THD_IMAGE_7_PATH, 
            THD_CREATOR_INTERNAL_ID, THD_EXTERNAL_ID_THREADS, THD_INTERNAL_ID_THREADS, THD_RESOURCE_BASE_PATH)
            VALUES (
            :titulo, :contenido, :tipo, :categoria, :subcategoria, 
            :video1, :video2, :video3, 
            :imagen1, :imagen1_path, :imagen2, :imagen2_path, :imagen3, :imagen3_path, 
            :imagen4, :imagen4_path, :imagen5, :imagen5_path, :imagen6, :imagen6_path, 
            :imagen7, :imagen7_path, 
            :usuario_interno_id, :THD_EXTERNAL_ID_THREADS, :THD_INTERNAL_ID_THREADS, :THD_RESOURCE_BASE_PATH)";
        
        $stmt_thread = $pdo->prepare($sql_thread);
        $stmt_thread->bindParam(':titulo', $titulo);
        $stmt_thread->bindParam(':contenido', $contenido);
        $stmt_thread->bindParam(':tipo', $tipo);
        $stmt_thread->bindParam(':categoria', $categoria);
        $stmt_thread->bindParam(':subcategoria', $subcategoria);
        $stmt_thread->bindParam(':video1', $video1);
        $stmt_thread->bindParam(':video2', $video2);
        $stmt_thread->bindParam(':video3', $video3);
        $stmt_thread->bindParam(':imagen1', $imagenes[0], PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen1_path', $imagenes_paths[0]);
        $stmt_thread->bindParam(':imagen2', $imagenes[1], PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen2_path', $imagenes_paths[1]);
        $stmt_thread->bindParam(':imagen3', $imagenes[2], PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen3_path', $imagenes_paths[2]);
        // Continúa enlazando las imágenes restantes si las hay...
        
        $stmt_thread->execute();

        echo "Thread created successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
