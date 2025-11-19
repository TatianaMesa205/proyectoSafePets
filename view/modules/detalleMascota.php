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

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalle de Mascota</title>

<style>

    .detalle-card {
        background: #ffffff;
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.1);
        display: flex;
        gap: 25px;
    }

    .detalle-card img {
        width: 280px;
        height: 280px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    }

    .detalle-info {
        flex: 1;
    }

    h1 {
        text-align: center;
        color: #a07b61;
        margin-bottom: 35px;
    }

    .detalle-info h2 {
        color: #8b5e3c;
        margin-bottom: 10px;
    }

    .detalle-info p {
        font-size: 18px;
        color: #555;
        margin: 5px 0;
    }

    .btn-volver {
        margin-top: 30px;
        background: #8b5e3c;
        color: #fff;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        display: block;
        width: 150px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        transition: 0.3s;
    }

    .btn-volver:hover {
        background: #a07b61;
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
    .btn-adopta {
        margin-top: 30px;
        background: #8b5e3c;
        color: #fff;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        display: block;
        width: 150px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        transition: 0.3s;
    }

    .btn-adopta:hover {
        background: #a07b61;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            <i class="fa-solid fa-circle-user me-2" style="font-size: 25px; color: #8b5e3c;"></i>

            <?php echo $_SESSION['nombre_usuario']; ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
            <li>
              <a class="dropdown-item" href="perfil.php">
                <i class="fa-solid fa-user me-2"></i> Mi Perfil
              </a>
            </li>

            <button id="btnLogout" class="btn-logout">
              <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión
            </button>
          </ul>
        </li>

      </ul>
    </div> 
  </div>
</nav><br>

<h1>🐾 Detalle de <?php echo $mascotaEncontrada["nombre"]; ?></h1>

<div class="detalle-card">

    <img src="<?php echo $mascotaEncontrada['imagen']; ?>" alt="Mascota">

    <div class="detalle-info">
        <h2><?php echo $mascotaEncontrada["nombre"]; ?></h2>

        <p><strong>Especie:</strong> <?php echo $mascotaEncontrada["especie"]; ?></p>
        <p><strong>Raza:</strong> <?php echo $mascotaEncontrada["raza"]; ?></p>
        <p><strong>Edad:</strong> <?php echo $mascotaEncontrada["edad"]; ?></p>
        <p><strong>Sexo:</strong> <?php echo $mascotaEncontrada["sexo"]; ?></p>
        <p><strong>Tamaño:</strong> <?php echo $mascotaEncontrada["tamano"]; ?></p>
        <p><strong>Fecha de ingreso:</strong> <?php echo $mascotaEncontrada["fecha_ingreso"]; ?></p>
        <p><strong>Estado de salud:</strong> <?php echo $mascotaEncontrada["estado_salud"]; ?></p>
        <p><strong>Estado:</strong> <?php echo $mascotaEncontrada["estado"]; ?></p>
        
    </div>
</div><br>

<div class="detalle-card">
    <div class="detalle-info" style="width:100%;">
        <h2>Mi historia</h2>
        <p><?php echo $mascotaEncontrada["descripcion"]; ?></p>
    </div>
</div>




<h2 style="text-align:center; margin-top:40px; color:#8b5e3c;">
    <i class="fas fa-notes-medical"></i> Carnet de Vacunación
</h2><br>



    <?php if (count($vacunasMascota) === 0) { ?>

        <div style="
            text-align:center;
            padding:30px;
            font-size:18px;
            color:#8b5e3c;
        ">
            <i class="fas fa-syringe" style="font-size:40px; margin-bottom:10px;"></i>
            <p>Esta mascota aún no tiene vacunas registradas.</p>
        </div>

    <?php } else { ?>

        <div style="
            display:flex;
            flex-wrap:wrap;
            gap:20px;
            justify-content:center;
        ">
            <?php foreach ($vacunasMascota as $vac) { ?>

                <div style="
                    width:260px;
                    background:white;
                    padding:20px;
                    border-radius:18px;
                    box-shadow:0 4px 15px rgba(0,0,0,0.08);
                    transition:transform .2s;
                    border: 2px solid #f3e1d3;
                " 
                onmouseover="this.style.transform='scale(1.03)'"
                onmouseout="this.style.transform='scale(1)'">

                    <div style="text-align:center; margin-bottom:10px;">
                        <i class="fas fa-syringe" style="font-size:36px; color:#a07b61;"></i>
                    </div>

                    <h3 style="
                        text-align:center;
                        color:#8b5e3c;
                        margin-bottom:12px;
                        font-size:20px;
                    ">
                        <?php echo ucfirst($vac["nombre_vacuna"]); ?>
                    </h3>

                    <p style="margin:6px 0; color:#5f4a3b;">
                        <strong><i class="fas fa-calendar-check"></i> Fecha de aplicación:</strong><br>
                        <?php echo $vac["fecha_aplicacion"]; ?>
                    </p>

                    <p style="margin:6px 0; color:#5f4a3b;">
                        <strong><i class="fas fa-clock"></i> Próxima dosis:</strong><br>
                        <?php echo $vac["proxima_dosis"]; ?>
                    </p>

                    <p style="margin:6px 0; color:#5f4a3b;">
                        <strong><i class="fas fa-sync-alt"></i> Frecuencia:</strong><br>
                        <?php echo $vac["tiempo_aplicacion"]; ?>
                    </p>

                </div>

            <?php } ?>
        </div>

    <?php } ?>


<a href="adoptaAdp" class="btn-volver">⬅ Volver</a> 
<a href="citasAdp" class="btn-adopta">Adoptame</a><br>

</body>
</html>
