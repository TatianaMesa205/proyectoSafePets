class Mascotas {
    constructor(objData){
        this._objData = objData;
    }

    recargarTabla() {
        let obj = new Mascotas({ listarMascotas: "ok" });
        obj.listarMascotas();
    }

    listarMascotas(){
        let objData = new FormData();
        objData.append("listarMascotas",this._objData.listarMascotas);

        fetch("controller/mascotasController.php",{
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

                response["listaMascotas"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<button id="btn-editarMascota" type="button" style="background-color:rgba(223, 179, 147, 1); border-color:pink; color:white" class="btn" mascota="'+item.id_mascotas+'" nombre="'+item.nombre+'" especie="'+item.especie+'" raza="'+item.raza+'" edad="'+item.edad+'" sexo="'+item.sexo+'" tamano="'+item.tamano+'" fecha_ingreso="'+item.fecha_ingreso+'" estado_salud="'+item.estado_salud+'" estado="'+item.estado+'" descripcion="'+item.descripcion+'" imagen="'+item.imagen+'"><i class="bi bi-pencil"></i></button>';
                    objBotones += '<button id="btn-eliminarMascota" type="button" style="background-color:rgba(112, 110, 120, 1); color:white" class="btn" mascota="'+item.id_mascotas+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    // --- CORRECCIÓN DE IMAGEN ---
                    // Definimos la ruta base donde están las imágenes físicas
                    let rutaBase = "../CarpetaCompartida/Mascotas/";
                    let imgHtml = "";

                    // Si hay imagen, concatenamos. Si no, mostramos una por defecto.
                    if (item.imagen && item.imagen != "") {
                        imgHtml = `<img src="${rutaBase + item.imagen}" alt="Foto" width="80" height="80" style="object-fit:cover;border-radius:10px;">`;
                    } else {
                        imgHtml = `<img src="view/img/default/anonymous.png" alt="Sin Foto" width="80" height="80" style="object-fit:cover;border-radius:10px;">`;
                    }
                    // ----------------------------

                    dataSet.push([ 
                        item.nombre,
                        item.especie,
                        item.raza,
                        item.edad,
                        item.sexo,
                        item.tamano,
                        item.fecha_ingreso,
                        item.estado_salud,
                        item.estado,
                        item.descripcion,
                        imgHtml, // Aquí va la imagen corregida
                        objBotones
                    ]);
                });

                $("#tablaMascotas").DataTable({
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

    eliminarMascota(){
        let objData = new FormData();
        objData.append("eliminarMascota",this._objData.eliminarMascota);
        objData.append("id_mascotas",this._objData.id_mascotas);
        fetch("controller/mascotasController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.listarMascotas();
                Swal.fire({
                    title: "Mascota eliminada correctamente :(",
                    width: 600,
                    padding: "3em",
                    color: "#ba88d1",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("")
                        left top
                        no-repeat
                    `,timer: 6000
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    registrarMascota(){
        console.log(this._objData.registrarMascota);

        let objDataMascota = new FormData();
        objDataMascota.append("registrarMascota",this._objData.registrarMascota);
        objDataMascota.append("nombre",this._objData.nombre);
        objDataMascota.append("especie",this._objData.especie);
        objDataMascota.append("raza",this._objData.raza);
        objDataMascota.append("edad",this._objData.edad);
        objDataMascota.append("sexo",this._objData.sexo);
        objDataMascota.append("tamano",this._objData.tamano);
        objDataMascota.append("fecha_ingreso",this._objData.fecha_ingreso);
        objDataMascota.append("estado_salud",this._objData.estado_salud);
        objDataMascota.append("estado",this._objData.estado);
        objDataMascota.append("descripcion",this._objData.descripcion);
        objDataMascota.append("imagen",this._objData.imagen);

        fetch('controller/mascotasController.php',{
            method: 'POST',
            body:objDataMascota
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroMascotas');
                formulario.reset();
                $("#panelFormularioMascotas").hide();
                $("#panelTablaMascotas").show();
                this.recargarTabla();

                    Swal.fire({
                    title: "Mascota registrada correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("")
                        left top
                        no-repeat
                    `,timer: 1600
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    editarMascota(){
        let objDataMascota = new FormData();
        objDataMascota.append("editarMascota",this._objData.editarMascota);
        objDataMascota.append("id_mascotas",this._objData.id_mascotas);
        objDataMascota.append("nombre",this._objData.nombre);
        objDataMascota.append("especie",this._objData.especie);
        objDataMascota.append("raza",this._objData.raza);
        objDataMascota.append("edad",this._objData.edad);
        objDataMascota.append("sexo",this._objData.sexo);
        objDataMascota.append("tamano",this._objData.tamano);
        objDataMascota.append("fecha_ingreso",this._objData.fecha_ingreso);
        objDataMascota.append("estado_salud",this._objData.estado_salud);
        objDataMascota.append("estado",this._objData.estado);
        objDataMascota.append("descripcion",this._objData.descripcion);
        objDataMascota.append("imagen_actual",this._objData.imagen_actual);

        if (this._objData.imagen) {
            objDataMascota.append("imagen", this._objData.imagen);
        }

        fetch('controller/mascotasController.php',{
            method: 'POST',
            body:objDataMascota
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formEditarMascotas');
                formulario.reset();
                $("#panelFormularioEditarMascotas").hide();
                $("#panelTablaMascotas").show();
                this.recargarTabla();

                    Swal.fire({
                    title: "Mascota editada correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("")
                        left top
                        no-repeat
                    `
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }
}