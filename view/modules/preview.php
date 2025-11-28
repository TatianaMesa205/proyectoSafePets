<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Safe Pets - Conócenos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="view/css/styles.css">
</head>
<body>
  <style>
.about-container {
    padding: 40px 40px;
    background: #F3E6DD;
    border-radius: 25px;
    margin: 40px auto;
    max-width: 1200px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
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
    background: #EFD8C5;
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


  /* Sección de historias */
.historias-container {
  max-width: 1200px;
  margin: 60px auto;
  padding: 30px 40px;
  background: #fff7f4;
  border-radius: 25px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  animation: fadeIn 1.4s ease;
}

.historias-title {
  text-align: center;
  font-size: 2.2rem;
  color: #8b5e3c;
  margin-bottom: 25px;
}

.historias-grid {
  display: grid;
  gap: 35px; /* antes 25px */
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
}

.historia-card {
  background: #ffece3;
  border-radius: 18px;
  padding: 18px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.12);
  transition: 0.3s ease;
}

.historia-card:hover {
  transform: translateY(-5px);
}

.historia-card img {
  width: 100%;
  height: 180px;
  border-radius: 12px;
  object-fit: cover;
}

.historia-card h4 {
  color: #8b5e3c;
  margin-top: 12px;
  font-size: 1.3rem;
}

.historia-card p {
  color: #6b5644;
  font-size: 0.95rem;
  margin-top: 5px;
}

/* Botón ver más */
.vermas-btn {
  display: block;
  margin: 30px auto 0;
  padding: 12px 35px;
  background: #d8a47f;
  border: none;
  border-radius: 40px;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0px 6px 14px rgba(0,0,0,0.2);
}

.vermas-btn:hover {
  transform: scale(1.07);
  background: #b68463;
}

.quick-btn {
  background: #F3E6DD; /* crema suave */
  border: 2px solid #C9A48F; /* borde café pastel */
  color: #5A4638; /* texto café */
  border-radius: 20px;
  padding: 12px 18px;
  font-weight: 600;
  transition: transform .35s ease, box-shadow .35s, background .35s;
}

.quick-btn:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  background: #E8D5C4; /* beige suave */
}


/* Chat flotante */

.chat-float {
  position: fixed;
  bottom: 28px;
  right: 28px;
  background: #d8a47f;
  color: white;
  width: 55px;
  height: 55px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 25px;
  cursor: pointer;
  z-index: 999;
  box-shadow: 0 6px 18px rgba(0,0,0,0.25);
  transition: transform .3s ease;
}
.chat-float:hover { transform: scale(1.1); }

.chat-box {
  position: fixed;
  bottom: 95px;
  right: 28px;
  width: 260px;
  background: #fff;
  border-radius: 12px;
  display: none;
  z-index: 999;
}

.chat-header {
  padding: 12px;
  background: #d8a47f;
  color: white;
  border-radius: 12px 12px 0 0;
  display: flex;
  justify-content: space-between;
}

.chat-body {
  padding: 15px;
  font-size: 0.9rem;
  color: #6a4f3b;
}

.close-chat {
  cursor: pointer;
  font-size: 20px;
}

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
  transition: opacity 800ms cubic-bezier(.22,.9,.32,1),
              transform 800ms cubic-bezier(.22,.9,.32,1);
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


<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #f0e4d8ff;">
  <div class="container">
    <a class="navbar-brand" href="index.php?ruta=preview" style="font-weight: bold; font-size: 1.7rem; color: #8b5e3c !important;">
        <i class="fas fa-paw me-2"></i>Safe Pets
    </a>
    <div class="ms-auto">
        <a href="index.php?ruta=login" class="btn btn-outline-secondary">Iniciar Sesión</a>
        <a href="index.php?ruta=registro" class="btn btn-primary" style="background: linear-gradient(to right, #d6baa5, #c4a484); border: none; color: #fff;">Registrarse</a>
    </div>
  </div>
</nav>



