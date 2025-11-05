(function(){

  listarTablaCitas();

  function listarTablaCitas(){
      let objData = {"listarCitas":"ok"};
      let objTablaCitas = new Citas(objData);
      objTablaCitas.listarCItas();
  }

  let btnAgregarCitas = document.getElementById("btn-AgregarCitas");
  btnAgregarCitas.addEventListener("click",()=>{
      $("#panelTablaCitas").hide();
      $("#panelFormularioCitas").show();
      
      // Cargar los selects cuando se abre el formulario
      let objCita = new Citas({});
      objCita.cargarSelects();
  })

  let btnRegresarCita = document.getElementById("btn-RegresarCita");
  btnRegresarCita.addEventListener("click",()=>{
      $("#panelFormularioCitas").hide();
      $("#panelTablaCitas").show();
  })
   
  let btnRegresarEditarCita = document.getElementById('btn-RegresarEditarCita');
  btnRegresarEditarCita.addEventListener("click",()=>{
      $("#panelFormularioEditarCitas").hide();
      $("#panelTablaCitas").show();
  })



  


  $("#tablaCitas").on("click","#btn-eliminarCita",function(){
      Swal.fire({
          title: "Esta usted seguro?",
          text: "Si confirma esta opción no podra recuperar el registro!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Aceptar"
        }).then((result) => {
          if (result.isConfirmed) {
              let idMascota = $(this).attr("mascota");
              let objData = {"eliminarCita":"ok","idMascota":idMascota,"listarCitas":"ok"};
              let objCita = new Citas(objData);
              objCita.eliminarCita();
          }
        });
  })

  $("#tablaCitas").on("click","#btn-editarCita",function(){
    $("#panelTablaCitas").hide();
    $("#panelFormularioEditarCitas").show();

    // sacamos los valores de los atributos del boton de editar de cada uno de los usuarios mostrando en la tabla
  
    let id_citas = $(this).attr("citas");
    let fecha_cita = $(this).attr("fecha_hora");
    let estado = $(this).attr("estado");
    let motivo = $(this).attr("motivo");
    

    // agregar el valor de cada atributo al formulario

    $("#txt_edit_fecha_cita").val(fecha_cita);
    $("#select_edit_estado").val(estado);
    $("#txt_edit_motivo").val(motivo);

    $("#btnEditarCita").attr("citas",id_citas);


  })



'use strict'

const forms = document.querySelectorAll('#formRegistroCitas');

Array.from(forms).forEach(form => {
  form.addEventListener('submit', event => {

  event.preventDefault()
    if (!form.checkValidity()) {
      event.stopPropagation()
      form.classList.add('was-validated')
    }else{

      let fecha_cita = document.getElementById('txt_fecha_hora').value;
      let estado = document.getElementById('select_estado').value;
      let motivo = document.getElementById('txt_motivo').value;
      let adoptantes_id = document.getElementById('select_adoptantes').value;
      let mascotas_id = document.getElementById('select_mascotas').value;

      let objData = {
        "resgistrarCita": "ok",
        "fecha_cita": fecha_cita,
        "estado": estado,
        "motivo": motivo,
        "adoptantes_id": adoptantes_id,
        "mascotas_id": mascotas_id,
        "listarCitas": "ok"
      }
      let objCita = new Citas(objData);
      objCita.registrarCita();

    }
  }, false)
})



const formsEditarCita = document.querySelectorAll('#formEditarCitas');

Array.from(formsEditarCita).forEach(form => {
  form.addEventListener('submit', event => {

  event.preventDefault()
    if (!form.checkValidity()) {
      event.stopPropagation()
      form.classList.add('was-validated')
    }else{

      let fecha_cita = document.getElementById('txt_edit_fecha_cita').value;
      let estado = document.getElementById('select_edit_estado').value;
      let motivo = document.getElementById('txt_edit_motivo').value;
      let id_citas = $("#btnEditarCita").attr("citas");

      let objData = {"editarCita":"ok","fecha_hora":fecha_cita, "estado":estado, "motivo":motivo, "id_citas":id_citas,"listarCitas":"ok"}
      let objCita = new Citas(objData);
      objCita.editarCita();

    }
  }, false)
})



})()
    
    
    