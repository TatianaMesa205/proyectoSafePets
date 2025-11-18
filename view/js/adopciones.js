(function () {

  listarTablaAdopciones();

  function listarTablaAdopciones() {
    let objData = { "listarAdopciones": "ok" };
    let objTablaAdopciones = new Adopciones(objData);
    objTablaAdopciones.listarAdopciones();
  }

  let btnAgregarAdopcion = document.getElementById("btn-AgregarAdopcion");
  btnAgregarAdopcion.addEventListener("click", () => {
    $("#panelTablaAdopciones").hide();
    $("#panelFormularioAdopciones").show();

    let objAdopcion = new Adopciones({});
    objAdopcion.cargarSelects(); 
  });

  let btnRegresarAdopcion = document.getElementById("btn-RegresarAdopcion");
  btnRegresarAdopcion.addEventListener("click", () => {
    $("#panelFormularioAdopciones").hide();
    $("#panelTablaAdopciones").show();
  });

  let btnRegresarEditarAdopcion = document.getElementById("btn-RegresarEditarAdopcion");
  btnRegresarEditarAdopcion.addEventListener("click", () => {
    $("#panelFormularioEditarAdopciones").hide();
    $("#panelTablaAdopciones").show();
  });

  

  $("#tablaAdopciones").on("click", "#btn-eliminarAdopcion", function () {
    Swal.fire({
      title: "¿Está seguro?",
      text: "No podrá recuperar este registro después de eliminarlo.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Aceptar"
    }).then((result) => {
      if (result.isConfirmed) {
        let id_adopciones = $(this).attr("adopcion");
        let objData = { "eliminarAdopcion": "ok", "id_adopciones": id_adopciones, "listarAdopciones": "ok" };
        let objAdopcion = new Adopciones(objData);
        objAdopcion.eliminarAdopcion();
      }
    });
  });

  $("#tablaAdopciones").on("click", "#btn-editarAdopcion", function () {
      $("#panelTablaAdopciones").hide();
      $("#panelFormularioEditarAdopciones").show();

      let id_adopciones = $(this).attr("adopcion");
      let mascotas_id = $(this).attr("mascota");
      let adoptantes_id = $(this).attr("adoptante");
      let fecha_adopcion = $(this).attr("fecha");
      let estado = $(this).attr("estado");
      let observaciones = $(this).attr("observaciones");
      let contrato = $(this).attr("contrato"); 
      $("#btnEditarAdopcion").attr("contrato_actual", contrato);


      let objAdopcion = new Adopciones({});
      objAdopcion.cargarSelectsEditar(mascotas_id, adoptantes_id);

      $("#txt_edit_fecha_adopcion").val(fecha_adopcion);
      $("#select_edit_estado").val(estado);
      $("#txt_edit_observaciones").val(observaciones);
      $("#btnEditarAdopcion").attr("adopcion", id_adopciones);

      if (contrato && contrato !== "null" && contrato !== "") {
          $("#linkContratoActual")
              .attr("href", `../../../CarpetaCompartida/Contratos/${contrato}`)
              .show();
      } else {
          $("#linkContratoActual").hide();
      }
  });


  const forms = document.querySelectorAll('#formRegistroAdopcion');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault();

      if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add('was-validated');
      } else {

        let objDataAdopcion = new FormData();
        objDataAdopcion.append("registrarAdopcion", "ok");
        objDataAdopcion.append("fecha_adopcion", document.getElementById('txt_fecha_adopcion').value);
        objDataAdopcion.append("estado", document.getElementById('select_estado').value);
        objDataAdopcion.append("observaciones", document.getElementById('txt_observaciones').value);
        objDataAdopcion.append("mascotas_id", document.getElementById('select_mascotas').value);
        objDataAdopcion.append("adoptantes_id", document.getElementById('select_adoptantes').value);

        let fileInput = document.getElementById('file_contrato');
        if (fileInput.files.length > 0) {
          objDataAdopcion.append("contrato", fileInput.files[0]);
        }

        let objAdopcion = new Adopciones(objDataAdopcion);
        objAdopcion.registrarAdopcionConArchivo(); 
      }
    }, false);
  });


  const formsEditar = document.querySelectorAll('#formEditarAdopcion');
  Array.from(formsEditar).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault();

      if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add('was-validated');
      } else {

        let objDataAdopcion = new FormData();
        objDataAdopcion.append("editarAdopcion", "ok");
        objDataAdopcion.append("mascotas_id", document.getElementById('select_edit_mascotas').value);
        objDataAdopcion.append("adoptantes_id", document.getElementById('select_edit_adoptantes').value);
        objDataAdopcion.append("fecha_adopcion", document.getElementById('txt_edit_fecha_adopcion').value);
        objDataAdopcion.append("estado", document.getElementById('select_edit_estado').value);
        objDataAdopcion.append("observaciones", document.getElementById('txt_edit_observaciones').value);
        objDataAdopcion.append("id_adopciones", $("#btnEditarAdopcion").attr("adopcion"));

        objDataAdopcion.append("contrato_actual", $("#btnEditarAdopcion").attr("contrato_actual"));

        let fileInput = document.getElementById('file_edit_contrato');
        if (fileInput.files.length > 0) {
            objDataAdopcion.append("contrato", fileInput.files[0]);
        }


        let objAdopcion = new Adopciones(objDataAdopcion);
        objAdopcion.editarAdopcionConArchivo();
      }
    }, false);
  });

})();

