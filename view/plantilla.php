<?php
session_start();


include "view/modules/cabecera.php";

// include_once "view/modules/inicioAdp.php";


if (isset($_SESSION["iniciarSesion"]) == "ok"){

    $listaRutas = array("inicio", "adopta", "citas", "donaciones", "publicaciones");

    if (isset($_GET["ruta"]) && in_array($_GET["ruta"], $listaRutas)){
        include "view/modules/".$_GET["ruta"].".php";
    } else {
        include "view/modules/login.php";
    }

} else {
    include "view/modules/login.php";
}

include "view/modules/pie.php";