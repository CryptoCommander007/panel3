<?php
// Función para cerrar sesión
function logoutInvitation() {
    // Verificar si la cookie 'invitation_access' existe
    if (isset($_COOKIE['invitation_access'])) {
        // Eliminar la cookie estableciendo su fecha de expiración en el pasado
        setcookie('invitation_access', '', time() - 3600, '/');  // Cookie expirada
        
        // Redirigir al usuario a la página de inicio de sesión o a cualquier otra página
        header("Location: ../client-access.php");
        exit();
    }
}

// Llamar a la función de cierre de sesión
logoutInvitation();
?>
