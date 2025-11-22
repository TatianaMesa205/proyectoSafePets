<style>
    /* --- CORRECCIÓN TÉCNICA 1: Z-INDEX --- */
    /* Agregamos z-index alto para que el menú salga POR ENCIMA de todo */
    .navbar {
      background-color: #f0e4d8ff;
      position: relative;
      z-index: 1050 !important; 
    }
    
    /* --- TU DISEÑO ORIGINAL SE MANTIENE INTACTO --- */
    .navbar-brand {
      font-weight: bold;
      font-size: 1.7rem; 
      color: #8b5e3c !important; 
    }
    .nav-link {
      color: #5a4633 !important; 
      font-weight: 500;
      transition: 0.3s;
    }
    .nav-link:hover {
      color: #a67856 !important;
    }
    .navbar-toggler {
      border-color: #8b5e3c;
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgb(139,94,60)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    .carousel-inner img {
      height: 350px;
      object-fit: cover;
      border-radius: 200px;
    }
    .container.text-center.my-4 {
      position: sticky;
      top: 0;
      background: #f8f3ee;
      z-index: 1000;
      padding: 10px 0;
    }
    .btn-logout {
        display: block;
        margin: 20px auto;
        padding: 10px 15px;
        background-color: #d6baa5;
        color: white;
        border: none;
        border-radius: 100px;
        cursor: pointer;
        font-weight: bold;
        width: 80%; /* Asegura que el botón se vea bien centrado */
    }
    .btn-logout:hover {
        background-color: #c4a48c; /* Un pequeño efecto hover para UX */
    }
</style>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            <i class="fa-solid fa-circle-user me-2" style="font-size: 25px; color: #8b5e3c;"></i>

            <?php 
              // Validación simple para evitar errores si no hay sesión
              echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario'; 
            ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
            <li>
              <a class="dropdown-item" href="perfil.php">
                <i class="fa-solid fa-user me-2"></i> Mi Perfil
              </a>
            </li>

            <li>
                <button id="btnLogout" class="btn-logout">
                  <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión
                </button>
            </li>
          </ul>
        </li>

      </ul>
    </div> 

  </div>
</nav>


<div id="carruselSafePets" class="carousel slide container mt-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.pexels.com/photos/2145878/pexels-photo-2145878.jpeg" class="d-block w-100" alt="Gatito tierno">
      <div class="carousel-caption d-none d-md-block">
        <h5>Encuentra tu mejor amigo 🤎</h5>
        <p>Adopta y cambia una vida hoy.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/140134/pexels-photo-140134.jpeg" class="d-block w-100" alt="Perrito feliz">
      <div class="carousel-caption d-none d-md-block">
        <h5>Brinda un hogar lleno de amor 🤎</h5>
        <p>Cada adopción es una nueva oportunidad.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/16395150/pexels-photo-16395150.jpeg" class="d-block w-100" alt="Mascotas felices">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conéctate con Safe Pets 🤎</h5>
        <p>Un puente entre adoptantes y fundaciones.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carruselSafePets" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carruselSafePets" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<div class="container text-center my-4">
  <div class="row row-cols-5 g-3">
    <div class="col">
      <a href="inicioAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-house"></i>
        <span class="small">𝐼𝓃𝒾𝒸𝒾𝑜</span>
      </a>
    </div>
    <div class="col">
      <a href="adoptaAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-paw"></i>
        <span class="small">𝑀𝒶𝓈𝒸𝑜𝓉𝒶𝓈</span>
      </a>
    </div>
    <div class="col">
      <a href="publicacionesAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-bell"></i>
        <span class="small">𝒫𝓊𝒷𝓁𝒾𝒸𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
    <div class="col">
      <a href="historiasAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-book-open"></i>
        <span class="small">𝐻𝒾𝓈𝓉𝑜𝓇𝒾𝒶𝓈</span>
      </a>
    </div>
    <div class="col">
      <a href="donacionesAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-heart"></i>
        <span class="small">𝒟𝑜𝓃𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>