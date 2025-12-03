<?php
// No es necesario session_start() aquí si ya está en plantilla.php
include_once "controller/adoptantesController.php";
include_once "model/adoptantesModel.php";

$email_usuario = $_SESSION['email'] ?? null;
$adoptanteInfo = AdoptantesController::ctrMostrarAdoptante("email", $email_usuario);
$idAdoptante = $adoptanteInfo["id_adoptantes"] ?? null;
?>

<body>

<input type="hidden" id="id_adoptante_sesion" value="<?php echo $idAdoptante; ?>">

<div class="perfil-container">

    <aside class="sidebar-menu">
        <a href="index.php?ruta=inicioAdp" class="sidebar-title">
            <i class="fa-solid fa-paw"></i> Safe Pets
        </a>
        <ul class="menu-list">
            <li class="menu-item active"><i class="fa-solid fa-user"></i> Mi Perfil</li>
            <li class="menu-item"><i class="fa-solid fa-calendar"></i> Historial de Citas</li>
        </ul>
    </aside>

    <div class="content-area">
        <div class="form-wrapper">
            <div class="profile-icon"><i class="fa-solid fa-circle-user"></i></div>
            <h4 class="form-title"><i class="fa-solid fa-paw me-2"></i>Mi Perfil Safe Pets</h4>

            <form id="formPerfil" novalidate>
                <div class="mb-4">
                    <label class="form-label-custom">Nombre de Usuario</label>
                    <div class="input-group input-group-lg input-custom">
                        <span class="input-group-text icon-box"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control input-field" id="nombre_usuario" value="<?php echo $_SESSION['nombre_usuario'] ?? ''; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Nueva Contraseña</label>
                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box"><i class="fa-solid fa-key"></i></span>
                            <input type="password" class="form-control input-field" id="password" placeholder="••••••">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Confirmar Contraseña</label>
                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box"><i class="fa-solid fa-check-double"></i></span>
                            <input type="password" class="form-control input-field" id="confirm_password" placeholder="••••••">
                        </div>
                    </div>
                </div>

                <?php if ($adoptanteInfo): ?>
                    <hr class="my-4" style="border-top: 2px dashed #e2c7b3;">
                    <h5 class="mb-4 text-center" style="color:#8b5e3c; font-weight:700;">Datos Personales</h5>
                    <input type="hidden" id="is_adoptante" value="true">
                    <input type="hidden" id="id_adoptante_form" value="<?php echo $idAdoptante; ?>">

                    <div class="mb-4">
                        <label class="form-label-custom">Nombre Completo</label>
                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box"><i class="fa-solid fa-id-card"></i></span>
                            <input type="text" class="form-control input-field" id="nombre_completo" value="<?php echo $adoptanteInfo['nombre_completo']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Cédula</label>
                            <div class="input-group input-group-lg input-custom">
                                <span class="input-group-text icon-box"><i class="fa-solid fa-fingerprint"></i></span>
                                <input type="number" class="form-control input-field" id="cedula" value="<?php echo $adoptanteInfo['cedula']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Teléfono</label>
                            <div class="input-group input-group-lg input-custom">
                                <span class="input-group-text icon-box"><i class="fa-solid fa-phone"></i></span>
                                <input type="number" class="form-control input-field" id="telefono" value="<?php echo $adoptanteInfo['telefono']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Dirección</label>
                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box"><i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" class="form-control input-field" id="direccion" value="<?php echo $adoptanteInfo['direccion']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Correo Electrónico (No editable)</label>
                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box" style="background-color: #e9ecef;"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control input-field" id="email_adoptante" value="<?php echo $adoptanteInfo['email']; ?>" readonly style="background-color: #e9ecef;">
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-save-lg form-btn">Guardar Cambios</button>
                </div>
            </form>
        </div>

        <div id="seccionCitas" class="seccion oculto" style="width: 100%;">
            <h3 class="mb-4 text-center" style="color:#8b5e3c; font-weight:700;">
                <i class="fa-solid fa-calendar-check me-2"></i>Historial de Citas
            </h3>
            <div id="listaCitasAdoptante" class="contenedor-principal-citas"></div>
        </div>
    </div> 
</div> 
</body>

<style>
/* ... (Tus estilos anteriores se mantienen igual, solo cambia .cita-card y .btn-cancelar abajo) ... */

