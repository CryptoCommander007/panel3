<?php
require_once __DIR__ . '/../vendor/autoload.php';  // Asegúrate de que la ruta al autoloader sea correcta
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTConfig {
    private static $secretKey = "your_secret_key";  // Cambia esto por una clave secreta segura

    // Función para crear un JWT
    public static function createJWT($codigo_externo) {
        $payload = [
            "iss" => "your_domain.com",  // Emisor
            "iat" => time(),             // Hora de emisión
            "exp" => time() + (60 * 60), // Expiración (1 hora)
            "codigo_externo" => $codigo_externo  // Datos que quieres almacenar en el token
        ];

        // Crear y devolver el JWT
        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    // Función para decodificar un JWT
    public static function decodeJWT($jwt) {
        try {
            return JWT::decode($jwt, new Key(self::$secretKey, 'HS256'));
        } catch (Exception $e) {
            throw new Exception("Error al decodificar el JWT: " . $e->getMessage());
        }
    }

    // Verificar si el JWT ha expirado
    public static function isJWTExpired($jwt) {
        $decoded = self::decodeJWT($jwt);
        return (time() > $decoded->exp);
    }
}
?>
