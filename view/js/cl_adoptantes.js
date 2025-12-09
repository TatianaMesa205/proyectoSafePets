class Adoptantes {
    constructor(objData){
        this._objData = objData;
    }

    recargarTabla() {
        let obj = new Adoptantes({ listarAdoptantes: "ok" });
        obj.listarAdoptantes();
    }

    listarAdoptantes(){
        let objData = new FormData();
        objData.append("listarAdoptantes",this._objData.listarAdoptantes);

        fetch("controller/adoptantesController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            console.log(response);

            if (response["codigo"] == "200"){
                let dataSet = [];

                response["listaAdoptantes"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<button id="btn-editarAdoptante" type="button" style="background-color:rgba(223, 179, 147, 1); border-color:pink; color:white" class="btn" adoptantes="'+item.id_adoptantes+'" nombre_completo="'+item.nombre_completo+'" cedula="'+item.cedula+'" telefono="'+item.telefono+'" email="'+item.email+'" direccion="'+item.direccion+'"><i class="bi bi-pencil"></i></button>';
                    
                    // CAMBIO AQUÍ: Enviamos el email y el nombre_usuario para la eliminación unificada
                    objBotones += '<button id="btn-eliminarAdoptante" type="button" style="background-color:rgba(112, 110, 120, 1); color:white" class="btn btn-eliminar-unificado" data-id-adoptantes="'+item.id_adoptantes+'" data-email-usuario="'+item.email+'" data-nombre-usuario="'+item.nombre_usuario+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    dataSet.push([
                        item.nombre_completo,
                        item.cedula,
                        item.telefono,
                        item.email,
                        item.direccion,
                        item.nombre_usuario, 
                        objBotones
                    ]);
                });

                // Inicializar DataTable (Asegúrate de que las columnas de tu HTML/datatable coincidan con estas 2 columnas)
                $("#tablaAdoptantes").DataTable({
                    dom: "Bfrtip",
                    responsive: true,
                    destroy:true,
                    data:dataSet
                });
            }else{
                console.log("error");
            }
        })
    }



    eliminarAdoptante(){
        let objData = new FormData();
        objData.append("eliminarAdoptante",this._objData.eliminarAdoptante);
        objData.append("id_adoptantes",this._objData.id_adoptantes);
        fetch("controller/adoptantesController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.recargarTabla();
                Swal.fire({
                    title: "Adoptante eliminada correctamente :(",
                    width: 600,
                    padding: "3em",
                    color: "#ba88d1",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/ba/c1/cd/bac1cdc1522ec6e9305e9e9b38b20bfd.gif")
                        left top
                        no-repeat
                    `,timer: 6000
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    registrarAdoptante(){

        console.log(this._objData.registrarAdoptante);

        let objDataAdoptante = new FormData();
        objDataAdoptante.append("registrarAdoptante",this._objData.registrarAdoptante);
        objDataAdoptante.append("nombre_completo",this._objData.nombre_completo);
        objDataAdoptante.append("cedula",this._objData.cedula);
        objDataAdoptante.append("telefono",this._objData.telefono);
        objDataAdoptante.append("email",this._objData.email);
        objDataAdoptante.append("direccion",this._objData.direccion);
        
        fetch('controller/adoptantesController.php',{
            method: 'POST',
            body:objDataAdoptante
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{

            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroAdoptantes');
                formulario.reset();
                $("#panelFormularioAdoptantes").hide();
                $("#panelTablaAdoptantes").show();
                this.recargarTabla();

                    Swal.fire({
                    title: "Adoptante registrado correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/3a/fb/fa/3afbfa4d4048a3dbbd56fac372de781f.gif")
                        left top
                        no-repeat
                    `,timer: 1600
                    });


            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }


    editarAdoptante(){

        let objDataAdoptante = new FormData();
        objDataAdoptante.append("editarAdoptante",this._objData.editarAdoptante);
        objDataAdoptante.append("id_adoptantes",this._objData.id_adoptantes);
        objDataAdoptante.append("nombre_completo",this._objData.nombre_completo);
        objDataAdoptante.append("cedula",this._objData.cedula);
        objDataAdoptante.append("telefono",this._objData.telefono);
        objDataAdoptante.append("email",this._objData.email);
        objDataAdoptante.append("direccion",this._objData.direccion);
        fetch('controller/adoptantesController.php',{
            method: 'POST',
            body:objDataAdoptante
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{

            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formEditarAdoptantes');
                formulario.reset();
                $("#panelFormularioEditarAdoptantes").hide();
                $("#panelTablaAdoptantes").show();
                this.recargarTabla();

                    Swal.fire({
                    title: "Adoptante editado correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/3a/fb/fa/3afbfa4d4048a3dbbd56fac372de781f.gif")
                        left top
                        no-repeat
                    `
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }
    registrarAdoptante(){
        let objDataAdoptante = new FormData();
        objDataAdoptante.append("registrarAdoptante", this._objData.registrarAdoptante);
        objDataAdoptante.append("nombre_completo", this._objData.nombre_completo);
        objDataAdoptante.append("cedula", this._objData.cedula);
        objDataAdoptante.append("telefono", this._objData.telefono);
        objDataAdoptante.append("email", this._objData.email);
        objDataAdoptante.append("direccion", this._objData.direccion);

        fetch('controller/adoptantesController.php', {
            method: 'POST',
            body: objDataAdoptante
        })
        .then(response => response.json())
        .catch(error => {
            console.log(error);
        })
        .then(response => {
            if (response["codigo"] == "200") {
                // Limpiar y cerrar formulario
                let formulario = document.getElementById('formRegistroAdoptantes');
                formulario.reset();
                $("#panelFormularioAdoptantes").hide();
                $("#panelTablaAdoptantes").show();
                this.recargarTabla();

                // MENSAJE INFORMATIVO PARA EL ADMIN
                Swal.fire({
                    icon: 'success',
                    title: '¡Registrado!',
                    html: `El adoptante se guardó correctamente.<br><br>
                           <span style="color:#d33; font-weight:bold;">IMPORTANTE:</span><br> 
                           Informe al usuario que debe registrarse en la plataforma usando este correo: 
                           <b>${this._objData.email}</b>`,
                    confirmButtonText: 'Entendido'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response["mensaje"]
                });
            }
        });
    }
}   


$(document).on("click", ".btn-eliminar-unificado", function(){
    let idAdoptantes = $(this).attr("data-id-adoptantes");
    let emailUsuario = $(this).attr("data-email-usuario");
    let nombreUsuario = $(this).attr("data-nombre-usuario");
    
    Swal.fire({
        title: '¿Estás seguro de eliminar a ' + nombreUsuario + '?',
        text: "¡Esta acción es irreversible y eliminará el usuario y su perfil de adoptante!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let objData = new FormData();
            // Nueva acción para eliminar
            objData.append("accion", "eliminarAdoptanteYUsuario"); 
            objData.append("id_adoptantes", idAdoptantes);
            objData.append("email_usuario", emailUsuario);

            fetch("controller/adoptantesController.php", {
                method: 'POST',
                body: objData
            })
            .then(response => response.json())
            .then(data => {
                if (data.codigo === "200") {
                    Swal.fire('¡Eliminado!', 'El adoptante y su usuario han sido eliminados.', 'success')
                    .then(() => {
                        new Adoptantes({}).recargarTabla(); 
                    });
                } else {
                    Swal.fire('Error', data.mensaje || 'No se pudo eliminar el registro.', 'error');
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                Swal.fire('Error', 'Hubo un problema de conexión al intentar eliminar.', 'error');
            });
        }
    })
});