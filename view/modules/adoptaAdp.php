<?php
include_once "model/mascotasModel.php";

$respuesta = MascotasModel::mdlListarMascotas();
$listaMascotas = $respuesta["listaMascotas"];
?>

<div class="cards-container">

    <?php foreach ($listaMascotas as $mascota) { ?>

        <?php if (strtolower($mascota['estado']) === 'adoptado') continue; ?> 

        <a href="index.php?ruta=detalleMascota&id=<?php echo $mascota['id_mascotas']; ?>" class="card"> 
            
            <div class="card-inner">

                <!-- FRONT -->
                <div class="card-front">
                    <img src="<?php echo $mascota['imagen']; ?>" alt="Mascota">

                    <!-- BURBUJA DE ESTADO -->
                    <span class="estado-badge 
                        <?php 
                            echo strtolower($mascota['estado']) === 'disponible' ? 'estado-disponible' : ''; 
                            echo strtolower($mascota['estado']) === 'en tratamiento' ? 'estado-tratamiento' : ''; 
                        ?>">
                        <?php echo ucfirst($mascota['estado']); ?>
                    </span>
                </div>

                <!-- BACK -->
                <div class="card-back">
                    <h3><?php echo $mascota['nombre']; ?></h3>

                    <p class="info-item">
                        <i class="fas fa-birthday-cake"></i>  
                        <?php echo $mascota['edad']; ?> años
                    </p>

                    <p class="info-item">
                        <i class="fas fa-venus-mars"></i>
                        <?php echo ucfirst($mascota['sexo']); ?>
                    </p>

                    <p class="info-item">
                        <i class="fas fa-paw"></i>
                        <?php echo ucfirst($mascota['raza']); ?>
                    </p>
                </div>

            </div>

        </a>

    <?php } ?>

</div>

<style>
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        padding: 30px;
        justify-content: center;
        max-width: 1400px;
        margin: auto;
    }

    /* TARJETA */
    .card {
        width: 220px;
        height: 220px;
        perspective: 1000px;
        cursor: pointer;
        border-radius: 18px; 
        background-color: transparent;
        border: none;
        text-decoration: none;
    }

    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
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
        border-radius: 18px;
        overflow: hidden;
    }

    /* FRONT */
    .card-front {
        position: relative;
    }

    .card-front img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* BURBUJAS DE ESTADO */
    .estado-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }

    .estado-disponible { background: #9bcb7fff; }         /* Verde pastel */
    .estado-tratamiento { background: #f6ac6bff; }       /* Amarillo suave */

    /* BACK */
    .card-back {
        background: #f7e9dd;
        color: #8b5e3c;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transform: rotateY(180deg);
        padding: 20px;
        text-align: center;
    }

    .card-back h3 {
        margin-bottom: 15px;
        font-size: 22px;
        color: #7a533b;
    }

    .info-item {
        margin: 6px 0;
        font-size: 16px;
        color: #6b4b37;
        display: flex;
        align-items: center;
        gap: 8px;
    }

</style>