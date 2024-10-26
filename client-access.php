<?php
require_once 'backend-invitation/auth_user_middleware.php'; // Incluir el middleware de autenticación de usuario

// Llamar a la función para verificar si el usuario ya está autenticado
verificarAccesoUsuario();

// El resto del contenido de la página
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css"> <!-- Estilo principal -->
    <link rel="stylesheet" href="css/footer.css"> <!-- Estilo del footer -->
    <link rel="stylesheet" href="css/whatsapp-button.css"> <!-- Estilo del botón de WhatsApp -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header.css"> <!-- Estilo del header -->
    <link rel="stylesheet" href="css/client-access.css"> <!-- Estilo de la página -->
    
    <style>
        /* Estilos para los fondos degradados de las pestañas */
        #email {
            background: linear-gradient(135deg, #032e23 0%, #011f38 100%) !important;
            padding: 20px;
            border-radius: 8px;
        }

        #invitation {
            background: linear-gradient(135deg, #0c6164 0%, #1e1c77 100%) !important;
            padding: 20px;
            border-radius: 8px;
        }

        .tab-pane {
            margin-top: 20px;
        }

        .btn-login, .btn-whatsapp {
            width: 100%;
            margin-top: 15px;
        }

        .btn-whatsapp {
            background-color: #25D366 !important;
            color: white !important;
        }

        /* Estilos para los inputs (fondo negro y texto blanco con important) */
        .form-control {
            background-color: #000 !important; /* Fondo negro siempre */
            color: white !important; /* Texto blanco siempre */
            font-weight: bold !important; /* Texto en negrita siempre */
            border: 2px solid #007bff !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7) !important; /* Placeholder en blanco tenue */
        }

        .input-group-text {
            background-color: #007bff !important;
            color: white !important;
        }

        .form-group label {
            color: white !important;
            font-weight: bold !important;
        }

    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="login-container">
        <h2 class="text-center">Acceso Clientes</h2>
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Correo y Contraseña</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="invitation-tab" data-toggle="tab" href="#invitation" role="tab" aria-controls="invitation" aria-selected="false">Número y Código de Invitación</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Sección para el acceso con correo y contraseña -->
            <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese su E-mail" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" placeholder="Ingrese su Contraseña" required>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                    </div>
                    <button type="submit" class="btn btn-login">Ingresar</button>
                </form>
            </div>

            <!-- Sección para el acceso con número y código de invitación -->
            <div class="tab-pane fade" id="invitation" role="tabpanel" aria-labelledby="invitation-tab">
                <form id="invitation-form" action="backend-invitation/validate_invitation.php" method="POST" onsubmit="return sanitizeInput()">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            <input type="text" class="form-control" id="invitation-number" name="invitation_number" placeholder="Ingrese su Número de Invitación" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                            <input type="text" class="form-control" id="invitation-code" name="invitation_code" placeholder="Ingrese su Código de Invitación" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login">Ingresar</button>
                </form>

                <!-- Botón de WhatsApp debajo del botón de Ingresar -->
                <div class="text-center mt-3">
                    <a href="https://wa.me/1234567890" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> Solicitar código de invitación
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'whatsapp-button.php'; ?>
    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Función para sanitizar los campos de entrada
        function sanitizeInput() {
            var numberInput = document.getElementById('invitation-number').value.trim();
            var codeInput = document.getElementById('invitation-code').value.trim();

            // Remover caracteres especiales y espacios adicionales
            numberInput = numberInput.replace(/[^a-zA-Z0-9]/g, '');
            codeInput = codeInput.replace(/[^a-zA-Z0-9]/g, '');

            // Reasignar los valores sanitizados a los campos
            document.getElementById('invitation-number').value = numberInput;
            document.getElementById('invitation-code').value = codeInput;

            // Permitir el envío del formulario
            return true;
        }
    </script>
</body>
</html>

