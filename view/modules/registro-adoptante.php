<div class="form-container">

    <h2>Registro de Adoptante</h2>
    <p>Completa tus datos para finalizar el proceso</p>

    <form id="formPerfilAdoptante">
        
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" 
                   class="form-control" 
                   id="txt_email_perfil" 
                   placeholder="Ingresa tu correo"
                   value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" 
                   readonly>
        </div>

        <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" class="form-control" id="txt_nombre_perfil" placeholder="Ingresa tu nombre" required>
        </div>

        <div class="form-group">
            <label>Cédula / DNI</label>
            <input type="text" class="form-control" id="txt_cedula_perfil" placeholder="Documento" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" class="form-control" id="txt_telefono_perfil" placeholder="Número de teléfono" required>
        </div>

        <div class="form-group">
            <label>Dirección de Residencia</label>
            <input type="text" class="form-control" id="txt_direccion_perfil" placeholder="Dirección completa" required>
        </div>

        <button type="submit" class="btn-save">GUARDAR DATOS</button>
    
    </form>

</div>

<script>
$(document).ready(function() {
    $("#formPerfilAdoptante").on("submit", function(e) {
        e.preventDefault();

        // Capturamos los valores por su ID
        var nombre = $("#txt_nombre_perfil").val();
        var cedula = $("#txt_cedula_perfil").val();
        var telefono = $("#txt_telefono_perfil").val();
        var direccion = $("#txt_direccion_perfil").val();
        var email = $("#txt_email_perfil").val(); // Este valor viene de la sesión PHP

        if (nombre == "" || cedula == "" || telefono == "" || direccion == "") {
            Swal.fire({ icon: 'warning', title: 'Campos vacíos', text: 'Por favor completa toda la información.' });
            return;
        }

        var datos = new FormData();
        datos.append("registrarAdoptante", "ok");
        datos.append("nombre_completo", nombre);
        datos.append("cedula", cedula);
        datos.append("telefono", telefono);
        datos.append("email", email);
        datos.append("direccion", direccion);

        $.ajax({
            url: "controller/adoptantesController.php",
            method: "POST",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(".btn-save").prop('disabled', true).text('Guardando...');
            },
            success: function(respuesta) {
                if (respuesta.codigo == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro Completado!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        if(localStorage.getItem("mascota_pendiente")){
                            window.location.href = "index.php?ruta=citasAdp";
                        } else {
                            window.location.href = "index.php?ruta=inicioAdp";
                        }
                    });
                } else {
                    Swal.fire("Error", respuesta.mensaje, "error");
                    $(".btn-save").prop('disabled', false).text('GUARDAR DATOS');
                }
            },
            error: function() {
                // En caso de error de red o JSON mal formado
                Swal.fire("Error", "Hubo un problema al procesar la solicitud.", "error");
                $(".btn-save").prop('disabled', false).text('GUARDAR DATOS');
            }
        });
    });
});
</script>