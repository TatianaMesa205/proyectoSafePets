<?php
include_once "model/publicacionesModel.php";

$respuesta = PublicacionesModel::mdlListarPublicaciones();
$listaPublicaciones = $respuesta["listaPublicaciones"];
?>

<div class="publi-container">

    <h2 class="titulo-principal">
        📢 Publicaciones
    </h2>

    <a href="crearPublicacion" class="btn-crear-publicacion">
        <i class="fa-solid fa-plus"></i> Crear Publicación
    </a>

    <?php foreach ($listaPublicaciones as $publi) { ?>

        <div class="tarjeta-publicacion">

            <div class="tarjeta-cabecera">
                <?php echo date("d/m/Y", strtotime($publi["fecha_publicacion"])); ?>
            </div>

            <div class="tarjeta-contenido">

                <!-- Imagen -->
                <div class="tarjeta-img">
                    <img src="../CarpetaCompartida/Publicaciones/<?php echo $publi['foto']; ?>" alt="Imagen">
                </div>

                <!-- Info -->
                <div class="tarjeta-info">

                    <h3><?php echo $publi["tipo"]; ?></h3>

                    <p><strong>Contacto:</strong> <?php echo $publi["contacto"]; ?></p>


                    <div class="descripcion" data-full="<?php echo $publi['descripcion']; ?>">
                        <?php echo substr($publi['descripcion'], 0, 120) . "..."; ?>
                    </div>

                    <button class="btn-ver-mas">Ver más ▼</button>


                </div>

            </div>

        </div>

    <?php } ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const botones = document.querySelectorAll(".btn-ver-mas");

    botones.forEach(boton => {
        boton.addEventListener("click", function () {
            
            const descripcionDiv = this.previousElementSibling;
            const textoCompleto = descripcionDiv.dataset.full;

            if (this.classList.contains("abierto")) {
                descripcionDiv.textContent = textoCompleto.substring(0, 120) + "...";
                this.textContent = "Ver más ▼";
                this.classList.remove("abierto");
            } else {
                descripcionDiv.textContent = textoCompleto;
                this.textContent = "Ver menos ▲";
                this.classList.add("abierto");
            }
        });
    });

});
</script>


<style>


.publi-container {
    max-width: 850px;
    margin: 20px auto;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
}

/* Titulo */
.titulo-principal {
    text-align: center;
    font-size: 28px;
    color: #3f5930;
    margin-bottom: 20px;
}

/* Botón crear publicación */
.btn-crear-publicacion {
    display: block;
    width: fit-content;
    margin: auto;
    padding: 12px 25px;
    background: #6f8f63;
    color: white;
    border-radius: 18px;
    text-decoration: none;
    font-size: 18px;
    box-shadow: 0 4px 8px #00000020;
    transition: 0.3s;
}

.btn-crear-publicacion:hover {
    background: #58724f;
    transform: translateY(-3px);
}

/* Tarjeta */
.tarjeta-publicacion {
    background: #ffffff;
    border-radius: 25px;
    margin: 30px 0;
    overflow: hidden;
    box-shadow: 0 6px 20px #00000025;
    animation: fadeIn 0.5s;
}

/* Cabecera fecha */
.tarjeta-cabecera {
    background: #94a78c;
    padding: 12px;
    text-align: center;
    font-weight: bold;
    color: white;
    font-size: 17px;
    border-radius: 25px 25px 0 0;
}

.tarjeta-contenido {
    display: flex;
    gap: 20px;
    padding: 18px;
}

/* Imagen */
.tarjeta-img img {
    width: 180px;
    height: 180px;
    border-radius: 18px;
    object-fit: cover;
    box-shadow: 0 4px 12px #00000020;
}

/* Texto */
.tarjeta-info h3 {
    color: #6f8f63;
    margin-bottom: 5px;
}

.tarjeta-info p {
    color: #5a6b4d;
    margin: 8px 0;
}

.descripcion {
    color: #4a4038;
    margin-top: 8px;
}

.ver-mas {
    display: inline-block;
    margin-top: 10px;
    color: #2f5d2f;
    text-decoration: none;
    font-weight: bold;
}

.ver-mas:hover {
    text-decoration: underline;
}

/* Animacion */
@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

.btn-ver-mas {
    background: none;
    border: none;
    color: #2f5d2f;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
    font-size: 14px;
    padding: 0;
    transition: 0.3s;
}

.btn-ver-mas:hover {
    opacity: 0.7;
}


</style>