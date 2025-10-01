<?php
// ARCHIVO CORREGIDO: view/modules/menu.php
// Este es un fragmento de código, no una página HTML completa.
?>

<style>
    .navbar {
      background-color: #f0e4d8ff; /* Fondo beige suave */
    }
    .navbar-brand {
      font-weight: bold; /* Texto en negrita */
      font-size: 1.7rem; /* Tamaño del texto grande */
      color: #8b5e3c !important; /* Marrón cálido para el logo/título */
    }
    .nav-link {
      color: #5a4633 !important; /* Marrón oscuro para los enlaces */
      font-weight: 500; /* Semi-negrita */
      transition: 0.3s; /* Suaviza los cambios de color al pasar el mouse */
    }
    .nav-link:hover {
      color: #a67856 !important; /* Marrón más claro cuando pasas el mouse */
    }
    .navbar-toggler {
      border-color: #8b5e3c; /* Color del borde del botón hamburguesa */
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgb(139,94,60)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    .carousel-inner img {
      height: 350px; /* Altura fija */
      object-fit: cover; /* La imagen se recorta sin deformarse */
      border-radius: 20px;
    }
    .container.text-center.my-4 {
      position: sticky;
      top: 0; /* se pega arriba cuando llega */
      background: #f9f6f6; /* fondo para que no se mezcle con el carrusel o el contenido */
      z-index: 1000; /* para que quede por encima del contenido */
      padding: 10px 0;
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
        <li class="nav-item">
          <img src="https://i.pinimg.com/736x/56/0b/d8/560bd8e051730a69576a5cd0dd24978b.jpg" alt="Perfil" class="rounded-circle me-2" width="38" height="40">
        </li>
        <li class="nav-item">
          <span class="nav-link fw-bold">𝐇𝐨𝐥𝐚 𝐓𝐚𝐭𝐢𝐚𝐧𝐚</span>
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
      <a href="adopta" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-paw"></i>
        <span class="small">𝒜𝒹𝑜𝓅𝓉𝒶</span>
      </a>
    </div>
    <div class="col">
      <a href="citas" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-calendar"></i>
        <span class="small">𝒞𝒾𝓉𝒶𝓈</span>
      </a>
    </div>
    <div class="col">
      <a href="donaciones" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-heart"></i>
        <span class="small">𝒟𝑜𝓃𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
    <div class="col">
      <a href="publicaciones" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-bell"></i>
        <span class="small">𝒫𝓊𝒷𝓁𝒾𝒸𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
  </div>
</div>