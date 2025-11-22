$(document).ready(function() {
    
    // 1. Cargar mascotas en el select al iniciar la página
    cargarMascotasDelUsuario();

    // (Eliminamos la función listarMisCitas y los botones de navegación porque ya no hay tabla)

    // --- EVENTO: REGISTRAR CITA ---
    $("#formRegistroCitaAdp").on("submit", function(e) {
        e.preventDefault();

        // Capturamos los datos
        var id_mascotas = $("#select_mascotas_adp").val();
        var id_adoptantes = $("#id_adoptante_sesion").val(); // Viene del input oculto en PHP
        var fecha_cita = $("#txt_fecha_cita").val();
        var motivo = $("#txt_motivo").val();
        var estado = "Pendiente"; 

        // Validación básica
        if (id_mascotas == "" || fecha_cita == "" || motivo == "") {
            Swal.fire("Atención", "Por favor complete todos los campos del formulario.", "warning");
            return;
        }

        // Preparamos los datos para enviar
        var datos = new FormData();
        datos.append("registrarCita", "ok");
        datos.append("id_mascotas", id_mascotas);
        datos.append("id_adoptantes", id_adoptantes);
        datos.append("fecha_cita", fecha_cita);
        datos.append("motivo", motivo);
        datos.append("estado", estado);

        // Petición AJAX
        $.ajax({
            url: "controller/citasController.php",
            method: "POST",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.codigo == "200") {
                    // Éxito: Mensaje y redirección
                    Swal.fire({
                        icon: 'success',
                        title: '¡Solicitud Enviada!',
                        text: 'Tu solicitud de adopción ha sido registrada. Nos pondremos en contacto contigo.',
                        confirmButtonText: 'Volver a Mascotas'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#formRegistroCitaAdp")[0].reset();
                            // Redirigimos al catálogo de adopción para seguir viendo
                            window.location.href = "index.php?ruta=adoptaAdp";
                        }
                    });
                } else {
                    // Error del servidor
                    Swal.fire("Error", respuesta.mensaje, "error");
                }
            }
        });
    });
});

// --- FUNCIONES AUXILIARES ---

function cargarMascotasDelUsuario() {
    var datos = new FormData();
    datos.append("listarMascotas", "ok"); 

    $.ajax({
        url: "controller/mascotasController.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // Limpiamos y llenamos el select
            $("#select_mascotas_adp").empty();
            $("#select_mascotas_adp").append('<option value="">Seleccione una mascota...</option>');
            
            if (respuesta.codigo == "200") {
                respuesta.listaMascotas.forEach(function(m) {
                    // Solo mostramos mascotas Disponibles
                    if(m.estado == "Disponible"){
                        $("#select_mascotas_adp").append(`<option value="${m.id_mascotas}">${m.nombre} - ${m.raza}</option>`);
                    }
                });

                // Una vez cargadas las opciones, verificamos si hay que seleccionar una automáticamente
                verificarPreseleccion();
            }
        }
    });
}

function verificarPreseleccion(){
    // 1. Si viene por URL (Ej: index.php?ruta=citasAdp&mascota=5)
    const urlParams = new URLSearchParams(window.location.search);
    const mascotaUrl = urlParams.get('mascota');

    if (mascotaUrl) {
        $("#select_mascotas_adp").val(mascotaUrl);
    } 
    // 2. Si viene por LocalStorage (Caso: Se acaba de registrar tras dar click en Adoptame)
    else {
        const mascotaPendiente = localStorage.getItem("mascota_pendiente");
        if (mascotaPendiente) {
            $("#select_mascotas_adp").val(mascotaPendiente);
            // Borramos el dato de la memoria para que no se seleccione siempre
            localStorage.removeItem("mascota_pendiente");
        }
    }
}