/* LAYOUT GENERAL */
.perfil-container { display: flex; min-height: 100vh; background-color: #f6eee7; }
.sidebar-menu { width: 260px; background-color: #f0e4d8ff; padding: 30px 20px; border-right: 2px solid #e2c7b3; font-family: "Poppins", sans-serif; }
.sidebar-title { display: block; text-align: center; font-weight: 700; color: #8b5e3c; font-size: 22px; margin-bottom: 30px; text-decoration: none; }
.sidebar-title:hover { color: #b98c68; }
.sidebar-title i { color: #b98c68; margin-right: 6px; }
.menu-list { list-style: none; padding: 0; }
.menu-item { padding: 14px 18px; border-radius: 10px; margin-bottom: 12px; font-size: 15px; font-weight: 500; cursor: pointer; color: #6b4a37; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
.menu-item:hover { background-color: #e2c7b3; }
.menu-item.active { background-color: #d5b292; color: #fff; font-weight: 600; }
.content-area { flex: 1; padding: 40px; display: flex; justify-content: center; align-items: flex-start; }
.form-wrapper { background: #ffffff; padding: 35px; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 600px; width: 100%; border: 1px solid #ebd7c4; }
.oculto { display: none; }
.visible { display: block; }
.form-title { text-align: center; font-size: 26px; font-weight: 700; color: #8b5e3c; margin-bottom: 25px; }
.form-label-custom { font-weight: 600; color: #6a4a35; font-size: 15px; }
.input-custom .icon-box { background-color: #f7eee7; color: #8b5e3c; border: 1px solid #e5d3c0; }
.input-custom .input-field { background-color: #fffaf6; border: 1px solid #e6d4c3; border-radius: 10px; }
.input-field:focus { border-color: #c49a7a; box-shadow: 0 0 5px #c49a7a60; }
.profile-icon i { font-size: 90px; color: #d0b39a; margin-bottom: 10px; display: block; text-align: center; }
.form-btn { background-color: #8b5e3c !important; border: none; padding: 12px; font-size: 17px; border-radius: 12px; box-shadow: 0px 4px 10px #00000020; transition: 0.2s; color: white; }
.form-btn:hover { background-color: #734b30 !important; transform: translateY(-2px); }

/* --- ESTILOS DE CITAS --- */
.titulo-decorado { display: flex; align-items: center; justify-content: center; color: #8b5e3c; font-weight: 700; font-size: 1.3rem; margin: 30px 0 20px 0; white-space: nowrap; width: 100%; }
.titulo-decorado::before, .titulo-decorado::after { content: ''; flex: 1; border-bottom: 2px solid #e2c7b3; margin: 0 15px; }
.contenedor-citas { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; width: 100%; }

/* --- TARJETA CORREGIDA --- */
.cita-card {
    background-color: #ffffff;
    border: 1px solid #ebd7c4;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(139, 94, 60, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.3s ease;
    width: 100%;
    max-width: 320px;
    margin: 0 auto;
    
    /* IMPORTANTE PARA POSICIONAR EL BOTÓN */
    position: relative; 
}

.cita-card:hover { transform: translateY(-5px); border-color: #c49a7a; box-shadow: 0 8px 20px rgba(139, 94, 60, 0.2); }
.cita-card img { width: 100%; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 12px; border: 1px solid #f0e4d8; }
.cita-card h5 { color: #8b5e3c; font-weight: 700; margin: 10px 0; font-size: 18px; text-align: center; }
.cita-card p { color: #6b4a37; margin-bottom: 5px; font-size: 14px; text-align: center; }
.estado-container { text-align: center; margin-bottom: 8px; }
.estado-activa { display: inline-block; background: #c8f3cc; color: #1b6022; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 12px; }
.estado-cancelada { display: inline-block; background: #ffd2d2; color: #8b1a1a; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 12px; }
.estado-pendiente { display: inline-block; background: #fff4cc; color: #7a5c1a; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 12px; }
.estado-finalizada { display: inline-block; background: #d1e7dd; color: #0f5132; padding: 4px 12px; border-radius: 12px; font-weight: bold; border: 1px solid #badbcc; font-size: 12px; }

/* --- BOTÓN PAPELERA EN LA ESQUINA --- */
.btn-cancelar {
    position: absolute; /* Flotante */
    top: 10px;
    right: 10px;
    z-index: 10; /* Encima de la imagen */
    
    background: #fff; /* Fondo blanco para que se vea bien */
    border: 1px solid #e3e3e3;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    color: #dc3545; 
    
    border-radius: 50%;
    width: 35px; height: 35px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; 
    transition: 0.2s;
}
.btn-cancelar:hover { background: #dc3545; color: #fff; transform: scale(1.1); }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const perfilWrapper = document.querySelector(".form-wrapper");
    const secCitas = document.getElementById("seccionCitas");
    
    function ocultarTodo() {
        if(perfilWrapper) perfilWrapper.style.display = "none";
        if(secCitas) secCitas.classList.add("oculto");
    }

    menuItems.forEach(item => {
        item.addEventListener("click", function () {
            menuItems.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            ocultarTodo();
            let texto = this.innerText.trim();
            if (texto.includes("Mi Perfil")) {
                if(perfilWrapper) perfilWrapper.style.display = "block";
            } else if (texto.includes("Historial de Citas")) {
                if(secCitas) secCitas.classList.remove("oculto");
            }
        });
    });
});
</script>

<script src="view/js/historialCitasAdp.js"></script>
<script src="view/js/perfil.js"></script>