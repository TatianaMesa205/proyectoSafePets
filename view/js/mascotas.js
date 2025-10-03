(function(){

  listarTablaMascotas();

  function listarTablaMascotas(){
      let objData = {"listarMascotas":"ok"};
      let objTablaMascotas = new Mascotas(objData);
      objTablaMascotas.listarMascotas();
  }

  let btnAgregarMascotas = document.getElementById("btn-AgregarMascotas");
  btnAgregarMascotas.addEventListener("click",()=>{
      $("#panelTablaMascotas").hide();
      $("#panelFormularioMascotas").show();
      
      // Cargar los selects cuando se abre el formulario
      let objMascota = new Mascotas({});
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
              let id_mascotas = $(this).attr("mascotas");
              let objData = {"eliminarMascota":"ok","id_mascotas":id_mascotas,"listarMascotas":"ok"};
              let objMascota = new Mascotas(objData);
              objMascota.eliminarMascota();
          }
        });
  })

  $("#tablaMascotas").on("click","#btn-editarMascota",function(){
    $("#panelTablaMascotas").hide();
    $("#panelFormularioEditarMascotas").show();

    // sacamos los valores de los atributos del boton de editar de cada uno de los usuarios mostrando en la tabla
  
    let id_mascotas = $(this).attr("mascotas");
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

    $("#btnEditarMascota").attr("mascotas",id_mascotas);

  })


  'use strict'

  const forms = document.querySelectorAll('#formRegistroMascotas');

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let  nombre = document.getElementById('txt_nombre').value;
        let  especie = document.getElementById('txt_especie').value;
        let  raza = document.getElementById('txt_raza').value;
        let  edad = document.getElementById('txt_edad').value;
        let  sexo = document.getElementById('txt_sexo').value;
        let  tamaño = document.getElementById('txt_tamaño').value;
        let  fecha_ingreso = document.getElementById('txt_fecha_ingreso').value;
        let  estado_salud = document.getElementById('txt_estado_salud').value;
        let  estado = document.getElementById('txt_estado').value;
        let  descripcion = document.getElementById('txt_descripcion').value;
        let  imagen = document.getElementById('txt_imagen').value;

        let objData = {
          "resgistrarMascota": "ok",
          "nombre": nombre,
          "especie": especie,
          "raza": raza,
          "edad": edad,
          "sexo": sexo,
          "tamaño": tamaño,
          "fecha_ingreso": fecha_ingreso,
          "estado_salud": estado_salud,
          "estado": estado,
          "descripcion": descripcion,
          "imagen": imagen,
          "listarMascotas": "ok"
        }
        let objMascota = new Mascotas(objData);
        objMascota.registrarMascota();
      }
    }, false)
  })


  const formsEditarMascota = document.querySelectorAll('#formEditarMascotas');

  Array.from(formsEditarMascota).forEach(form => {
    form.addEventListener('submit', event => {

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let  nombre = document.getElementById('txt_nombre').value;
        let  especie = document.getElementById('txt_especie').value;
        let  raza = document.getElementById('txt_raza').value;
        let  edad = document.getElementById('txt_edad').value;
        let  sexo = document.getElementById('txt_sexo').value;
        let  tamaño = document.getElementById('txt_tamaño').value;
        let  fecha_ingreso = document.getElementById('txt_fecha_ingreso').value;
        let  estado_salud = document.getElementById('txt_estado_salud').value;
        let  estado = document.getElementById('txt_estado').value;
        let  descripcion = document.getElementById('txt_descripcion').value;
        let  imagen = document.getElementById('txt_imagen').value;
        let id_mascotas = $("#btnEditarMascota").attr("mascotas");

        let objData = {
          "editarMascota":"ok",
          "nombre": nombre,
          "especie": especie,
          "raza": raza,
          "edad": edad,
          "sexo": sexo,
          "tamaño": tamaño,
          "fecha_ingreso": fecha_ingreso,
          "estado_salud": estado_salud,
          "estado": estado,
          "descripcion": descripcion,
          "imagen": imagen,
          "id_mascotas":id_mascotas,
          "listarMascotas": "ok"
        }
        let objMascota = new Mascotas(objData);
        objMascota.editarMascota();
      }
    }, false)
  })

})()  