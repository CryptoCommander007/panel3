<?php
// Incluir el archivo que obtiene los datos de los hilos
$threads = require 'get_data.php';
?>

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
        </select><br><br>

        <!-- Subcategoría -->
        <label for="subcategoria">Subcategoría:</label>
        <select id="subcategoria" name="subcategoria" required>
            <option value="3fd56c8e20082cf04527e1c96da3e2528346fbfb0de2d9aa0872ebaf9edf4399">CREACION-GESTION-MANTENCION EMPRESA</option>
        </select><br><br>

        <!-- Contenido del hilo -->
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" rows="6" required></textarea><br><br>

        <!-- Botón para crear el hilo -->
        <button type="submit">Crear Hilo</button>
    </form>

    <h2>Hilos recientes</h2>

    <!-- Mostrar los hilos recientes obtenidos -->
    <?php if (count($threads) > 0): ?>
        <?php foreach ($threads as $thread): ?>
            <div class="thread">
                <h3><?= htmlspecialchars($thread['THD_TITLE']) ?></h3>
                <p><?= htmlspecialchars($thread['THD_CONTENT']) ?></p>
                <p><small>Fecha de creación: <?= $thread['THD_CREATION_DATE'] ?></small></p>
                
                <!-- Mostrar otros campos del hilo -->
                <p><small>ID del hilo: <?= $thread['THD_EXTERNAL_ID_THREADS'] ?></small></p>
                <p><small>Creador ID: <?= $thread['THD_CREATOR_INTERNAL_ID'] ?></small></p>
                <p><small>Categoría: <?= $thread['THD_CATEGORY_CODE'] ?></small></p>
                <p><small>Subcategoría: <?= $thread['THD_SUBCATEGORY_CODE'] ?></small></p>
                <p><small>Tipo: <?= $thread['THD_TIP'] ?></small></p>
                <p><small>Visibilidad: <?= $thread['THD_VISIBILITY'] ?></small></p>

                <!-- Si hay imágenes o videos asociados -->
                <?php if ($thread['THD_IMAGE_1_PATH']): ?>
                    <p><small>Imagen 1: <img src="<?= htmlspecialchars($thread['THD_IMAGE_1_PATH']) ?>" alt="Imagen 1"></small></p>
                <?php endif; ?>
                <?php if ($thread['THD_VIDEO_URL_1']): ?>
                    <p><small>Video 1: <a href="<?= htmlspecialchars($thread['THD_VIDEO_URL_1']) ?>" target="_blank">Ver Video</a></small></p>
                <?php endif; ?>

                <!-- Puedes continuar agregando más campos según sea necesario -->
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron hilos.</p>
    <?php endif; ?>
</body>
</html>
