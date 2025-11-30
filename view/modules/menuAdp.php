<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php?ruta=inicioAdp">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse fade-scroll" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] != "ok"): ?>
            
            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary" href="index.php?ruta=login">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Iniciar Sesión
                </a>
            </li>
            <li class="nav-item ms-2">
                <a class="btn btn-primary rounded-pill px-4 text-white" href="index.php?ruta=registro" style="background: #8b5e3c; border:none;">
                    Registrarse
                </a>
            </li>

        <?php else: ?>

            <li class="nav-item dropdown perfil-nav-item">
              <a class="nav-link dropdown-toggle d-flex align-items-center perfil-toggle" 
                href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="perfil-icono"><i class="fa-solid fa-circle-user"></i></div>
                <span class="perfil-nombre">
                  <?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario'; ?>
                </span>
              </a>

              <ul class="dropdown-menu dropdown-menu-end perfil-menu" aria-labelledby="perfilDropdown">
                <li>
                  <a class="dropdown-item perfil-opcion" href="index.php?ruta=perfilAdp">
                    <i class="fa-solid fa-user me-2"></i> Mi Perfil
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item perfil-opcion text-danger" href="index.php?ruta=logout">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión
                  </a>
                </li>
              </ul>
            </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<div id="carruselSafePets" class="carousel slide container mt-4 reveal zoom" data-bs-ride="carousel">
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

<div class="container text-center my-4 stagger-container">
  <div class="row row-cols-5 g-3">
    <div class="col stagger-item">
      <a href="index.php?ruta=inicioAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-house"></i>
        <span class="small">𝐼𝓃𝒾𝒸𝒾𝑜</span>
      </a>
    </div>
    <div class="col stagger-item">
      <a href="index.php?ruta=adoptaAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-paw"></i>
        <span class="small">𝑀𝒶𝓈𝒸𝑜𝓉𝒶𝓈</span>
      </a>
    </div>
    <div class="col stagger-item">
      <a href="index.php?ruta=publicacionesAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-bell"></i>
        <span class="small">𝒫𝓊𝒷𝓁𝒾𝒸𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
    <div class="col stagger-item">
      <a href="index.php?ruta=historiasAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-book-open"></i>
        <span class="small">𝐻𝒾𝓈𝓉𝑜𝓇𝒾𝒶𝓈</span>
      </a>
    </div>
    <div class="col stagger-item">
      <a href="index.php?ruta=donacionesAdp" class="text-decoration-none text-dark d-flex flex-column align-items-center">
        <i class="fa-solid fa-heart"></i>
        <span class="small">𝒟𝑜𝓃𝒶𝒸𝒾𝑜𝓃𝑒𝓈</span>
      </a>
    </div>
  </div>
</div>

<?php include("pie.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* Tus estilos del menú */
.container.text-center.my-4 { position: sticky; top: 0; background: #f8f3ee; z-index: 1000; padding: 10px 0; }
.navbar { animation: fadeDown 1s ease; background: #f0e4d8ff; border-bottom: 2px solid #e8d2c6; }
.navbar-brand { font-size: 1.9rem; font-weight: 700; color: #8b5e3c !important; transition: 0.3s; }
.navbar-brand:hover { transform: scale(1.08); color: #b7855e !important; }
.perfil-icono i { font-size: 1.9rem; color: #8b5e3c; transition: 0.4s; }
.perfil-toggle:hover .perfil-icono i { transform: rotate(10deg) scale(1.15); color: #b7855e; }
.perfil-nombre { font-weight: 600; margin-left: 8px; animation: fadeIn 1s ease; }
.perfil-menu { border-radius: 15px; animation: dropdownSlide 0.35s ease; background: #e4d6c7; border: 1px solid #e7d1c4; }
.perfil-opcion { transition: 0.3s; }
.perfil-opcion:hover { background: #f4e6dd; color: #8b5e3c; }
.row-cols-5 .col a i { font-size: 1.5rem; transition: transform 0.3s, color 0.3s; color: #8b5e3c; }
.row-cols-5 .col a:hover i { transform: translateY(-4px) scale(1.12); color: #b7855e; }
.row-cols-5 .col span { margin-top: 3px; color: #6d4c33; font-weight: 500; animation: fadeIn 1s ease; }
@keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes dropdownSlide { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
.reveal { opacity: 0; transform: translateY(24px); transition: opacity 600ms cubic-bezier(.22,.9,.32,1), transform 600ms cubic-bezier(.22,.9,.32,1); will-change: opacity, transform; pointer-events: none; }
.reveal.in-view { opacity: 1; transform: translateY(0); pointer-events: auto; }
.reveal.zoom { transform: scale(.95) translateY(10px); } .reveal.zoom.in-view { transform: scale(1) translateY(0); }
.stagger-container .stagger-item { opacity: 0; transform: translateY(18px); transition: opacity 520ms cubic-bezier(.22,.9,.32,1), transform 520ms cubic-bezier(.22,.9,.32,1); pointer-events: none; }
.stagger-container.in-view .stagger-item { opacity: 1; transform: translateY(0); pointer-events: auto; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const revealOptions = { root: null, rootMargin: "0px 0px -8% 0px", threshold: 0.12 };
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      const el = entry.target;
      if (entry.isIntersecting) {
        if (el.classList.contains('stagger-container')) {
          el.classList.add('in-view');
          const items = Array.from(el.querySelectorAll('.stagger-item'));
          items.forEach((it, idx) => {
            it.style.transitionDelay = (idx * 80) + 'ms';
            it.classList.add('in-view');
          });
        } else {
          const delayAttr = el.getAttribute('data-delay');
          if (delayAttr) el.style.transitionDelay = delayAttr;
          el.classList.add('in-view');
        }
        observer.unobserve(el);
      }
    });
  }, revealOptions);
  document.querySelectorAll('.reveal, .stagger-container').forEach(node => observer.observe(node));
});
</script>