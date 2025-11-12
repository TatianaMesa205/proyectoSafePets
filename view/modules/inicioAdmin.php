<style>
    .admin-dashboard {
        padding: 0 30px 30px 30px;
    }
    .stat-card {
        background: #f0e4d8;
        border: none;
        border-radius: 15px;
        color: #4b3832;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .stat-card .card-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .stat-card i {
        font-size: 3rem;
        opacity: 0.5;
    }
    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
    }
    .quick-link {
        display: block;
        background: #fff;
        border: 1px solid #eee;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        text-decoration: none;
        color: #5c4b3b;
        font-weight: 600;
        transition: all 0.2s;
    }
    .quick-link:hover {
        background: #f9f4f3;
        color: #4b3832;
        transform: translateY(-3px);
    }
    .quick-link i {
        font-size: 2rem;
        display: block;
        margin-bottom: 10px;
    }
</style>

<div class="admin-dashboard container-fluid">

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

    <h3 class="mb-3">Accesos Rápidos</h3>
    <div class="row g-4">
        <div class="col-md-3">
            <a href="mascotas" class="quick-link" onclick="mascotas()">
                <i class="fas fa-dog"></i>
                <span>Gestionar Mascotas</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="adoptantes" class="quick-link" onclick="adoptantes()">
                <i class="fas fa-user-cog"></i>
                <span>Gestionar Adoptantes</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="adopciones" class="quick-link" onclick="adopciones()">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Gestión de Adopciones</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="citas" class="quick-link" onclick="citas()">
                <i class="fas fa-calendar-alt"></i>
                <span>Gestión de Citas</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunas" class="quick-link" onclick="vacunas()">
                <i class="fas fa-syringe"></i>
                <span>Control de Vacunas</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunasMascotas" class="quick-link" onclick="vacunasMascotas()">
                <i class="fas fa-clipboard-list"></i>
                <span>Vacunas de la mascota</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="publicaciones" class="quick-link" onclick="publicaciones()">
                <i class="fas fa-bullhorn"></i>
                <span>Publicaciones</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="seguimientos" class="quick-link" onclick="seguimientos()">
                <i class="fas fa-clipboard-list"></i>
                <span>Seguimientos</span>
            </a>
        </div>
        
        <div class="col-md-3">
            <a href="#" class="quick-link" onclick="crearAdmin()">
                <i class="fas fa-user-shield"></i>
                <span>Crear Nuevo Admin</span>
            </a>
        </div>
    </div>
</div>