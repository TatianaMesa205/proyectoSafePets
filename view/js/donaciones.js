(function(){

  listarTablaDonaciones();

  function listarTablaDonaciones(){
      let objData = {"listarDonaciones":"ok"};
      let objTabla = new Donaciones(objData);
      objTabla.listarDonaciones();
  }

  let btnAgregar = document.getElementById("btn-AgregarDonacion");
  btnAgregar.addEventListener("click",()=>{
      $("#panelTablaDonaciones").hide();
      $("#panelFormularioDonaciones").show();
  });

  let btnRegresar = document.getElementById("btn-RegresarDonacion");
  btnRegresar.addEventListener("click",()=>{
      $("#panelFormularioDonaciones").hide();
      $("#panelTablaDonaciones").show();
  });

  let btnRegresarEditar = document.getElementById("btn-RegresarEditarDonacion");
  btnRegresarEditar.addEventListener("click",()=>{
      $("#panelFormularioEditarDonaciones").hide();
      $("#panelTablaDonaciones").show();
  });

  $("#tablaDonaciones").on("click","#btn-eliminarDonacion",function(){
      Swal.fire({
          title: "¿Está seguro?",
          text: "No podrá recuperar esta donación.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Aceptar"
      }).then((result)=>{
          if(result.isConfirmed){
              let id_donaciones = $(this).attr("donacion");
              let objData = {"eliminarDonacion":"ok","id_donaciones":id_donaciones,"listarDonaciones":"ok"};
              let obj = new Donaciones(objData);
              obj.eliminarDonacion();
          }
      });
  });

  $("#tablaDonaciones").on("click","#btn-editarDonacion",function(){
      $("#panelTablaDonaciones").hide();
      $("#panelFormularioEditarDonaciones").show();

      let id_donaciones = $(this).attr("donacion");
      let monto = $(this).attr("monto");
      let fecha = $(this).attr("fecha");
      let metodo_pago = $(this).attr("metodo_pago");
      let id_usuarios = $(this).attr("usuario");

      $("#txt_edit_monto").val(monto);
      $("#txt_edit_fecha").val(fecha);
      $("#select_edit_metodo_pago").val(metodo_pago);
      $("#select_edit_usuario").val(id_usuarios);
      $("#btnEditarDonacion").attr("donacion",id_donaciones);
  });

  // Registrar
  const forms = document.querySelectorAll('#formRegistroDonacion');
  Array.from(forms).forEach(form=>{
      form.addEventListener('submit',event=>{
          event.preventDefault();
          if(!form.checkValidity()){
              event.stopPropagation();
              form.classList.add('was-validated');
          }else{
              let id_usuarios = document.getElementById('select_usuario').value;
              let monto = document.getElementById('txt_monto').value;
              let fecha = document.getElementById('txt_fecha').value;
              let metodo_pago = document.getElementById('select_metodo_pago').value;

              let objData = {"registrarDonacion":"ok","id_usuarios":id_usuarios,"monto":monto,"fecha":fecha,"metodo_pago":metodo_pago,"listarDonaciones":"ok"};
              let obj = new Donaciones(objData);
              obj.registrarDonacion();
          }
      },false);
  });

  // Editar
  const formsEditar = document.querySelectorAll('#formEditarDonacion');
  Array.from(formsEditar).forEach(form=>{
      form.addEventListener('submit',event=>{
          event.preventDefault();
          if(!form.checkValidity()){
              event.stopPropagation();
              form.classList.add('was-validated');
          }else{
              let id_donaciones = $("#btnEditarDonacion").attr("donacion");
              let id_usuarios = document.getElementById('select_edit_usuario').value;
              let monto = document.getElementById('txt_edit_monto').value;
              let fecha = document.getElementById('txt_edit_fecha').value;
              let metodo_pago = document.getElementById('select_edit_metodo_pago').value;

              let objData = {"editarDonacion":"ok","id_donaciones":id_donaciones,"id_usuarios":id_usuarios,"monto":monto,"fecha":fecha,"metodo_pago":metodo_pago,"listarDonaciones":"ok"};
              let obj = new Donaciones(objData);
              obj.editarDonacion();
          }
      },false);
  });

})();
