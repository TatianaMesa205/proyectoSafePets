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
    /* --- Estilos de Adopción (adopta.php) --- */ 
    .cards-container { 
        display: flex; 
        flex-wrap: wrap; 
        gap: 25px; 
        padding: 30px; 
        justify-content: center; 
        max-width: 1400px; 
        margin: auto; 
    } 
    .card { 
        width: 220px; 
        height: 220px; 
        perspective: 1000px; 
        cursor: pointer; 
        border-radius: 15px; 
        background-color: transparent; 
        border: none; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        transition: transform 0.2s; 
    } 
    .card:hover { 
        transform: translateY(-5px); 
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
    .card-front img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
    } 
    .card-back { 
        background: #f0e4d8; color: #a07b61; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center; 
        transform: rotateY(180deg); 
        padding: 15px; 
        text-align: center; 
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

    /* ====== ANIMACIONES LINDAS ====== */

    /* Flotación suave */
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
        100% { transform: translateY(0); }
    }

    /* Pulso para la burbuja */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Sombra animada */
    @keyframes shadowGlow {
        0% { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        50% { box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
        100% { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    }

    /* ====== APLICACIÓN EN LAS CARTAS ====== */



    /* La parte interna con 3D suave */
    .card-inner {
        transition: transform 0.8s cubic-bezier(.25,.8,.25,1); /* Flip más elegante */
    }

    /* Burbuja de estado con animación */
    .estado-badge {
        animation: pulse 2s infinite ease-in-out;
        transition: 0.3s;
    }

    .estado-badge:hover {
        transform: scale(1.2) rotate(-5deg);
    }


</style>