<section class="about-container reveal from-bottom">

  <h2 class="about-title">𝑨𝒎𝒐𝒓 𝒒𝒖𝒆 𝒔𝒂𝒏𝒂, 𝒑𝒓𝒐𝒕𝒆𝒈𝒆 𝒚 𝒕𝒓𝒂𝒏𝒔𝒇𝒐𝒓𝒎𝒂 </h2>
  <p class="about-subtitle">Trabajamos por quienes no tienen voz, pero sí un corazón inmenso.</p>

  <div class="about">
    
    <img src="https://images.pexels.com/photos/4012470/pexels-photo-4012470.jpeg">

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

      <a href="login" class="btn btn-primary d-block mx-auto mt-3" style="background: #c4a484; border: none; max-width: 200px;">Iniciar Sesión para Adoptar</a>
    </div>

  </div>

</section>


<!-- GALERÍA -->
<h3 class="gallery-title reveal from-top">Nuestra fundacion y rescates realizados 🐾</h3>
<div class="gallery reveal stagger-container">
  <img class="stagger-item" src="https://imagenes.elpais.com/resizer/v2/2LNQJII6MRHVTAOWG7ZUE7TVIE.jpg?auth=0ef5bf695c9b206bccda59f5f115396144e05e7a3df648817548109e3676091b&width=414">
  <img class="stagger-item" src="https://i.revistapym.com.co/cms/2023/08/18171321/spark.png?w=412&d=2.625">
  <img class="stagger-item" src="https://img.lalr.co/cms/2017/07/12221638/unnamed_8_0.jpg?r=4_3">
  <img class="stagger-item" src="https://queondagye.com/wp-content/uploads/2023/06/Empresas-DONACION-1024x683.jpg">
</div>

<!-- FRASE DESTACADA -->
<div class="quote-box reveal from-left">
  “No cambiamos al mundo entero… pero sí cambiamos el mundo de cada animal que rescatamos.” 🐾
</div>



<!-- MISIÓN Y VISIÓN -->
<section class="mv-section container my-5">
  <h2 class="text-center mb-4 reveal from-top">Nuestra misión y visión 🤎</h2>

  <div class="row text-center">

    <div class="col-md-6 mb-4 reveal from-left">
      <div class="mv-box shadow-sm p-4 rounded-4">
        <i class="fa-solid fa-heart fs-1 mb-3" style="color:#b68463;"></i>
        <h4 class="fw-bold">Nuestra Misión</h4>
        <p class="mt-2 text-muted">
          Brindar amor, protección y una segunda oportunidad a los animales más vulnerables,
          conectándolos con adoptantes responsables.
        </p>
      </div>
    </div>

    <div class="col-md-6 mb-4 reveal from-right">
      <div class="mv-box shadow-sm p-4 rounded-4">
        <i class="fa-solid fa-paw fs-1 mb-3" style="color:#b68463;"></i>
        <h4 class="fw-bold">Nuestra Visión</h4>
        <p class="mt-2 text-muted">
          Ser el puente más confiable entre fundaciones, rescatistas y familias, promoviendo bienestar,
          educación y adopciones seguras.
        </p>
      </div>
    </div>

  </div>
</section>



<!-- CHAT FLOTANTE -->
<div id="chatBubble" class="chat-float reveal from-right">
  <i class="fa-solid fa-comments"></i>
</div>

<div id="chatBox" class="chat-box shadow-lg">
  <div class="chat-header">
    <strong>Safe Pets 🐾</strong>
    <span id="closeChat" class="close-chat">&times;</span>
  </div>

  <div class="chat-body">
    <p>¡Hola! 🐶💛<br> ¿Necesitas ayuda con una adopción o tienes dudas?</p>
  </div>
</div>




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

<script>
document.getElementById("chatBubble").addEventListener("click", () => {
  document.getElementById("chatBox").style.display = "block";
});

document.getElementById("closeChat").addEventListener("click", () => {
  document.getElementById("chatBox").style.display = "none";
});
</script>














<?php include __DIR__ . '/flooter.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>