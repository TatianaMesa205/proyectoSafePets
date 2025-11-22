$(document).ready(function() {
    
    $(document).on("click", ".btn-adoptame", function(e) {
        e.preventDefault(); 

        var idMascota = $(this).attr("id-mascota");

        var datos = new FormData();
        datos.append("verificarPerfil", "ok");

        $.ajax({
            url: "controller/adoptantesController.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                
                if (respuesta.codigo == "200") {
                    if (respuesta.existe) {
                        // CASO A: YA ES ADOPTANTE -> A Citas
                        window.location.href = "index.php?ruta=citasAdp&mascota=" + idMascota;
                    } else {
                        // CASO B: NO ES ADOPTANTE -> Al formulario de registro
                        Swal.fire({
                            title: '¡Un paso más!',
                            text: "Para adoptar, primero necesitamos registrar tus datos de contacto.",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#8b5e3c',
                            confirmButtonText: 'Ir a registrarme',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                localStorage.setItem("mascota_pendiente", idMascota);
                                
                                // --- CORRECCIÓN AQUÍ: Ruta correcta ---
                                window.location.href = "index.php?ruta=registro-adoptante"; 
                                // --------------------------------------
                            }
                        });
                    }
                } else {
                    Swal.fire("Error", "Por favor inicia sesión nuevamente.", "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Hubo un problema al verificar tu perfil.", "error");
            }
        });
    });
});