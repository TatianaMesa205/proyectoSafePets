<?php
include_once "model/mascotasModel.php";
include_once "model/vacunasMascotasModel.php";

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

// consultar vacunas
$vacunasMascota = VacunasMascotasModel::mdlListarVacunasPorMascota($idMascota);
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php?ruta=adoptaAdp">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse fade-scroll" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] != "ok"): ?>
            
            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary" href="index.php?ruta=login">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Iniciar Sesión
                </a>
            </li>
            <li class="nav-item ms-2">
                <a class="btn btn-primary rounded-pill px-4 text-white" href="index.php?ruta=registro" style="background: #8b5e3c; border:none;">
                    Registrarse
                </a>
            </li>

        <?php else: ?>

            <li class="nav-item dropdown perfil-nav-item">
              <a class="nav-link dropdown-toggle d-flex align-items-center perfil-toggle" 
                href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="perfil-icono"><i class="fa-solid fa-circle-user"></i></div>
                <span class="perfil-nombre">
                  <?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario'; ?>
                </span>
              </a>

              <ul class="dropdown-menu dropdown-menu-end perfil-menu" aria-labelledby="perfilDropdown">
                <li>
                  <a class="dropdown-item perfil-opcion" href="index.php?ruta=perfilAdp">
                    <i class="fa-solid fa-user me-2"></i> Mi Perfil
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item perfil-opcion text-danger" href="index.php?ruta=logout">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión
                  </a>
                </li>
              </ul>
            </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav><br>

<h1>Detalle de <?php echo $mascotaEncontrada["nombre"]; ?></h1>

<div class="detalle-card">
    

    <span class="estado-badge 
        <?php 
            echo strtolower($mascotaEncontrada['estado']) === 'disponible' ? 'estado-disponible' : ''; 
            echo strtolower($mascotaEncontrada['estado']) === 'en tratamiento' ? 'estado-tratamiento' : ''; 
        ?>">
        <?php echo ucfirst($mascotaEncontrada["estado"]); ?>
    </span>

    <img src="../../../CarpetaCompartida/Mascotas/<?php echo $mascotaEncontrada['imagen']; ?>" alt="Mascota">




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

        <?php if (strtolower($mascotaEncontrada["estado"]) === "en tratamiento") { ?>

        <div style="text-align:center; margin:20px 0;">
            <button id="btnActivarCampana" 
                data-mascota="<?php echo $mascotaEncontrada['id_mascotas']; ?>"
                data-usuario="<?= $_SESSION['id'] ?? '' ?>"
                data-email="<?= $_SESSION['email'] ?>"
                class="btn btn-warning"
                style="font-size:22px; padding:10px 20px; border-radius:30px;">
                <i class="fa-solid fa-bell"></i>
            </button>
        </div>

    <?php } ?>

</div>


<div class="historia-card">
    <h2> Mi historia</h2>
    <p><?php echo $mascotaEncontrada["descripcion"]; ?></p>
</div>

<h2 style="text-align:center; color:#7c5845; margin-top: 40px;">
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

    /* Imagen */
    .detalle-card img {
        width: 380px;
        height: 380px;
        border-radius: 20px;
        object-fit: cover;
        box-shadow: 0 4px 16px rgba(0,0,0,0.18);
        transition: transform .3s;
    }
    .detalle-card img:hover {
        transform: scale(1.05);
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
    }

    .estado-disponible {
        background: #9bcb7f89;
    }
    .estado-tratamiento {
        background: #f6ac6b7e;
    }

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

    .historia-card h2 {
        color: #7c5845;
        margin-bottom: 15px;
    }

.vacuna-card {
    width: 270px;
    background: #E9F5E7; /* verde muy claro */
    padding: 18px;
    border-radius: 18px;
    border: 2px solid #76a35cff; 
    box-shadow: 0 4px 12px rgba(60, 120, 60, 0.12);
    text-align: left;
    animation: floatCard 4s ease-in-out infinite;
    color: #355E33;
}

/* cuadrito blanco interno */
.vacuna-inner {
    background: #ffffffac;       /* CUADRO BLANCO como en la foto */
    border-radius: 15px;
    padding: 15px; /* borde gris muy suave */
}


.vacuna-card:hover {
    transform: translateY(-6px);
    background: #F2FAF0; /* Ligeramente más claro en hover */
    border-color: #B8DBB2; 
}





    /* Animaciones */
    @keyframes fadeIn {
        from {opacity:0; transform:translateY(20px);}
        to {opacity:1; transform:translateY(0);}
    }
    @keyframes fadeInUp {
        from {opacity:0; transform:translateY(40px);}
        to {opacity:1; transform:translateY(0);}
    }
    @keyframes pop {
        0% {transform: scale(0.5); opacity:0;}
        100% {transform: scale(1); opacity:1;}
    }
    @keyframes floatCard {
        0% {transform: translateY(0);}
        50% {transform: translateY(-6px);}
        100% {transform: translateY(0);}
    }

    /* Botones */
    .botones-acciones {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-top: 30px;
    }

    .btn-volver, .btn-adopta {
        background: #8b5e3cd4;
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        display: block;
        text-align: center;
        transition: 0.3s;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-volver:hover, .btn-adopta:hover {
        background: #a07557be;
    }
    
    .btn-logout {
        display: block;
        margin: 10px auto;
        padding: 10px 10px;
        background-color: #d6baa5;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
    }

    .perfil-icono i { font-size: 1.9rem; color: #8b5e3c; transition: 0.4s; }
    .perfil-toggle:hover .perfil-icono i { transform: rotate(10deg) scale(1.15); color: #b7855e; }
    .perfil-nombre { font-weight: 600; margin-left: 8px; animation: fadeIn 1s ease; }
    .perfil-menu { border-radius: 15px; animation: dropdownSlide 0.35s ease; background: #e4d6c7; border: 1px solid #e7d1c4; }
    .perfil-opcion { transition: 0.3s; }
    .perfil-opcion:hover { background: #f4e6dd; color: #8b5e3c; }
</style>

<script src="view/js/detalleMascota.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("btnActivarCampana");
    if (btn) {
        btn.addEventListener("click", function () {

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
                        title: "Notificación activada",
                        text: "Te avisaremos cuando la mascota esté disponible."
                    });

                    btn.disabled = true;
                    btn.innerHTML = "✔";
                    btn.style.background = "#7DCEA0";
                }
            });
        });
    }
});
</script>
