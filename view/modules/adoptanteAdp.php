<?php
// --------------------------------------------------------------------------
// 1. LÓGICA PHP: Verificar si el usuario ya es adoptante
// --------------------------------------------------------------------------
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Validar email del usuario logueado
$emailUsuario = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$yaEstaRegistrado = false;

// Incluimos el modelo si no está cargado
if (!class_exists('AdoptantesModel')) {
    if (file_exists("model/adoptantesModel.php")) {
        include_once "model/adoptantesModel.php";
    } elseif (file_exists("../model/adoptantesModel.php")) {
        include_once "../model/adoptantesModel.php";
    }
}

// Consultamos a la base de datos
if ($emailUsuario != "" && class_exists('AdoptantesModel')) {
    $adoptante = AdoptantesModel::mdlMostrarAdoptante("email", $emailUsuario);
    if ($adoptante) {
        $yaEstaRegistrado = true;
    }
}
?>

<?php if ($yaEstaRegistrado): ?>

    <div class="container py-5 animate-card">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card shadow-sm border-0 p-5" style="background-color: #fffdfa;">
                    <h2 style="color: #8b5e3c;"><i class="fa-solid fa-circle-check"></i> ¡Perfil Verificado!</h2>
                    
                    <div style="margin: 30px 0;">
                        <i class="fa-solid fa-user-shield" style="font-size: 80px; color: #8b5e3c;"></i>
                    </div>
                    
                    <p style="font-size: 1.2rem; color: #7c5845; margin-bottom: 30px;">
                        Ya has completado tu registro como adoptante.<br>
                        Ahora tienes acceso total para adoptar y agendar citas.
                    </p>
                    
                    <a href="inicioAdp" class="btn text-white fw-bold px-4 py-2 rounded-pill" style="background: #8b5e3c;">
                        <i class="fa-solid fa-house"></i> Ir al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-lg rounded-4 border-0 bg-white" style="background-color: #ffffff !important;">
                    
                    <div class="card-body p-5">
                        
                        <div class="text-center mb-4">
                            <i class="fas fa-user-edit" style="font-size: 3rem; color: #8b5e3c !important;"></i>
                            <h3 class="fw-bold mt-3" style="color: #5a4633;">Completa tu Perfil</h3>
                            <p class="text-muted">Necesitamos tus datos de contacto para procesar la adopción.</p>
                        </div>

                        <form id="formPerfilAdoptante" novalidate>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #7c5845;">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control bg-light border-start-0" value="<?php echo $emailUsuario; ?>" readonly>
                                </div>
                                <input type="hidden" id="txt_email_perfil" value="<?php echo $emailUsuario; ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #7c5845;">Nombre Completo</label>
                                <input type="text" class="form-control" id="txt_nombre_perfil" required placeholder="Tu nombre y apellido">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #7c5845;">Cédula / DNI</label>
                                    <input type="number" class="form-control" id="txt_cedula_perfil" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #7c5845;">Teléfono</label>
                                    <input type="tel" class="form-control" id="txt_telefono_perfil" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold" style="color: #7c5845;">Dirección de Residencia</label>
                                <input type="text" class="form-control" id="txt_direccion_perfil" required placeholder="Dirección completa">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg rounded-3 text-white" style="background: linear-gradient(to right, #8b5e3c, #a07b61); border: none;">
                                    <i class="fas fa-save me-2"></i> Guardar y Continuar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<style>
    .form-control {
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }
    .form-control:focus {
        border-color: #8b5e3c;
        box-shadow: 0 0 0 0.25rem rgba(139, 94, 60, 0.25);
    }
    /* Animación suave de entrada */
    .animate-card {
        animation: fadeIn 0.8s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    const form = document.getElementById("formPerfilAdoptante");

    if(form){
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            // Validaciones básicas
            if(document.getElementById("txt_nombre_perfil").value == "" || document.getElementById("txt_cedula_perfil").value == ""){
                Swal.fire("Atención", "Por favor completa todos los campos obligatorios", "warning");
                return;
            }

            // Preparamos datos
            var datos = new FormData();
            datos.append("registrarAdoptante", "ok");
            datos.append("nombre_completo", document.getElementById("txt_nombre_perfil").value);
            datos.append("cedula", document.getElementById("txt_cedula_perfil").value);
            datos.append("telefono", document.getElementById("txt_telefono_perfil").value);
            datos.append("email", document.getElementById("txt_email_perfil").value);
            datos.append("direccion", document.getElementById("txt_direccion_perfil").value);

            // Enviamos Fetch
            fetch("controller/adoptantesController.php", {
                method: "POST",
                body: datos
            })
            .then(res => res.json())
            .then(respuesta => {
                if (respuesta.codigo == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Datos Guardados!',
                        text: 'Tu perfil ha sido creado correctamente.',
                        timer: 2000,
                        showConfirmButton: false,
                        confirmButtonColor: "#8b5e3c"
                    }).then(() => {
                        // Recargar para actualizar el estado de la sesión
                        window.location.reload();
                    });
                } else {
                    Swal.fire("Error", respuesta.mensaje || "No se pudo guardar", "error");
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire("Error", "Error de conexión con el servidor", "error");
            });
        });
    }
});
</script>