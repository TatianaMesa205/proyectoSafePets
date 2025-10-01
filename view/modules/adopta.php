<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tarjetas Mascotas</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: #f9f6f6;
    }

    /* Contenedor en columna */
    .cards-container {
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      padding: 30px;
      justify-content: center;
      max-width: calc(220px * 5 + 25px * 4); /* ancho para 4 tarjetas */
      margin: auto;
    }


    /* Carta */
    .card {
      width: 220px;
      height: 220px;
      perspective: 1000px;
      cursor: pointer; /* 👈 Para que se vea clickeable */
      border-radius: 15px; 
      background-color: #f9f6f6;
    }

    .card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.3s ease-in-out;
      transform-style: preserve-3d;
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
      box-shadow: none;
    }

    .card-front img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

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

    .card, .card-front img {
      border: none;
      outline: none;
      box-shadow: none;
    }
  </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="cards-container">
  <?php
    // Mascotas de ejemplo
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

    foreach ($mascotas as $m) {
      echo '
      <div class="card" onclick="goTo(\'detalleMascota.php?id='.$m["id"].'\')">
        <div class="card-inner">
          <div class="card-front">
            <img src="'.$m["imagen"].'" alt="'.$m["nombre"].'">
          </div>
          <div class="card-back">
            <h3>'.$m["nombre"].'</h3>
            <p>Edad: '.$m["edad"].'</p>
            <p>Sexo: '.$m["sexo"].'</p>
          </div>
        </div>
      </div>
      ';
    }
  ?>
</div>

<script>
  // Redirige al detalle
  function goTo(url) {
    window.location.href = url;
  }
</script>

<?php include 'flooter.php'; ?>

</body>
</html>
