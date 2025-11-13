(function(){

    listarTablaSeguimientos();

    function listarTablaSeguimientos(){
        let objData = {"listarSeguimientos":"ok"};
        let objTabla = new SeguimientosMascotas(objData);
        objTabla.listarSeguimientos();
    }

    let btnAgregar = document.getElementById("btn-AgregarSeguimiento");
    btnAgregar.addEventListener("click",()=>{
        $("#panelTablaSeguimientos").hide();
        $("#panelFormularioSeguimientos").show();
    });

    let btnRegresar = document.getElementById("btn-RegresarSeguimiento");
    btnRegresar.addEventListener("click",()=>{
        $("#panelFormularioSeguimientos").hide();
        $("#panelTablaSeguimientos").show();
    });

    let btnRegresarEditar = document.getElementById("btn-RegresarEditarSeguimiento");
    btnRegresarEditar.addEventListener("click",()=>{
        $("#panelFormularioEditarSeguimientos").hide();
        $("#panelTablaSeguimientos").show();
    });

    $("#tablaSeguimientos").on("click","#btn-eliminarSeguimiento",function(){
        Swal.fire({
            title: "¿Está seguro?",
            text: "El seguimiento será eliminado permanentemente.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result)=>{
            if(result.isConfirmed){
                let id_seguimientos = $(this).attr("seguimiento");
                let objData = {"eliminarSeguimiento":"ok","id_seguimientos":id_seguimientos,"listarSeguimientos":"ok"};
                let obj = new SeguimientosMascotas(objData);
                obj.eliminarSeguimiento();
            }
        });
    });

    $("#tablaSeguimientos").on("click","#btn-editarSeguimiento",function(){
        $("#panelTablaSeguimientos").hide();
        $("#panelFormularioEditarSeguimientos").show();

        let id_seguimientos = $(this).attr("seguimiento");
        let fecha_visita = $(this).attr("fecha");
        let observacion = $(this).attr("observacion");
        let id_adopciones = $(this).attr("adopcion");

        $("#txt_edit_fecha_visita").val(fecha_visita);
        $("#txt_edit_observacion").val(observacion);
        $("#select_edit_adopciones").val(id_adopciones);
        $("#btnEditarSeguimiento").attr("seguimiento",id_seguimientos);
    });

    const forms = document.querySelectorAll('#formRegistroSeguimiento');
    Array.from(forms).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let id_adopciones = document.getElementById('select_adopciones').value;
                let fecha_visita = document.getElementById('txt_fecha_visita').value;
                let observacion = document.getElementById('txt_observacion').value;

                let objData = {"registrarSeguimiento":"ok","id_adopciones":id_adopciones,"fecha_visita":fecha_visita,"observacion":observacion,"listarSeguimientos":"ok"};
                let obj = new SeguimientosMascotas(objData);
                obj.registrarSeguimiento();
            }
        },false);
    });

    const formsEditar = document.querySelectorAll('#formEditarSeguimiento');
    Array.from(formsEditar).forEach(form=>{
        form.addEventListener('submit',event=>{
            event.preventDefault();
            if(!form.checkValidity()){
                event.stopPropagation();
                form.classList.add('was-validated');
            }else{
                let id_seguimientos = $("#btnEditarSeguimiento").attr("seguimiento");
                let id_adopciones = document.getElementById('select_edit_adopciones').value;
                let fecha_visita = document.getElementById('txt_edit_fecha_visita').value;
                let observacion = document.getElementById('txt_edit_observacion').value;

                let objData = {"editarSeguimiento":"ok","id_seguimientos":id_seguimientos,"id_adopciones":id_adopciones,"fecha_visita":fecha_visita,"observacion":observacion,"listarSeguimientos":"ok"};
                let obj = new SeguimientosMascotas(objData);
                obj.editarSeguimiento();
            }
        },false);
    });

})();
