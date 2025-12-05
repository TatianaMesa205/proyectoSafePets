<div class="container-fluid mt-5 d-flex justify-content-center">
    <div class="form-wrapper">

        <div class="profile-icon">
            <i class="fa-solid fa-circle-user"></i>
        </div>

        <h4 class="text-center fw-bold mb-4"><i class="fas fa-user-cog me-2"></i>Perfil Administrador</h4>

        <form id="formPerfil" novalidate>

            <div class="mb-4">
                <label for="nombre_usuario" class="form-label fw-bold">Nombre de Usuario</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                    <input type="text"
                           class="form-control"
                           id="nombre_usuario"
                           name="nombre_usuario"
                           value="<?php echo $_SESSION['nombre_usuario']; ?>"
                           autocomplete="username"
                           required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               autocomplete="new-password"
                               placeholder="Nueva clave">
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="confirm_password" class="form-label fw-bold">Confirmar</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light"><i class="fas fa-check"></i></span>
                        <input type="password"
                               class="form-control"
                               id="confirm_password"
                               autocomplete="new-password"
                               placeholder="Repetir clave">
                    </div>
                </div>
            </div>

            <div class="form-text mb-4 ms-1">Deja los campos de contraseña vacíos si no deseas cambiarla.</div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-save-lg">
                    <i class="fas fa-save me-2"></i>Actualizar Datos
                </button>
            </div>

        </form>

    </div>
</div><br>
<script src="view/js/perfil.js"></script>
<?php include("cabecera.php"); ?>