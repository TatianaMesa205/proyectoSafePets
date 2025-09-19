<?php
session_start();

include "view/modules/cabecera.php";

// Obtener la ruta
$ruta = isset($_GET["ruta"]) ? $_GET["ruta"] : "";

// Rutas públicas (no requieren sesión)
$rutasPublicas = array("registro", "inicioAdp");

// Rutas privadas para adoptantes
$rutasAdoptante = array("inicio", "adopta", "citas", "donaciones");

// Rutas privadas para administradores
$rutasAdmin = array("admin", "usuarios", "mascotas", "reportes");

// Verificar si es una ruta pública
if (in_array($ruta, $rutasPublicas)) {
    include "view/modules/" . $ruta . ".php";
} 
// Verificar si hay sesión activa
elseif (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] === "ok") {
    
    // Rutas para adoptantes
    if ($_SESSION["rol"] === "adoptante" && in_array($ruta, $rutasAdoptante)) {
        include "view/modules/" . $ruta . ".php";
    }
    // Rutas para administradores
    elseif ($_SESSION["rol"] === "admin" && in_array($ruta, $rutasAdmin)) {
        include "view/modules/" . $ruta . ".php";
    }
    // Ruta por defecto según el rol
    elseif ($ruta === "" || $ruta === "inicio") {
        if ($_SESSION["rol"] === "admin") {
            include "view/modules/admin.php";
        } else {
            include "view/modules/inicio.php";
        }
    }
    // Ruta no válida
    else {
        include "view/modules/404.php";
    }
} 
// Sin sesión, mostrar login o página pública
else {
    if ($ruta === "" || $ruta === "login") {
        include "view/modules/login.php";
    } else {
        include "view/modules/inicioAdp.php";
    }
}

include "view/modules/pie.php";
?>