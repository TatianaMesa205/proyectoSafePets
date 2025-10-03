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
      height: 300px;
      border-radius: 15px;
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
<section class="about" style="margin-top: 30px;">
    <img src="https://images.pexels.com/photos/4012470/pexels-photo-4012470.jpeg" alt="gatitos">
    <div class="about-text">
      <h2>𝐀𝐦𝐨𝐫 𝐪𝐮𝐞 𝐭𝐫𝐚𝐧𝐬𝐟𝐨𝐫𝐦𝐚 𝐯𝐢𝐝𝐚𝐬 <i class="fa-solid fa-paw"></i></h2>
      <p>
        𝐒𝐨𝐦𝐨𝐬 𝐮𝐧𝐚 𝐅𝐮𝐧𝐝𝐚𝐜𝐢ó𝐧 𝐪𝐮𝐞 𝐛𝐮𝐬𝐜𝐚 𝐥𝐚 𝐩𝐫𝐨𝐭𝐞𝐜𝐜𝐢ó𝐧, 𝐫𝐞𝐬𝐜𝐚𝐭𝐞 𝐲 𝐛𝐢𝐞𝐧𝐞𝐬𝐭𝐚𝐫 𝐝𝐞 𝐩𝐞𝐫𝐫𝐨𝐬 𝐲 𝐠𝐚𝐭𝐨𝐬...
      </p>
      <p>
        𝐏𝐫𝐨𝐦𝐨𝐯𝐞𝐦𝐨𝐬 𝐥𝐚 𝐞𝐝𝐮𝐜𝐚𝐜𝐢ó𝐧 𝐬𝐨𝐛𝐫𝐞 𝐭𝐞𝐧𝐞𝐧𝐜𝐢𝐚 𝐫𝐞𝐬𝐩𝐨𝐧𝐬𝐚𝐛𝐥𝐞...
      </p>
      <p>
        𝐂𝐫𝐞𝐞𝐦𝐨𝐬 𝐪𝐮𝐞 𝐜𝐚𝐝𝐚 𝐯𝐢𝐝𝐚 𝐢𝐦𝐩𝐨𝐫𝐭𝐚...
      </p>
      <a href="login" class="btn btn-primary d-block mx-auto mt-3" style="background: #c4a484; border: none; max-width: 200px;">Iniciar Sesión para Adoptar</a>
    </div>
</section>

<?php include __DIR__ . '/flooter.php'; // Corrected path to include the footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>