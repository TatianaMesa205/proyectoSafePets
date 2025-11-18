(function(){

  listarTablaAdoptantes();

  function listarTablaAdoptantes(){
      let objData = {"listarAdoptantes":"ok"};
      let objTablaAdoptantes = new Adoptantes(objData);
      objTablaAdoptantes.listarAdoptantes();
  }

  let btnAgregarAdoptantes = document.getElementById("btn-AgregarAdoptantes");
  btnAgregarAdoptantes.addEventListener("click",()=>{
      $("#panelTablaAdoptantes").hide();
      $("#panelFormularioAdoptantes").show();
  })

  let btnRegresarAdoptante = document.getElementById("btn-RegresarAdoptante");
  btnRegresarAdoptante.addEventListener("click",()=>{
      $("#panelFormularioAdoptantes").hide();
      $("#panelTablaAdoptantes").show();
  })
   
  let btnRegresarEditarAdoptante = document.getElementById('btn-RegresarEditarAdoptante');
  btnRegresarEditarAdoptante.addEventListener("click",()=>{
      $("#panelFormularioEditarAdoptantes").hide();
      $("#panelTablaAdoptantes").show();
  })


  $("#tablaAdoptantes").on("click","#btn-eliminarAdoptante",function(){
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
              let id_adoptantes = $(this).attr("adoptantes");
              let objData = {"eliminarAdoptante":"ok","id_adoptantes":id_adoptantes,"listarAdoptantes":"ok"};
              let objAdoptante = new Adoptantes(objData);
              objAdoptante.eliminarAdoptante();
          }
        });
  })

  $("#tablaAdoptantes").on("click","#btn-editarAdoptante",function(){
    $("#panelTablaAdoptantes").hide();
    $("#panelFormularioEditarAdoptantes").show();

    
    let id_adoptantes = $(this).attr("adoptantes");
    let nombre_completo = $(this).attr("nombre_completo");
    let cedula = $(this).attr("cedula");
    let telefono = $(this).attr("telefono");
    let email = $(this).attr("email");
    let direccion = $(this).attr("direccion");
    

    $("#txt_edit_nombre_completo").val(nombre_completo);
    $("#txt_edit_cedula").val(cedula);
    $("#txt_edit_telefono").val(telefono);
    $("#txt_edit_email").val(email);
    $("#txt_edit_direccion").val(direccion);
    $("#btnEditarAdoptante").attr("adoptantes",id_adoptantes);


  })


  const forms = document.querySelectorAll('#formRegistroAdoptantes');

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let nombre_completo = document.getElementById('txt_nombre_completo').value;
        let cedula = document.getElementById('txt_cedula').value;
        let telefono = document.getElementById('txt_telefono').value;
        let email = document.getElementById('txt_email').value;
        let direccion = document.getElementById('txt_direccion').value;

        let objData = {
          "registrarAdoptante": "ok",
          "nombre_completo": nombre_completo,
          "cedula": cedula,
          "telefono": telefono,
          "email": email,
          "direccion": direccion,
          "listarAdoptantes": "ok"
        }
        let objAdoptante = new Adoptantes(objData);
        objAdoptante.registrarAdoptante();

      }
    }, false)
  })


  const formsEditarAdoptante = document.querySelectorAll('#formEditarAdoptantes');

  Array.from(formsEditarAdoptante).forEach(form => {
    form.addEventListener('submit', event => {

    event.preventDefault()
      if (!form.checkValidity()) {
        event.stopPropagation()
        form.classList.add('was-validated')
      }else{

        let nombre_completo = document.getElementById('txt_edit_nombre_completo').value;
        let cedula = document.getElementById('txt_edit_cedula').value;
        let telefono = document.getElementById('txt_edit_telefono').value;
        let email = document.getElementById('txt_edit_email').value;
        let direccion = document.getElementById('txt_edit_direccion').value;
        let id_adoptantes = $("#btnEditarAdoptante").attr("adoptantes");

        let objData = {
          "editarAdoptante":"ok",
          "nombre_completo":nombre_completo,
          "cedula":cedula,
          "telefono":telefono,
          "email":email,
          "direccion":direccion,
          "id_adoptantes":id_adoptantes,
          "listarAdoptantes":"ok"
        }
        let objAdoptante = new Adoptantes(objData);
        objAdoptante.editarAdoptante();
      }
    }, false)
  })
})()