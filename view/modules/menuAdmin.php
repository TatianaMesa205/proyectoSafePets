

<style>
/* Navbar Admin */
.navbar-admin {
    background-color: #4b3832;
    padding: 12px 0;
}

.navbar-admin .nav-link,
.navbar-admin .navbar-brand,
.navbar-admin .dropdown-toggle {
    color: #f0e4d8 !important;
    font-weight: 500;
}

.navbar-admin .nav-link:hover,
.navbar-admin .dropdown-item:hover {
    color: #ffffff !important;
}

.navbar-admin .dropdown-menu {
    background-color: #4b3832;
    border-radius: 10px;
    border: none;
    /* Asegura que el menú quede encima de otros elementos */
    z-index: 1050; 
}

.navbar-admin .dropdown-item {
    color: #f0e4d8;
}

.navbar-admin .dropdown-item:hover {
    background-color: #6f4e37;
}

.nav-item-icon {
    padding: 10px 18px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-item-icon i {
    font-size: 18px;
}

/* Tooltip estilo Safe Pets */
.nav-item-icon {
    position: relative;
}

.nav-item-icon .nav-tooltip {
    position: absolute;
    left: 50%;
    bottom: -5px;
    transform: translateX(-50%) translateY(10px);
    background-color: #6f4e37;
    color: #f0e4d8;
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 8px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: all .25s ease;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    z-index: 1060;
}

/* Flechita del tooltip */
.nav-item-icon .nav-tooltip::after {
    content: "";
    position: absolute;
    top: -4px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 0 5px 5px 5px;
    border-style: solid;
    border-color: transparent transparent #6f4e37 transparent;
}

/* Mostrar tooltip en hover */
.nav-item-icon:hover .nav-tooltip {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}
</style>

<nav class="navbar navbar-expand-lg navbar-admin shadow-sm mb-4">
  <div class="container">

    <a class="navbar-brand" href="inicioAdmin">
      <i class="fas fa-paw me-2"></i> Admin Safe Pets
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="mascotas">
            <i class="fas fa-dog"></i>
            <span class="nav-tooltip">Mascotas</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="adoptantes">
            <i class="fas fa-user-friends"></i>
            <span class="nav-tooltip">Adoptantes</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="adopciones">
            <i class="fas fa-hand-holding-heart"></i>
            <span class="nav-tooltip">Adopciones</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="citas">
            <i class="fas fa-calendar-alt"></i>
            <span class="nav-tooltip">Citas</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="vacunas">
            <i class="fas fa-syringe"></i>
            <span class="nav-tooltip">Vacunas</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="vacunasMascotas">
            <i class="fas fa-notes-medical"></i>
            <span class="nav-tooltip">Vacunas Mascotas</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="publicaciones">
            <i class="fas fa-bullhorn"></i>
            <span class="nav-tooltip">Publicaciones</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="seguimientos">
            <i class="fas fa-clipboard-list"></i>
            <span class="nav-tooltip">Seguimientos</span>
          </a>
        </li>

        <li class="nav-item nav-item-icon">
          <a class="nav-link" href="donaciones">
            <i class="fas fa-hand-holding-usd"></i>
            <span class="nav-tooltip">Donaciones</span>
          </a>
        </li>


        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-1"></i>
            <?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Admin'; ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
            <li>
              <a class="dropdown-item" href="perfilAdmin">
                <i class="fas fa-user me-2"></i> Mi Perfil
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <button id="btnLogout" class="dropdown-item">
                <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
              </button>
            </li>
          </ul>
        </li>

      </ul>
    </div>

  </div>
</nav>
<?php include("pie.php"); ?>