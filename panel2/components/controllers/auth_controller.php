<?php
require_once __DIR__ . '../../../config/db_config.php';  // Conexión a la base de datos
require_once __DIR__ . '../../../config/JWT_config.php';  // Configuración de JWT

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Conectarse a la base de datos
    $conexion = conectarDB();

    // Preparar el SP para autenticar al usuario con variables de salida
    $stmt = $conexion->prepare("CALL AUTHENTICATE_GUEST_USER(?, ?, @resultado, @codigo_externo)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    // Obtener el resultado y el código externo desde el SP
    $result = $conexion->query("SELECT @resultado AS resultado, @codigo_externo AS codigo_externo")->fetch_assoc();

    if ($result['resultado'] == 1) {
        // Si la autenticación es exitosa, generar el JWT
        $codigo_externo = $result['codigo_externo'];
        $jwt = JWTConfig::createJWT($codigo_externo);

        // Almacenar el JWT en una cookie
        setcookie("access_token", $jwt, time() + (60 * 60), "/", "", true, true);

        // Redirigir al usuario a la página principal
        header("Location: ../home.php");
        exit();
    } else {
        // Si falla la autenticación, redirigir al login con un error
        header("Location: ../login.php?error=1");
        exit();
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
