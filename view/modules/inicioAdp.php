<?php
include_once "model/mascotasModel.php";

$respuesta = MascotasModel::mdlListarMascotas();
$listaMascotas = $respuesta["listaMascotas"];

// Filtrar mascots adoptadas
$historias = [];

foreach ($listaMascotas as $m) {
    if ($m["estado"] === "Adoptado") {
        $historias[] = $m;
    }
}

// Limitar cuántas mostrar en el inicio
$historias = array_slice($historias, 0, 3); // 👈 Cambia 3 por el número que quieras mostrar
?>


<!-- SECCIÓN "SOBRE NOSOTROS" -->
<section class="about-container reveal from-bottom">
  <h2 class="about-title">𝑨𝒎𝒐𝒓 𝒒𝒖𝒆 𝒔𝒂𝒏𝒂, 𝒑𝒓𝒐𝒕𝒆𝒈𝒆 𝒚 𝒕𝒓𝒂𝒏𝒔𝒇𝒐𝒓𝒎𝒂 </h2>
  <p class="about-subtitle">Trabajamos por quienes no tienen voz, pero sí un corazón inmenso.</p>
  <div class="about">
    <img src="https://cdn.pixabay.com/photo/2017/11/01/17/42/dog-and-cat-2908810_1280.jpg">
    <div class="about-text">
      <h3>¿Quiénes somos?</h3>
      <p>
        Somos una fundación dedicada a la protección, rescate y bienestar de perros y gatos en situación de abandono o maltrato.
        Ofrecemos atención médica, refugio temporal, recuperación emocional y buscamos familias responsables que les den una segunda oportunidad.
      </p>
      <p>
        Promovemos la adopción responsable, esterilización y la educación sobre el respeto por la vida animal.
        Gracias al apoyo de voluntarios y personas como tú, seguimos transformando vidas cada día.
      </p>
      <button class="help-btn" onclick="window.location.href='index.php?ruta=donacionesAdp'">
      <i class="fa-solid fa-heart"></i> Quiero ayudar</button>
    </div>
  </div>
</section>


<!-- GALERÍA -->
<h3 class="gallery-title reveal from-top">Nuestra fundacion y rescates realizados </h3>
<div class="gallery reveal stagger-container">
  <img class="stagger-item" src="https://imagenes.elpais.com/resizer/v2/2LNQJII6MRHVTAOWG7ZUE7TVIE.jpg?auth=0ef5bf695c9b206bccda59f5f115396144e05e7a3df648817548109e3676091b&width=414">
  <img class="stagger-item" src="https://i.revistapym.com.co/cms/2023/08/18171321/spark.png?w=412&d=2.625">
  <img class="stagger-item" src="https://img.lalr.co/cms/2017/07/12221638/unnamed_8_0.jpg?r=4_3">
  <img class="stagger-item" src="https://queondagye.com/wp-content/uploads/2023/06/Empresas-DONACION-1024x683.jpg">
</div>



<!-- HISTORIAS DE ADOPCIÓN -->
<section class="historia-section reveal from-bottom">
  <h3 class="historia-title reveal from-top">Historias que inspiran</h3>
  <?php foreach ($historias as $h): ?>

    <div class="historia-row reveal from-right">

      <!-- Título -->
      <div class="historia-left reveal from-left">
        <h2><?php echo $h['nombre']; ?></h2>
      </div>

      <!-- Imagen -->
      <div class="historia-center reveal from-right">
        <img src="../../../CarpetaCompartida/Mascotas/<?php echo $h['imagen']; ?>" alt="Mascota">
      </div>

      <!-- Descripción -->
      <div class="historia-right reveal from-right">
        <p>
          <?php 
            if (!empty($h['descripcion'])) {
              echo $h['descripcion'];
            } else {
              echo "Ahora disfruta una vida llena de amor junto a su nueva familia ❤️";
            }
          ?>
        </p>

        <button class="historia-btn reveal from-right" onclick="window.location.href='index.php?ruta=historiasAdp'">
          Ver historia completa
        </button>
      </div>

    </div>

  <?php endforeach; ?>
</section>


<!-- FRASE DESTACADA -->
<div class="quote-box reveal from-left">
  “No cambiamos al mundo entero… pero sí cambiamos el mundo de cada animal que rescatamos.” 
</div>


