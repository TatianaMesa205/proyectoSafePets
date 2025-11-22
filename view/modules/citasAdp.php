<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-calendar-plus"></i> Agendar Cita de Adopción
  </h2>

  <?php
    // --- CORRECCIÓN: INCLUIR EL CONTROLADOR ---
    // Esto carga la definición de la clase AdoptantesController para poder usarla abajo.
    require_once "controller/adoptantesController.php"; 
    // -------------------------------------------

    // 1. Obtener el email de la sesión de forma segura
    $email_usuario = isset($_SESSION['email']) ? $_SESSION['email'] : "ERROR_SESION";

    // 2. Buscar si existe este email en la tabla adoptantes
    // Ahora esta línea funcionará porque la clase ya está cargada
    $adoptante = AdoptantesController::ctrMostrarAdoptante("email", $email_usuario);
    
    // 3. VALIDACIÓN: Si no encuentra al adoptante, bloquea el formulario
    if (!$adoptante) {
        echo '<div class="alert alert-warning text-center p-4">';
        echo '<h4><i class="fas fa-exclamation-triangle"></i> Acción Requerida</h4>';
        echo '<p>Tu usuario está registrado con el correo: <strong>' . $email_usuario . '</strong></p>';
        echo '<p>Pero no encontramos una ficha de adoptante con ese mismo correo.</p>';
        echo '<a href="index.php?ruta=registro-adoptante" class="btn btn-primary mt-2">Crear mi ficha de Adoptante ahora</a>';
        echo '</div>';
        
        // Script para la alerta visual (SweetAlert)
        echo '<script>
            Swal.fire({
                icon: "warning",
                title: "Perfil incompleto",
                html: "No encontramos datos de adoptante para el correo: <b>' . $email_usuario . '</b>.<br>Debes registrar tus datos antes de agendar una cita.",
                confirmButtonText: "Ir a completar registro",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?ruta=registro-adoptante";
                }
            });
        </script>';
        return; // Detiene la carga del resto de la página
    }

    $id_adoptante_db = $adoptante["id_adoptantes"];
  ?>

  <input type="hidden" id="id_adoptante_sesion" value="<?php echo $id_adoptante_db; ?>">

  <div class="form-panel shadow-sm rounded-4 p-4 mx-auto" style="max-width: 800px; background: #fff;">
    
    <h4 class="mb-4 text-center text-dark fw-semibold">Datos de la Solicitud</h4>
    
    <form id="formRegistroCitaAdp" novalidate>
      <div class="row g-3">
        
        <div class="col-md-12">
          <label for="select_mascotas_adp" class="form-label fw-bold">Mascota de interés</label>
          <select class="form-select rounded-3" id="select_mascotas_adp" required>
              <option value="">Cargando mascotas...</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Fecha y Hora deseada</label>
          <input type="datetime-local" id="txt_fecha_cita" class="form-control rounded-3" required>
        </div>
        
        <div class="col-md-12">
          <label class="form-label">Motivo / Comentarios</label>
          <textarea id="txt_motivo" class="form-control rounded-3" rows="3" placeholder="Ej: Quiero conocerlo para adoptarlo..."></textarea>
        </div>

      </div>
      
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit" style="min-width: 150px;">Confirmar Cita</button>
        <a href="index.php?ruta=adoptaAdp" class="btn btn-secondary rounded-3" style="min-width: 150px;">Cancelar</a>
      </div>
    </form>

  </div>
</div>

<script src="view/js/citasAdp.js"></script>