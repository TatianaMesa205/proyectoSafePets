$(document).ready(function() {
    
    $(document).on("click", ".btn-adoptame", function(e) {
        e.preventDefault(); 

        var estado = $(this).attr("estado");

        if (estado === "en tratamiento") {
            Swal.fire({
                icon: "warning",
                title: "Mascota en tratamiento",
                text: "Lo sentimos, esta mascota aún no se encuentra disponible para adopción.",
                confirmButtonColor: "#a07b61"
            });
            return;
        }

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
                        window.location.href = "index.php?ruta=citasAdp&mascota=" + idMascota;
                    } else {

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
                                window.location.href = "index.php?ruta=registro-adoptante"; 
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
