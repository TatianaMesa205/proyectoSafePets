<?php
include_once "model/mascotasModel.php";

$respuesta = MascotasModel::mdlListarMascotas();
$listaMascotas = $respuesta["listaMascotas"];
?>

<div class="filtros-container">
    <button class="btn-filtro active" data-filter="all">Todos</button>
    <button class="btn-filtro" data-filter="perro">Perros</button>
    <button class="btn-filtro" data-filter="gato">Gatos</button>
</div>


<div class="cards-container">

    <?php foreach ($listaMascotas as $mascota) { ?>

    <?php 
        // Ocultar si NO tiene imagen
        if (empty($mascota['imagen']) || $mascota['imagen'] === null || $mascota['imagen'] === "null") {
            continue;
        }
    ?>

    <?php if (strtolower($mascota['estado']) === 'adoptado') continue; ?> 


        <a href="index.php?ruta=detalleMascota&id=<?php echo $mascota['id_mascotas']; ?>" 
            class="card" 
            data-especie="<?php echo strtolower($mascota['especie']); ?>">

            
            <div class="card-inner">

                <!-- FRONT -->
                <div class="card-front">
                    <img src="../../../CarpetaCompartida/Mascotas/<?php echo $mascota['imagen']; ?>" alt="Mascota">

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

    .estado-disponible { background: #9bcb7fa0; } 
    .estado-tratamiento { background: #f6ac6b9c; }   


    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
        100% { transform: translateY(0); }
    }


    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    @keyframes shadowGlow {
        0% { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        50% { box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
        100% { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    }

    .card-inner {
        transition: transform 0.8s cubic-bezier(.25,.8,.25,1);
    }

    /* Burbuja de estado con animación */
    .estado-badge {
        animation: pulse 2s infinite ease-in-out;
        transition: 0.3s;
    }

    .estado-badge:hover {
        transform: scale(1.2) rotate(-5deg);
    }

    .filtros-container {
        text-align: center;
        margin: 20px 0 10px;
    }

    .btn-filtro {
        background: #e8d8c4;
        color: #5a4633;
        border: none;
        padding: 10px 18px;
        margin: 0 8px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-filtro:hover {
        background: #d4b89f;
    }

    .btn-filtro.active {
        background: #b89477;
        color: white;
        transform: scale(1.1);
    }

</style>

<script>
    const botones = document.querySelectorAll(".btn-filtro");
    const cards = document.querySelectorAll(".card");

    botones.forEach(btn => {
        btn.addEventListener("click", () => {

            // Activar botón seleccionado
            botones.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filtro = btn.getAttribute("data-filter");

            cards.forEach(card => {
                const especie = card.getAttribute("data-especie");

                if (filtro === "all") {
                    card.style.display = "block";
                } else {
                    card.style.display = especie === filtro ? "block" : "none";
                }
            });
        });
    });
</script>
