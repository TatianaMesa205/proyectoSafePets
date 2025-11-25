<?php
include_once "controller/adoptantesController.php";
include_once "model/adoptantesModel.php";

// Obtener email de sesión
$email_usuario = $_SESSION['email'] ?? null;

// Buscar adoptante por email
$adoptanteInfo = AdoptantesController::ctrMostrarAdoptante("email", $email_usuario);

// Si existe adoptante extraer id
$idAdoptante = $adoptanteInfo["id_adoptantes"] ?? null;
?>


<body>

<input type="hidden" id="id_adoptante_sesion" value="<?php echo $idAdoptante; ?>">

<div class="perfil-container">

    <!-- MENÚ LATERAL -->
    <aside class="sidebar-menu">
        <a href="index.php?ruta=inicioAdp" class="sidebar-title">
            <i class="fa-solid fa-paw"></i> Safe Pets
        </a>


        <ul class="menu-list">
            <li class="menu-item active">
                <i class="fa-solid fa-user"></i> Mi Perfil
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-calendar"></i> Historial de Citas
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-file-lines"></i> Publicaciones Realizadas
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-heart"></i> Mis Adopciones
            </li>
        </ul>
    </aside>


    <!-- CONTENIDO A LA DERECHA -->
    <div class="content-area">

        <div class="form-wrapper">

            <!-- ICONO DE PERFIL -->
            <div class="profile-icon">
                <i class="fa-solid fa-circle-user"></i>
            </div>

            <!-- TÍTULO -->
            <h4 class="form-title">
                <i class="fa-solid fa-paw me-2"></i>Mi Perfil Safe Pets
            </h4>

            <form id="formPerfil" novalidate>

                <!-- NOMBRE DE USUARIO -->
                <div class="mb-4">
                    <label class="form-label-custom">Nombre de Usuario</label>
                    <div class="input-group input-group-lg input-custom">
                        <span class="input-group-text icon-box">
                            <i class="fa-solid fa-user"></i>
                        </span>

                        <input type="text"
                            class="form-control input-field"
                            id="nombre_usuario"
                            value="<?php echo $_SESSION['nombre_usuario']; ?>"
                            required>
                    </div>
                </div>

                <!-- CONTRASEÑAS -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Nueva Contraseña</label>

                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box">
                                <i class="fa-solid fa-key"></i>
                            </span>

                            <input type="password"
                                class="form-control input-field"
                                id="password"
                                placeholder="••••••">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Confirmar Contraseña</label>

                        <div class="input-group input-group-lg input-custom">
                            <span class="input-group-text icon-box">
                                <i class="fa-solid fa-check-double"></i>
                            </span>

                            <input type="password"
                                class="form-control input-field"
                                id="confirm_password"
                                placeholder="••••••">
                        </div>
                    </div>
                </div>

                <small class="text-muted d-block text-center mb-3">
                    Déjalo vacío si no deseas actualizar la contraseña.
                </small>

                <!-- BOTÓN -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-save-lg form-btn">Guardar Cambios</button>
                </div>

            </form>
        </div>



        <!-- SECCIÓN HISTORIAL DE CITAS -->
        <div id="seccionCitas" class="seccion oculto">
            <h3 class="mb-4" style="color:#8b5e3c; font-weight:700;">
                <i class="fa-solid fa-calendar-check me-2"></i>Historial de Citas
            </h3>

            <div id="listaCitasAdoptante" class="row g-3"></div>
                <div id="modalCancelar" class="modal-cancelar">
                    <div class="modal-content">
                        <h4>¿Seguro que desea cancelar esta cita?</h4>
                        <p>Esta acción no se puede deshacer.</p>

                        <div class="modal-buttons">
                        <button id="btnConfirmar" class="btn-confirmar">Sí, cancelar</button>
                        <button id="btnCerrar" class="btn-cerrar">No</button>
                        </div>
                    </div>
                </div>

        </div>


        <!-- SECCIÓN PUBLICACIONES REALIZADAS -->
        <div id="seccionPublicaciones" class="seccion oculto">
            <h3 class="mb-4" style="color:#8b5e3c; font-weight:700;">
                <i class="fa-solid fa-file-lines me-2"></i>Publicaciones Realizadas
            </h3>
            <p class="text-muted">Aquí aparecerán las publicaciones hechas por el usuario.</p>
        </div>

        <!-- SECCIÓN MIS ADOPCIONES -->
        <div id="seccionAdopciones" class="seccion oculto">
            <h3 class="mb-4" style="color:#8b5e3c; font-weight:700;">
                <i class="fa-solid fa-heart me-2"></i>Mis Adopciones
            </h3>
            <p class="text-muted">Aquí se mostrarán las adopciones asociadas al usuario.</p>
        </div>


    </div>

</div>




<style>
/* LAYOUT GENERAL */
.perfil-container {
    display: flex;
    min-height: 100vh;
    background-color: #f6eee7; 
}

/* SIDEBAR */
.sidebar-menu {
    width: 260px;
    background-color: #f0e4d8ff;
    padding: 30px 20px;
    border-right: 2px solid #e2c7b3;
    font-family: "Poppins", sans-serif;
}

