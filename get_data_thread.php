<?php
// Incluir la configuración de la base de datos
include 'db_config.php';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar la consulta para obtener todos los campos de la tabla THREADS
    $stmt = $pdo->prepare("SELECT 
        THD_ID, THD_EXTERNAL_ID, THD_INTERNAL_ID, THD_CREATOR_INTERNAL_ID, 
        THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, THD_TITLE, THD_CONTENT, 
        THD_RESOURCE_BASE_PATH, THD_IMAGE_1, THD_IMAGE_1_NAME, THD_IMAGE_2, 
        THD_IMAGE_2_NAME, THD_IMAGE_3, THD_IMAGE_3_NAME, THD_IMAGE_4, 
        THD_IMAGE_4_NAME, THD_IMAGE_5, THD_IMAGE_5_NAME, THD_IMAGE_6, 
        THD_IMAGE_6_NAME, THD_IMAGE_7, THD_IMAGE_7_NAME, THD_VIDEO_URL_1, 
        THD_VIDEO_URL_2, THD_VIDEO_URL_3, THD_CREATION_DATE, 
        THD_LAST_UPDATE_DATE, THD_STATUS, THD_TYPE, THD_VISIBILITY, 
        THD_IS_PINNED, THD_IS_EDITABLE, THD_IS_APPROVED, 
        THD_APPROVER_INTERNAL_ID, THD_POLL_OPTION_1, THD_POLL_OPTION_2, 
        THD_POLL_OPTION_3, THD_POLL_OPTION_4, THD_POLL_OPTION_5 
        FROM THREADS");
    
    // Ejecutar la consulta
    $stmt->execute();

    // Obtener todos los resultados en un array
    $threads = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los resultados
    return $threads;
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
    return [];
}
?>
