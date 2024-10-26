<?php
require_once 'config_jwt.php';  // Incluir la configuración del JWT

// Función para obtener el external_id desde la cookie
function getExternalIdFromCookie() {
    // Verificar si la cookie 'invitation_access' existe
    if (isset($_COOKIE['invitation_access'])) {
        $token = $_COOKIE['invitation_access'];  // Leer el token desde la cookie
        
        // Verificar el JWT y decodificarlo
        $decoded_data = verifyJWT($token);
        
        if ($decoded_data && isset($decoded_data['external_id'])) {
            // Retornar el external_id si es válido
            return $decoded_data['external_id'];
        } else {
            // Si el token no es válido o no contiene external_id
            return null;
        }
    } else {
        // Si la cookie no existe, retornar null
        return null;
    }
}

// Ejemplo de uso
$external_id = getExternalIdFromCookie();

if ($external_id) {
    echo "El external_id es: " . $external_id;
} else {
    echo "No se pudo obtener el external_id. Token no válido o no existe.";
}
?>
