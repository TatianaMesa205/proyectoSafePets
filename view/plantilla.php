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


if ($_SESSION["rol"] === "admin") {
    include "view/modules/menuAdmin.php";
} else {
    include "view/modules/menuAdp.php";
}


$rutasAdoptante = ["inicioAdp", "adoptaAdp", "citasAdp", "donacionesAdp", "detalleMascota"];
$rutasAdmin = ["inicioAdmin", "adoptantes", "mascotas", "adopciones", "vacunas", "citas", "donaciones", "publicaciones", "seguimientos"];
$archivoModulo = "view/modules/404.php"; 

if ($ruta === "" || $ruta === "inicio") {
    $archivoModulo = ($_SESSION["rol"] === "admin") ? "view/modules/inicioAdmin.php" : "view/modules/inicioAdp.php";
} else {
   
    if ($_SESSION["rol"] === 'admin' && in_array($ruta, $rutasAdmin)) {
        if (file_exists("view/modules/" . $ruta . ".php")) {
            $archivoModulo = "view/modules/" . $ruta . ".php";
        }
    } elseif ($_SESSION["rol"] === 'adoptante' && in_array($ruta, $rutasAdoptante)) {
        if (file_exists("view/modules/" . $ruta . ".php")) {
            $archivoModulo = "view/modules/" . $ruta . ".php";
        }
    }
}

include $archivoModulo;

include "view/modules/flooter.php";


include "view/modules/pie.php";
?>