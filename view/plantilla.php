<?php
session_start();

include "view/modules/cabecera.php";

// Obtener la ruta
$ruta = isset($_GET["ruta"]) ? $_GET["ruta"] : "";

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Rutas públicas (no requieren sesión)
$rutasPublicas = array("registro", "inicioAdp", "login");

// Rutas privadas para adoptantes
$rutasAdoptante = array("inicio", "adopta", "citas", "donaciones", "inicioAdp");

// Rutas privadas para administradores
$rutasAdmin = array("admin", "usuarios", "mascotas", "reportes");

// Verificar si es una ruta pública
if (in_array($ruta, $rutasPublicas)) {
    $archivo = "view/modules/" . $ruta . ".php";
    if (file_exists($archivo)) {
        include $archivo;
    } else {
        include "view/modules/404.php";
    }
} 
// Verificar si hay sesión activa
elseif (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] === "ok") {
    
    if (!isset($_SESSION["rol"]) || !isset($_SESSION["id"])) {
        session_destroy();
        header("Location: index.php?ruta=login");
        exit();
    }
    
    // Rutas para adoptantes
    if ($_SESSION["rol"] === "adoptante" && in_array($ruta, $rutasAdoptante)) {

        
        $archivo = "view/modules/" . $ruta . ".php";
        if (file_exists($archivo)) {
            include $archivo;
        } else {
            include "view/modules/404.php";
        }
    }
    // Rutas para administradores
    elseif ($_SESSION["rol"] === "admin" && in_array($ruta, $rutasAdmin)) {
        $archivo = "view/modules/" . $ruta . ".php";
        if (file_exists($archivo)) {
            include $archivo;
        } else {
            include "view/modules/404.php";
        }
    }
    elseif ($ruta === "" || $ruta === "inicio") {
        if ($_SESSION["rol"] === "admin") {
            $archivo = "view/modules/admin.php";
            if (file_exists($archivo)) {
                include $archivo;
            } else {
                echo "<div class='alert alert-warning'>Módulo de administración no encontrado</div>";
            }
        } elseif ($_SESSION["rol"] === "adoptante") {
            $archivo = "view/modules/inicioAdp.php";
            if (file_exists($archivo)) {
                include $archivo;
            } else {
                echo "<div class='alert alert-warning'>Módulo de inicio para adoptantes no encontrado</div>";
            }
        } else {
            $archivo = "view/modules/inicio.php";
            if (file_exists($archivo)) {
                include $archivo;
            } else {
                echo "<div class='alert alert-warning'>Módulo de inicio no encontrado</div>";
            }
        }
    }
    // Ruta no válida para el rol actual
    else {
        include "view/modules/404.php";
    }
} 
// Sin sesión, mostrar login o página pública
else {
    if ($ruta === "" || $ruta === "login") {
        include "view/modules/login.php";
    } elseif ($ruta === "registro") {
        include "view/modules/registro.php";
    } else {
        include "view/modules/login.php";
    }
}

include "view/modules/pie.php";
?>
