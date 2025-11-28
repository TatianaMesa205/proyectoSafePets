$(document).ready(function() {
    // Cargar citas al entrar a la sección o al cargar la página si ya es visible
    listarCitasAdoptante();
});

function listarCitasAdoptante() {
    var id_adoptante = $("#id_adoptante_sesion").val();

    // Si no hay ID de sesión, detenemos
    if(!id_adoptante) return;

    var datos = new FormData();
    datos.append("listarCitasAdoptante", "ok");
    datos.append("id_adoptantes", id_adoptante);

    $.ajax({
        url: "controller/citasController.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            
            $("#listaCitasAdoptante").empty();

            if (respuesta.codigo == "200") {
                
                if (respuesta.listaCitas.length == 0) {
                    $("#listaCitasAdoptante").html('<div class="alert alert-light text-center">No tienes citas registradas aún.</div>');
                    return;
                }

                respuesta.listaCitas.forEach(function(cita) {
                    
                    let estadoClass = "";
                    let icono = "";

                    // --- VALIDACIÓN DEL ESTADO PARA ASIGNAR CLASE ---
                    switch(cita.estado) {
                        case "Pendiente":
                            estadoClass = "estado-pendiente"; 
                            icono = '<i class="fa-solid fa-hourglass-half"></i>';
                            break;
                        case "Confirmada":
                            estadoClass = "estado-activa"; // Usamos 'activa' o 'confirmada' según tu CSS
                            icono = '<i class="fa-solid fa-check-circle"></i>';
                            break;
                        case "Completada": // <--- AQUÍ EL CAMBIO IMPORTANTE
                            estadoClass = "estado-completada";
                            icono = '<i class="fa-solid fa-flag-checkered"></i>';
                            break;
                        case "Finalizada": // Mantenemos compatibilidad por si acaso queda alguna en BD
                            estadoClass = "estado-completada";
                            icono = '<i class="fa-solid fa-flag-checkered"></i>';
                            break;
                        case "Cancelada":
                            estadoClass = "estado-cancelada";
                            icono = '<i class="fa-solid fa-ban"></i>';
                            break;
                        default:
                            estadoClass = "badge bg-secondary";
                            icono = '<i class="fa-solid fa-info-circle"></i>';
                    }

                    // Renderizado de la tarjeta
                    let card = `
                        <div class="card mb-3 shadow-sm border-0 rounded-4 cita-card">
                            <div class="card-body d-flex align-items-center gap-3 flex-wrap">
                                
                                <div class="flex-shrink-0">
                                    <img src="${cita.imagen ? 'uploads/mascotas/'+cita.imagen : 'view/img/default-pet.png'}" 
                                         class="rounded-circle object-fit-cover" 
                                         style="width: 70px; height: 70px; border: 3px solid #f0e4d8;">
                                </div>
                                
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-dark fw-bold" style="font-size: 1.1rem;">${cita.mascota}</h6>
                                    <p class="mb-1 text-muted small">
                                        <i class="fa-regular fa-calendar me-1"></i> ${cita.fecha_cita}
                                    </p>
                                    <p class="mb-0 text-muted small fst-italic text-truncate" style="max-width: 250px;">
                                        "${cita.motivo}"
                                    </p>
                                </div>

                                <div class="text-end ms-auto">
                                    <span class="${estadoClass}">
                                        ${icono} ${cita.estado}
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;

                    $("#listaCitasAdoptante").append(card);
                });

            } else {
                 $("#listaCitasAdoptante").html('<p class="text-center text-danger">Error al cargar las citas.</p>');
            }
        },
        error: function(err) {
            console.error("Error AJAX:", err);
        }
    });
}