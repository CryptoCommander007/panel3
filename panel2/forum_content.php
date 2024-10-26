<?php
// Incluir el controlador que obtiene los datos
require 'get_data_forum.php';

// Obtener las categorías
$categories = get_forum_categories();
?>

<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h3 class="mb-4">Categorías del Foro</h3>
        <div class="table-responsive d-none d-md-block">
            <!-- Tabla solo visible en pantallas medianas y grandes -->
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Icono</th>
                        <th>Subcategoría</th>
                        <th>Descripción</th>
                        <th>Cantidad de Temas</th>
                        <th>Cantidad de Respuestas</th>
                        <th>Último Tema</th>
                        <th>Último Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($categories) > 0): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><i class="<?= htmlspecialchars($category['CAT_ICON_CLASS']); ?>" style="font-size: 1.5rem;"></i></td>
                                <td><?= htmlspecialchars($category['CAT_SUBCATEGORY_NAME']); ?></td>
                                <td><?= htmlspecialchars($category['CAT_SUBCATEGORY_DESCRIPTION']); ?></td>
                                <td><?= htmlspecialchars($category['total_temas']); ?></td>
                                <td><?= htmlspecialchars($category['total_respuestas']); ?></td>
                                <td><?= htmlspecialchars($category['ultimo_tema']) ?: 'N/A'; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($category['USER_PROFILE_IMAGE_PATH'])): ?>
                                            <img src="<?= htmlspecialchars($category['USER_PROFILE_IMAGE_PATH']); ?>" alt="Perfil" class="rounded-circle" style="width: 40px; height: 40px;">
                                        <?php else: ?>
                                            <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
                                        <?php endif; ?>
                                        <span class="ms-2"><?= htmlspecialchars($category['ultimo_usuario']) ?: 'N/A'; ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No se encontraron categorías en la base de datos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tarjetas para pantallas pequeñas -->
        <div class="d-block d-md-none">
            <?php if (count($categories) > 0): ?>
                <?php foreach ($categories as $category): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <i class="<?= htmlspecialchars($category['CAT_ICON_CLASS']); ?>" style="font-size: 1.5rem;"></i>
                                <h5 class="card-title"><?= htmlspecialchars($category['CAT_SUBCATEGORY_NAME']); ?></h5>
                            </div>
                            <p class="card-text"><?= htmlspecialchars($category['CAT_SUBCATEGORY_DESCRIPTION']); ?></p>
                            <p><strong>Temas:</strong> <?= htmlspecialchars($category['total_temas']); ?></p>
                            <p><strong>Respuestas:</strong> <?= htmlspecialchars($category['total_respuestas']); ?></p>
                            <p><strong>Último Tema:</strong> <?= htmlspecialchars($category['ultimo_tema']) ?: 'N/A'; ?></p>
                            <div class="d-flex align-items-center">
                                <?php if (!empty($category['USER_PROFILE_IMAGE_PATH'])): ?>
                                    <img src="<?= htmlspecialchars($category['USER_PROFILE_IMAGE_PATH']); ?>" alt="Perfil" class="rounded-circle" style="width: 40px; height: 40px;">
                                <?php else: ?>
                                    <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
                                <?php endif; ?>
                                <span class="ms-2"><?= htmlspecialchars($category['ultimo_usuario']) ?: 'N/A'; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron categorías en la base de datos.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
