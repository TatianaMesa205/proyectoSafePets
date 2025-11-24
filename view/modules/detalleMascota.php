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
    <a class="navbar-brand" href="adoptaAdp">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
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
              <a class="dropdown-item" href="perfilAdp">
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
</div>

<div class="historia-card">
    <h2><i class="fas fa-book-open"></i> Mi historia</h2>
    <p><?php echo $mascotaEncontrada["descripcion"]; ?></p>
</div>

<h2 style="text-align:center; color:#7c5845; margin-top: 40px;">
    <i class="fas fa-notes-medical"></i> Carnet de Vacunación
</h2><br>

<div style="display:flex; flex-wrap:wrap; gap:25px; justify-content:center;">

<?php if (count($vacunasMascota) === 0) { ?>

    <p style="text-align:center; font-size:18px; color:#8b5e3c;">
        <i class="fas fa-syringe"></i> Esta mascota aún no tiene vacunas registradas.
    </p>

<?php } else { ?>

    <?php foreach ($vacunasMascota as $vac) { ?>
        <div class="vacuna-card">
            <i class="fas fa-syringe" style="font-size:35px; color:#a07b61;"></i>
            <h3 style="margin:12px 0; color:#8b5e3c;">
                <?php echo ucfirst($vac["nombre_vacuna"]); ?>
            </h3>

            <p><strong><i class="fas fa-calendar-check"></i></strong> <?php echo $vac["fecha_aplicacion"]; ?></p>
            <p><strong><i class="fas fa-clock"></i></strong> <?php echo $vac["proxima_dosis"]; ?></p>
            <p><strong><i class="fas fa-sync-alt"></i></strong> <?php echo $vac["tiempo_aplicacion"]; ?></p>
        </div>
    <?php } ?>

<?php } ?>

</div>

<div class="botones-acciones">
    <a href="index.php?ruta=adoptaAdp" class="btn-volver">⬅ Volver</a>
    
    <button type="button" class="btn-adopta btn-adoptame" 
            id-mascota="<?php echo $mascotaEncontrada['id_mascotas']; ?>"
            estado="<?php echo strtolower($mascotaEncontrada['estado']); ?>">
        Adoptame
    </button>

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
        background: #76d48b;
    }
    .estado-tratamiento {
        background: #f2c84b;
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

    /* Carnet */
    .vacuna-card {
        width: 270px;
        background: #ffffff;
        padding: 20px;
        border-radius: 18px;
        border: 2px solid #f3e1d3;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        text-align: center;
        animation: floatCard 4s ease-in-out infinite;
    }

    .vacuna-card:hover {
        transform: translateY(-6px);
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
        background: #8b5e3c;
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
        background: #a07557;
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
</style>


<script src="view/js/detalleMascota.js"></script>