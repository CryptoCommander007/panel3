<?php
require_once 'config_jwt.php';  // Incluir el archivo de configuración del JWT

// Función que verifica si el usuario tiene una cookie válida y redirige si es necesario
function verificarAccesoUsuario() {
    // Verificar si existe la cookie 'invitation_access'
    if (isset($_COOKIE['invitation_access'])) {
        $token = $_COOKIE['invitation_access'];

        // Verificar si el token (ID externo) es válido
        $data = verifyJWT($token);

        if ($data !== null) {
            // La cookie es válida, redirigir al archivo home_invited.php
            header("Location: backend-invitation/protected/home_invited.php");
            exit();
        }
        // Si no es válida, simplemente continuar
    }
    // Si no existe la cookie, continuar con la ejecución normal de la página
}
