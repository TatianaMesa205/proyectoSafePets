<?php
session_start();
$ruta = $_GET["ruta"] ?? "";

// Cabeceras de seguridad
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// --- MANEJO DE RUTAS PÚBLICAS (Sin sesión) ---
$rutasPublicas = ["login", "registro", "preview"];
if (!isset($_SESSION["iniciarSesion"])) {
    $archivo = "view/modules/login.php"; // Página por defecto si no hay sesión
    if (in_array($ruta, $rutasPublicas) && file_exists("view/modules/" . $ruta . ".php")) {
        $archivo = "view/modules/" . $ruta . ".php";
    }
    include $archivo;
    return; // Detiene la ejecución para no cargar la plantilla de usuario logueado.
}

// --- PLANTILLA PARA USUARIOS LOGUEADOS ---

// 1. Incluir Cabecera
include "view/modules/cabecera.php";

// 2. Incluir Menú según el rol
if ($_SESSION["rol"] === "admin") {
    include "view/modules/menuAdmin.php";
} else {
    include "view/modules/menu.php";
}

// 3. Cargar el Módulo de Contenido
$rutasAdoptante = ["inicioAdp", "adopta", "citas", "donaciones", "detalleMascota"];
$rutasAdmin = ["inicioAdmin", "usuarios", "mascotas", "reportes"];
$archivoModulo = "view/modules/404.php"; // Por defecto, página de error

if ($ruta === "" || $ruta === "inicio") {
    $archivoModulo = ($_SESSION["rol"] === "admin") ? "view/modules/inicioAdmin.php" : "view/modules/inicioAdp.php";
} else {
    // ‼️ LÓGICA CORREGIDA PARA EVITAR ERRORES ‼️
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

// 4. Incluir Footer
include "view/modules/flooter.php";

// 5. Incluir Pie (scripts y cierre de HTML)
include "view/modules/pie.php";
?>