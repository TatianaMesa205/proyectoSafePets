<?php

session_start();


include "view/modules/cabecera.php";


if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin") {
    include "view/modules/menuAdmin.php";
} else {
    include "view/modules/menuAdp.php";
}
?>

<div class="container py-5">
    <div style="max-width: 600px;" class="mx-auto">
        <div class="form-panel shadow-sm rounded-4 p-4 mt-4 text-center">
            
            <div class="card-header bg-transparent border-0 mb-3">
                <h2 class="mb-0 text-dark fw-bold">Donación Cancelada</h2>
            </div>

            <div class="card-body" style="padding: 20px;">
                <i class="fas fa-times-circle fa-3x text-danger mb-4" style="color: #dc3545;"></i>
                
                <h4 class="card-title fw-semibold">Has cancelado el proceso</h4>
                
                <p class="card-text text-muted" style="margin-top: 15px; margin-bottom: 25px;">
                    No se ha realizado ningún cargo.
                    Puedes volver a intentarlo cuando quieras.
                </p>
                
                <a href="index.php?ruta=donacionesAdp" class="btn btn-save" style="font-weight: 600;">
                    Volver a Donaciones
                </a>
            </div>
        </div>
    </div>
</div>

<?php

include "view/modules/flooter.php";
include "view/modules/pie.php";
?>