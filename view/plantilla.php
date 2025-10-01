<?php
session_start();

// Obtener la ruta de la URL, si no existe, es una cadena vacía.
$ruta = $_GET["ruta"] ?? "";

// Cabeceras de seguridad
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// --- MANEJO DE RUTAS PÚBLICAS ---
// Estas rutas no necesitan la plantilla principal (cabecera, menú, etc.)
$rutasPublicas = ["login", "registro", "preview"];
if (in_array($ruta, $rutasPublicas) || $ruta === "") {
    // Si no hay sesión y la ruta es pública o vacía, muestra la página pública correspondiente.
    if (!isset($_SESSION["iniciarSesion"])) {
        $archivoPublico = "view/modules/login.php"; // Por defecto es el login
        if (file_exists("view/modules/" . $ruta . ".php")) {
            $archivoPublico = "view/modules/" . $ruta . ".php";
        }
        include $archivoPublico;
        return; // Detiene la ejecución para no cargar el resto.
    }
}

// --- MANEJO DE RUTAS PRIVADAS (USUARIOS LOGUEADOS) ---

// Si a este punto no hay una sesión activa, lo mandamos al login.
if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] !== "ok") {
    header("Location: login");
    exit();
}

// 1. INCLUIR LA CABECERA (Inicia el HTML)
include "view/modules/cabecera.php";

// 2. ELEGIR E INCLUIR EL MENÚ CORRECTO
if ($_SESSION["rol"] === "admin") {
    include "view/modules/menuAdmin.php";
} else {
    include "view/modules/menu.php";
}

// 3. DEFINIR RUTAS Y CARGAR EL MÓDULO DE CONTENIDO
$rutasAdoptante = ["inicioAdp", "adopta", "citas", "donaciones", "detalleMascota"];
$rutasAdmin = ["inicioAdmin", "usuarios", "mascotas", "reportes"];
$archivoModulo = "view/modules/404.php"; // Página de error por defecto

// Si la ruta está vacía o es "inicio", asignamos la página principal según el rol.
if ($ruta === "" || $ruta === "inicio") {
    if ($_SESSION["rol"] === "admin") {
        $archivoModulo = "view/modules/inicioAdmin.php";
    } else {
        $archivoModulo = "view/modules/inicioAdp.php";
    }
}
// Si la ruta está en la lista permitida para el rol, la asignamos.
elseif ($_SESSION["rol"] === "adoptante" && in_array($ruta, $rutasAdoptante)) {
    if (file_exists("view/modules/" . $ruta . ".php")) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    }
} elseif ($_SESSION["rol"] === "admin" && in_array($ruta, $rutasAdmin)) {
    if (file_exists("view/modules/" . $ruta . ".php")) {
        $archivoModulo = "view/modules/" . $ruta . ".php";
    }
}

include $archivoModulo;



?>