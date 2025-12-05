(function(){

    if($('#tablaVacunas').length > 0){
        listarTablaVacunas();
    }

    function listarTablaVacunas(){
        let objData = {"listarVacunas":"ok"};
        let objTablaVacunas = new Vacunas(objData);
        objTablaVacunas.listarVacunas();
    }


    let btnAgregarVacuna = document.getElementById("btn-AgregarVacuna");
    if (btnAgregarVacuna) {
        btnAgregarVacuna.addEventListener("click",()=>{
            $("#panelTablaVacunas").hide();
            $("#panelFormularioVacunas").show();
        });
    }

    let btnRegresarVacuna = document.getElementById("btn-RegresarVacuna");
    if (btnRegresarVacuna) {
        btnRegresarVacuna.addEventListener("click",()=>{
            $("#panelFormularioVacunas").hide();
            $("#panelTablaVacunas").show();
        });
    }

    let btnRegresarEditarVacuna = document.getElementById("btn-RegresarEditarVacuna");
    if (btnRegresarEditarVacuna) {
        btnRegresarEditarVacuna.addEventListener("click",()=>{
            $("#panelFormularioEditarVacunas").hide();
            $("#panelTablaVacunas").show();
        });
    }

    $("#tablaVacunas").on("click","#btn-eliminarVacuna",function(){
        Swal.fire({
            title: "¿Está seguro?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result)=>{
            if(result.isConfirmed){
                let id_vacunas = $(this).attr("vacuna");
                let objData = {"eliminarVacuna":"ok","id_vacunas":id_vacunas,"listarVacunas":"ok"};
                let objVacuna = new Vacunas(objData);
                objVacuna.eliminarVacuna();
            }
        });
    });

    $("#tablaVacunas").on("click","#btn-editarVacuna",function(){
        $("#panelTablaVacunas").hide();
        $("#panelFormularioEditarVacunas").show();

        let id_vacunas = $(this).attr("vacuna");
        let nombre_vacuna = $(this).attr("nombre");
        let tiempo_aplicacion = $(this).attr("tiempo");

        $("#txt_edit_nombre_vacuna").val(nombre_vacuna);
        $("#txt_edit_tiempo_aplicacion").val(tiempo_aplicacion);
        $("#btnEditarVacuna").attr("vacuna",id_vacunas);
    });

    const forms = document.querySelectorAll('#formRegistroVacuna');
    Array.from(forms).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let nombre_vacuna = document.getElementById('txt_nombre_vacuna').value;
                let tiempo_aplicacion = document.getElementById('txt_tiempo_aplicacion').value;

                let objData = {"registrarVacuna":"ok","nombre_vacuna":nombre_vacuna,"tiempo_aplicacion":tiempo_aplicacion,"listarVacunas":"ok"};
                let objVacuna = new Vacunas(objData);
                objVacuna.registrarVacuna();
            }
        },false);
    });

    const formsEditar = document.querySelectorAll('#formEditarVacuna');
    Array.from(formsEditar).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let id_vacunas = $("#btnEditarVacuna").attr("vacuna");
                let nombre_vacuna = document.getElementById('txt_edit_nombre_vacuna').value;
                let tiempo_aplicacion = document.getElementById('txt_edit_tiempo_aplicacion').value;

                let objData = {"editarVacuna":"ok","id_vacunas":id_vacunas,"nombre_vacuna":nombre_vacuna,"tiempo_aplicacion":tiempo_aplicacion,"listarVacunas":"ok"};
                let objVacuna = new Vacunas(objData);
                objVacuna.editarVacuna();
            }
        },false);
    });

})();