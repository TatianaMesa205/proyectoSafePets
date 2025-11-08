(function(){

  listarTablaPublicaciones();

  function listarTablaPublicaciones(){
      let objData = {"listarPublicaciones":"ok"};
      let objTabla = new Publicaciones(objData);
      objTabla.listarPublicaciones();
  }

  let btnAgregar = document.getElementById("btn-AgregarPublicacion");
  btnAgregar.addEventListener("click",()=>{
      $("#panelTablaPublicaciones").hide();
      $("#panelFormularioPublicaciones").show();
  });

  let btnRegresar = document.getElementById("btn-RegresarPublicacion");
  btnRegresar.addEventListener("click",()=>{
      $("#panelFormularioPublicaciones").hide();
      $("#panelTablaPublicaciones").show();
  });

  let btnRegresarEditar = document.getElementById("btn-RegresarEditarPublicacion");
  btnRegresarEditar.addEventListener("click",()=>{
      $("#panelFormularioEditarPublicaciones").hide();
      $("#panelTablaPublicaciones").show();
  });

  $("#tablaPublicaciones").on("click","#btn-eliminarPublicacion",function(){
      Swal.fire({
          title: "¿Está seguro?",
          text: "No podrá recuperar este registro.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Aceptar"
      }).then((result)=>{
          if(result.isConfirmed){
              let id_publicaciones = $(this).attr("publicacion");
              let objData = {"eliminarPublicacion":"ok","id_publicaciones":id_publicaciones,"listarPublicaciones":"ok"};
              let obj = new Publicaciones(objData);
              obj.eliminarPublicacion();
          }
      });
  });

  $("#tablaPublicaciones").on("click","#btn-editarPublicacion",function(){
      $("#panelTablaPublicaciones").hide();
      $("#panelFormularioEditarPublicaciones").show();

      let id_publicaciones = $(this).attr("publicacion");
      let tipo = $(this).attr("tipo");
      let descripcion = $(this).attr("descripcion");
      let foto = $(this).attr("foto");
      let fecha_publicacion = $(this).attr("fecha");
      let contacto = $(this).attr("contacto");

      $("#txt_edit_tipo").val(tipo);
      $("#txt_edit_descripcion").val(descripcion);
      $("#txt_edit_foto").val(foto);
      $("#txt_edit_fecha_publicacion").val(fecha_publicacion);
      $("#txt_edit_contacto").val(contacto);
      $("#btnEditarPublicacion").attr("publicacion",id_publicaciones);
  });

  const forms = document.querySelectorAll('#formRegistroPublicacion');
  Array.from(forms).forEach(form=>{
      form.addEventListener('submit',event=>{
          event.preventDefault();
          if(!form.checkValidity()){
              event.stopPropagation();
              form.classList.add('was-validated');
          }else{
              let tipo = document.getElementById('txt_tipo').value;
              let descripcion = document.getElementById('txt_descripcion').value;
              let foto = document.getElementById('txt_foto').value;
              let fecha_publicacion = document.getElementById('txt_fecha_publicacion').value;
              let contacto = document.getElementById('txt_contacto').value;

              let objData = {"registrarPublicacion":"ok","tipo":tipo,"descripcion":descripcion,"foto":foto,"fecha_publicacion":fecha_publicacion,"contacto":contacto,"listarPublicaciones":"ok"};
              let obj = new Publicaciones(objData);
              obj.registrarPublicacion();
          }
      },false);
  });

  const formsEditar = document.querySelectorAll('#formEditarPublicacion');
  Array.from(formsEditar).forEach(form=>{
      form.addEventListener('submit',event=>{
          event.preventDefault();
          if(!form.checkValidity()){
              event.stopPropagation();
              form.classList.add('was-validated');
          }else{
              let id_publicaciones = $("#btnEditarPublicacion").attr("publicacion");
              let tipo = document.getElementById('txt_edit_tipo').value;
              let descripcion = document.getElementById('txt_edit_descripcion').value;
              let foto = document.getElementById('txt_edit_foto').value;
              let fecha_publicacion = document.getElementById('txt_edit_fecha_publicacion').value;
              let contacto = document.getElementById('txt_edit_contacto').value;

              let objData = {"editarPublicacion":"ok","id_publicaciones":id_publicaciones,"tipo":tipo,"descripcion":descripcion,"foto":foto,"fecha_publicacion":fecha_publicacion,"contacto":contacto,"listarPublicaciones":"ok"};
              let obj = new Publicaciones(objData);
              obj.editarPublicacion();
          }
      },false);
  });

})();