<!-- MISIÓN Y VISIÓN -->
<section class="mv-section my-5">
  <div class="container">
    <!-- MISIÓN -->
    <div class="row align-items-center mb-5">
      <!-- Imagen -->
      <div class="col-md-6 mb-4 mb-md-0 reveal from-left">
        <img src="https://cdn.pixabay.com/photo/2017/03/27/14/09/black-cat-2178983_1280.jpg"
             class="img-fluid rounded-4 shadow-sm mv-img" alt="Misión Safe Pets">
      </div>
      <!-- Texto -->
      <div class="col-md-6 reveal from-right">
        <h2 class="fw-bold mv-title text-center text-md-start">MISIÓN</h2>
        <p class="mv-text text-muted mt-3">
          Brindar amor, protección y una segunda oportunidad a los animales en situación de vulnerabilidad,
          impulsando su bienestar y conectándolos con adoptantes responsables.
        </p>
      </div>
    </div>

    <!-- VISIÓN -->
    <div class="row align-items-center flex-md-row-reverse">
      <!-- Imagen -->
      <div class="col-md-6 mb-4 mb-md-0 reveal from-right">
        <img src="https://images.pexels.com/photos/406014/pexels-photo-406014.jpeg"
             class="img-fluid rounded-4 shadow-sm mv-img" alt="Visión Safe Pets">
      </div>
      <!-- Texto -->
      <div class="col-md-6 reveal from-left">
        <h2 class="fw-bold mv-title text-center text-md-start">VISIÓN</h2>
        <p class="mv-text text-muted mt-3">
          Ser la plataforma más confiable para conectar adoptantes, fundaciones y rescatistas,
          promoviendo educación, responsabilidad y un futuro donde cada mascota tenga un hogar.
        </p>
      </div>
    </div>
  </div>
</section>




<style>
/* Estilos generales */
.about-container {
    padding: 60px 60px;
    background: #f1eae2ff;
    border-radius: 28px;
    margin: 70px auto 140px auto;   /* ⬅ MÁS ESPACIO DEBAJO */
    max-width: 1300px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    animation: fadeIn 1.4s ease-in-out;
}


  /* Títulos */
  .about-title {
    text-align: center;
    font-size: 2.8rem;
    font-weight: bold;
    color: #9C7B63;
    margin-top: 20px;
    animation: slideDown 1.2s ease;
  }

  .about-subtitle {
    text-align: center;
    color: #C9A48F;
    margin-bottom: 40px;
    font-size: 1.2rem;
    font-style: italic;
  }

  /* Contenido principal dentro del recuadro */
  .about {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
  }

  .about img {
    width: 320px;
    height: 320px;
    border-radius: 18px;
    object-fit: cover;
    box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    animation: zoomIn 1.2s ease;
  }

  .about-text {
    max-width: 650px;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #5A4638;
    text-align: justify;
    animation: fadeIn 1.5s ease;
  }

  .about-text h3 {
    font-size: 2rem;
    color: #8b5e3c;
    margin-bottom: 15px;
    text-align: center;
  }

  .help-btn {
    display: block;
    margin: 20px auto 0;
    padding: 12px 35px;
    background: #C9A48F;
    border: none;
    border-radius: 40px;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0px 6px 14px rgba(0,0,0,0.2);
    animation: pulse 2s infinite;
  }

  .help-btn:hover {
    transform: scale(1.07);
    background: #9C7B63;
  }

  /* Frase destacada */
  .quote-box {
    margin: 60px auto;
    padding: 25px 30px;
    background: #f0e4d8ff;
    border-left: 5px solid #C9A48F;
    border-radius: 10px;
    max-width: 900px;
    text-align: center;
    font-style: italic;
    font-size: 1.3rem;
    color: #5A4638;
    animation: fadeIn 1.8s ease;
  }

  /* Galería */

  .gallery-title {
    text-align: center;
    margin: 50px 0 25px;
    font-size: 2.2rem;
    color: #8b5e3c;
    animation: slideDown 1.2s ease;
    padding: 100px 0 0;
  }

  .gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(260px,1fr));
    gap: 35px; /* antes 25px */
    padding: 0 60px; /* más aire a los lados */
  }

  .gallery img {
    width: 100%;
    height: 230px;
    border-radius: 15px;
    object-fit: cover;
    transition: transform .4s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }

  .gallery img:hover {
    transform: scale(1.05);
  }

/* Historias de adopción */
.historia-section {
  max-width: 1300px;
  margin: 80px auto;
  padding: 50px 40px;
}

.historia-title {
  text-align: center;
  margin-bottom: 60px;
  font-size: 2.5rem;
  color: #8b5e3c;
  font-weight: 700;
}

/* Fila estilo Animalove */
.historia-row {
  display: grid;
  grid-template-columns: 0.8fr 1fr 2fr; /* 👉 MÁS ancho para la columna del texto */
  align-items: center;
  gap: 50px; /* más aire entre columnas */
  margin-bottom: 80px;
}

/* Columna izquierda (título grande) */
.historia-left h2 {
  font-size: 3rem;
  font-weight: 800;
  color: #5A4638;
}

/* Imagen estilo Animalove */
.historia-center img {
  width: 100%;
  max-width: 330px;
  display: block;
  margin: 0 auto;
  border-radius: 20px;
}

/* Texto */
.historia-right p {
  font-size: 1.10rem;     /* un poquito más grande */
  line-height: 2;         /* 👉 más separación entre líneas */
  color: #4f4a4a;
  margin-bottom: 30px;
  max-width: 900px;       /* 👉 texto más extendido */
  text-align: justify;
}

