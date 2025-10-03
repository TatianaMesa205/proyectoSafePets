(function(){

  listarTablaMascotas();

  function listarTablaMascotas(){
      let objData = {"listarMascotas":"ok"};
      let objTablaMascotas = new Mascota(objData);
      objTablaMascotas.listarMascotas();
  }

  let btnAgregarMascotas = document.getElementById("btn-AgregarMascotas");
  btnAgregarMascotas.addEventListener("click",()=>{
      $("#panelTablaMascotas").hide();
      $("#panelFormularioMascotas").show();
      
      // Cargar los selects cuando se abre el formulario
      let objMascota = new Mascota({});
      objMascota.cargarSelects();
  })

  let btnRegresarMascota = document.getElementById("btn-RegresarMascota");
  btnRegresarMascota.addEventListener("click",()=>{
      $("#panelFormularioMascotas").hide();
      $("#panelTablaMascotas").show();
  })
   
  let btnRegresarEditarMascota = document.getElementById('btn-RegresarEditarMascota');
  btnRegresarEditarMascota.addEventListener("click",()=>{
      $("#panelFormularioEditarMascotas").hide();
      $("#panelTablaMascotas").show();
  })



  


  $("#tablaMascotas").on("click","#btn-eliminarMascota",function(){
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
              let id_mascotas = $(this).attr("mascota");
              let objData = {"eliminarMascota":"ok","id_mascotas":id_mascotas,"listarMascotas":"ok"};
              let objMascota = new Mascota(objData);
              objMascota.eliminarMascota();
          }
        });
  })

  $("#tablaMascotas").on("click","#btn-editarMascota",function(){
    $("#panelTablaMascotas").hide();
    $("#panelFormularioEditarMascotas").show();

    // sacamos los valores de los atributos del boton de editar de cada uno de los usuarios mostrando en la tabla
  
    let id_mascotas = $(this).attr("mascota");
    let nombre = $(this).attr("nombre");
    let especie = $(this).attr("especie");
    let raza = $(this).attr("raza");
    let edad = $(this).attr("edad");
    let sexo = $(this).attr("sexo");
    let tamaño = $(this).attr("tamaño");
    let fecha_ingreso = $(this).attr("fecha_ingreso");
    let estado_salud = $(this).attr("estado_salud");
    let estado = $(this).attr("estado");
    let descripcion = $(this).attr("descripcion");
    let imagen = $(this).attr("imagen");
    

    // agregar el valor de cada atributo al formulario

    $("#txt_edit_nombre").val(nombre);
    $("#txt_edit_especie").val(especie);
    $("#txt_edit_raza").val(raza);
    $("#txt_edit_edad").val(edad);
    $("#txt_edit_sexo").val(sexo);
    $("#txt_edit_tamaño").val(tamaño);
    $("#txt_edit_fecha_ingreso").val(fecha_ingreso);
    $("#txt_edit_estado_salud").val(estado_salud);
    $("#txt_edit_estado").val(estado);
    $("#txt_edit_descripcion").val(descripcion);
    $("#txt_edit_imagen").val(imagen);

    $("#btnEditarMascota").attr("mascota",id_mascotas);


  })






'use strict'

const forms = document.querySelectorAll('#formRegistroMusuarios');

Array.from(forms).forEach(form => {
  form.addEventListener('submit', event => {

  event.preventDefault()
    if (!form.checkValidity()) {
      event.stopPropagation()
      form.classList.add('was-validated')
    }else{

      let  nombreM = document.getElementById('txt_nombreM').value;
      let  edadM = document.getElementById('txt_edadM').value;
      let usuario_id = document.getElementById('select_usuario').value;
      let raza_id = document.getElementById('select_raza').value;
      let tipo_mascota_id = document.getElementById('select_tipo_mascota').value;

      let objData = {
        "resgistrarMusuario": "ok",
        "nombreM": nombreM,
        "edadM": edadM,
        "usuario_id": usuario_id,
        "raza_id": raza_id,
        "tipo_mascota_id": tipo_mascota_id,
        "listarMusuarios": "ok"
      }
      let objMusuario = new Musuario(objData);
      objMusuario.registrarMusuario();

    }
  }, false)
})



const formsEditarMusuario = document.querySelectorAll('#formEditarMusuarios');

Array.from(formsEditarMusuario).forEach(form => {
  form.addEventListener('submit', event => {

  event.preventDefault()
    if (!form.checkValidity()) {
      event.stopPropagation()
      form.classList.add('was-validated')
    }else{

      let  nombreM = document.getElementById('txt_edit_nombreM').value;
      let  edadM = document.getElementById('txt_edit_edadM').value;
      let idMascota = $("#btnEditarMusuario").attr("mascota");

      let objData = {"editarMusuario":"ok","nombreM":nombreM,"edadM":edadM,"idMascota":idMascota,"listarMusuarios":"ok"}
      let objMusuario = new Musuario(objData);
      objMusuario.editarMusuario();

    }
  }, false)
})



})()
    
    
    