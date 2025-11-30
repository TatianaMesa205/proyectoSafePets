<?php
session_start();
$ruta = $_GET["ruta"] ?? "inicioAdp"; 

// Headers de seguridad
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// =======================================================
// 1. RUTAS EXCLUSIVAS (PANTALLA COMPLETA)
// =======================================================
// Si la ruta es Login o Registro, cargamos SOLO ese archivo y detenemos todo.
if ($ruta == "login" || $ruta == "registro") {
    if (file_exists("view/modules/" . $ruta . ".php")) {
        include "view/modules/" . $ruta . ".php";
    } else {
        include "view/modules/login.php"; // Fallback
    }
    return; // <--- AQUÍ ESTÁ EL TRUCO: DETENEMOS LA EJECUCIÓN
}

// 2. LÓGICA DE LOGOUT
if ($ruta == "logout") {
    session_destroy();
    echo '<script>window.location = "index.php?ruta=inicioAdp";</script>';
    return;
}

// =======================================================
// 3. RUTAS PÚBLICAS CON MENÚ (Inicio, Mascotas, etc.)
// =======================================================
$rutasPublicas = [
    "inicioAdp", "adoptaAdp", "detalleMascota", 
    "publicacionesAdp", "historiasAdp", "donacionesAdp", 
    "preview"
];

$logueado = (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok");

// MODO INVITADO (SIN SESIÓN)
if (!$logueado) {
    if (in_array($ruta, $rutasPublicas)) {
        include "view/modules/cabecera.php"; 
        include "view/modules/menuAdp.php"; 
        
        if (file_exists("view/modules/" . $ruta . ".php")) {
            include "view/modules/" . $ruta . ".php";
        } else {
            include "view/modules/404.php";
        }
        
        include "view/modules/flooter.php";
        echo '<script src="view/js/login.js"></script></body></html>';
        return; 
    } else {
        // Cualquier otra cosa va al Login
        include "view/modules/login.php";
        return;
    }
}

// =======================================================
// 4. MODO USUARIO LOGUEADO (ADMIN O ADOPTANTE)
// =======================================================
include "view/modules/cabecera.php";

if ($_SESSION["rol"] === "admin") {
    include "view/modules/menuAdmin.php";
} else {
    include "view/modules/menuAdp.php";
}

$rutasAdoptante = ["inicioAdp", "adoptaAdp", "citasAdp", "donacionesAdp", "detalleMascota", "publicacionesAdp","historiasAdp", "adoptanteAdp", "registro-adoptante","perfilAdp","crearPublicacion"];
$rutasAdmin = ["inicioAdmin", "adoptantes", "mascotas", "adopciones", "vacunas", "citas", "donaciones", "publicaciones", "seguimientos", "vacunasMascotas", "perfilAdmin"];

$archivoModulo = "view/modules/404.php"; 

if ($ruta === "" || $ruta === "inicio") {
    $archivoModulo = ($_SESSION["rol"] === "admin") ? "view/modules/inicioAdmin.php" : "view/modules/inicioAdp.php";
} else {
    if ($_SESSION["rol"] === 'admin' && in_array($ruta, $rutasAdmin)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    } elseif ($_SESSION["rol"] === 'adoptante' && in_array($ruta, $rutasAdoptante)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    } elseif (in_array($ruta, $rutasPublicas)) { 
        $archivoModulo = "view/modules/" . $ruta . ".php";
    }
}

if (file_exists($archivoModulo)) {
    include $archivoModulo;
} else {
    include "view/modules/404.php";
}

include "view/modules/flooter.php"; 
?>