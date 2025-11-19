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
  });




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
              let objMascota = new Mascotas(objData);
              objMascota.eliminarMascota();
          }
        });
  })

  $("#tablaMascotas").on("click","#btn-editarMascota",function(){
    $("#panelTablaMascotas").hide();
    $("#panelFormularioEditarMascotas").show();
  
    let id_mascotas = $(this).attr("mascota");
    let nombre = $(this).attr("nombre");
    let especie = $(this).attr("especie");
    let raza = $(this).attr("raza");
    let edad = $(this).attr("edad");
    let sexo = $(this).attr("sexo");
    let tamano = $(this).attr("tamano");
    let fecha_ingreso = $(this).attr("fecha_ingreso");
    let estado_salud = $(this).attr("estado_salud");
    let estado = $(this).attr("estado");
    let descripcion = $(this).attr("descripcion");
    let imagen = $(this).attr("imagen");

    if (imagen) {
        $("#linkImagenActualMascota").attr("href", "../../../CarpetaCompartida/Mascotas/" + imagen)
        $("#linkImagenActualMascota").show();
    } else {
        $("#linkImagenActualMascota").hide();
    }
    

    $("#txt_edit_nombre").val(nombre);
    $("#txt_edit_especie").val(especie);
    $("#txt_edit_raza").val(raza);
    $("#txt_edit_edad").val(edad);
    $("#select_edit_sexo").val(sexo);
    $("#select_edit_tamano").val(tamano);
    $("#txt_edit_fecha_ingreso").val(fecha_ingreso);
    $("#txt_edit_estado_salud").val(estado_salud);
    $("#select_edit_estado").val(estado);
    $("#txt_edit_descripcion").val(descripcion);
    $("#txt_edit_imagen").val(imagen);

    $("#btnEditarMascota").attr("mascota",id_mascotas);
  })


<<<<<<< HEAD
  'use strict'

  const forms = document.querySelectorAll('#formRegistroMascotas');
=======
    $("#formRegistroMascotas").on("submit", function (event) {
      event.preventDefault();
>>>>>>> 354623cf7111537f61cf68dd3fb3ea198dcbe365

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let nombre = document.getElementById('txt_nombre').value;
        let especie = document.getElementById('txt_especie').value;
        let raza = document.getElementById('txt_raza').value;
        let edad = document.getElementById('txt_edad').value;
        let sexo = document.getElementById('select_sexo').value;
        let tamano = document.getElementById('select_tamano').value;
        let fecha_ingreso = document.getElementById('txt_fecha_ingreso').value;
        let estado_salud = document.getElementById('txt_estado_salud').value;
        let estado = document.getElementById('select_estado').value;
        let descripcion = document.getElementById('txt_descripcion').value;
        let imagen = document.getElementById('txt_imagen').value;

        let objData = {
          "registrarMascota": "ok",
          "nombre": nombre,
          "especie": especie,
          "raza": raza,
          "edad": edad,
          "sexo": sexo,
          "tamano": tamano,
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

<<<<<<< HEAD
  Array.from(formsEditarMascota).forEach(form => {
    form.addEventListener('submit', event => {
=======
    $("#formEditarMascotas").on("submit", function (event) {
        event.preventDefault();
>>>>>>> 354623cf7111537f61cf68dd3fb3ea198dcbe365

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let nombre = document.getElementById('txt_edit_nombre').value;
        let especie = document.getElementById('txt_edit_especie').value;
        let raza = document.getElementById('txt_edit_raza').value;
        let edad = document.getElementById('txt_edit_edad').value;
        let sexo = document.getElementById('select_edit_sexo').value;
        let tamano = document.getElementById('select_edit_tamano').value;
        let fecha_ingreso = document.getElementById('txt_edit_fecha_ingreso').value;
        let estado_salud = document.getElementById('txt_edit_estado_salud').value;
        let estado = document.getElementById('select_edit_estado').value;
        let descripcion = document.getElementById('txt_edit_descripcion').value;
        let imagen = document.getElementById('txt_edit_imagen').value;
        let id_mascotas = $("#btnEditarMascota").attr("mascota");

        let objData = {
<<<<<<< HEAD
          "editarMascota":"ok",
          "nombre": nombre,
          "especie": especie,
          "raza": raza,
          "edad": edad,
          "sexo": sexo,
          "tamano": tamano,
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
=======
            editarMascota: "ok", 
            nombre,
            especie,
            raza,
            edad,
            sexo,
            tamano,
            fecha_ingreso,
            estado_salud,
            estado,
            descripcion,
            imagen,
            imagen_actual,
            id_mascotas
        };

        let objMascota = new Mascotas(objData);
        objMascota.editarMascota();
    });
>>>>>>> 354623cf7111537f61cf68dd3fb3ea198dcbe365

})()  