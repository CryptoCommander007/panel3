<?php
// Incluir la configuración de la base de datos
include 'db_config.php';

try {
    // Conectar a la base de datos
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener todos los campos de los primeros 100 hilos
    $sql_threads = "SELECT * FROM THREADS ORDER BY THD_CREATION_DATE DESC LIMIT 100";
    $stmt_threads = $pdo->prepare($sql_threads);
    $stmt_threads->execute();
    $threads = $stmt_threads->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los hilos
    return $threads;

} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
    return [];
}
?>
