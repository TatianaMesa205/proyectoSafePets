<style>
    .navbar-admin {
        background-color: #4b3832; /* Un color más sobrio para el admin */
    }
    .navbar-admin .navbar-brand,
    .navbar-admin .nav-link,
    .navbar-admin .navbar-text {
        color: #f0e4d8 !important;
    }
    .navbar-admin .nav-link:hover {
        color: #fff !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-admin shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="admin"><i class="fas fa-paw me-2"></i>Admin Safe Pets</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link" href="usuarios">Gestionar Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="mascotas">Gestionar Mascotas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="reportes">Ver Reportes</a>
        </li>
        <li class="nav-item">
          <span class="navbar-text ms-3 me-2">
            Bienvenido, <strong><?php echo $_SESSION['nombre_usuario']; ?></strong>
          </span>
        </li>
        <li class="nav-item">
            <button id="btnLogout" class="btn btn-sm btn-outline-light">Cerrar Sesión</button>
        </li>
      </ul>
    </div>
  </div>
</nav>