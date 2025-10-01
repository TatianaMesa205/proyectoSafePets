<!-- flooter.php -->
<style>
/* Pie de página principal con logo, info y redes */
.footer {
  background-color: #f0e4d8ff;
  padding: 40px 20px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap; /* se acomoda en pantallas pequeñas */
  border-radius: 20px 20px 0 0;
  font-family: 'Arial', sans-serif;
}

/* Logo */
.footer .logo {
  text-align: center;
  flex: 1;
  min-width: 200px;
  margin-bottom: 20px;
}

.footer .logo i {
  font-size: 50px;
  margin-bottom: 10px;
  color: #a07b61; 
}

/* Información */
.footer .info {
  flex: 1;
  min-width: 200px;
  margin-bottom: 20px;
}

.footer .info h5 {
  margin-bottom: 15px;
  color: #4b3832;
}

.footer ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer ul li { 
  margin-bottom: 10px;
  font-size: 15px;
  color: #4b3832;
}

.footer ul li i {
  color: #a07b61;
  margin-right: 10px;
}

/* Redes sociales */
.footer .social {
  flex: 1;
  min-width: 200px;
  margin-bottom: 20px;
}

.footer .social h5 {
  margin-bottom: 15px;
  color: #4b3832;
}

.social-icons a {
  margin: 0 8px;
  color: #a07b61;
  font-size: 26px;
  transition: 0.3s;
}

.social-icons a:hover {
  color: #c0a18bff;
}

/* Sección inferior */
.footer-bottom {
  text-align: center;
  margin-top: 20px;
  flex-basis: 100%;
}

.footer-bottom hr {
  border: none;
  border-top: 2px dashed #a07b61;
  margin: 10px auto;
  width: 95%;
}

.footer-bottom p {
  margin-top: 10px;
  font-size: 14px;
  color: #4b3832;
}
</style>

<footer class="footer">
  <div class="logo">
    <i class="fa-solid fa-paw"></i>
    <p><strong>𝒮𝒶𝒻𝑒 𝒫𝑒𝓉𝓈</strong></p> 
  </div>

  <div class="info">
    <h5>Información</h5>
    <ul>
      <li><i class="fa-solid fa-location-dot"></i> Calle 45B #23 - 76</li>
      <li><i class="fa-solid fa-envelope"></i> contacto@corazonpeludito.com</li>
      <li><i class="fa-solid fa-envelope"></i> adoptante@corazonpeludito.com</li>
      <li><i class="fa-solid fa-phone"></i> 3001109458</li>
    </ul>
  </div>

  <div class="social">
    <h5>Síguenos</h5>
    <div class="social-icons">
      <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
      <a href="#"><i class="fa-brands fa-facebook"></i></a>
      <a href="#"><i class="fa-brands fa-instagram"></i></a>
      <a href="#"><i class="fa-brands fa-tiktok"></i></a>
      <a href="#"><i class="fa-brands fa-youtube"></i></a>
    </div>
  </div>

  <!-- Línea + texto de copyright -->
  <div class="footer-bottom">
    <hr>
    <p>© 2025 Safe Pets - Adoptar es un acto de amor.</p>
  </div>

    
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</footer>
