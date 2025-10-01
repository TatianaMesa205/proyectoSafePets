<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Adopta una Mascota - Safe Pets</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: #f9f6f6;
    }

    /* Contenedor principal de las tarjetas */
    .cards-container {
      display: flex;
      flex-wrap: wrap;
      gap: 25px; /* Espacio entre tarjetas */
      padding: 30px;
      justify-content: center;
      max-width: 1200px; /* Ancho máximo para 5 tarjetas por fila */
      margin: auto;
    }

    /* Estilo de cada tarjeta */
    .card {
      width: 220px;
      height: 220px;
      perspective: 1000px;
      cursor: pointer;
      border-radius: 15px; 
      background-color: transparent; /* Hacemos el fondo transparente */
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Sombra sutil */
      transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px); /* Efecto al pasar el mouse */
    }

    .card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.5s;
      transform-style: preserve-3d;
      border-radius: 15px;
    }

    .card:hover .card-inner {
      transform: rotateY(180deg);
    }

    .card-front, .card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border-radius: 15px;
      overflow: hidden;
    }

    /* Cara frontal con la imagen de la mascota */
    .card-front img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Asegura que la imagen cubra el espacio sin deformarse */
    }

    /* Cara trasera con la información */
    .card-back {
      background: #f0e4d8;
      color: #a07b61;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transform: rotateY(180deg);
      padding: 15px;
      text-align: center;
    }
  </style>
</head>
<body>

<?php 
  // Se incluye el menú de navegación. 
  // Este archivo debe estar en la misma carpeta (view/modules/).
  include 'menu.php'; 
?>

<div class="cards-container">
  <?php
    // Array con la información de las mascotas.
    // Las rutas de las imágenes son correctas porque el proyecto se ejecuta desde el 'index.php' en la raíz.
    // El navegador buscará la carpeta 'uploads' desde la raíz del proyecto.
    $mascotas = [
      ["id"=>1, "nombre"=>"Zeus", "edad"=>"2 años", "sexo"=>"Macho", "imagen"=>"uploads/p1.jpeg"],
      ["id"=>2, "nombre"=>"Luna", "edad"=>"3 años", "sexo"=>"Hembra", "imagen"=>"uploads/g1.jpeg"],
      ["id"=>3, "nombre"=>"Max", "edad"=>"1 año", "sexo"=>"Macho", "imagen"=>"uploads/p2.jpeg"],
      ["id"=>4, "nombre"=>"Nina", "edad"=>"4 años", "sexo"=>"Hembra", "imagen"=>"uploads/gato.jpeg"],
      ["id"=>5, "nombre"=>"Rocky", "edad"=>"5 años", "sexo"=>"Macho", "imagen"=>"uploads/p3.jpeg"],
      ["id"=>6, "nombre"=>"Molly", "edad"=>"2 años", "sexo"=>"Hembra", "imagen"=>"uploads/g2.jpeg"],
      ["id"=>7, "nombre"=>"Buddy", "edad"=>"3 años", "sexo"=>"Macho", "imagen"=>"uploads/g3.jpeg"],
      ["id"=>8, "nombre"=>"Daisy", "edad"=>"1 año", "sexo"=>"Hembra", "imagen"=>"uploads/p4.jpeg"],
      ["id"=>9, "nombre"=>"Charlie", "edad"=>"4 años", "sexo"=>"Macho", "imagen"=>"uploads/g4.jpeg"],
      ["id"=>10, "nombre"=>"Bella", "edad"=>"5 años", "sexo"=>"Hembra", "imagen"=>"uploads/Dog.jpeg"],
      ["id"=>11, "nombre"=>"Toby", "edad"=>"2 años", "sexo"=>"Macho", "imagen"=>"uploads/perrito.jpeg"],
      ["id"=>12, "nombre"=>"Lucy", "edad"=>"3 años", "sexo"=>"Hembra", "imagen"=>"uploads/g5.jpeg"],
    ];

    // Se recorre el array para generar una tarjeta por cada mascota.
    foreach ($mascotas as $mascota) {
      echo '
      <div class="card" onclick="goTo(\'detalleMascota.php?id='.$mascota["id"].'\')">
        <div class="card-inner">
          <div class="card-front">
            <img src="'.$mascota["imagen"].'" alt="Foto de '.$mascota["nombre"].'">
          </div>
          <div class="card-back">
            <h3>'.$mascota["nombre"].'</h3>
            <p>Edad: '.$mascota["edad"].'</p>
            <p>Sexo: '.$mascota["sexo"].'</p>
          </div>
        </div>
      </div>
      ';
    }
  ?>
</div>

<script>
  // Función de JavaScript para redirigir a la página de detalles de la mascota.
  function goTo(url) {
    window.location.href = url;
  }
</script>

<?php 
  // Se incluye el pie de página.
  include 'flooter.php'; 
?>

</body>
</html>