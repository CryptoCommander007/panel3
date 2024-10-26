<?php
$servername = "localhost";  // Cambia esto si es necesario
$username = "root";  // Tu usuario de MySQL
$password = "";  // Tu contraseña de MySQL
$dbname = "SISTEMA_BRIEF";  // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
