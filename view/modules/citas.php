<?php
// Aquí procesarías los datos cuando el usuario envíe el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre   = htmlspecialchars($_POST["nombre"]);
    $email    = htmlspecialchars($_POST["email"]);
    $telefono = htmlspecialchars($_POST["telefono"]);
    $fecha    = htmlspecialchars($_POST["fecha"]);
    $hora     = htmlspecialchars($_POST["hora"]);
    $mensaje  = htmlspecialchars($_POST["mensaje"]);

    // Ejemplo: enviar correo o guardar en base de datos
    // mail(...), mysqli_query(...), etc.
    
    echo "<script>alert('Tu cita ha sido registrada con éxito. ¡Gracias $nombre!');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agendar Cita - Safe Pets</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

      body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background-color: #f9f6f6;
      }
        /* --- SOLO afecta a citas.php --- */
        .citas-page .containerCita {
        max-width: 700px;
        margin: 60px auto;
        background: #f0e4d8;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .citas-page h2 {
        text-align: center;
        color: #6b4f3f;
        margin-bottom: 20px;
        }

        .citas-page form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        }

        .citas-page label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #4b3832;
        }

        .citas-page input,
        .citas-page textarea,
        .citas-page select {
        padding: 12px;
        border: 1px solid #c0a18b;
        border-radius: 10px;
        font-size: 15px;
        outline: none;
        transition: 0.3s;
        width: 100%;
        background: #fff;
        }

        .citas-page input:focus,
        .citas-page textarea:focus,
        .citas-page select:focus {
        box-shadow: 0 0 6px rgba(160,123,97,0.5);
        }

        .citas-page textarea {
        resize: none;
        height: 100px;
        }

        .citas-page button {
        padding: 14px;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        }

      

        /* Filas y grupos de formulario personalizados */
        .citas-page .form-row {
        display: flex;
        gap: 15px;
        }

        .citas-page .form-row .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        }
    </style>
</head>
<body class="citas-page">

<?php include 'menu.php'; ?>

  <div class="containerCita">
    <h2><i class="fa-solid fa-calendar-check"></i> Agendar Cita</h2>
    <form action="citas.php" method="POST">
      
      <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
      </div>

      <div class="row">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="ejemplo@email.com" required>
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="tel" id="telefono" name="telefono" placeholder="3001234567" required>
        </div>
      </div>

      <div class="row">
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

  <!-- Footer -->
  <?php include 'flooter.php'; ?>

</body>
</html>
