(function(){

  listarTablaMusuarios();

  function listarTablaMusuarios(){
      let objData = {"listarMusuarios":"ok"};
      let objTablaMusuarios = new Musuario(objData);
      objTablaMusuarios.listarMusuarios();
  }

  let btnAgregarMusuarios = document.getElementById("btn-AgregarMusuarios");
  btnAgregarMusuarios.addEventListener("click",()=>{
      $("#panelTablaMusuarios").hide();
      $("#panelFormularioMusuarios").show();
      
      // Cargar los selects cuando se abre el formulario
      let objMusuario = new Musuario({});
      objMusuario.cargarSelects();
  })

  let btnRegresarMusuario = document.getElementById("btn-RegresarMusuario");
  btnRegresarMusuario.addEventListener("click",()=>{
      $("#panelFormularioMusuarios").hide();
      $("#panelTablaMusuarios").show();
  })
   
  let btnRegresarEditarMusuario = document.getElementById('btn-RegresarEditarMusuario');
  btnRegresarEditarMusuario.addEventListener("click",()=>{
      $("#panelFormularioEditarMusuarios").hide();
      $("#panelTablaMusuarios").show();
  })



  


  $("#tablaMusuarios").on("click","#btn-eliminarMusuario",function(){
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
              let objData = {"eliminarMusuario":"ok","idMascota":idMascota,"listarMusuarios":"ok"};
              let objMusuario = new Musuario(objData);
              objMusuario.eliminarMusuario();
          }
        });
  })

  $("#tablaMusuarios").on("click","#btn-editarMusuario",function(){
    $("#panelTablaMusuarios").hide();
    $("#panelFormularioEditarMusuarios").show();

    // sacamos los valores de los atributos del boton de editar de cada uno de los usuarios mostrando en la tabla
  
    let idMascota = $(this).attr("mascota");
    let nombre = $(this).attr("nombre");
    let edad = $(this).attr("edad");
    

    // agregar el valor de cada atributo al formulario

    $("#txt_edit_nombreM").val(nombre);
    $("#txt_edit_edadM").val(edad);

    $("#btnEditarMusuario").attr("mascota",idMascota);


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
    
    
    