/* Botón estilo Animalove */
.historia-btn {
  width: 100%;
  background: #9C7B63;
  color: #fff;
  border: none;
  padding: 14px;
  font-size: 1.1rem;
  border-radius: 40px;
  cursor: pointer;
  transition: .3s;
}

.historia-btn:hover {
  background: #9C7B63;
  transform: scale(1.03);
}

/* Responsive */
@media (max-width: 992px) {
  .historia-row {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .historia-left h2 {
    text-align: center;
  }
}



  /* Misión y Visión */

  .mv-section {
    background: #f7f2ef; /* Fondo suave estilo Safe Pets */
    padding: 60px 0;
    border-radius: 20px;
  }

  .mv-title {
    font-size: 2rem;
    color: #9C7B63; /* Verde bonito similar al diseño */
    letter-spacing: 1px;
  }

  .mv-text {
    font-size: 1.1rem;
    line-height: 1.8;
  }

  .mv-img {
    height: 350px;
    width: 100%;
    object-fit: cover;
    border-radius: 15px;
  }

  /* Ajustes de márgenes para mejor espaciado */

  .about-container {
    margin: 70px auto; /* antes 40px */
  }

  .quote-box {
    margin: 80px auto; /* antes 60px */
  }

  .gallery-title {
    margin: 70px 0 35px; /* más separación antes y después */
  }

  .historias-container {
    margin: 80px auto; /* antes 60px */
    padding: 45px 50px; /* más aire dentro */
  }
  
  /* Animaciones */
  @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
  @keyframes zoomIn { from {transform: scale(0.7); opacity: 0;} to {transform: scale(1); opacity: 1;} }
  @keyframes slideDown { from {opacity: 0; transform: translateY(-15px);} to {opacity: 1; transform: translateY(0);} }
  @keyframes pulse { 0% {transform: scale(1);} 50% {transform: scale(1.05);} 100% {transform: scale(1);} }

  /* -------------------------
   Reveal + Stagger Utilities
   ------------------------- */
  .reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 900ms cubic-bezier(.22,.9,.32,1), 
                transform 900ms cubic-bezier(.22,.9,.32,1);
    will-change: opacity, transform;
    pointer-events: none;
  }

  .reveal.in-view {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
  }

  /* Direcciones alternativas */
  .reveal.from-left { transform: translateX(-30px); }
  .reveal.from-right { transform: translateX(30px); }
  .reveal.from-top { transform: translateY(-20px); }

  /* Zoom subtle */
  .reveal.zoom { transform: scale(.98) translateY(10px); }
  .reveal.zoom.in-view { transform: scale(1) translateY(0); }

  /* Glow opcional al aparecer */
  .reveal-glow.in-view { box-shadow: 0 10px 28px rgba(139,94,60,0.08); }

  /* Stagger container: aplica delays automáticamente a sus hijos .stagger-item */
  .stagger-container .stagger-item {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 800ms cubic-bezier(.22,.9,.32,1),transform 800ms cubic-bezier(.22,.9,.32,1);
    pointer-events: none;
  }

  .stagger-container.in-view .stagger-item {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
  }

  /* Reseteo: permite que elementos con transform horizontales vuelvan bien */
  .reveal.from-left.in-view,
  .reveal.from-right.in-view,
  .reveal.from-top.in-view { transform: translate(0); }

</style>


<script>
/* ANIMACIÓN DE CONTADORES */
const counters = document.querySelectorAll(".counter-number");
counters.forEach(counter => {
  counter.innerText = "0";
  const updateCounter = () => {
    const target = +counter.getAttribute("data-target");
    const count = +counter.innerText;
    const increment = target / 200;

    if (count < target) {
      counter.innerText = Math.ceil(count + increment);
      setTimeout(updateCounter, 10);
    } else {
      counter.innerText = target;
    }
  };
  updateCounter();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const opts = {
    root: null,
    rootMargin: '0px 0px -12% 0px', // aparece un poco antes
    threshold: 0.12
  };

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;

      const el = entry.target;

      // Si es stagger container, añadimos clase y delays a hijos
      if (el.classList.contains('stagger-container')) {
        // marcar container como visible
        el.classList.add('in-view');

        // aplicar delays a cada hijo .stagger-item
        const items = Array.from(el.querySelectorAll('.stagger-item'));
        items.forEach((it, i) => {
          // delay incremental (ajusta 80ms si quieres más rápido/lento)
          it.style.transitionDelay = (i * 80) + 'ms';
          // si el item tiene la clase reveal también la activamos (por redundancia)
          it.classList.add('in-view');
        });

        // dejamos de observar el container (solo animar una vez)
        obs.unobserve(el);
        return;
      }

      // Si el elemento tiene data-delay lo usamos
      const d = el.getAttribute('data-delay');
      if (d) el.style.transitionDelay = d;

      el.classList.add('in-view');

      // Una vez animado, dejar de observar para performance
      obs.unobserve(el);
    });
  }, opts);

  // Observamos los elementos marcados
  document.querySelectorAll('.reveal, .stagger-container').forEach(n => observer.observe(n));
});
</script>
