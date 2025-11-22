<?php
session_start();
$ruta = $_GET["ruta"] ?? "";

// Headers de seguridad (opcional pero recomendado)
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

$rutasPublicas = ["login", "registro", "preview"];

// Si NO hay sesión iniciada
if (!isset($_SESSION["iniciarSesion"])) {
    $archivo = "view/modules/login.php"; 
    if (in_array($ruta, $rutasPublicas) && file_exists("view/modules/" . $ruta . ".php")) {
        $archivo = "view/modules/" . $ruta . ".php";
    }
    include $archivo;
    return; // Detenemos la ejecución aquí para no cargar menú de usuario
}

// --- ZONA DE USUARIO LOGUEADO ---

include "view/modules/cabecera.php"; // Aquí cargas CSS y librerías (Bootstrap, FontAwesome, SweetAlert)

// Lógica del menú según rol
if ($ruta !== "detalleMascota" && $ruta !== "adoptanteAdp" && $ruta !== "citasAdp" && $ruta !== "registro-adoptante") {
    if ($_SESSION["rol"] === "admin") {
        include "view/modules/menuAdmin.php";
    } else {
        include "view/modules/menuAdp.php";
    }
}

// Listas blancas de rutas
$rutasAdoptante = ["inicioAdp", "adoptaAdp", "citasAdp", "donacionesAdp", "detalleMascota", "publicaciones", "adoptanteAdp", "registro-adoptante", "perfil.php"];
$rutasAdmin = ["inicioAdmin", "adoptantes", "mascotas", "adopciones", "vacunas", "citas", "donaciones", "publicaciones", "seguimientos", "vacunasMascotas", "perfilAdmin"];

// Lógica de navegación central
$archivoModulo = "view/modules/404.php"; 

if ($ruta === "" || $ruta === "inicio") {
    $archivoModulo = ($_SESSION["rol"] === "admin") ? "view/modules/inicioAdmin.php" : "view/modules/inicioAdp.php";
} else {
    if ($_SESSION["rol"] === 'admin' && in_array($ruta, $rutasAdmin)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    } elseif ($_SESSION["rol"] === 'adoptante' && in_array($ruta, $rutasAdoptante)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    } elseif ($ruta == "logout") {
        // Fallback por si el JS falla, aunque lo ideal es el AJAX
        $archivoModulo = "view/modules/logout.php"; 
    }
}

// Incluir el módulo seleccionado
if (file_exists($archivoModulo)) {
    include $archivoModulo;
} else {
    include "view/modules/404.php";
}

// Opcional: incluir pie de página
// include "view/modules/flooter.php"; 
?>

<script src="view/js/login.js"></script>

</body>
</html>