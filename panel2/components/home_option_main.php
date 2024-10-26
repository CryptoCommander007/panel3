<!-- Información personalizada Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 d-flex justify-content-center align-items-stretch">

        <!-- Rango: Hierro -->
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 custom-card w-100">
                <i class="fas fa-trophy fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Rango</p>
                    <h6 class="mb-0">Hierro</h6>
                </div>
            </div>
        </div>

        <!-- Puntos de Reputación -->
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 custom-card w-100">
                <i class="fas fa-star fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Puntos de Reputación</p>
                    <h6 class="mb-0">450</h6>
                </div>
            </div>
        </div>

        <!-- Saldo -->
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 custom-card w-100">
                <i class="fas fa-wallet fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Saldo</p>
                    <h6 class="mb-0">$1250</h6>
                </div>
            </div>
        </div>

        <!-- Cargar Saldo -->
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 custom-card w-100">
                <i class="fas fa-plus-circle fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Cargar Saldo</p>
                    <h6 class="mb-0">Click aquí</h6>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Información personalizada End -->

<!-- Estilos personalizados para evitar desbordes -->
<style>
    .custom-card {
        min-width: 0; /* Evita que las tarjetas se expandan más allá del contenedor */
        width: 100%; /* Asegura que las tarjetas ocupen el ancho completo del contenedor */
        max-width: 100%; /* Impide desbordes */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .row.g-4 {
        gap: 20px; /* Espaciado entre las tarjetas */
    }

    @media(min-width: 992px) {
        .row.g-4 {
            gap: 0; /* Elimina el espaciado extra en pantallas grandes */
        }
    }

    @media (max-width: 576px) {
        .custom-card {
            margin-bottom: 15px; /* Añadir margen inferior en pantallas pequeñas para espaciado */
        }
    }
</style>
