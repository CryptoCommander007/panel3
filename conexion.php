<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";  // Asegúrate de usar la contraseña de root
$dbname = "foro_emprende";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    // Solo si necesitas ver un mensaje de conexión exitosa
    echo "Conexión exitosa a la base de datos $dbname";
}
?>
