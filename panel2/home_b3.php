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
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
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
            <a href="info.php" class="nav-item nav-link" style="font-size: 1.2rem;">
                <i class="fas fa-home me-2" style="color: #003366;"></i>Información
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
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>



            <!-- Navbar End -->
            <?php require 'components/home_option_main.php'; ?>
            <?php require 'components/home_options.php'; ?>



           <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Modal genérico de confirmación -->

            
<!-- Botones que requieren confirmación -->
<!-- Botones que requieren confirmación -->
<button type="button" class="btn btn-danger" data-action="delete" data-id="1">Eliminar</button>
<button type="button" class="btn btn-success" data-action="save" data-id="2">Guardar</button>

<!-- logica para trabajar modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let actionUrl = '';  // Variable para almacenar la acción
    let dataId = '';     // Variable para almacenar el ID (si es necesario)

    // Al hacer clic en un botón que tiene que mostrar el modal de confirmación
    document.querySelectorAll('button[data-action]').forEach(function (button) {
        button.addEventListener('click', function () {
            // Guardamos la acción y el ID del botón que fue clicado
            actionUrl = this.getAttribute('data-action');
            dataId = this.getAttribute('data-id');

            // Abrimos el modal de confirmación
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        });
    });

    // Al hacer clic en "Confirmar" dentro del modal de confirmación
    document.getElementById('confirmAction').addEventListener('click', function () {
        // Aquí realizamos la acción según el valor de actionUrl
        if (actionUrl) {
            fetch('prueba.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: actionUrl, id: dataId })
            })
            .then(response => response.json())
            .then(data => {
                // Aquí manejamos la respuesta y mostramos el segundo modal (éxito)
                showSuccessModal(data.message);
            })
            .catch(error => console.error('Error:', error));
        }

        // Cerrar el modal de confirmación
        var confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        confirmModal.hide();
    });

    // Función para mostrar el modal de éxito con un mensaje dinámico
    function showSuccessModal(message) {
        // Insertar el mensaje dinámico en el cuerpo del modal
        document.getElementById('successModalBody').innerText = message;

        // Mostrar el modal de éxito
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }
});
</script>




<div class="container-fluid pt-4 px-4">
        <!-- Sistema de pestañas con posicionamiento a la izquierda -->
        <ul class="nav nav-tabs justify-content-start"> <!-- Cambié a justify-content-start -->
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home">Información Contacto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#about">About</a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content bg-light p-3 mt-3">
            <div id="home" class="tab-pane fade show active">
                <h5>Información Contacto</h5>



                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded p-4">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellido" class="form-label">Apellido:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular" class="form-label">Celular:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" id="celular" placeholder="Celular">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="dni" class="form-label"></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="dni" placeholder="Número de D.N.I.">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="dni" class="form-label"></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="dni" placeholder="Número de D.N.I.">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger w-100"><i class="fas fa-save"></i> Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary w-100"><i class="fas fa-times"></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>








                <p>This is the content for the Home tab. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div id="profile" class="tab-pane fade">
                <h5>Información Empresa</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae elit libero, a pharetra augue.</p>
            </div>
            <div id="contact" class="tab-pane fade">
                <h5>Detalles</h5>
                <p>This is the content for the Contact tab. Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
            <div id="about" class="tab-pane fade">
                <h5>About Content</h5>
                <p>This is the content for the About tab. Donec id elit non mi porta gravida at eget metus.</p>
            </div>
        </div>
    </div>


<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="celular" class="form-label">Celular:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" class="form-control" id="celular" placeholder="Celular">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dni" class="form-label">Número de D.N.I.:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" id="dni" placeholder="Número de D.N.I.">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="passwordActual" class="form-label">Contraseña actual:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="passwordActual" placeholder="Contraseña actual">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="passwordNueva" class="form-label">Contraseña nueva:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="passwordNueva" placeholder="Contraseña nueva">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="passwordConfirmar" class="form-label">Confirmar contraseña nueva:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="passwordConfirmar" placeholder="Confirmar contraseña nueva">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-danger w-100"><i class="fas fa-save"></i> Guardar</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary w-100"><i class="fas fa-times"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>





            <!-- Form Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <!-- Contact Information Form -->
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4 shadow-sm">
                        <h6 class="mb-4"><i class="fas fa-user"></i> Información de contacto</h6>
                        <form>
                            <div class="mb-3">
                                <label for="inputName" class="form-label"><i class="fas fa-user"></i> Nombre</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Ingrese su nombre">
                            </div>
                            <div class="mb-3">
                                <label for="inputLastName" class="form-label"><i class="fas fa-user-tag"></i> Apellido</label>
                                <input type="text" class="form-control" id="inputLastName" placeholder="Ingrese su apellido">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="ejemplo@correo.com">
                            </div>
                            <div class="mb-3">
                                <label for="inputPhone" class="form-label"><i class="fas fa-phone-alt"></i> Teléfono de contacto</label>
                                <input type="tel" class="form-control" id="inputPhone" placeholder="Ingrese su número de teléfono">
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Actualizar</button>
                        </form>
                    </div>
                </div>

                <!-- Company Information Form -->
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4 shadow-sm">
                        <h6 class="mb-4"><i class="fas fa-building"></i> Información Empresa</h6>
                        <form>
                            <div class="mb-3">
                                <label for="inputCompanyName" class="form-label"><i class="fas fa-building"></i> Nombre Empresa</label>
                                <input type="text" class="form-control" id="inputCompanyName" placeholder="Ingrese el nombre de la empresa">
                            </div>
                            <div class="mb-3">
                                <label for="inputCompanyEmail" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                <input type="email" class="form-control" id="inputCompanyEmail" placeholder="empresa@correo.com">
                            </div>
                            <div class="mb-3">
                                <label for="inputRut" class="form-label"><i class="fas fa-id-card"></i> RUT</label>
                                <input type="text" class="form-control" id="inputRut" placeholder="Ingrese el RUT de la empresa">
                            </div>
                            <div class="mb-3">
                                <label for="inputCompanyPhone" class="form-label"><i class="fas fa-phone-alt"></i> Teléfono de contacto</label>
                                <input type="tel" class="form-control" id="inputCompanyPhone" placeholder="Ingrese el teléfono de la empresa">
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Información de contacto</h6>
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Apellido</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Telefono de contacto</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Información Empresa</h6>
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre Empresa</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Rut</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Telefono de contacto</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4 d-flex align-items-center">
                            <div class="icon-container d-flex justify-content-center align-items-center" style="width: 50px;">
                                <i class="bi bi-plus-circle" style="font-size: 2rem;"></i> <!-- Ícono de Crear Solicitud -->
                            </div>
                            <div class="title-container ps-3">
                                <h5>Crear Solicitud</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4 d-flex align-items-center">
                            <div class="icon-container d-flex justify-content-center align-items-center" style="width: 50px;">
                                <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i> <!-- Ícono de Mis Facturas -->
                            </div>
                            <div class="title-container ps-3">
                                <h5>Mis Facturas</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4 d-flex align-items-center">
                            <div class="icon-container d-flex justify-content-center align-items-center" style="width: 50px;">
                                <i class="bi bi-list-check" style="font-size: 2rem;"></i> <!-- Ícono de Detalles Servicios -->
                            </div>
                            <div class="title-container ps-3">
                                <h5>Detalles Servicios</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">

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