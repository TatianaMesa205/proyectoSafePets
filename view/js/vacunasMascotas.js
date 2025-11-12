(function(){

    listarTablaVacunasMascotas();

    function listarTablaVacunasMascotas(){
        let objData = {"listarVacunasMascotas":"ok"};
        let objTabla = new VacunasMascotas(objData);
        objTabla.listarVacunasMascotas();
    }

    let btnAgregar = document.getElementById("btn-AgregarVacunaMascota");
    btnAgregar.addEventListener("click",()=>{
        $("#panelTablaVacunasMascotas").hide();
        $("#panelFormularioVacunasMascotas").show();
    });

    let btnRegresar = document.getElementById("btn-RegresarVacunaMascota");
    btnRegresar.addEventListener("click",()=>{
        $("#panelFormularioVacunasMascotas").hide();
        $("#panelTablaVacunasMascotas").show();
    });

    let btnRegresarEditar = document.getElementById("btn-RegresarEditarVacunaMascota");
    btnRegresarEditar.addEventListener("click",()=>{
        $("#panelFormularioEditarVacunasMascotas").hide();
        $("#panelTablaVacunasMascotas").show();
    });

    $("#tablaVacunasMascotas").on("click","#btn-eliminarVacunaMascota",function(){
        Swal.fire({
            title: "¿Está seguro?",
            text: "Esta acción eliminará el registro de vacuna aplicada.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result)=>{
            if(result.isConfirmed){
                let id_vacunas_mascotas = $(this).attr("vacuna_mascota");
                let objData = {"eliminarVacunaMascota":"ok","id_vacunas_mascotas":id_vacunas_mascotas,"listarVacunasMascotas":"ok"};
                let obj = new VacunasMascotas(objData);
                obj.eliminarVacunaMascota();
            }
        });
    });

    $("#tablaVacunasMascotas").on("click","#btn-editarVacunaMascota",function(){
        $("#panelTablaVacunasMascotas").hide();
        $("#panelFormularioEditarVacunasMascotas").show();

        let id_vacunas_mascotas = $(this).attr("vacuna_mascota");
        let id_mascotas = $(this).attr("mascota");
        let id_vacunas = $(this).attr("vacuna");
        let fecha_aplicacion = $(this).attr("fecha_aplicacion");
        let proxima_dosis = $(this).attr("proxima_dosis");

        $("#select_edit_mascota").val(id_mascotas);
        $("#select_edit_vacuna").val(id_vacunas);
        $("#txt_edit_fecha_aplicacion").val(fecha_aplicacion);
        $("#txt_edit_proxima_dosis").val(proxima_dosis);
        $("#btnEditarVacunaMascota").attr("vacuna_mascota",id_vacunas_mascotas);
    });

    const forms = document.querySelectorAll('#formRegistroVacunaMascota');
    Array.from(forms).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let id_mascotas = document.getElementById('select_mascota').value;
                let id_vacunas = document.getElementById('select_vacuna').value;
                let fecha_aplicacion = document.getElementById('txt_fecha_aplicacion').value;
                let proxima_dosis = document.getElementById('txt_proxima_dosis').value;

                let objData = {"registrarVacunaMascota":"ok","id_mascotas":id_mascotas,"id_vacunas":id_vacunas,"fecha_aplicacion":fecha_aplicacion,"proxima_dosis":proxima_dosis,"listarVacunasMascotas":"ok"};
                let obj = new VacunasMascotas(objData);
                obj.registrarVacunaMascota();
            }
        },false);
    });

    const formsEditar = document.querySelectorAll('#formEditarVacunaMascota');
    Array.from(formsEditar).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let id_vacunas_mascotas = $("#btnEditarVacunaMascota").attr("vacuna_mascota");
                let id_mascotas = document.getElementById('select_edit_mascota').value;
                let id_vacunas = document.getElementById('select_edit_vacuna').value;
                let fecha_aplicacion = document.getElementById('txt_edit_fecha_aplicacion').value;
                let proxima_dosis = document.getElementById('txt_edit_proxima_dosis').value;

                let objData = {"editarVacunaMascota":"ok","id_vacunas_mascotas":id_vacunas_mascotas,"id_mascotas":id_mascotas,"id_vacunas":id_vacunas,"fecha_aplicacion":fecha_aplicacion,"proxima_dosis":proxima_dosis,"listarVacunasMascotas":"ok"};
                let obj = new VacunasMascotas(objData);
                obj.editarVacunaMascota();
            }
        },false);
    });

})();
