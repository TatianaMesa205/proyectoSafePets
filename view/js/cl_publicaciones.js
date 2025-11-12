class Publicaciones {
    constructor(objData){
        this._objData = objData;
    }

    listarPublicaciones(){
        let objData = new FormData();
        objData.append("listarPublicaciones", this._objData.listarPublicaciones);

        fetch("controller/publicacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                let dataSet = [];

                response["listaPublicaciones"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group">';
                    objBotones += `<button id="btn-editarPublicacion" type="button" style="background-color:rgba(223, 179, 147, 1); border-color:pink; color:white" class="btn"
                        publicacion="${item.id_publicaciones}" tipo="${item.tipo}" descripcion="${item.descripcion}" foto="${item.foto}"
                        fecha_publicacion="${item.fecha_publicacion}" contacto="${item.contacto}">
                        <i class="bi bi-pencil"></i></button>`;
                    objBotones += `<button id="btn-eliminarPublicacion" type="button" style="background-color:rgba(112, 110, 120, 1); color:white" class="btn"
                        publicacion="${item.id_publicaciones}">
                        <i class="bi bi-trash"></i></button>`;
                    objBotones += '</div>';

                    dataSet.push([
                        item.id_publicaciones,
                        item.tipo,
                        item.descripcion,
                        item.fecha_publicacion,
                        item.contacto,
                        item.foto,
                        objBotones
                    ]);
                });

                $("#tablaPublicaciones").DataTable({
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

    eliminarPublicacion(){
        let objData = new FormData();
        objData.append("eliminarPublicacion", this._objData.eliminarPublicacion);
        objData.append("id_publicaciones", this._objData.id_publicaciones);

        fetch("controller/publicacionesController.php", {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.listarPublicaciones();
                Swal.fire({
                    title: "Publicación eliminada correctamente 📰",
                    width: 600,
                    padding: "3em",
                    color: "#ba88d1",
                    background: "#fff",
                    timer: 1800
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    registrarPublicacion(){
        let objData = new FormData();
        objData.append("registrarPublicacion", "ok");
        objData.append("tipo", this._objData.tipo);
        objData.append("descripcion", this._objData.descripcion);
        objData.append("foto", this._objData.foto);
        objData.append("fecha_publicacion", this._objData.fecha_publicacion);
        objData.append("contacto", this._objData.contacto);

        fetch('controller/publicacionesController.php', {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroPublicacion');
                formulario.reset();
                $("#panelFormularioPublicaciones").hide();
                $("#panelTablaPublicaciones").show();
                this.listarPublicaciones();

                Swal.fire({
                    title: "Publicación registrada correctamente 🐶📢",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff",
                    timer: 1600
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    editarPublicacion(){
        let objData = new FormData();
        objData.append("editarPublicacion", "ok");
        objData.append("id_publicaciones", this._objData.id_publicaciones);
        objData.append("tipo", this._objData.tipo);
        objData.append("descripcion", this._objData.descripcion);
        objData.append("foto", this._objData.foto);
        objData.append("fecha_publicacion", this._objData.fecha_publicacion);
        objData.append("contacto", this._objData.contacto);

        fetch('controller/publicacionesController.php', {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formEditarPublicacion');
                formulario.reset();
                $("#panelFormularioEditarPublicaciones").hide();
                $("#panelTablaPublicaciones").show();
                this.listarPublicaciones();

                Swal.fire({
                    title: "Publicación editada correctamente ✏️",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff",
                    timer: 1600
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }
}
