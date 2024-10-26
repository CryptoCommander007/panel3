<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login_process.php" method="POST">
        <!-- Campo para el correo electrónico -->
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Campo para la contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- Botón para enviar los datos -->
        <button type="submit">Iniciar Sesión</button>
    </form>

    <!-- Mostrar mensaje de error si la autenticación falla -->
    <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
        <p style="color: red;">Correo electrónico o contraseña incorrectos. Inténtalo de nuevo.</p>
    <?php endif; ?>
</body>
</html>
