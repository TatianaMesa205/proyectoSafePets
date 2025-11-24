<link rel="stylesheet" href="view/css/citasAdp.css">

<div class="container py-4">
  <h2 class="titulo-cita">
    <i class="fas fa-calendar-plus"></i> Agendar Cita de Adopción
  </h2>

  <?php
    require_once "controller/adoptantesController.php"; 
    $email_usuario = isset($_SESSION['email']) ? $_SESSION['email'] : "ERROR_SESION";
    $adoptante = AdoptantesController::ctrMostrarAdoptante("email", $email_usuario);

    if (!$adoptante) {
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
        return;
    }

    $id_adoptante_db = $adoptante["id_adoptantes"];
  ?>

  <input type="hidden" id="id_adoptante_sesion" value="<?php echo $id_adoptante_db; ?>">

  <div class="form-panel-cita shadow">

    <h4 class="subtitulo-cita">Datos de la Solicitud</h4>

    <form id="formRegistroCitaAdp" novalidate>

      <div class="row g-4">

        <div class="col-md-12">
          <label class="label-cita">Mascota de interés</label>
          <select class="input-cita" id="select_mascotas_adp" required>
              <option value="">Cargando mascotas...</option>
          </select>
        </div>

        <div class="col-md-12">
          <label class="label-cita">Fecha y Hora deseada</label>
          <input type="datetime-local" id="txt_fecha_cita" class="input-cita" required>
        </div>

        <div class="col-md-12">
          <label class="label-cita">Motivo / Comentarios</label>
          <textarea id="txt_motivo" class="input-cita textarea-cita" rows="3" placeholder="Cuéntanos por qué quieres conocer esta mascota..."></textarea>
        </div>

      </div>

      <div class="botones-cita">
        <button type="submit" class="btn-confirmar-cita">Confirmar Cita</button>
        <a href="adoptaAdp" class="btn-cancelar-cita">Cancelar</a>
      </div>

    </form>
  </div>
</div>

<script src="view/js/citasAdp.js"></script>

<style>
  /* ---- TITULOS ---- */
  .titulo-cita {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
      color: #6b4f3a;
  }

  .subtitulo-cita {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
      color: #6b4f3a;
  }

  /* ---- PANEL PRINCIPAL ---- */
  .form-panel-cita {
      max-width: 850px;
      margin: auto;
      background: #faf9f8ff;
      border-radius: 20px;
      padding: 35px;
      border: 1px solid #e3d5c2;
  }

  /* ---- LABELS ---- */
  .label-cita {
      font-weight: bold;
      color: #6b4f3a;
      margin-bottom: 5px;
  }

  /* ---- INPUTS ---- */
  .input-cita {
      width: 100%;
      border: 1px solid #c8b8a6;
      background: #fff9f3;
      padding: 12px;
      border-radius: 10px;
      font-size: 15px;
  }

  .textarea-cita {
      resize: none;
  }

  /* ---- BOTONES ---- */
  .botones-cita {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 25px;
  }

  .btn-confirmar-cita {
      background: #b89572;
      color: white;
      padding: 10px 30px;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      transition: 0.3s;
  }

  .btn-confirmar-cita:hover {
      background: #a48263;
  }

  .btn-cancelar-cita {
      background: #d8c7b5;
      color: #4b3a2d;
      padding: 10px 30px;
      border-radius: 10px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
  }

  .btn-cancelar-cita:hover {
      background: #cbb7a0;
  }

</style>