<?php
include_once "model/mascotasModel.php";
include_once "model/vacunasMascotasModel.php";
include_once "model/notificacionesModel.php"; // IMPORTANTE: Incluir el modelo

// Validar ID
if (!isset($_GET["id"])) {
    echo "<h2>Error: No se recibió una mascota válida.</h2>";
    exit;
}

$idMascota = $_GET["id"];

// Traer todas las mascotas y buscar la que coincide
$respuesta = MascotasModel::mdlListarMascotas();
$mascotas = $respuesta["listaMascotas"];

$mascotaEncontrada = null;
foreach ($mascotas as $m) {
    if ($m["id_mascotas"] == $idMascota) {
        $mascotaEncontrada = $m;
        break;
    }
}

if (!$mascotaEncontrada) {
    echo "<h2>No se encontró la mascota.</h2>";
    exit;
}

// Consultar vacunas
$vacunasMascota = VacunasMascotasModel::mdlListarVacunasPorMascota($idMascota);

// --- LÓGICA DE PERSISTENCIA ---
$notificacionActiva = false;
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    $idUsuario = $_SESSION['id'];
    // Verificamos en la BD si este usuario ya activó la campana para esta mascota
    $check = NotificacionesModel::verificarNotificacion($idUsuario, $idMascota);
    if ($check) {
        $notificacionActiva = true;
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<h1>Detalle de <?php echo $mascotaEncontrada["nombre"]; ?></h1>

<div class="detalle-card">

    <span class="estado-badge 
        <?php 
            echo strtolower($mascotaEncontrada['estado']) === 'disponible' ? 'estado-disponible' : ''; 
            echo strtolower($mascotaEncontrada['estado']) === 'en tratamiento' ? 'estado-tratamiento' : ''; 
        ?>">
        <?php echo ucfirst($mascotaEncontrada["estado"]); ?>
    </span>

    <div class="imagen-contenedor">
        <img src="../../../CarpetaCompartida/Mascotas/<?php echo $mascotaEncontrada['imagen']; ?>" alt="Mascota">

        <?php 
        // Mostrar SOLO si está en tratamiento Y hay sesión iniciada
        if (strtolower($mascotaEncontrada["estado"]) === "en tratamiento" && 
            isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") { 
        ?>
            <button id="btnActivarCampana" 
                data-mascota="<?php echo $mascotaEncontrada['id_mascotas']; ?>"
                data-usuario="<?= $_SESSION['id'] ?? '' ?>"
                data-email="<?= $_SESSION['email'] ?>"
                class="btn-campana <?php echo $notificacionActiva ? 'campana-activada' : ''; ?>"
                title="<?php echo $notificacionActiva ? 'Notificación activada' : 'Avísame cuando esté disponible'; ?>"
                <?php echo $notificacionActiva ? 'disabled' : ''; ?> >
                
                <?php if($notificacionActiva): ?>
                    <i class="fa-solid fa-bell fa-shake"></i>
                <?php else: ?>
                    <i class="fa-regular fa-bell"></i>
                <?php endif; ?>

            </button>
        <?php } ?>
    </div>

    <div class="detalle-info">
        <h2><?php echo $mascotaEncontrada["nombre"]; ?></h2>

        <p><strong>Especie:</strong> <?php echo $mascotaEncontrada["especie"]; ?></p>
        <p><strong>Raza:</strong> <?php echo $mascotaEncontrada["raza"]; ?></p>
        <p><strong>Edad:</strong> <?php echo $mascotaEncontrada["edad"]; ?></p>
        <p><strong>Sexo:</strong> <?php echo $mascotaEncontrada["sexo"]; ?></p>
        <p><strong>Tamaño:</strong> <?php echo $mascotaEncontrada["tamano"]; ?></p>
        <p><strong>Fecha de ingreso:</strong> <?php echo $mascotaEncontrada["fecha_ingreso"]; ?></p>
        <p><strong>Estado de salud:</strong> <?php echo $mascotaEncontrada["estado_salud"]; ?></p>
    </div>

</div>

<div class="historia-card">
    <h2> Mi historia</h2>
    <p><?php echo $mascotaEncontrada["descripcion"]; ?></p>
</div>

<h2 style="text-align:center; color:#7c5845; margin-top: 40px;" class="titulo-carnet">
     Carnet de Vacunación
</h2><br>

<div style="display:flex; flex-wrap:wrap; gap:25px; justify-content:center;">

    <?php if (count($vacunasMascota) === 0) { ?>
        <p style="text-align:center; font-size:18px; color:#8b5e3c;">
            <i class="fas fa-syringe"></i> Esta mascota aún no tiene vacunas registradas.
        </p>
    <?php } else { ?>
        <?php foreach ($vacunasMascota as $vac) { ?>
            <div class="vacuna-card">
                    <i class="fas fa-syringe" style="font-size:35px; color:#3f5930;"></i>
                    <h3 style="margin:12px 0; color:#3f5930;">
                        <?php echo ucfirst($vac["nombre_vacuna"]); ?>
                    </h3>
                <div class="vacuna-inner">
                    <p><strong><i class="fas fa-calendar-check"></i></strong> <?php echo $vac["fecha_aplicacion"]; ?></p>
                    <p><strong><i class="fas fa-clock"></i></strong> <?php echo $vac["proxima_dosis"]; ?></p>
                    <p><strong><i class="fas fa-sync-alt"></i></strong> <?php echo $vac["tiempo_aplicacion"]; ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

</div>

<div class="botones-acciones">
    <a href="index.php?ruta=adoptaAdp" class="btn-volver">⬅ Volver</a>
    
    <?php if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") { ?>
        <button type="button" class="btn-adopta btn-adoptame" 
                id-mascota="<?php echo $mascotaEncontrada['id_mascotas']; ?>"
                estado="<?php echo strtolower($mascotaEncontrada['estado']); ?>">
            Adoptame
        </button>
    <?php } else { ?>
        <a href="index.php?ruta=login" class="btn-adopta">
            Adoptame
        </a>
    <?php } ?>
</div>
<br>

<style>
    body {
        background: #faf5f0;
        font-family: "Poppins", sans-serif;
    }

    /* Tarjeta principal */
    .detalle-card {
        background: #ffffff;
        max-width: 1100px;
        margin: 30px auto;
        padding: 35px;
        border-radius: 25px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
        display: flex;
        gap: 40px;
        animation: fadeIn 0.8s ease;
        position: relative;
    }
    h1 { text-align: center; color: #a07b61; margin-bottom: 35px; }

    /* CONTENEDOR DE LA IMAGEN (Relativo para posicionar la campana) */
    .imagen-contenedor {
        position: relative; 
        width: 380px;
        height: 380px;
    }

    .imagen-contenedor img {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        object-fit: cover;
        box-shadow: 0 4px 16px rgba(0,0,0,0.18);
        transition: transform .3s;
    }

    /* --- ESTILO DE LA CAMPANA --- */
    .btn-campana {
        position: absolute;
        top: 15px;
        left: 15px;
        /* Fondo transparente pero con blur para legibilidad */
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(3px);
        border: 2px solid #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        z-index: 10;
        outline: none;
    }

    .btn-campana:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #e67e22; /* Naranja al pasar el mouse */
        transform: scale(1.1);
        border-color: #e67e22;
    }

    /* CLASE CUANDO YA ESTÁ ACTIVADA */
    .campana-activada {
        background-color: #ffffff !important; 
        color: #e67e22 !important; /* Icono naranja */
        border-color: #e67e22 !important;
        opacity: 0.95;
        cursor: default !important; /* No cliqueable */
        box-shadow: 0 0 15px rgba(230, 126, 34, 0.6);
    }

    /* Información */
    .detalle-info h2 {
        color: #7c5845;
        margin-bottom: 12px;
        font-size: 28px;
    }
    .detalle-info p {
        font-size: 18px;
        margin: 7px 0;
        color: #5b4a3c;
    }

    /* Burbuja de estado */
    .estado-badge {
        position: absolute;
        top: 25px;
        right: 25px;
        padding: 10px 18px;
        border-radius: 20px;
        color: #fff;
        font-weight: bold;
        font-size: 15px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        animation: pop 0.6s ease;
        z-index: 11;
    }

    .estado-disponible { background: #9bcb7f89; }
    .estado-tratamiento { background: #f6ac6b7e; }

    /* Historia */
    .historia-card {
        max-width: 1100px;
        margin: 30px auto;
        padding: 30px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        animation: fadeInUp 0.8s ease;
    }
    .historia-card h2 { color: #7c5845; margin-bottom: 15px; }

    /* Vacunas */
    .vacuna-card {
        width: 270px;
        background: #E9F5E7;
        padding: 18px;
        border-radius: 18px;
        border: 2px solid #76a35cff; 
        box-shadow: 0 4px 12px rgba(60, 120, 60, 0.12);
        text-align: left;
        animation: floatCard 4s ease-in-out infinite;
        color: #355E33;
    }
    .vacuna-inner {
        background: #ffffffac;
        border-radius: 15px;
        padding: 15px;
    }
    .vacuna-card:hover {
        transform: translateY(-6px);
        background: #F2FAF0; 
        border-color: #B8DBB2; 
    }

    /* Animaciones */
    @keyframes fadeIn { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }
    @keyframes fadeInUp { from {opacity:0; transform:translateY(40px);} to {opacity:1; transform:translateY(0);} }
    @keyframes pop { 0% {transform: scale(0.5); opacity:0;} 100% {transform: scale(1); opacity:1;} }
    @keyframes floatCard { 0% {transform: translateY(0);} 50% {transform: translateY(-6px);} 100% {transform: translateY(0);} }

    /* Botones */
    .botones-acciones {
        display: flex; justify-content: center; gap: 25px; margin-top: 30px;
    }
    .btn-volver, .btn-adopta {
        background: #8b5e3cd4; padding: 12px 30px; border-radius: 10px; text-decoration: none;
        color: #fff; font-weight: bold; display: block; text-align: center;
        transition: 0.3s; border: none; cursor: pointer; font-size: 1rem;
    }
    .btn-volver:hover, .btn-adopta:hover { background: #a07557be; }
    
    /* MODO OSCURO */
    body.dark-mode { background-color: #121212 !important; }
    body.dark-mode .detalle-card, body.dark-mode .historia-card {
        background-color: #1e1e1e !important; color: #f1f1f1 !important; border: 1px solid #333; box-shadow: none !important;
    }
    body.dark-mode h1, body.dark-mode .detalle-info h2, body.dark-mode .historia-card h2, body.dark-mode .titulo-carnet {
        color: #3fa9f5 !important;
    }
    body.dark-mode .detalle-info p { color: #ccc !important; }
    body.dark-mode .vacuna-card { background-color: #1a2e1a !important; border-color: #2e4d2e !important; color: #aaddaa !important; }
    body.dark-mode .vacuna-inner { background-color: #243b24 !important; color: #fff !important; }
    body.dark-mode .vacuna-card h3, body.dark-mode .vacuna-card i { color: #5eff5e !important; }
    body.dark-mode .btn-volver, body.dark-mode .btn-adopta { background-color: #3fa9f5 !important; color: #fff; }

</style>

<script src="view/js/detalleMascota.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("btnActivarCampana");
    if (btn) {
        btn.addEventListener("click", function () {

            // Evitar múltiples clics si ya está activado o deshabilitado
            if(btn.disabled || btn.classList.contains("campana-activada")) return;

            let idMascota = btn.getAttribute("data-mascota");
            let idUsuario = btn.getAttribute("data-usuario");
            let email = btn.getAttribute("data-email");

            if (!idUsuario) {
                Swal.fire("Debes iniciar sesión para activar la notificación.");
                return;
            }

            let form = new FormData();
            form.append("activarCampana", "ok");
            form.append("id_mascotas", idMascota);
            form.append("id_usuarios", idUsuario);
            form.append("email_usuario", email);

            fetch("controller/notificacionesController.php", {
                method: "POST",
                body: form
            })
            .then(r => r.json())
            .then(res => {
                if (res.codigo === "200") {
                    Swal.fire({
                        icon: "success",
                        title: "¡Notificación activada!",
                        text: "Te avisaremos apenas la mascota esté disponible.",
                        timer: 2500,
                        showConfirmButton: false
                    });

                    // CAMBIO VISUAL INMEDIATO
                    btn.disabled = true; 
                    // Cambiamos el icono a campana sonando (shake)
                    btn.innerHTML = '<i class="fa-solid fa-bell fa-shake"></i>';
                    btn.classList.add("campana-activada");
                    btn.title = "Ya has activado la notificación";
                } else {
                    Swal.fire("Error", "No se pudo activar la notificación", "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "Ocurrió un problema de conexión", "error");
            });
        });
    }
});
</script>