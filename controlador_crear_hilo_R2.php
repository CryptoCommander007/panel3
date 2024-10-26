<?php
// Incluir la configuración de la base de datos
include 'db_config.php';

// Definir el ID externo del usuario (ya proporcionado)
$usuario_externo_id = '58cc0ff5cc1bc81fc705303dee2bda1bfae4bcd74a41e9be2b84c6b6a6e0bf8e';

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
                // Leer la imagen y crear un hash para su ruta
                $imagenes[] = file_get_contents($_FILES['imagenes']['tmp_name'][$i]);
                $hash_imagen = sha1(uniqid(rand(), true));
                $imagenes_paths[] = "img/" . $hash_imagen . ".png"; // Guardar la ruta de la imagen con el hash
            }
        }
    }

    // Variables individuales para las imágenes y rutas
    $imagen1 = $imagenes[0] ?? null;
    $imagen1_path = $imagenes_paths[0] ?? null;
    $imagen2 = $imagenes[1] ?? null;
    $imagen2_path = $imagenes_paths[1] ?? null;
    $imagen3 = $imagenes[2] ?? null;
    $imagen3_path = $imagenes_paths[2] ?? null;
    $imagen4 = $imagenes[3] ?? null;
    $imagen4_path = $imagenes_paths[3] ?? null;
    $imagen5 = $imagenes[4] ?? null;
    $imagen5_path = $imagenes_paths[4] ?? null;
    $imagen6 = $imagenes[5] ?? null;
    $imagen6_path = $imagenes_paths[5] ?? null;
    $imagen7 = $imagenes[6] ?? null;
    $imagen7_path = $imagenes_paths[6] ?? null;

    try {
        // Conectar a la base de datos
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Llamar al procedimiento almacenado para obtener el ID interno
        $stmt_sp = $pdo->prepare("CALL SP_GLOBAL_GET_ID_INTERNAL_USER(:usuario_externo_id, @usuario_interno_id)");
        $stmt_sp->bindParam(':usuario_externo_id', $usuario_externo_id);
        $stmt_sp->execute();

        // Obtener el valor de @usuario_interno_id
        $result = $pdo->query("SELECT @usuario_interno_id AS usuario_interno_id")->fetch(PDO::FETCH_ASSOC);
        $usuario_interno_id = $result['usuario_interno_id'];

        // Validar si se obtuvo un ID interno válido
        if ($usuario_interno_id == 0) {
            throw new Exception('Usuario no encontrado.');
        }

        // Generar THD_EXTERNAL_ID_THREADS y THD_INTERNAL_ID_THREADS como hashes
        $base_externo = "BASE_ID_EXTERNO";
        $base_interno = "BASE_ID_INTERNO";
        $THD_EXTERNAL_ID_THREADS = sha1($base_externo . rand() . microtime(true));  // Hash para ID externo
        $THD_INTERNAL_ID_THREADS = sha1($base_interno . rand() . microtime(true));  // Hash para ID interno

        // Generar la ruta base para los recursos del hilo usando un hash aleatorio
        $THD_RESOURCE_BASE_PATH = "resources/" . sha1(uniqid(rand(), true)) . "/";

        // Consulta para insertar el hilo
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
        $stmt_thread->bindParam(':imagen1', $imagen1, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen1_path', $imagen1_path);
        $stmt_thread->bindParam(':imagen2', $imagen2, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen2_path', $imagen2_path);
        $stmt_thread->bindParam(':imagen3', $imagen3, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen3_path', $imagen3_path);
        $stmt_thread->bindParam(':imagen4', $imagen4, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen4_path', $imagen4_path);
        $stmt_thread->bindParam(':imagen5', $imagen5, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen5_path', $imagen5_path);
        $stmt_thread->bindParam(':imagen6', $imagen6, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen6_path', $imagen6_path);
        $stmt_thread->bindParam(':imagen7', $imagen7, PDO::PARAM_LOB);
        $stmt_thread->bindParam(':imagen7_path', $imagen7_path);
        $stmt_thread->bindParam(':usuario_interno_id', $usuario_interno_id);
        $stmt_thread->bindParam(':THD_EXTERNAL_ID_THREADS', $THD_EXTERNAL_ID_THREADS);
        $stmt_thread->bindParam(':THD_INTERNAL_ID_THREADS', $THD_INTERNAL_ID_THREADS);
        $stmt_thread->bindParam(':THD_RESOURCE_BASE_PATH', $THD_RESOURCE_BASE_PATH);

        $stmt_thread->execute();

        echo "Hilo creado exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
