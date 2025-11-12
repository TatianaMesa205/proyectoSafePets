(function(){

  listarTablaCitas();

  function listarTablaCitas() {
    let objData = { "listarCitas": "ok" };
    let objTablaCitas = new Citas(objData);
    objTablaCitas.listarCitas();
  }

  let btnAgregarCitas = document.getElementById("btn-AgregarCitas");
  btnAgregarCitas.addEventListener("click", () => {
    $("#panelTablaCitas").hide();
    $("#panelFormularioCitas").show();

    let objCita = new Citas({});
    objCita.cargarSelects();
  });

  document.getElementById("btn-RegresarCita").addEventListener("click", () => {
    $("#panelFormularioCitas").hide();
    $("#panelTablaCitas").show();
  });
   
  let btnRegresarEditarCita = document.getElementById('btn-RegresarEditarCita');
  btnRegresarEditarCita.addEventListener("click",()=>{
      $("#panelFormularioEditarCitas").hide();
      $("#panelTablaCitas").show();
  })


  $("#tablaCitas").on("click","#btn-eliminarCita",function(){
      Swal.fire({
          title: "Está seguro?",
          text: "Si confirma esta opción no podra recuperar el registro!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Aceptar"
        }).then((result) => {
          if (result.isConfirmed) {
              let id_citas = $(this).attr("citas");
              let objData = {"eliminarCita":"ok","id_citas":id_citas,"listarCitas":"ok"};
              let objCita = new Citas(objData);
              objCita.eliminarCita();
          }
        });
  })

  // --- BOTÓN EDITAR ---
  $("#tablaCitas").on("click", "#btn-editarCita", function () {
    $("#panelTablaCitas").hide();
    $("#panelFormularioEditarCitas").show();

    let id_citas = $(this).attr("citas");
    let id_adoptantes = $(this).attr("adoptantes"); // corregido
    let id_mascotas = $(this).attr("mascotas");     // corregido
    let estado = $(this).attr("estado");
    let motivo = $(this).attr("motivo");

    // Convertimos fecha
    let fechaCita = $(this).attr("fecha_cita");
    let fechaLocal = fechaCita.replace(" ", "T").slice(0, 16);
    $("#txt_edit_fecha_cita").val(fechaLocal);
    $("#select_edit_estado").val(estado);
    $("#txt_edit_motivo").val(motivo);
    $("#btnEditarCita").attr("citas", id_citas);

    // Cargar selects con valores seleccionados
    let objCita = new Citas({});
    objCita.cargarSelectsEditar(id_adoptantes, id_mascotas);
  });



  // Registrar cita
  const forms = document.querySelectorAll('#formRegistroCitas');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault();

      if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
      }

      // Convertir fecha
      let fecha_cita_input = document.getElementById('txt_fecha_cita').value;
      let fecha_cita = fecha_cita_input.replace("T", " ") + ":00";

      let estado = document.getElementById('select_estado').value;
      let motivo = document.getElementById('txt_motivo').value;
      let id_mascotas = document.getElementById('select_mascotas').value;
      let id_adoptantes = document.getElementById('select_adoptantes').value;

      if (!id_mascotas || !id_adoptantes) {
        Swal.fire("Error", "Debe seleccionar mascota y adoptante válidos.", "error");
        return;
      }

      let objData = {
        "registrarCita": "ok",
        "fecha_cita": fecha_cita,
        "estado": estado,
        "motivo": motivo,
        "id_adoptantes": id_adoptantes,
        "id_mascotas": id_mascotas,
        "listarCitas": "ok"
      };

      let objCita = new Citas(objData);
      objCita.registrarCita();
    }, false);
  });





  const formsEditarCita = document.querySelectorAll('#formEditarCitas');
  Array.from(formsEditarCita).forEach(form => {
    form.addEventListener('submit', event => {
    event.preventDefault()

      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let fecha_edit = document.getElementById('txt_edit_fecha_cita').value; // "YYYY-MM-DDTHH:mm"
        let estado = document.getElementById('select_edit_estado').value;
        let motivo = document.getElementById('txt_edit_motivo').value;
        let id_mascotas = document.getElementById('select_edit_mascotas').value;
        let id_adoptantes = document.getElementById('select_edit_adoptantes').value;
        let id_citas = $("#btnEditarCita").attr("citas");

        let objData = {
          id_citas: id_citas,
          id_mascotas: id_mascotas,
          id_adoptantes: id_adoptantes,
          fecha_cita: fecha_edit,
          estado: estado,
          motivo: motivo
        };

        let objCita = new Citas(objData);
        objCita.editarCita();


      }
    }, false)
  })
})()
