<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "GUEST_SYSTEM";

    // Capturar los datos enviados por el formulario
    $user_code = $_POST['user_code'];
    $user_password = $_POST['user_password'];

    try {
        // Crear la conexión a la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la llamada al procedimiento almacenado AUTHENTICATE_GUEST_USER
        $stmt = $conn->prepare("CALL AUTHENTICATE_GUEST_USER(:user_code, :user_password)");
        
        // Vincular los parámetros
        $stmt->bindParam(':user_code', $user_code);
        $stmt->bindParam(':user_password', $user_password);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado del SP (debería devolver una fila con dos columnas: success y external_id)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el SP retornó éxito (success = 1)
        if ($result['success'] == 1) {
            echo "Autenticación exitosa. External ID: " . $result['external_id'];
        } else {
            echo "Autenticación fallida. Usuario o contraseña incorrecta.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Autenticación de Usuario</title>
</head>
<body>
    <h2>Autenticación de Usuario</h2>
    <form method="POST" action="">
        <label for="user_code">Código de Usuario:</label><br>
        <input type="text" id="user_code" name="user_code" required><br><br>
        <label for="user_password">Contraseña:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <input type="submit" value="Autenticar">
    </form>
</body>
</html>
