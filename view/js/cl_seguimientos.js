$("#tablaSeguimientos tbody").on("click", ".btnEditar", function() {
    
    var data = $("#tablaSeguimientos").DataTable().row($(this).parents("tr")).data();
    
    $("#select_edit_adopciones").val(data.id_adopciones);
    $("#txt_edit_fecha_visita").val(data.fecha_visita);
    $("#txt_edit_observacion").val(data.observacion);

    $("#btnEditarSeguimiento").attr("idSeguimiento", data.id_seguimientos);

    $("#panelTablaSeguimientos").hide();
    $("#panelFormularioSeguimientos").hide();
    $("#panelFormularioEditarSeguimientos").show();
});