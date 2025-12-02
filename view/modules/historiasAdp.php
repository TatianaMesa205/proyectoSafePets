<?php
include_once "model/mascotasModel.php";

$respuesta = MascotasModel::mdlListarMascotas();
$listaMascotas = $respuesta["listaMascotas"];
?>



<div class="titulo-seccion">
    Historias de Adopción
</div>

<div class="adop-grid">

    <?php foreach ($listaMascotas as $mascota) { 
        if ($mascota["estado"] != "Adoptado") continue;
    ?>

        <div class="tarjeta-adopcion">

            <h3 class="nombre-mascota"><?php echo $mascota["nombre"]; ?></h3>

            <div class="info-mascota">
                <p><b>Especie:</b> <?= $mascota["especie"] ?></p>
                <p><b>Raza:</b> <?= $mascota["raza"] ?></p>
                <p><b>Edad:</b> <?= $mascota["edad"] ?> años</p>
            </div>

            <div class="foto-mascota">
                <img src="../../../CarpetaCompartida/Mascotas/<?= $mascota['imagen'] ?>" alt="Foto de mascota">
            </div>


            <p class="historia-mascota">
                <?= $mascota["descripcion"] ?>
            </p>

        </div>

    <?php } ?>

</div> <br>


<style>

/* Título centrado arriba */
.titulo-seccion {
    text-align: center;
    font-size: 32px;
    color: #6b4f3a;
    margin-bottom: 30px;
    font-family: 'Poppins', sans-serif;
}

/* Grid correctamente centrado */
.adop-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    padding: 15px;
    justify-content: center;
}

.adop-grid > *:nth-child(odd):last-child {
    grid-column: 1 / -1;     /* La tarjeta ocupa toda la fila */
    justify-self: center;    /* Se centra */
    max-width: 480px;        /* Para que no se estire */
}



/* Tarjeta */
.tarjeta-adopcion {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    font-family: 'Poppins', sans-serif;
}

/* Nombre */
.nombre-mascota {
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    color: #8b5e3c;
    margin-bottom: 20px;
}

/* Info */
.info-mascota { display: flex; gap: 30px; font-size: 15px; color: #5c4b43; margin-bottom: 10px; justify-content: center; }

.info-mascota b {
    color: #6b3e2e;
}

/* Imagen */
.foto-mascota img {
    width: 100%;
    height: 200px;
    border-radius: 12px;
    object-fit: cover;
    margin-bottom: 10px;
}

/* Historia */
.historia-mascota {
    font-size: 14px;
    color: #4a3b32;
    text-align: center;
}

</style>