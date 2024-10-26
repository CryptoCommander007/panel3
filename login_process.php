<?php
require_once 'config_db.php';  // Archivo de configuración de la base de datos
require_once 'config_jwt.php'; // Archivo de configuración del JWT

// Capturar los datos enviados desde el formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Conectar a la base de datos
$connection = connectDB();

// Llamar al procedimiento almacenado para autenticar al usuario
$stmt = $connection->prepare("CALL SP_AUTHENTICATE_USER(?, ?, @P_RESULT, @P_EXTERNAL_ID)");
$stmt->bind_param('ss', $email, $password);
$stmt->execute();

// Consultar los valores devueltos por el procedimiento almacenado
$result = $connection->query("SELECT @P_RESULT AS IS_VALID, @P_EXTERNAL_ID AS EXTERNAL_ID");
$data = $result->fetch_assoc();

// Verificar si la autenticación fue exitosa
if ($data['IS_VALID'] == 1) {
    // Autenticación exitosa, generar el JWT
    $external_id = $data['EXTERNAL_ID'];
    $token_jwt = generateJWT($external_id);

    // Establecer una cookie con el token JWT
    setcookie("auth_token", $token_jwt, time() + (86400 * 30), "/", "", false, true);  // Cookie válida por 30 días

    // Redirigir al archivo de inicio del sistema (home)
    header("Location: protected/home.php");
    exit();
} else {
    // Autenticación fallida, mostrar un mensaje de error
    echo "Authentication failed. Please check your email and password.";
}

// Cerrar la conexión a la base de datos
$connection->close();
?>
