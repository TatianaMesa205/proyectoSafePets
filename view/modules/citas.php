<?php
// Esta sección procesa los datos cuando el usuario envía el formulario.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Es una buena práctica de seguridad limpiar los datos recibidos.
    $nombre   = htmlspecialchars($_POST["nombre"]);
    
    // Aquí iría tu lógica para guardar la cita en la base de datos.
    
    // Se muestra un mensaje de confirmación al usuario.
    echo "<script>alert('¡Tu cita ha sido registrada con éxito, $nombre!');</script>";
}
?>

<div class="citas-page"> 

  <div class="containerCita">
    <h2><i class="fa-solid fa-calendar-check"></i> Agendar Cita</h2>
    
    <form action="citas" method="POST">
      
      <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="ejemplo@email.com" required>
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="tel" id="telefono" name="telefono" placeholder="3001234567" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="fecha">Fecha de la cita</label>
          <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
          <label for="hora">Hora</label>
          <input type="time" id="hora" name="hora" required>
        </div>
      </div>

      <div class="form-group">
        <label for="mensaje">Motivo de la cita</label>
        <textarea id="mensaje" name="mensaje" placeholder="Escribe un breve motivo..."></textarea>
      </div>

      <button type="submit"><i class="fa-solid fa-paw"></i> Confirmar cita</button>
    </form>
  </div>
  
</div>