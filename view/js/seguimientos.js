$(document).ready(function() {
    listarSeguimientos();
    cargarSelectAdopciones();

    $("#btn-AgregarSeguimiento").on("click", function() {
        $("#panelTablaSeguimientos").hide();
        $("#panelFormularioSeguimientos").show();
        $("#panelFormularioEditarSeguimientos").hide();
        $("#formRegistroSeguimiento")[0].reset(); // Limpiar form
    });

    $("#btn-RegresarSeguimiento").on("click", function() {
        $("#panelFormularioSeguimientos").hide();
        $("#panelTablaSeguimientos").show();
    });

    $("#btn-RegresarEditarSeguimiento").on("click", function() {
        $("#panelFormularioEditarSeguimientos").hide();
        $("#panelTablaSeguimientos").show();
    });

    // ----------------------------------------------------
    // INICIO: VALIDACIÓN DE FECHA vs ADOPCIÓN
    // ----------------------------------------------------
    function validarFechaSeguimiento(selectId, dateInputId) {
        var opcionSeleccionada = $(selectId).find(':selected');
        var fechaAdopcion = opcionSeleccionada.attr('data-fecha'); // Obtenemos la fecha del atributo data
        var fechaVisita = $(dateInputId).val();

        if (fechaAdopcion && fechaVisita) {
            // Convertimos a objetos Date para comparar correctamente
            // Nota: Agregamos "T00:00:00" o ajustamos horas para evitar problemas de zona horaria si es necesario.
            // Una forma simple es comparar timestamps de fecha pura.
            var dateAdopcion = new Date(fechaAdopcion);
            var dateVisita = new Date(fechaVisita);
            
            // Ajustamos horas a 0 para comparar solo el día calendario
            dateAdopcion.setHours(0,0,0,0);
            dateVisita.setHours(0,0,0,0);

            if (dateVisita < dateAdopcion) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fecha inválida',
                    text: `La visita no puede ser anterior a la fecha de adopción (${fechaAdopcion}).`,
                    confirmButtonColor: '#8b5e3c'
                });
                $(dateInputId).val(""); // Limpiamos la fecha incorrecta
            }
        }
    }

    // Eventos para el formulario de REGISTRO
    $("#select_adopciones, #txt_fecha_visita").on("change", function() {
        validarFechaSeguimiento("#select_adopciones", "#txt_fecha_visita");
    });

    // Eventos para el formulario de EDICIÓN
    $("#select_edit_adopciones, #txt_edit_fecha_visita").on("change", function() {
        validarFechaSeguimiento("#select_edit_adopciones", "#txt_edit_fecha_visita");
    });
    // ----------------------------------------------------
    // FIN: VALIDACIÓN DE FECHA
    // ----------------------------------------------------


    $("#formRegistroSeguimiento").on("submit", function(e) {
        e.preventDefault();
        
        var id_adopciones = $("#select_adopciones").val();
        var fecha_visita = $("#txt_fecha_visita").val();
        var observacion = $("#txt_observacion").val();

        if (id_adopciones == "" || fecha_visita == "") {
            Swal.fire("Atención", "Complete los campos obligatorios", "warning");
            return;
        }

        var datos = new FormData();
        datos.append("registrarSeguimiento", "ok");
        datos.append("id_adopciones", id_adopciones);
        datos.append("fecha_visita", fecha_visita);
        datos.append("observacion", observacion);

        $.ajax({
            url: "controller/seguimientosController.php",
            method: "POST",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.codigo == "200") {
                    Swal.fire("¡Éxito!", respuesta.mensaje, "success");
                    $("#panelFormularioSeguimientos").hide();
                    $("#panelTablaSeguimientos").show();
                    $("#tablaSeguimientos").DataTable().ajax.reload();
                } else {
                    Swal.fire("Error", respuesta.mensaje, "error");
                }
            }
        });
    });

    $("#formEditarSeguimiento").on("submit", function(e) {
        e.preventDefault();
        
        // Obtenemos el ID del seguimiento guardado en el botón
        var id_seguimientos = $("#btnEditarSeguimiento").attr("idSeguimiento");
        var id_adopciones = $("#select_edit_adopciones").val();
        var fecha_visita = $("#txt_edit_fecha_visita").val();
        var observacion = $("#txt_edit_observacion").val();

        var datos = new FormData();
        datos.append("editarSeguimiento", "ok");
        datos.append("id_seguimientos", id_seguimientos);
        datos.append("id_adopciones", id_adopciones);
        datos.append("fecha_visita", fecha_visita);
        datos.append("observacion", observacion);

        $.ajax({
            url: "controller/seguimientosController.php",
            method: "POST",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.codigo == "200") {
                    Swal.fire("Actualizado", respuesta.mensaje, "success");
                    $("#panelFormularioEditarSeguimientos").hide();
                    $("#panelTablaSeguimientos").show();
                    $("#tablaSeguimientos").DataTable().ajax.reload();
                } else {
                    Swal.fire("Error", respuesta.mensaje, "error");
                }
            }
        });
    });

    $("#tablaSeguimientos tbody").on("click", ".btnEliminar", function() {
        var data = $("#tablaSeguimientos").DataTable().row($(this).parents("tr")).data();
        var idSeguimiento = data.id_seguimientos;

        Swal.fire({
            title: '¿Eliminar seguimiento?',
            text: "No se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                var datos = new FormData();
                datos.append("eliminarSeguimiento", "ok");
                datos.append("id_seguimientos", idSeguimiento);

                $.ajax({
                    url: "controller/seguimientosController.php",
                    method: "POST",
                    data: datos,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {
                        if (respuesta.codigo == "200") {
                            Swal.fire('¡Eliminado!', respuesta.mensaje, 'success');
                            $("#tablaSeguimientos").DataTable().ajax.reload();
                        } else {
                            Swal.fire('Error', respuesta.mensaje, 'error');
                        }
                    }
                });
            }
        });
    });
});

