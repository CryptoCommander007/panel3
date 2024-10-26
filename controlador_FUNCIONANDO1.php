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

// Verificar y decodificar el token JWT para obtener el ID externo del usuario
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
    $categoria = $_POST['categoria']; // Esto será 'EMPRESAS CHILE'
    $subcategoria = $_POST['subcategoria']; // El código de subcategoría '3fd56c8e20082cf04527e1c96da3e2528346fbfb0de2d9aa0872ebaf9edf4399'

    try {
        // Conectar a la base de datos
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Llamar al procedimiento almacenado para obtener el ID interno del usuario
        $stmt_sp = $pdo->prepare("CALL SP_GLOBAL_GET_ID_INTERNAL_USER(:usuario_externo_id, @usuario_interno_id)");
        $stmt_sp->bindParam(':usuario_externo_id', $usuario_externo_id);
        $stmt_sp->execute();

        // Obtener el valor de @usuario_interno_id
        $result = $pdo->query("SELECT @usuario_interno_id AS usuario_interno_id")->fetch(PDO::FETCH_ASSOC);
        $usuario_interno_id = $result['usuario_interno_id'];

        if ($usuario_interno_id == 0) {
            throw new Exception('Usuario no encontrado.');
        }

        // Generar los IDs externos e internos del hilo como hashes
        $THD_EXTERNAL_ID_THREADS = sha1("BASE_ID_EXTERNO" . rand() . microtime(true));
        $THD_INTERNAL_ID_THREADS = sha1("BASE_ID_INTERNO" . rand() . microtime(true));

        // Inserción del hilo en la tabla THREADS
        $sql_thread = "INSERT INTO THREADS (
            THD_TITLE, THD_CONTENT, THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, 
            THD_CREATOR_INTERNAL_ID, THD_EXTERNAL_ID_THREADS, THD_INTERNAL_ID_THREADS, 
            THD_RESOURCE_BASE_PATH)
            VALUES (
            :titulo, :contenido, :categoria, :subcategoria, 
            :usuario_interno_id, :THD_EXTERNAL_ID_THREADS, :THD_INTERNAL_ID_THREADS, null)"; // null para el campo THD_RESOURCE_BASE_PATH
        
        $stmt_thread = $pdo->prepare($sql_thread);
        $stmt_thread->bindParam(':titulo', $titulo);
        $stmt_thread->bindParam(':contenido', $contenido);
        $stmt_thread->bindParam(':categoria', $categoria); // Esto será 'EMPRESAS CHILE' o el código hash
        $stmt_thread->bindParam(':subcategoria', $subcategoria); // Aquí pasas el código de subcategoría '3fd56c8e20082cf04527e1c96da3e2528346fbfb0de2d9aa0872ebaf9edf4399'
        $stmt_thread->bindParam(':usuario_interno_id', $usuario_interno_id);
        $stmt_thread->bindParam(':THD_EXTERNAL_ID_THREADS', $THD_EXTERNAL_ID_THREADS);
        $stmt_thread->bindParam(':THD_INTERNAL_ID_THREADS', $THD_INTERNAL_ID_THREADS);

        // Ejecutar la consulta de inserción
        $stmt_thread->execute();

        echo "Hilo creado exitosamente.";
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
