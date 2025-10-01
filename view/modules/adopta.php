<div class="cards-container">
  <?php
    // Array con la información de las mascotas.
    // Las rutas a las imágenes son relativas a la raíz del proyecto (donde está index.php),
    // por lo que "uploads/imagen.jpeg" es la forma correcta.
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

    // Se recorre el array para generar una tarjeta HTML por cada mascota.
    foreach ($mascotas as $m) {
      echo '
      <div class="card" onclick="goTo(\'detalleMascota?id='.$m["id"].'\')">
        <div class="card-inner">
          <div class="card-front">
            <img src="'.$m["imagen"].'" alt="Foto de '.$m["nombre"].'">
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
  // Función de JavaScript para redirigir a la página de detalles.
  function goTo(url) {
    window.location.href = url;
  }
</script>

<?php include 'flooter.php'; ?>