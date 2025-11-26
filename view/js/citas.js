(function(){

  // --- VARIABLES GLOBALES ---
  let fechasOcupadas = [];
  let fechaOriginalEdicion = ""; 

  // Iniciar solo si estamos en la vista de citas
  if(document.getElementById('tablaCitas')){
      listarTablaCitas();
      cargarFechasOcupadas(); 
  }

  function listarTablaCitas() {
    let objData = { "listarCitas": "ok" };
    let objTablaCitas = new Citas(objData);
    objTablaCitas.listarCitas();
  }

  // --- 1. FUNCIÓN PARA TRAER FECHAS DEL SERVIDOR ---
  function cargarFechasOcupadas() {
      let datos = new FormData();
      datos.append("traerFechas", "ok");

      fetch("controller/citasController.php", {
          method: "POST",
          body: datos
      })
      .then(response => response.json())
      .then(data => {
          fechasOcupadas = data;
      })
      .catch(err => console.error("Error cargando fechas", err));
  }

  // --- 2. VALIDACIÓN DE FECHA DISPONIBLE ---
  function validarFechaDisponible(inputElement) {
      if(!inputElement.value) return true;

      // Normalizamos la fecha (quitamos segundos y la T)
      let fechaInput = inputElement.value.replace("T", " ").substring(0, 16); 
      
      // EXCEPCIÓN: Si estamos editando, permitir la misma fecha que ya tenía
      if (fechaOriginalEdicion) {
          let originalNormalizada = fechaOriginalEdicion.replace("T", " ").substring(0, 16);
          if (fechaInput === originalNormalizada) {
              return true; 
          }
      }

      // Buscar coincidencia en la lista negra
      let encontrada = fechasOcupadas.some(fechaBD => {
          let fechaNormalizada = String(fechaBD).substring(0, 16); 
          return fechaNormalizada === fechaInput;
      });

      if (encontrada) {
          Swal.fire({
              icon: 'warning',
              title: 'Horario Ocupado',
              text: 'Ya existe una cita programada para esa fecha y hora.',
              confirmButtonColor: '#d33'
          });
          inputElement.value = ""; // Limpiar el campo
          return false;
      }
      return true;
  }

  // Asignar validación a inputs
  let inputFechaRegistro = document.getElementById('txt_fecha_cita');
  let inputFechaEditar = document.getElementById('txt_edit_fecha_cita');

  if(inputFechaRegistro) {
      inputFechaRegistro.addEventListener('change', function() { validarFechaDisponible(this); });
  }
  if(inputFechaEditar) {
      inputFechaEditar.addEventListener('change', function() { validarFechaDisponible(this); });
  }

  // --- BOTONES ---
  let btnAgregarCitas = document.getElementById("btn-AgregarCitas");
  if (btnAgregarCitas) {
      btnAgregarCitas.addEventListener("click", () => {
        $("#panelTablaCitas").hide();
        $("#panelFormularioCitas").show();
        
        fechaOriginalEdicion = ""; 
        let objCita = new Citas({});
        objCita.cargarSelects();
        cargarFechasOcupadas(); 
      });
  }

  let btnRegresarCita = document.getElementById("btn-RegresarCita");
  if (btnRegresarCita) {
      btnRegresarCita.addEventListener("click", () => {
        $("#panelFormularioCitas").hide();
        $("#panelTablaCitas").show();
      });
  }
   
  let btnRegresarEditarCita = document.getElementById('btn-RegresarEditarCita');
  if (btnRegresarEditarCita) {
      btnRegresarEditarCita.addEventListener("click",()=>{
          $("#panelFormularioEditarCitas").hide();
          $("#panelTablaCitas").show();
      });
  }

  // --- ELIMINAR ---
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
              setTimeout(cargarFechasOcupadas, 1000);
          }
        });
  });

  // --- CARGAR EDITAR ---
  $("#tablaCitas").on("click", "#btn-editarCita", function () {
    $("#panelTablaCitas").hide();
    $("#panelFormularioEditarCitas").show();
    cargarFechasOcupadas(); 

    let id_citas = $(this).attr("citas");
    let id_adoptantes = $(this).attr("adoptantes");
    let id_mascotas = $(this).attr("mascotas");
    let estado = $(this).attr("estado");
    let motivo = $(this).attr("motivo");
    let fechaCita = $(this).attr("fecha_cita"); 
    
    fechaOriginalEdicion = fechaCita; 
    
    let fechaLocal = (fechaCita) ? fechaCita.replace(" ", "T").slice(0, 16) : "";
    
    $("#txt_edit_fecha_cita").val(fechaLocal);
    $("#select_edit_estado").val(estado);
    $("#txt_edit_motivo").val(motivo);
    $("#btnEditarCita").attr("citas", id_citas);

    let objCita = new Citas({});
    objCita.cargarSelectsEditar(id_adoptantes, id_mascotas);
  });

  // --- SUBMIT REGISTRO (CORREGIDO: SIN listarCitas) ---
  const forms = document.querySelectorAll('#formRegistroCitas');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault();
      
      if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
      }

      if(!validarFechaDisponible(document.getElementById('txt_fecha_cita'))) return;

      let fecha_cita = document.getElementById('txt_fecha_cita').value.replace("T", " ") + ":00";
      let estado = document.getElementById('select_estado').value;
      let motivo = document.getElementById('txt_motivo').value;
      let id_mascotas = document.getElementById('select_mascotas').value;
      let id_adoptantes = document.getElementById('select_adoptantes').value;

      let objData = {
        "registrarCita": "ok",
        "fecha_cita": fecha_cita,
        "estado": estado,
        "motivo": motivo,
        "id_adoptantes": id_adoptantes,
        "id_mascotas": id_mascotas
      };

      $.ajax({
          url: "controller/citasController.php",
          type: "POST",
          data: objData,
          dataType: "json" 
      }).done(function(respuesta){
          if(respuesta.codigo == "200"){
              Swal.fire("Éxito", respuesta.mensaje, "success").then(()=>{
                  $("#panelFormularioCitas").hide();
                  $("#panelTablaCitas").show();
                  listarTablaCitas();
                  cargarFechasOcupadas();
                  $("#formRegistroCitas")[0].reset();
                  $("#formRegistroCitas").removeClass('was-validated');
              });
          }else{
              Swal.fire("Error", respuesta.mensaje, "error");
          }
      }).fail(function(){
          Swal.fire("Error", "Error de comunicación con el servidor", "error");
      });

    }, false);
  });


  const formsEditarCita = document.querySelectorAll('#formEditarCitas');
  Array.from(formsEditarCita).forEach(form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        if (!form.checkValidity()) {
            event.stopPropagation();
            form.classList.add('was-validated');
        }

        if(!validarFechaDisponible(document.getElementById('txt_edit_fecha_cita'))) return;

        Swal.fire({
            title: '¿Confirmar cambios?',
            text: "Se actualizará la cita y se enviará notificación.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                let fecha_edit = document.getElementById('txt_edit_fecha_cita').value.replace("T", " ") + ":00";
                let estado = document.getElementById('select_edit_estado').value;
                let motivo = document.getElementById('txt_edit_motivo').value;
                let id_mascotas = document.getElementById('select_edit_mascotas').value;
                let id_adoptantes = document.getElementById('select_edit_adoptantes').value;
                let id_citas = $("#btnEditarCita").attr("citas");

                let objData = {
                    "editarCita": "ok", 
                    id_citas: id_citas,
                    id_mascotas: id_mascotas,
                    id_adoptantes: id_adoptantes,
                    fecha_cita: fecha_edit,
                    estado: estado,
                    motivo: motivo
                };
                
                Swal.fire({
                    title: 'Actualizando...',
                    text: 'Enviando notificación...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: "controller/citasController.php",
                    type: "POST",
                    data: objData,
                    dataType: "json"
                }).done(function(respuesta){
                    if(respuesta.codigo == "200"){
                        Swal.fire("Actualizado", respuesta.mensaje, "success").then(()=>{
                            $("#panelFormularioEditarCitas").hide();
                            $("#panelTablaCitas").show();
                            listarTablaCitas();
                            cargarFechasOcupadas();
                        });
                    } else {
                        Swal.fire("Error", respuesta.mensaje, "error");
                    }
                }).fail(function(){
                    Swal.fire("Error", "Error de comunicación", "error");
                });
            }
        });
    }, false);
  });
})();