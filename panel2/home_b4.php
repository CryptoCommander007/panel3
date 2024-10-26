<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>USUARIOS INVITADO</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">INVITADO</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="home.php" class="nav-item nav-link active" style="font-size: 1.2rem; background-color: #003366; color: white;">
                        <i class="fas fa-home me-2" style="color: #003366;"></i>Inicio
                    </a>
                    <a href="info.php" class="nav-item nav-link" style="font-size: 1.2rem;">
                        <i class="fas fa-info-circle me-2"></i>Información
                    </a>
                    <a href="profile.php" class="nav-item nav-link" style="font-size: 1.2rem;">
                        <i class="fas fa-user me-2"></i>Cerrar Sesión
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
            </nav>
            <!-- Navbar End -->

            <!-- Foro Emprendedor Section -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Foro Emprendedor y Anuncios</h3>

                            <!-- Tabla para pantallas grandes -->
                            <div class="table-responsive d-none d-md-block">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">Icono</th>
                                            <th class="text-center">Categoría</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Temas</th>
                                            <th class="text-center">Respuestas</th>
                                            <th class="text-center">Último Mensaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $category => $subcategories): ?>
                                            <tr>
                                                <td colspan="6" class="bg-secondary text-white text-center">
                                                    <strong><?php echo strtoupper($category); ?></strong>
                                                </td>
                                            </tr>
                                            <?php foreach ($subcategories as $subcategory): ?>
                                                <tr>
                                                    <td class="table-icon text-center">
                                                        <i class="<?php echo $subcategory['icon']; ?> text-primary"></i>
                                                    </td>
                                                    <td class="table-text text-center">
                                                        <strong><?php echo $subcategory['subcategory']; ?></strong>
                                                    </td>
                                                    <td class="table-text text-center">
                                                        <small><?php echo $subcategory['description']; ?></small>
                                                    </td>
                                                    <td class="table-text text-center">
                                                        <strong><?php echo $subcategory['thread_count']; ?></strong>
                                                    </td>
                                                    <td class="table-text text-center">
                                                        <strong><?php echo $subcategory['answer_count']; ?></strong>
                                                    </td>
                                                    <td class="table-text text-center">
                                                        <?php if ($subcategory['last_post_title'] && $subcategory['last_post_user']): ?>
                                                            <small><?php echo $subcategory['last_post_title']; ?><br>
                                                            por <strong><?php echo $subcategory['last_post_user']; ?></strong></small>
                                                        <?php else: ?>
                                                            <small>No hay mensajes recientes</small>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tarjetas para pantallas pequeñas -->
                            <div class="d-block d-md-none">
                                <?php foreach ($categories as $category => $subcategories): ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo strtoupper($category); ?></h5>
                                            <?php foreach ($subcategories as $subcategory): ?>
                                                <div class="d-flex mb-3">
                                                    <i class="<?php echo $subcategory['icon']; ?> fa-2x text-primary me-3"></i>
                                                    <div>
                                                        <h6><?php echo $subcategory['subcategory']; ?></h6>
                                                        <p class="small text-muted"><?php echo $subcategory['description']; ?></p>
                                                        <p class="small">Temas: <?php echo $subcategory['thread_count']; ?></p>
                                                        <p class="small">Respuestas: <?php echo $subcategory['answer_count']; ?></p>
                                                        <?php if ($subcategory['last_post_title'] && $subcategory['last_post_user']): ?>
                                                            <p class="small">Último post: <?php echo $subcategory['last_post_title']; ?><br>
                                                            por <?php echo $subcategory['last_post_user']; ?></p>
                                                        <?php else: ?>
                                                            <p class="small">No hay mensajes recientes</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Foro Emprendedor Section End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 text-center">
                            <small>&copy; Your Company. All Rights Reserved.</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
