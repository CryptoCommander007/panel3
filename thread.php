<?php
// Incluir el archivo que obtiene los datos de los hilos
$threads = require 'get_data_thread.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Hilos</title>
</head>
<body>
    <h2>Foro de Hilos</h2>

    <!-- Mostrar los hilos -->
    <?php if (count($threads) > 0): ?>
        <?php foreach ($threads as $thread): ?>
            <div class="thread">
                <h3><?= htmlspecialchars($thread['THD_TITLE']) ?></h3>
                <p><?= htmlspecialchars($thread['THD_CONTENT']) ?></p>
                <p><small>Fecha de creación: <?= $thread['THD_CREATION_DATE'] ?></small></p>

                <!-- Mostrar las imágenes asociadas -->
                <?php if ($thread['THD_IMAGE_1']): ?>
                    <p><small>Imagen 1: <img src="data:image/png;base64,<?= base64_encode($thread['THD_IMAGE_1']) ?>" alt="Imagen 1"></small></p>
                <?php endif; ?>

                <!-- Mostrar videos asociados -->
                <?php if ($thread['THD_VIDEO_URL_1']): ?>
                    <p><small>Video 1: <a href="<?= htmlspecialchars($thread['THD_VIDEO_URL_1']) ?>" target="_blank">Ver Video</a></small></p>
                <?php endif; ?>

                <!-- Mostrar opciones si es encuesta -->
                <?php if ($thread['THD_TYPE'] === 'POLL'): ?>
                    <p><strong>Opciones de la encuesta:</strong></p>
                    <ul>
                        <?php if ($thread['THD_POLL_OPTION_1']) echo "<li>" . htmlspecialchars($thread['THD_POLL_OPTION_1']) . "</li>"; ?>
                        <?php if ($thread['THD_POLL_OPTION_2']) echo "<li>" . htmlspecialchars($thread['THD_POLL_OPTION_2']) . "</li>"; ?>
                        <?php if ($thread['THD_POLL_OPTION_3']) echo "<li>" . htmlspecialchars($thread['THD_POLL_OPTION_3']) . "</li>"; ?>
                        <?php if ($thread['THD_POLL_OPTION_4']) echo "<li>" . htmlspecialchars($thread['THD_POLL_OPTION_4']) . "</li>"; ?>
                        <?php if ($thread['THD_POLL_OPTION_5']) echo "<li>" . htmlspecialchars($thread['THD_POLL_OPTION_5']) . "</li>"; ?>
                    </ul>
                <?php endif; ?>

                <!-- Mostrar botón dependiendo del tipo de hilo -->
                <?php if ($thread['THD_TYPE'] === 'POLL'): ?>
                    <button>Votar</button>
                <?php else: ?>
                    <button>Comentar</button>
                <?php endif; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron hilos.</p>
    <?php endif; ?>
</body>
</html>
