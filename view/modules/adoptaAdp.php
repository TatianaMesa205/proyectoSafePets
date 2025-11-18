<?php
include_once "model/mascotasModel.php";

$respuesta = MascotasModel::mdlListarMascotas();
$listaMascotas = $respuesta["listaMascotas"];
?>


<div class="cards-container">

    <?php foreach ($listaMascotas as $mascota) { ?>
        
        <a href="index.php?ruta=detalleMascota&id=<?php echo $mascota['id_mascotas']; ?>" class="card"> 
            <div class="card-inner">

                <div class="card-front">
                    <img src="<?php echo $mascota['imagen']; ?>" alt="Mascota">
                </div>

                <div class="card-back">
                    <h3><?php echo $mascota['nombre']; ?></h3>
                    <p><strong>Edad:</strong> <?php echo $mascota['edad']; ?></p>
                    <p><strong>Sexo:</strong> <?php echo $mascota['sexo']; ?></p>
                </div>

            </div>
        </a>

    <?php } ?>

</div>

