<div class="container-fluid mt-5 d-flex justify-content-center">
    <div class="form-wrapper">

        <div class="profile-icon">
            <i class="fa-solid fa-circle-user"></i>
        </div>

        <h4 class="text-center fw-bold mb-4"><i class="fa-solid fa-paw me-2"></i>Mi Perfil Safe Pets</h4>

        <form id="formPerfil" novalidate>

            <div class="mb-4">
                <label class="form-label fw-bold" style="color: #5a4633;">Nombre de Usuario</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light"><i class="fa-solid fa-user"></i></span>

                    <input type="text"
                           class="form-control"
                           id="nombre_usuario"
                           value="<?php echo $_SESSION['nombre_usuario']; ?>"
                           required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold" style="color: #5a4633;">Nueva Contraseña</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light"><i class="fa-solid fa-key"></i></span>
                        <input type="password"
                               class="form-control"
                               id="password"
                               placeholder="••••••">
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold" style="color: #5a4633;">Confirmar Contraseña</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light"><i class="fa-solid fa-check-double"></i></span>
                        <input type="password"
                               class="form-control"
                               id="confirm_password"
                               placeholder="••••••">
                    </div>
                </div>
            </div>

            <small class="text-muted ms-1 mb-3 d-block">Déjalo vacío si no quieres cambiarla.</small>

            <div class="d-grid mt-3">
                <button type="submit" class="btn text-white btn-save-lg" style="background-color: #8b5e3c;">
                    <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios
                </button>
            </div>

        </form>

    </div>
</div>
<script src="view/js/perfil.js"></script>
<?php include("cabecera.php"); ?>
