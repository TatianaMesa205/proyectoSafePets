$(document).ready(function() {
    
    validarEstadoCita();

    cargarMascotasDelUsuario();

    const inputFecha = document.getElementById("txt_fecha_cita");
    if (inputFecha) {
        const ahora = new Date();

        ahora.setMinutes(ahora.getMinutes() - ahora.getTimezoneOffset());
        
        const fechaMinima = ahora.toISOString().slice(0, 16);
        
        inputFecha.min = fechaMinima;

        inputFecha.addEventListener("change", function() {
            if (this.value < fechaMinima) {
                Swal.fire("Fecha inválida", "No puedes seleccionar una fecha u hora pasada.", "warning");
                this.value = "";
            }
        });
    }

    $("#formRegistroCitaAdp").on("submit", function(e) {
        e.preventDefault();

        var id_mascotas = $("#select_mascotas_adp").val();
        var id_adoptantes = $("#id_adoptante_sesion").val();
        var fecha_cita = $("#txt_fecha_cita").val();
        var motivo = $("#txt_motivo").val();
        var estado = "Pendiente"; 

        if (id_mascotas == "" || fecha_cita == "" || motivo == "") {
            Swal.fire("Atención", "Por favor complete todos los campos del formulario.", "warning");
            return;
        }

        var datos = new FormData();
        datos.append("registrarCita", "ok");
        datos.append("id_mascotas", id_mascotas);
        datos.append("id_adoptantes", id_adoptantes);
        datos.append("fecha_cita", fecha_cita);
        datos.append("motivo", motivo);
        datos.append("estado", estado);

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
                            window.location.href = "index.php?ruta=adoptaAdp";
                        }
                    });
                } else if (respuesta.codigo == "409") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Solicitud Activa',
                        text: respuesta.mensaje,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Entendido'
                    });
                } else {
                    Swal.fire("Error", respuesta.mensaje || "Error desconocido", "error");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX:", textStatus, errorThrown);
                console.log("Respuesta cruda del servidor:", jqXHR.responseText);
                Swal.fire("Error Técnico", "Hubo un problema de comunicación con el servidor. Revisa la consola (F12) para más detalles.", "error");
            }
        });
    });
});



function validarEstadoCita() {
    var id_adoptantes = $("#id_adoptante_sesion").val();
    
    if(!id_adoptantes) return; 

    var datos = new FormData();
    datos.append("validarCita", "ok"); 
    datos.append("id_adoptantes", id_adoptantes);

    $.ajax({
        url: "controller/citasController.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta.total > 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Ya tienes una cita en proceso',
                    text: 'Para agendar una nueva, tu cita actual debe estar Completada o Cancelada. Te redirigiremos a tu historial.',
                    allowOutsideClick: false,
                    confirmButtonText: 'Ir a mis Citas'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?ruta=perfilAdp"; 
                    }
                });
                
                $("#formRegistroCitaAdp input, #formRegistroCitaAdp select, #formRegistroCitaAdp button").prop("disabled", true);
            }
        }
    });
}

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
            $("#select_mascotas_adp").empty();
            $("#select_mascotas_adp").append('<option value="">Seleccione una mascota...</option>');
            
            if (respuesta.codigo == "200") {
                respuesta.listaMascotas.forEach(function(m) {
                    if(m.estado == "Disponible"){
                        $("#select_mascotas_adp").append(`<option value="${m.id_mascotas}">${m.nombre} - ${m.raza}</option>`);
                    }
                });
                verificarPreseleccion();
            }
        }
    });
}

function verificarPreseleccion(){
    const urlParams = new URLSearchParams(window.location.search);
    const mascotaUrl = urlParams.get('mascota');

    if (mascotaUrl) {
        $("#select_mascotas_adp").val(mascotaUrl);
    } else {
        const mascotaPendiente = localStorage.getItem("mascota_pendiente");
        if (mascotaPendiente) {
            $("#select_mascotas_adp").val(mascotaPendiente);
            localStorage.removeItem("mascota_pendiente");
        }
    }
}