function listarSeguimientos() {
    $("#tablaSeguimientos").DataTable({
        "destroy": true,
        "ajax": {
            "url": "controller/seguimientosController.php",
            "type": "POST",
            "data": { "listarSeguimientos": "ok" },
            "dataSrc": function(json) { return json.listaSeguimientos; }
        },
        "columns": [
            { "data": "nombre_mascota" },    // Viene del JOIN
            { "data": "nombre_adoptante" },  // Viene del JOIN
            { "data": "fecha_adopcion" },
            { "data": "fecha_visita" },
            { "data": "observacion" },
            { "defaultContent": 
                "<div class='text-center'>" +
                    "<button class='btn btn-sm btnEditar' style='background-color:rgba(223, 179, 147, 1); margin-right:5px;' title='Editar'><i class='bi bi-pencil'></i></button>" +
                    "<button class='btn btn-sm btnEliminar' title='Eliminar' style='background-color:rgba(112, 110, 120, 1);'><i class='bi bi-trash'></i></button>" +
                "</div>"
            }
        ],
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
    });
}

function cargarSelectAdopciones() {
    var datos = new FormData(); 
    datos.append("listarAdopcionesSelect", "ok");

    $.ajax({
        url: "controller/seguimientosController.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta.codigo == "200") {
                var opciones = '<option value="">Seleccione una adopción...</option>';
                respuesta.listaAdopciones.forEach(function(item) {
                    var estado = (item.estado || "").toString().trim().toLowerCase();
                    if (estado === "adoptado") {
                        // AQUÍ AGREGAMOS EL ATRIBUTO DATA-FECHA
                        opciones += `<option value="${item.id_adopciones}" 
                                             data-estado="Adoptado"
                                             data-fecha="${item.fecha_adopcion}">
                                        ${item.nombre_mascota} - ${item.nombre_adoptante}
                                     </option>`;
                    }
                });
                
                if (opciones === '<option value="">Seleccione una adopción...</option>') {
                    opciones = '<option value="">No hay adopciones en estado Adoptado</option>';
                    $("#select_adopciones").prop("disabled", true);
                    $("#select_edit_adopciones").prop("disabled", true);
                } else {
                    $("#select_adopciones").prop("disabled", false);
                    $("#select_edit_adopciones").prop("disabled", false);
                }

                $("#select_adopciones").html(opciones);
                $("#select_edit_adopciones").html(opciones);
            } else {
                console.error("Error al cargar adopciones:", respuesta.mensaje);
            }
        },
        error: function(err) {
            console.error("Error AJAX cargarSelectAdopciones:", err);
        }
    });
}