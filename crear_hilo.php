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
    <script>
        // Previsualización de las imágenes seleccionadas
        function previewImages() {
            var preview = document.querySelector('#preview');
            preview.innerHTML = ''; // Limpiar el contenedor de previsualización

            var files = document.querySelector('input[type=file]').files;
            if (files.length > 7) {
                alert("Solo puedes subir un máximo de 7 imágenes.");
                return;
            }
            
            if (files) {
                [].forEach.call(files, function(file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px'; // Ajustar tamaño de previsualización
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        // Mostrar u ocultar opciones de encuesta según el tipo seleccionado
        function togglePollOptions() {
            var tipo = document.getElementById('tipo').value;
            var pollOptions = document.getElementById('poll-options');
            if (tipo === 'ENCUESTA') {
                pollOptions.style.display = 'block';
            } else {
                pollOptions.style.display = 'none';
            }
        }

        // Validar si las opciones de encuesta son correctas
        function validateForm() {
            var tipo = document.getElementById('tipo').value;
            if (tipo === 'ENCUESTA') {
                var opciones = document.querySelectorAll('.poll-option');
                var filledOptions = 0;
                opciones.forEach(function(option) {
                    if (option.value.trim() !== '') {
                        filledOptions++;
                    }
                });
                if (filledOptions < 2) {
                    alert("Debes ingresar al menos 2 opciones para la encuesta.");
                    return false;
                }
                if (filledOptions > 5) {
                    alert("Solo puedes ingresar hasta 5 opciones.");
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <h2>Crear un nuevo hilo o encuesta</h2>
    <form action="controlador.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
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

        <!-- Tipo de hilo -->
        <label for="tipo">Tipo de hilo:</label>
        <select id="tipo" name="tipo" required onchange="togglePollOptions()">
            <option value="HILO">Hilo</option>
            <option value="ENCUESTA">Encuesta</option>
        </select><br><br>

        <!-- Contenido del hilo -->
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" rows="6" required></textarea><br><br>

        <!-- Subida de imágenes -->
        <label for="imagenes">Subir imágenes (Máximo 7):</label>
        <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple onchange="previewImages()"><br><br>

        <!-- Previsualización de imágenes -->
        <div id="preview"></div>

        <!-- Opciones de encuesta (se muestran solo si se selecciona "Encuesta") -->
        <div id="poll-options" style="display:none;">
            <h3>Opciones de la encuesta (Mínimo 2, Máximo 5)</h3>
            <input type="text" class="poll-option" name="opcion1" placeholder="Opción 1"><br>
            <input type="text" class="poll-option" name="opcion2" placeholder="Opción 2"><br>
            <input type="text" class="poll-option" name="opcion3" placeholder="Opción 3"><br>
            <input type="text" class="poll-option" name="opcion4" placeholder="Opción 4"><br>
            <input type="text" class="poll-option" name="opcion5" placeholder="Opción 5"><br><br>
        </div>

        <!-- Subida de videos -->
        <label for="videos">URLs de videos (Máximo 3):</label>
        <input type="url" name="videos[]" placeholder="Video URL 1"><br>
        <input type="url" name="videos[]" placeholder="Video URL 2"><br>
        <input type="url" name="videos[]" placeholder="Video URL 3"><br><br>

        <!-- Botón para crear el hilo -->
        <button type="submit">Crear Hilo o Encuesta</button>
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
                <p><small>ID del hilo: <?= $thread['THD_EXTERNAL_ID'] ?></small></p>
                <p><small>Creador ID: <?= $thread['THD_CREATOR_INTERNAL_ID'] ?></small></p>
                <p><small>Categoría: <?= $thread['THD_CATEGORY_CODE'] ?></small></p>
                <p><small>Subcategoría: <?= $thread['THD_SUBCATEGORY_CODE'] ?></small></p>
                <p><small>Tipo: <?= $thread['THD_TYPE'] ?></small></p>
                <p><small>Visibilidad: <?= $thread['THD_VISIBILITY'] ?></small></p>

                <!-- Si hay imágenes o videos asociados -->
                <?php if ($thread['THD_IMAGE_1_NAME']): ?>
                    <p><small>Imagen 1: <img src="<?= 'uploads/' . htmlspecialchars($thread['THD_IMAGE_1_NAME']) ?>" alt="Imagen 1"></small></p>
                <?php endif; ?>
                <?php if ($thread['THD_VIDEO_URL_1']): ?>
                    <p><small>Video 1: <a href="<?= htmlspecialchars($thread['THD_VIDEO_URL_1']) ?>" target="_blank">Ver Video</a></small></p>
                <?php endif; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron hilos.</p>
    <?php endif; ?>
</body>
</html>
