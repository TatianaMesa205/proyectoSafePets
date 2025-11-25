<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="inicioAdp">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item dropdown perfil-nav-item">
          <a class="nav-link dropdown-toggle d-flex align-items-center perfil-toggle" 
            href="#" 
            id="perfilDropdown" 
            role="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">

            <div class="perfil-icono">
              <i class="fa-solid fa-circle-user"></i>
            </div>

            <span class="perfil-nombre">
              <?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario'; ?>
            </span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end perfil-menu" aria-labelledby="perfilDropdown">

            <li>
              <a class="dropdown-item perfil-opcion" href="perfilAdp">
                <i class="fa-solid fa-user me-2"></i> Mi Perfil
              </a>
            </li>

            <li>
              <button id="btnLogout" class="perfil-logout">
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
<?php include("pie.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* ==== CONTENEDOR GENERAL ==== */
.perfil-nav-item {
    position: relative;
}

/* ==== BOTÓN DEL PERFIL EN NAV ==== */
.perfil-toggle {
    background: #f4e9dd;
    padding: 8px 14px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: 0.3s;
    border: 1px solid #e0d4c4;
}

.perfil-toggle:hover {
    background: #e8dccd;
}

/* ==== ICONO ==== */
.perfil-icono i {
    font-size: 26px;
    color: #8b5e3c;
}

/* ==== NOMBRE ==== */
.perfil-nombre {
    font-weight: 600;
    color: #6b4f3a;
    margin-left: 4px;
}

/* ==== DROPDOWN ==== */
.perfil-menu {
    background: #fff8f1;
    border-radius: 12px;
    border: 1px solid #e4d6c7;
    padding: 8px 0;
    min-width: 180px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
}

/* Opciones */
.perfil-opcion {
    padding: 10px 18px !important;
    font-weight: 500;
    color: #6b4f3a;
    transition: 0.2s;
}

.perfil-opcion:hover {
    background: #f1e4d7;
    color: #4a3729;
}

/* ==== BOTÓN LOGOUT ==== */
.perfil-logout {
    width: 100%;
    padding: 10px 18px;
    background: transparent;
    border: none;
    text-align: left;
    font-weight: 500;
    color: #6b4f3a;
    transition: 0.2s;
}

.perfil-logout:hover {
    background: #f1e4d7;
    color: #4a3729;
}

.navbar {
  background-color: #f0e4d8ff;
  position: relative;
  z-index: 1050 !important; 
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

