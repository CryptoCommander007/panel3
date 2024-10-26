<?php
require_once 'config_db.php';  // Incluir la configuración de la base de datos
require_once 'config_jwt.php';  // Incluir la configuración del JWT

// Capturar los datos enviados desde el formulario
$invitation_number = $_POST['invitation_number'];  // Número de invitación
$invitation_code = $_POST['invitation_code'];      // Código de invitación

// Conectarse a la base de datos
$connection = connectDB();

// Llamar al procedimiento almacenado para validar la invitación
$stmt = $connection->prepare("CALL SP_EXT_VALIDAR_ACCESO_INVITACION(?, ?, @P_VALIDO, @P_ID_EXTERNO)");
$stmt->bind_param('ss', $invitation_number, $invitation_code);
$stmt->execute();

// Consultar los valores devueltos
$result = $connection->query("SELECT @P_VALIDO AS IS_VALID, @P_ID_EXTERNO AS EXTERNAL_ID");
$data = $result->fetch_assoc();

// Verificar el resultado
if ($data['IS_VALID'] == 1) {
    // Invitación válida, generar el JWT
    $external_id = $data['EXTERNAL_ID'];
    $token_jwt = generateJWT($external_id);

    // Establecer una cookie con el ID externo, llamándola 'invitation_access'
    setcookie("invitation_access", $token_jwt, time() + (86400 * 30), "/", "", false, true);  // Cookie válida por 30 días

    // Redirigir al archivo home_invited.php en la carpeta protected
    header("Location: protected/home_invited.php");
    exit();
} else {
    // Invitación no válida
    echo "Acceso denegado. Código de invitación no válido.";
}

$connection->close();
