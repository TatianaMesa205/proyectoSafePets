<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Safe Pets</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar {
      background-color: #f5f0e6; /* Beige suave */
    }
    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: #8b5e3c !important; /* Marrón cálido */
    }
    .nav-link {
      color: #5a4633 !important; /* Marrón más oscuro */
      font-weight: 500;
      transition: 0.3s;
    }
    .nav-link:hover {
      color: #a67856 !important; /* Marrón claro al pasar */
    }
    .navbar-toggler {
      border-color: #8b5e3c;
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgb(139,94,60)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">🐾 Safe Pets</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Adopta</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Citas</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Donaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Publicaciones</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
