<?php
session_start();
$ruta = $_GET["ruta"] ?? "";

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

$rutasPublicas = ["login", "registro", "preview"];
if (!isset($_SESSION["iniciarSesion"])) {
    $archivo = "view/modules/login.php"; 
    if (in_array($ruta, $rutasPublicas) && file_exists("view/modules/" . $ruta . ".php")) {
        $archivo = "view/modules/" . $ruta . ".php";
    }
    include $archivo;
    return; 
}

include "view/modules/cabecera.php";

if ($ruta !== "detalleMascota" && $ruta !== "adoptanteAdp" && $ruta !== "citasAdp" && $ruta !== "registro-adoptante") {

    if ($_SESSION["rol"] === "admin") {
        include "view/modules/menuAdmin.php";
    } else {
        include "view/modules/menuAdp.php";
    }
}


$rutasAdoptante = ["inicioAdp", "adoptaAdp", "citasAdp", "donacionesAdp", "detalleMascota", "publicaciones", "adoptanteAdp", "registro-adoptante"];


$rutasAdmin = ["inicioAdmin", "adoptantes", "mascotas", "adopciones", "vacunas", "citas", "donaciones", "publicaciones", "seguimientos", "vacunasMascotas"];
$archivoModulo = "view/modules/404.php"; 

if ($ruta === "" || $ruta === "inicio") {
    $archivoModulo = ($_SESSION["rol"] === "admin") ? "view/modules/inicioAdmin.php" : "view/modules/inicioAdp.php";
} else {
    if ($_SESSION["rol"] === 'admin' && in_array($ruta, $rutasAdmin)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    } else if ($_SESSION["rol"] === 'adoptante' && in_array($ruta, $rutasAdoptante)) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    }
    
    // Validar existencia física del archivo
    if (!file_exists($archivoModulo)) {
        $archivoModulo = "view/modules/404.php";
    }
}

include $archivoModulo;
include "view/modules/flooter.php"; // Asegúrate de incluir el footer si lo usas
?>