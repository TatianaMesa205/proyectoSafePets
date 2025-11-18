<style>
/* ============================
   NUEVA SECCIÓN ABOUT ELEGANTE
============================ */
/* Contenedor general solo del ABOUT */
.about-container {
  padding: 40px 40px;
  background: #fff7f4;
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
  color: #8b5e3c;
  margin-top: 20px;
  animation: slideDown 1.2s ease;
}

.about-subtitle {
  text-align: center;
  color: #ad7a52;
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
  color: #5b4636;
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
  background: #d8a47f;
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
  background: #b68463;
}

/* Frase destacada */
.quote-box {
  margin: 60px auto;
  padding: 25px 30px;
  background: #fff3eb;
  border-left: 5px solid #c48c60;
  border-radius: 10px;
  max-width: 900px;
  text-align: center;
  font-style: italic;
  font-size: 1.3rem;
  color: #6a4f3b;
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
  gap: 25px;
  padding: 0 40px;
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



/* Animaciones */
@keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
@keyframes zoomIn { from {transform: scale(0.7); opacity: 0;} to {transform: scale(1); opacity: 1;} }
@keyframes slideDown { from {opacity: 0; transform: translateY(-15px);} to {opacity: 1; transform: translateY(0);} }
@keyframes pulse { 0% {transform: scale(1);} 50% {transform: scale(1.05);} 100% {transform: scale(1);} }

</style>

<!-- ============================
        CONTENIDO HTML
============================ -->



<!-- 💛 ABOUT solo esta parte dentro de un recuadro -->
<section class="about-container">

  <h2 class="about-title">𝑨𝒎𝒐𝒓 𝒒𝒖𝒆 𝒔𝒂𝒏𝒂, 𝒑𝒓𝒐𝒕𝒆𝒈𝒆 𝒚 𝒕𝒓𝒂𝒏𝒔𝒇𝒐𝒓𝒎𝒂 </h2>
  <p class="about-subtitle">Trabajamos por quienes no tienen voz, pero sí un corazón inmenso.</p>

  <div class="about">
    
    <img src="https://images.pexels.com/photos/4012470/pexels-photo-4012470.jpeg">

    <div class="about-text">
      <h3>¿Quiénes somos?</h3>

      <p>
        Somos una fundación dedicada a la protección, rescate y bienestar de perros y gatos en situación de abandono o maltrato.
      </p>

      <p>
        Ofrecemos atención médica, refugio temporal, recuperación emocional y buscamos familias responsables que les den una segunda oportunidad.
      </p>

      <p>
        Promovemos la adopción responsable, esterilización y la educación sobre el respeto por la vida animal.
      </p>

      <p>
        Gracias al apoyo de voluntarios y personas como tú, seguimos transformando vidas cada día.
      </p>

      <button class="help-btn"><i class="fa-solid fa-heart"></i> Quiero ayudar</button>
    </div>

  </div>

</section>


<!-- GALERÍA -->
<h3 class="gallery-title">Fundaciones y rescates que nos inspiran 🐾</h3>
<div class="gallery">
  <img src="https://scontent.fpei1-1.fna.fbcdn.net/v/t51.75761-15/464471014_18460800316054773_2502976628373376055_n.jpg?stp=dst-jpg_tt6&_nc_cat=100&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFjGCxUcP7UsVFtfZ2BksH--p898YPJGc36nz3xg8kZzXzcTHVOSevGDHCyv85hLMNHLEFeR9sbnWpGg77NAxBO&_nc_ohc=_P4m467WGkEQ7kNvwGC6d4j&_nc_oc=AdnKKJx7oh_8VTgE_wvjio9UyI_jPmMsNoSYvzghQuuG-MESTbCxH-_OyYXkCkkR5D9AHCzw0dUGso7G28bAQ5-B&_nc_zt=23&_nc_ht=scontent.fpei1-1.fna&_nc_gid=Tv06Qdv7Iv7D6Q_EUPxxDw&oh=00_Afhe1ZKyTuJygmW4ycxugbWgPJQyQHyrZAzfcsr8D0OYQQ&oe=6921475A">
  <img src="https://i.revistapym.com.co/cms/2023/08/18171321/spark.png?w=412&d=2.625">
  <img src="https://img.lalr.co/cms/2017/07/12221638/unnamed_8_0.jpg?r=4_3">
  <img src="https://queondagye.com/wp-content/uploads/2023/06/Empresas-DONACION-1024x683.jpg">
</div>

<!-- FRASE DESTACADA -->
<div class="quote-box">
  “No cambiamos al mundo entero… pero sí cambiamos el mundo de cada animal que rescatamos.” 🐾
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
