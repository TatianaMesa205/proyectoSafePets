(function(){

  listarTablaAdopciones();

  function listarTablaAdopciones(){
      let objData = {"listarAdopciones":"ok"};
      let objTablaAdopciones = new Adopciones(objData);
      objTablaAdopciones.listarAdopciones();
  }

  let btnAgregarAdopcion = document.getElementById("btn-AgregarAdopcion");
  btnAgregarAdopcion.addEventListener("click",()=>{
      $("#panelTablaAdopciones").hide();
      $("#panelFormularioAdopciones").show();
      let objAdopcion = new Adopciones({});
      objAdopcion.cargarSelects();
  });

  let btnRegresarAdopcion = document.getElementById("btn-RegresarAdopcion");
  btnRegresarAdopcion.addEventListener("click",()=>{
      $("#panelFormularioAdopciones").hide();
      $("#panelTablaAdopciones").show();
  });

  let btnRegresarEditarAdopcion = document.getElementById("btn-RegresarEditarAdopcion");
  btnRegresarEditarAdopcion.addEventListener("click",()=>{
      $("#panelFormularioEditarAdopciones").hide();
      $("#panelTablaAdopciones").show();
  });

  // Eliminar adopción
  $("#tablaAdopciones").on("click","#btn-eliminarAdopcion",function(){
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
              let objData = {"eliminarAdopcion":"ok","id_adopciones":id_adopciones,"listarAdopciones":"ok"};
              let objAdopcion = new Adopciones(objData);
              objAdopcion.eliminarAdopcion();
          }
        });
  });

  // Editar adopción
  $("#tablaAdopciones").on("click","#btn-editarAdopcion",function(){
      $("#panelTablaAdopciones").hide();
      $("#panelFormularioEditarAdopciones").show();

      let id_adopciones = $(this).attr("adopcion");
      let fecha_adopcion = $(this).attr("fecha");
      let estado = $(this).attr("estado");
      let observaciones = $(this).attr("observaciones");
      let contrato = $(this).attr("contrato");

      $("#txt_edit_fecha_adopcion").val(fecha_adopcion);
      $("#select_edit_estado").val(estado);
      $("#txt_edit_observaciones").val(observaciones);
      $("#txt_edit_contrato").val(contrato);
      $("#btnEditarAdopcion").attr("adopcion",id_adopciones);
  });

  // Registrar adopción
  'use strict'
  const forms = document.querySelectorAll('#formRegistroAdopcion');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{
        let fecha_adopcion = document.getElementById('txt_fecha_adopcion').value;
        let estado = document.getElementById('select_estado').value;
        let observaciones = document.getElementById('txt_observaciones').value;
        let contrato = document.getElementById('txt_contrato').value;
        let mascotas_id = document.getElementById('select_mascotas').value;
        let adoptantes_id = document.getElementById('select_adoptantes').value;

        let objData = {
          "registrarAdopcion": "ok",
          "fecha_adopcion": fecha_adopcion,
          "estado": estado,
          "observaciones": observaciones,
          "contrato": contrato,
          "mascotas_id": mascotas_id,
          "adoptantes_id": adoptantes_id,
          "listarAdopciones": "ok"
        }
        let objAdopcion = new Adopciones(objData);
        objAdopcion.registrarAdopcion();
      }
    }, false)
  });

  // Editar adopción
  const formsEditar = document.querySelectorAll('#formEditarAdopcion');
  Array.from(formsEditar).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{
        let fecha_adopcion = document.getElementById('txt_edit_fecha_adopcion').value;
        let estado = document.getElementById('select_edit_estado').value;
        let observaciones = document.getElementById('txt_edit_observaciones').value;
        let contrato = document.getElementById('txt_edit_contrato').value;
        let id_adopciones = $("#btnEditarAdopcion").attr("adopcion");

        let objData = {
          "editarAdopcion":"ok",
          "fecha_adopcion":fecha_adopcion,
          "estado":estado,
          "observaciones":observaciones,
          "contrato":contrato,
          "id_adopciones":id_adopciones,
          "listarAdopciones":"ok"
        }
        let objAdopcion = new Adopciones(objData);
        objAdopcion.editarAdopcion();
      }
    }, false)
  });

})();