.sidebar-title {
    display: block;
    text-align: center;
    font-weight: 700;
    color: #8b5e3c;
    font-size: 22px;
    margin-bottom: 30px;
    text-decoration: none; /* Quita subrayado */
}

.sidebar-title:hover {
    color: #b98c68; /* color bonito en hover */
}


.sidebar-title i {
    color: #b98c68;
    margin-right: 6px;
}

/* LISTA DE OPCIONES */
.menu-list {
    list-style: none;
    padding: 0;
}

.menu-item {
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 12px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    color: #6b4a37;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
}

.menu-item:hover {
    background-color: #e2c7b3;
}

.menu-item.active {
    background-color: #d5b292;
    color: #fff;
    font-weight: 600;
}

/* CONTENIDO DERECHA */
.content-area {
    flex: 1;
    padding: 40px;
    display: flex;
    justify-content: center;   /* Centra horizontal */
    align-items: flex-start;   /* Mantiene arriba pero centrado */
}

/* ICONO PERFIL */
.profile-icon i {
    font-size: 80px;
    color: #c7a386;
    display: block;
    text-align: center;
    margin-bottom: 10px;
}

/* FORM WRAPPER */
.form-wrapper {
    background: #ffffff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 600px;
    width: 100%;
    border: 1px solid #ebd7c4;
}

/* Secciones ocultas */
.oculto {
    display: none;
}

/* Secciones visibles */
.visible {
    display: block;
}

/* -------------------------
   ESTILOS MEJORADOS PERFIL
-------------------------- */

/* Título */
.form-title {
    text-align: center;
    font-size: 26px;
    font-weight: 700;
    color: #8b5e3c;
    margin-bottom: 25px;
}

/* Labels */
.form-label-custom {
    font-weight: 600;
    color: #6a4a35;
    font-size: 15px;
}

/* Caja del input */
.input-custom .icon-box {
    background-color: #f7eee7;
    color: #8b5e3c;
    border: 1px solid #e5d3c0;
}

.input-custom .input-field {
    background-color: #fffaf6;
    border: 1px solid #e6d4c3;
    border-radius: 10px;
}

.input-field:focus {
    border-color: #c49a7a;
    box-shadow: 0 0 5px #c49a7a60;
}

/* Icono de perfil */
.profile-icon i {
    font-size: 90px;
    color: #d0b39a;
    margin-bottom: 10px;
}

/* Botón */
.form-btn {
    background-color: #8b5e3c !important;
    border: none;
    padding: 12px;
    font-size: 17px;
    border-radius: 12px;
    box-shadow: 0px 4px 10px #00000020;
    transition: 0.2s;
}

.form-btn:hover {
    background-color: #734b30 !important;
    transform: translateY(-2px);
}

#listaCitasAdoptante {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.cita-card {
    width: 300px;         /* 🔥 Tarjeta uniforme */
    background: #ffffff;
    border-radius: 18px;
    padding: 18px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: .3s;
    border: 1px solid #e6d4c3;
}

.cita-img {
    width: 100%;
    height: 220px;         /* Mejor proporción */
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 12px;
    border: 2px solid #f5e6da;
}


.cita-card:hover {
    transform: translateY(-5px);
}


/* ESTADOS DE LA CITA */

/* Confirmada */
.estado-activa {
    display: inline-block;
    background: #c8f3cc;   /* verde pastel suave */
    color: #1b6022;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: bold;
}

/* Cancelada */
.estado-cancelada {
    display: inline-block;
    background: #ffd2d2;
    color: #8b1a1a;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: bold;
}

/* Completada */
.estado-completada {
    display: inline-block;
    background: #d8e8ff;  /* azul suave */
    color: #1a3d7c;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: bold;
}

/* Pendiente */
.estado-pendiente {
    display: inline-block;
    background: #fff4cc;  /* amarillo suave */
    color: #7a5c1a;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: bold;
}
.modal-cancelar {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    width: 90%;
    max-width: 350px;
}

.btn-confirmar {
    background: #c0392b;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
}

.btn-cerrar {
    background: #d5b292ff;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    margin-left: 10px;
}


</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const menuItems = document.querySelectorAll(".menu-item");

    const secciones = {
        "Mi Perfil": "content-area", 
        "Historial de Citas": "seccionCitas",
        "Publicaciones Realizadas": "seccionPublicaciones",
        "Mis Adopciones": "seccionAdopciones"
    };

    menuItems.forEach(item => {
        item.addEventListener("click", function () {

            // Quitar activo a todos
            menuItems.forEach(btn => btn.classList.remove("active"));

            // Activar el clickeado
            this.classList.add("active");

            // Ocultar todas las secciones
            document.querySelectorAll(".seccion").forEach(sec => sec.classList.add("oculto"));

            // Mostrar la que corresponde
            let texto = this.innerText.trim();

            if (texto === "Mi Perfil") {
                document.querySelector(".form-wrapper").style.display = "block";
            } else {
                document.querySelector(".form-wrapper").style.display = "none";
            }

            const idSeccion = secciones[texto];
            if (idSeccion !== "content-area") {
                document.getElementById(idSeccion).classList.remove("oculto");
            }
        });
    });

});
</script>

<script src="view/js/historialCitasAdp.js"></script>