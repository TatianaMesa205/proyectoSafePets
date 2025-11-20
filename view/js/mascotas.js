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
    $("#txt_edit_imagen_actual").val(imagen);


    $("#btnEditarMascota").attr("mascota",id_mascotas);
  })


    $("#formRegistroMascotas").on("submit", function (event) {
      event.preventDefault();

        let nombre = $("#txt_nombre").val();
        let especie = $("#txt_especie").val();
        let raza = $("#txt_raza").val();
        let edad = $("#txt_edad").val();
        let sexo = $("#select_sexo").val();
        let tamano = $("#select_tamano").val();
        let fecha_ingreso = $("#txt_fecha_ingreso").val();
        let estado_salud = $("#txt_estado_salud").val();
        let estado = $("#select_estado").val();
        let descripcion = $("#txt_descripcion").val();
        let imagen = $("#txt_imagen")[0].files[0];


        let objData = {
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
        };
        let objMascota = new Mascotas(objData);
        objMascota.registrarMascota();
  });



    $("#formEditarMascotas").on("submit", function (event) {
        event.preventDefault();

        let nombre = $('#txt_edit_nombre').val();
        let especie = $('#txt_edit_especie').val();
        let raza = $('#txt_edit_raza').val();
        let edad = $('#txt_edit_edad').val();
        let sexo = $('#select_edit_sexo').val();
        let tamano = $('#select_edit_tamano').val();
        let fecha_ingreso = $('#txt_edit_fecha_ingreso').val();
        let estado_salud = $('#txt_edit_estado_salud').val();
        let estado = $('#select_edit_estado').val();
        let descripcion = $('#txt_edit_descripcion').val();
        let imagen = $('#txt_edit_imagen')[0].files[0];
        let imagen_actual = $('#txt_edit_imagen_actual').val();
        let id_mascotas = $("#btnEditarMascota").attr("mascota");

        let objData = {
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

})();