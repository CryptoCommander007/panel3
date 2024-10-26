<?php
require_once 'vendor/autoload.php';  // Asegúrate de que cargue el autoload de Composer

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_SECRET', 'your_secret_key');  // Cambia esta clave secreta por algo seguro
define('JWT_ALGORITHM', 'HS256');

// Función para generar el JWT
function generateJWT($external_id) {
    $current_time = time();
    $payload = [
        'iat' => $current_time,  // Tiempo en que se genera el token
        'exp' => $current_time + (60 * 60),  // Token válido por 1 hora
        'data' => [
            'external_id' => $external_id
        ]
    ];

    return JWT::encode($payload, JWT_SECRET, JWT_ALGORITHM);
}

// Función para verificar el JWT
function verifyJWT($token) {
    try {
        // Decodificar el JWT
        $decoded = JWT::decode($token, new Key(JWT_SECRET, JWT_ALGORITHM));
        return (array) $decoded->data;  // Retornar los datos decodificados
    } catch (Exception $e) {
        // Si hay un error al decodificar, retornar null
        return null;
    }
}
?>
