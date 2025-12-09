<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-user-cog"></i> Gestión de Adoptantes
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarAdoptantes" class="btn btn-add">
      <i class="fas fa-plus"></i> Agregar Adoptante
    </button>
  </div>

  <!-- Panel de tabla -->
  <div id="panelTablaAdoptantes" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaAdoptantes" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Nombre completo</th>
          <th>Cédula</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Nombre de usuario</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario de agregar -->
  <div id="panelFormularioAdoptantes" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Adoptante</h4>
    <form id="formRegistroAdmin" novalidate> 
      <div class="row g-3">
        <div class="col-md-6">
            <label>Nombre completo</label>
            <input type="text" class="form-control rounded-3" id="txt_nombre_completo_adp" required>
        </div>
        <div class="col-md-6">
            <label>Cédula</label>
            <input type="text" class="form-control rounded-3" id="txt_cedula_adp" required>
        </div>
        <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" class="form-control rounded-3" id="txt_telefono_adp" required>
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" class="form-control rounded-3" id="txt_email_adp" required>
        </div>
        <div class="col-md-12">
            <label>Dirección</label>
            <input type="text" class="form-control rounded-3" id="txt_direccion_adp" required>
        </div>
      </div><br>

      <h4 class="mb-3 text-center text-dark fw-semibold">Datos de usuario</h4>

      <div class="row g-3">
        <div class="col-md-6">
            <label>Nombre usuario</label>
            <input type="text" class="form-control rounded-3" id="txt_nombre_usuario_new" required>
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" class="form-control rounded-3" id="txt_email_usuario_new" required readonly> 
        </div>
        <div class="col-md-6">
            <label>Contraseña</label>
            <input type="password" class="form-control rounded-3" id="txt_contrasena_new" required>
        </div>
      </div>

      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarAdoptante" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario de editar -->
  <div id="panelFormularioEditarAdoptantes" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Adoptante</h4>
    <form id="formEditarAdoptantes" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre completo</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_nombre_completo" required>
        </div>
        <div class="col-md-6">
          <label>Cédula</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_cedula" required>
        </div>
        <div class="col-md-6">
          <label>Teléfono</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_telefono" required>
        </div>
        <div class="col-md-6">
          <label>Email</label>
          <input type="email" class="form-control rounded-3" id="txt_edit_email" required readonly>
        </div>
        <div class="col-md-12">
          <label>Dirección</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_direccion" required>   
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarAdoptante" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarAdoptante" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
<?php include("pie.php"); ?>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Nuevos elementos
    const formRegistroAdmin = document.getElementById("formRegistroAdmin");
    const txtEmailAdoptante = document.getElementById("txt_email_adp");
    const txtEmailUsuario = document.getElementById("txt_email_usuario_new");
    const Swal = window.Swal;

    // Lógica de Autocompletado
    if (txtEmailAdoptante && txtEmailUsuario) {
        txtEmailAdoptante.addEventListener('input', function() {
            txtEmailUsuario.value = this.value;
        });
    }

    // Lógica de Registro (al hacer clic en Guardar)
    if (formRegistroAdmin) {
        formRegistroAdmin.addEventListener("submit", function (e) {
            e.preventDefault();

            if (this.checkValidity()) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
                submitBtn.disabled = true;

                // Capturar datos del formulario
                const nombre_completo = document.getElementById("txt_nombre_completo_adp").value.trim();
                const cedula = document.getElementById("txt_cedula_adp").value.trim();
                const telefono = document.getElementById("txt_telefono_adp").value.trim();
                const direccion = document.getElementById("txt_direccion_adp").value.trim();
                
                const nombre_usuario = document.getElementById("txt_nombre_usuario_new").value.trim();
                const email = document.getElementById("txt_email_usuario_new").value.trim();
                const contrasena = document.getElementById("txt_contrasena_new").value;

                const formData = new FormData();
                formData.append("accion", "registro"); // Usa la acción de registro unificado
                
                // Datos de Usuario
                formData.append("nombre_usuario", nombre_usuario);
                formData.append("email", email);
                formData.append("contrasena", contrasena); // El modelo hashea la contraseña
                
                // Datos de Adoptante
                formData.append("nombre_completo", nombre_completo);
                formData.append("cedula", cedula);
                formData.append("telefono", telefono);
                formData.append("direccion", direccion);
                
                // Envío de datos al controlador
                fetch("controller/loginController.php", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => {
                    if (!response.ok) throw new Error("Error de red");
                    return response.json();
                })
                .then((data) => {
                    if (data.codigo === "200") {
                        Swal.fire({
                            icon: "success",
                            title: "¡Registro exitoso!",
                            text: data.mensaje || "Adoptante y Usuario creados.",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            
                            // 1. Limpiar formulario
                            formRegistroAdmin.reset(); 
                            
                            // 2. Ocultar formulario y mostrar la tabla (usando jQuery como en tu clase)
                            $("#panelFormularioAdoptantes").hide();
                            $("#panelTablaAdoptantes").show();

                            // 3. CAMBIO CLAVE: Llamar a listarAdoptantes
                            // Creamos una nueva instancia de la clase Adoptantes y llamamos a la función.
                            new Adoptantes({ listarAdoptantes: "ok" }).listarAdoptantes();
                            
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Atención",
                            text: data.mensaje || "No se pudo completar el registro.",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Hubo un problema técnico al procesar el registro.",
                    });
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    this.classList.remove("was-validated"); // Opcional: limpiar validación visual
                });
            } else {
                this.classList.add("was-validated");
            }
        });
    }
});
</script>