<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Safe Pets</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    .navbar {
      background-color: #f0e4d8ff; /* Beige suave */
    }
    .navbar-brand {
      font-weight: bold;
      font-size: 1.7rem;
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

    /* Ajustes carrusel */
    .carousel-inner img {
      height: 350px;
      object-fit: cover;
      border-radius: 250px;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: #f9f6f6;
    }

    .about {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
      padding: 50px;
      background-color: #f9f4f3;
      border-radius: 20px;
      margin: 30px;
    }

    .about img {
      width: 300px;
      border-radius: 15px;
      height: 300px;
      object-fit: cover;
    }

    .about-text {
      max-width: 600px;
      text-align: justify;
    }

    .about-text h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .footer {
      background-color: #f0e4d8ff;
      padding: 40px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-radius: 20px 20px 0 0;
    }

    .footer .logo {
      text-align: center;
      margin-left: 50px;
    }

    .footer .logo i {
      font-size: 50px;
      margin-bottom: 10px;
      color: #a07b61; 
      
    }

    .footer h3 {
      margin-bottom: 20px;
    }

    .footer ul {
      list-style: none;
      padding: 0;
    }

    .footer ul li { 
      margin-bottom: 10px;
    }

    .footer ul li i {
      color: #a07b61;
      margin-right: 10px;
    }

    .social-icons a {
      margin: 0 10px;
      color: #a07b61;
      font-size: 28px;
      transition: 0.3s;
    }

    .social-icons a:hover {
      color: #c0a18bff;
    }

    .footer1 {
      background: #f0e4d8ff;
      padding: 3px 20px 10px;
      font-family: 'Arial', sans-serif;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 20px;
    }

    .footer-bottom hr {
      border: none;
      border-top: 2px dashed white;
      margin: 10px auto;
      width: 95%;
      background: #000;
    }

    .footer-bottom p {
      margin-top: 10px;
      font-size: 14px;
      color: #4b3832;
    }



  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <!-- Imagen de perfil -->
        <li class="nav-item">
          <img src="https://i.pinimg.com/736x/56/0b/d8/560bd8e051730a69576a5cd0dd24978b.jpg" alt="Perfil" class="rounded-circle me-2" width="38" height="40">
        </li>
        <!-- Nombre usuario -->
        <li class="nav-item">
          <span class="nav-link fw-bold">𝐇𝐨𝐥𝐚 𝐓𝐚𝐭𝐢𝐚𝐧𝐚</span>
        </li>
      </ul>
    </div>

  </div>
</nav>

<!-- Carrusel -->
<div id="carruselSafePets" class="carousel slide container mt-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- Imagen 1 -->
    <div class="carousel-item active">
      <img src="https://images.pexels.com/photos/2145878/pexels-photo-2145878.jpeg" class="d-block w-100" alt="Gatito tierno">
      <div class="carousel-caption d-none d-md-block">
        <h5>Encuentra tu mejor amigo 🤎</h5>
        <p>Adopta y cambia una vida hoy.</p>
      </div>
    </div>
    <!-- Imagen 2 -->
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/140134/pexels-photo-140134.jpeg" class="d-block w-100" alt="Perrito feliz">
      <div class="carousel-caption d-none d-md-block">
        <h5>Brinda un hogar lleno de amor 🤎</h5>
        <p>Cada adopción es una nueva oportunidad.</p>
      </div>
    </div>
    <!-- Imagen 3 -->
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/16395150/pexels-photo-16395150.jpeg" class="d-block w-100" alt="Mascotas felices">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conéctate con Safe Pets 🤎</h5>
        <p>Un puente entre adoptantes y fundaciones.</p>
      </div>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carruselSafePets" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carruselSafePets" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


<!-- Menú de accesos rápidos -->
<div class="container text-center my-4">
  <div class="row row-cols-5 g-3">
    
    <!-- Inicio -->
    <div class="col">
      <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-house"></i>
        <span class="small">𝐼𝓃𝒾𝒸𝒾𝑜</span>
      </a>
    </div>

    <!-- Adopta -->
    <div class="col">
      <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-paw"></i>
        <span class="small">𝒜𝒹𝑜𝓅𝓉𝒶</span>
      </a>
    </div>

    <!-- Citas -->
    <div class="col">
      <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-calendar"></i>
        <span class="small">𝒞𝒾𝓉𝒶𝓈</span>
      </a>
    </div>

    <!-- Donaciones -->
    <div class="col">
      <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-heart"></i>
        <span class="small">𝒟𝑜𝓃𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>

    <!-- Publicaciones -->
    <div class="col">
      <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-bell"></i>
        <span class="small">𝒫𝓊𝒷𝓁𝒾𝒸𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
  </div>
</div>


<section class="about">
    <img src="https://images.pexels.com/photos/4012470/pexels-photo-4012470.jpeg" alt="gatitos">
    <div class="about-text">
      <h2>𝐀𝐦𝐨𝐫 𝐪𝐮𝐞 𝐭𝐫𝐚𝐧𝐬𝐟𝐨𝐫𝐦𝐚 𝐯𝐢𝐝𝐚𝐬 <i class="fa-solid fa-paw"></i></h2>
      <p>
        𝐒𝐨𝐦𝐨𝐬 𝐮𝐧𝐚 𝐅𝐮𝐧𝐝𝐚𝐜𝐢ó𝐧 𝐪𝐮𝐞 𝐛𝐮𝐬𝐜𝐚 𝐥𝐚 𝐩𝐫𝐨𝐭𝐞𝐜𝐜𝐢ó𝐧, 𝐫𝐞𝐬𝐜𝐚𝐭𝐞 𝐲 𝐛𝐢𝐞𝐧𝐞𝐬𝐭𝐚𝐫 𝐝𝐞 𝐩𝐞𝐫𝐫𝐨𝐬 𝐲 𝐠𝐚𝐭𝐨𝐬 𝐞𝐧 𝐬𝐢𝐭𝐮𝐚𝐜𝐢ó𝐧 
        𝐝𝐞 𝐚𝐛𝐚𝐧𝐝𝐨𝐧𝐨, 𝐦𝐚𝐥𝐭𝐫𝐚𝐭𝐨 𝐨 𝐯𝐮𝐥𝐧𝐞𝐫𝐚𝐛𝐢𝐥𝐢𝐝𝐚𝐝. 𝐍𝐮𝐞𝐬𝐭𝐫𝐚 𝐦𝐢𝐬𝐢ó𝐧 𝐞𝐬 𝐛𝐫𝐢𝐧𝐝𝐚𝐫𝐥𝐞𝐬 𝐮𝐧𝐚 𝐬𝐞𝐠𝐮𝐧𝐝𝐚 𝐨𝐩𝐨𝐫𝐭𝐮𝐧𝐢𝐝𝐚𝐝 𝐚 𝐭𝐫𝐚𝐯é𝐬 𝐝𝐞𝐥 𝐫𝐞𝐬𝐜𝐚𝐭𝐞, 
        𝐥𝐚 𝐫𝐞𝐜𝐮𝐩𝐞𝐫𝐚𝐜𝐢ó𝐧 𝐲 𝐥𝐚 𝐛ú𝐬𝐪𝐮𝐞𝐝𝐚 𝐝𝐞 𝐡𝐨𝐠𝐚𝐫𝐞𝐬 𝐫𝐞𝐬𝐩𝐨𝐧𝐬𝐚𝐛𝐥𝐞𝐬 𝐲 𝐚𝐦𝐨𝐫𝐨𝐬𝐨𝐬.
      </p>
      <p>
        𝐏𝐫𝐨𝐦𝐨𝐯𝐞𝐦𝐨𝐬 𝐥𝐚 𝐞𝐝𝐮𝐜𝐚𝐜𝐢ó𝐧 𝐬𝐨𝐛𝐫𝐞 𝐭𝐞𝐧𝐞𝐧𝐜𝐢𝐚 𝐫𝐞𝐬𝐩𝐨𝐧𝐬𝐚𝐛𝐥𝐞, 𝐞𝐥 𝐫𝐞𝐬𝐩𝐞𝐭𝐨 𝐩𝐨𝐫 𝐥𝐚 𝐯𝐢𝐝𝐚 𝐚𝐧𝐢𝐦𝐚𝐥 𝐲 𝐟𝐨𝐦𝐞𝐧𝐭𝐚𝐦𝐨𝐬 
        𝐜𝐚𝐦𝐩𝐚ñ𝐚𝐬 𝐝𝐞 𝐞𝐬𝐭𝐞𝐫𝐢𝐥𝐢𝐳𝐚𝐜𝐢ó𝐧 𝐜𝐨𝐦𝐨 𝐞𝐬𝐭𝐫𝐚𝐭𝐞𝐠𝐢𝐚 𝐜𝐥𝐚𝐯𝐞 𝐩𝐚𝐫𝐚 𝐫𝐞𝐝𝐮𝐜𝐢𝐫 𝐥𝐚 𝐬𝐨𝐛𝐫𝐞𝐩𝐨𝐛𝐥𝐚𝐜𝐢ó𝐧 𝐜𝐚𝐥𝐥𝐞𝐣𝐞𝐫𝐚.
      </p>
      <p>
        𝐂𝐫𝐞𝐞𝐦𝐨𝐬 𝐪𝐮𝐞 𝐜𝐚𝐝𝐚 𝐯𝐢𝐝𝐚 𝐢𝐦𝐩𝐨𝐫𝐭𝐚, 𝐲 𝐩𝐨𝐫 𝐞𝐬𝐨, 𝐝í𝐚 𝐚 𝐝í𝐚, 𝐮𝐧𝐢𝐦𝐨𝐬 𝐟𝐮𝐞𝐫𝐳𝐚𝐬 𝐩𝐚𝐫𝐚 𝐜𝐚𝐦𝐛𝐢𝐚𝐫 𝐥𝐚 𝐫𝐞𝐚𝐥𝐢𝐝𝐚𝐝 𝐝𝐞 
        𝐜𝐢𝐞𝐧𝐭𝐨𝐬 𝐝𝐞 𝐚𝐧𝐢𝐦𝐚𝐥𝐞𝐬 𝐪𝐮𝐞 𝐦𝐞𝐫𝐞𝐜𝐞𝐧 𝐮𝐧𝐚 𝐯𝐢𝐝𝐚 𝐝𝐢𝐠𝐧𝐚 𝐲 𝐥𝐥𝐞𝐧𝐚 𝐝𝐞 𝐚𝐦𝐨𝐫.
      </p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="logo">
      <i class="fa-solid fa-paw"></i>
      <p><strong>𝒮𝒶𝒻𝑒 𝒫𝑒𝓉𝓈</strong></p>
    </div>

    <div class="info">
      <h3>Información</h3>
      <ul>
        <li><i class="fa-solid fa-location-dot"></i> Calle 45B #23 - 76</li>
        <li><i class="fa-solid fa-envelope"></i> contacto@corazonpeludito.com</li>
        <li><i class="fa-solid fa-envelope"></i> adoptante@corazonpeludito.com</li>
        <li><i class="fa-solid fa-phone"></i> 3001109458</li>
      </ul>
    </div>

    <div class="social">
      <h3>Síguenos</h3>
      <div class="social-icons">
        <a href="#"><i class="fa-brands fa-whatsapp"></i></i></a>
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </footer>

  <footer class="footer1">
    <!-- Línea + texto de copyright -->
    <div class="footer-bottom">
      <hr>
      <p>© 2025 Safe pets - Adoptar es un acto de amor.</p>
    </div>
  </footer>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
