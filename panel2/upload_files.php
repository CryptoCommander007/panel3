<!DOCTYPE html>
<html lang="es">

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

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Inicio -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">INVITADO</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="home.php" class="nav-item nav-link active" style="font-size: 1.2rem; background-color: #003366; color: white;">
                        <i class="fas fa-home me-2" style="color: #003366;"></i>Inicio
                    </a>
                    <a href="profile.php" class="nav-item nav-link" style="font-size: 1.2rem;">
                        <i class="fas fa-home me-2" style="color: #003366;"></i>Información
                    </a>
                    <a href="logout.php" class="nav-item nav-link" style="font-size: 1.2rem;">
                        <i class="fas fa-user me-2"></i>Cerrar Sesión
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar Fin -->

        <!-- Contenido Inicio -->
        <div class="content">
            <!-- Navbar Inicio -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color: #000000; font-size: 2rem; font-weight: bold; background-color: transparent; box-shadow: none; border: none;"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar Fin -->

            <!-- Contenido Principal -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">

                    <!-- Formulario de Subida de Archivos -->
                    <div class="container">
                        <form>
                            <!-- Subida de Archivos -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="files" class="form-label">Subir Imágenes</label>
                                    <input type="file" id="files" name="files[]" multiple accept="image/*" class="form-control" onchange="previewFiles()">
                                </div>
                            </div>

                            <!-- Galería de Imágenes -->
                            <div class="row mb-3">
                                <div class="col-md-12 gallery" id="gallery"></div>
                            </div>

                            <!-- Botón Guardar -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Guardar cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Script para mostrar la galería de imágenes -->
                    <script>
                        function previewFiles() {
                            var preview = document.getElementById('gallery');
                            var files = document.getElementById('files').files;
                            preview.innerHTML = "";  // Limpiar la galería primero

                            if (files) {
                                [].forEach.call(files, function(file) {
                                    var reader = new FileReader();

                                    reader.onload = function(event) {
                                        var img = document.createElement("img");
                                        img.src = event.target.result;
                                        img.style.width = "100px";
                                        img.style.height = "100px";
                                        img.style.objectFit = "cover";
                                        img.style.margin = "10px";
                                        preview.appendChild(img);
                                    }

                                    reader.readAsDataURL(file);
                                });
                            }
                        }
                    </script>
                </div>
            </div>

            <!-- Footer Inicio -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                    </div>
                </div>
            </div>
            <!-- Footer Fin -->
        </div>
        <!-- Contenido Fin -->

        <!-- Volver al inicio -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
