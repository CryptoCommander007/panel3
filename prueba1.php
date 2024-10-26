<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$usuario = 'root';
$contrasena = ''; // Cambia si tienes contraseña
$nombre_base_datos = 'prueba_texto';

// Conexión a la base de datos
$conn = new mysqli($host, $usuario, $contrasena, $nombre_base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenido = $_POST['contenido'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO texto (contenido) VALUES (?)");
    $stmt->bind_param("s", $contenido);

    if ($stmt->execute()) {
        echo "Texto ingresado correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Texto</title>
    <script>
        function contarCaracteres() {
            var contenido = document.getElementById('contenido').value;
            var contador = document.getElementById('contador');
            contador.innerText = 'Caracteres ingresados: ' + contenido.length + '/7000';
        }
    </script>
</head>
<body>
    <h1>Ingresar Texto</h1>
    <form method="post" action="">
        <textarea id="contenido" name="contenido" rows="20" cols="80" maxlength="7000" oninput="contarCaracteres()" required></textarea><br>
        <p id="contador">Caracteres ingresados: 0/7000</p>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
