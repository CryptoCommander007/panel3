<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Hilo</title>
</head>
<body>
    <h2>Crear un nuevo hilo</h2>
    <form action="controlador.php" method="POST">
        <!-- Título del hilo -->
        <label for="titulo">Título del Hilo:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <!-- Descripción del hilo -->
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="3" required></textarea><br><br>

        <!-- Categoría -->
        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria" required>
            <option value="EMPRESAS_CHILE">EMPRESAS CHILE</option>
            <!-- Agrega más categorías si es necesario -->
        </select><br><br>

        <!-- Subcategoría -->
        <label for="subcategoria">Subcategoría:</label>
        <select id="subcategoria" name="subcategoria" required>
            <option value="3fd56c8e20082cf04527e1c96da3e2528346fbfb0de2d9aa0872ebaf9edf4399">CREACION-GESTION-MANTENCION EMPRESA</option>
            <!-- Aquí puedes agregar más códigos de subcategorías si es necesario -->
        </select><br><br>

        <!-- Contenido del hilo -->
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" rows="6" required></textarea><br><br>

        <!-- Botón para crear el hilo -->
        <button type="submit">Crear Hilo</button>
    </form>
</body>
</html>

