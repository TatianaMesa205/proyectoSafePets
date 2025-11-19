<style>
    /* --- CONTENEDOR GENERAL --- */
    .admin-dashboard {
        padding: 20px 30px 40px 30px;
        background: #fef9f6;
    }

    /* --- TARJETAS SUPERIORES --- */
    .stat-card {
        background: #f4e7dd;
        border: none;
        border-radius: 18px;
        color: #4b3832;
        padding: 18px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .stat-card .card-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-card i {
        font-size: 3.2rem;
        opacity: 0.4;
    }

    .stat-card h3 {
        font-size: 2.7rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    /* --- TÍTULO DE ACCESOS RÁPIDOS --- */
    .dashboard-title {
        color: #4b3832;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 18px;
        margin-top: 25px;
    }

    /* --- BOTONES (Quick Links) --- */
    .quick-link {
        display: block;
        background: #ffffff;
        border: none;
        padding: 28px 20px;
        text-align: center;
        border-radius: 16px;
        text-decoration: none;
        color: #5c4b3b;
        font-weight: 600;
        font-size: 1.05rem;
        transition: 0.25s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }

    .quick-link:hover {
        background: #f4e7dd;
        color: #4b3832;
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .quick-link i {
        font-size: 2.3rem;
        display: block;
        margin-bottom: 12px;
        opacity: 0.85;
    }

    /* Centrado automático de la última fila */
    .quick-row-last {
        justify-content: center;
        margin-top: 10px;
    }

</style>

<div class="admin-dashboard container-fluid">

    <!-- TARJETAS SUPERIORES -->
    <div class="row mb-4 g-4">

        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body">
                    <div>
                        <h3>12</h3>
                        <p class="mb-0">Mascotas Registradas</p>
                    </div>
                    <i class="fas fa-paw"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body">
                    <div>
                        <h3>45</h3>
                        <p class="mb-0">Usuarios Activos</p>
                    </div>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body">
                    <div>
                        <h3>8</h3>
                        <p class="mb-0">Citas Pendientes</p>
                    </div>
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- TÍTULO -->
    <h3 class="dashboard-title">Accesos Rápidos</h3>

    <!-- PRIMER BLOQUE -->
    <div class="row g-4">

        <div class="col-md-3">
            <a href="mascotas" class="quick-link">
                <i class="fas fa-dog"></i>
                Gestionar Mascotas
            </a>
        </div>

        <div class="col-md-3">
            <a href="adoptantes" class="quick-link">
                <i class="fas fa-user-cog"></i>
                Gestionar Adoptantes
            </a>
        </div>

        <div class="col-md-3">
            <a href="adopciones" class="quick-link">
                <i class="fas fa-hand-holding-heart"></i>
                Gestión de Adopciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="citas" class="quick-link">
                <i class="fas fa-calendar-alt"></i>
                Gestión de Citas
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunas" class="quick-link">
                <i class="fas fa-syringe"></i>
                Control de Vacunas
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunasMascotas" class="quick-link">
                <i class="fas fa-notes-medical"></i>
                Vacunas de la mascota
            </a>
        </div>

        <div class="col-md-3">
            <a href="publicaciones" class="quick-link">
                <i class="fas fa-bullhorn"></i>
                Publicaciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="seguimientos" class="quick-link">
                <i class="fas fa-clipboard-list"></i>
                Seguimientos
            </a>
        </div>

    </div>

    <!-- ÚLTIMA FILA CENTRADA -->
    <div class="row g-4 quick-row-last">

        <div class="col-md-3">
            <a href="donaciones" class="quick-link">
                <i class="fas fa-hand-holding-usd"></i>
                Gestión de Donaciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="#" class="quick-link" onclick="crearAdmin()">
                <i class="fas fa-user-shield"></i>
                Crear Nuevo Admin
            </a>
        </div>

    </div>

</div>
