<?php
// ARCHIVO: gracias.php (en la raíz del proyecto)

// --- CORRECCIÓN AQUÍ ---
// Verificamos si la sesión ya está iniciada antes de llamar a session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// -----------------------

// 1. Incluimos la cabecera (CSS, etc.)
// La ruta es "view/modules/cabecera.php" porque este archivo está en la raíz.
include "view/modules/cabecera.php";

// 2. Incluimos el menú (para que el usuario vea que sigue logueado)
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
                <h2 class="mb-0 text-dark fw-bold">¡Muchas Gracias!</h2>
            </div>
            
            <div class="card-body" style="padding: 20px;">
                <i class="fas fa-heart fa-3x mb-4" style="color: #28a745;"></i>
                
                <h4 class="card-title fw-semibold">Tu donación ha sido recibida</h4>
                
                <p class="card-text text-muted" style="margin-top: 15px; margin-bottom: 25px;">
                    Tu apoyo es fundamental. El pago está siendo procesado por Stripe
                    y se verá reflejado en tu historial pronto.
                </p>
                
                <a href="index.php?ruta=inicioAdp" class="btn btn-save" style="font-weight: 600;">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</div>

<?php
// 3. Incluimos el footer y los scripts
include "view/modules/flooter.php";
include "view/modules/pie.php";
?>