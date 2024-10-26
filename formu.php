<?php
include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos enviados por el formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $ip_address = $_SERVER['REMOTE_ADDR']; // Obtener la IP del usuario
    $device_id = $_POST['device_id']; // Podrías generar o capturar esto según sea necesario

    // Preparar la llamada al procedimiento almacenado
    $stmt = $conn->prepare("CALL SP_REGISTER_USER(?, ?, ?, ?, ?, ?, @result)");
    $stmt->bind_param("ssssss", $username, $email, $password, $country, $ip_address, $device_id);

    // Ejecutar el procedimiento
    if ($stmt->execute()) {
        // Obtener el resultado del procedimiento almacenado
        $result_query = $conn->query("SELECT @result as result");
        $row = $result_query->fetch_assoc();

        // Verificar el resultado
        if ($row['result'] == 1) {
            echo "Registro exitoso!";
        } else {
            echo "Error: El nombre de usuario o correo ya existe.";
        }
    } else {
        echo "Error al ejecutar el procedimiento.";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="POST" action="formu.php">
        <label for="username">Nombre de Usuario:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="country">País:</label><br>
        <input type="text" id="country" name="country" required><br><br>

        <label for="device_id">ID del Dispositivo:</label><br>
        <input type="text" id="device_id" name="device_id" required><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
