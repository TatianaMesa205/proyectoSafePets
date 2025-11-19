// Evento Click en el botón EDITAR (Lápiz)
$("#tablaSeguimientos tbody").on("click", ".btnEditar", function() {
    
    // 1. Tomar los datos de la fila
    var data = $("#tablaSeguimientos").DataTable().row($(this).parents("tr")).data();
    
    // 2. Llenar el formulario de edición
    $("#select_edit_adopciones").val(data.id_adopciones);
    $("#txt_edit_fecha_visita").val(data.fecha_visita);
    $("#txt_edit_observacion").val(data.observacion);

    // 3. Guardar el ID del seguimiento en el botón de guardar (atributo personalizado)
    $("#btnEditarSeguimiento").attr("idSeguimiento", data.id_seguimientos);

    // 4. Cambiar vista
    $("#panelTablaSeguimientos").hide();
    $("#panelFormularioSeguimientos").hide();
    $("#panelFormularioEditarSeguimientos").show();
});