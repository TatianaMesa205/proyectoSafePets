class Adopciones {
    constructor(objData){
        this._objData = objData;
    }

    listarAdopciones(){
        let objData = new FormData();
        objData.append("listarAdopciones", this._objData.listarAdopciones);

        fetch("controller/adopcionesController.php",{
            method:'POST',
            body:objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            console.log(response);

            if(response["codigo"]=="200"){
                let dataSet = [];

                response["listaAdopciones"].forEach(item=>{
                    let botones = `
                        <div class="btn-group">
                          <button id="btn-editarAdopcion" class="btn" style="background-color:rgba(223, 179, 147, 1); border-color:pink;color:white"
                            adopcion="${item.id_adopciones}"
                            mascota="${item.id_mascotas}"
                            adoptante="${item.id_adoptantes}"
                            fecha="${item.fecha_adopcion}"
                            estado="${item.estado}"
                            observaciones="${item.observaciones}"
                            contrato="${item.contrato}">
                            <i class="bi bi-pencil"></i>
                          </button>
                          <button id="btn-eliminarAdopcion" class="btn" style="background-color:rgba(112, 110, 120, 1); color:white"
                            adopcion="${item.id_adopciones}">
                            <i class="bi bi-trash"></i>
                          </button>
                        </div>`;
                    dataSet.push([
                        item.id_adopciones,
                        item.nombre_mascota,    
                        item.nombre_adoptante,  
                        item.fecha_adopcion,
                        item.estado,
                        item.observaciones,
                        item.contrato ? `<a href="uploads/contratos/${item.contrato}" target="_blank">Ver contrato</a>` : '—',
                        botones
                    ]);

                });
                $("#tablaAdopciones").DataTable({
                    destroy:true,
                    responsive:true,
                    dom:"Bfrtip",
                    buttons:["colvis","excel","pdf","print"],
                    data:dataSet
                });
            }
        });
    }

    eliminarAdopcion(){
        let objData = new FormData();
        objData.append("eliminarAdopcion", this._objData.eliminarAdopcion);
        objData.append("id_adopciones", this._objData.id_adopciones);

        fetch("controller/adopcionesController.php", {method:'POST',body:objData})
        .then(r=>r.json()).then(response=>{
            if(response["codigo"]=="200"){
                this.listarAdopciones();
                Swal.fire({
                    title:"Adopción eliminada correctamente 🐾",
                    color:"#ba88d1",
                    background:"#fff",
                    timer:1500
                });
            }else Swal.fire(response["mensaje"]);
        });
    }

    registrarAdopcion(){
        let objData = new FormData();
        objData.append("registrarAdopcion","ok");
        objData.append("mascotas_id",this._objData.mascotas_id);
        objData.append("adoptantes_id",this._objData.adoptantes_id);
        objData.append("fecha_adopcion",this._objData.fecha_adopcion);
        objData.append("estado",this._objData.estado);
        objData.append("observaciones",this._objData.observaciones);
        objData.append("contrato",this._objData.contrato);

        fetch("controller/adopcionesController.php",{method:'POST',body:objData})
        .then(r=>r.json()).then(response=>{
            if(response["codigo"]=="200"){
                document.getElementById("formRegistroAdopcion").reset();
                $("#panelFormularioAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.listarAdopciones();
                Swal.fire({title:"Adopción registrada 🐶",timer:1600});
            }else Swal.fire(response["mensaje"]);
        });
    }

    editarAdopcion(){
        let objData = new FormData();
        objData.append("editarAdopcion","ok");
        objData.append("id_adopciones",this._objData.id_adopciones);
        objData.append("fecha_adopcion",this._objData.fecha_adopcion);
        objData.append("estado",this._objData.estado);
        objData.append("observaciones",this._objData.observaciones);
        objData.append("contrato",this._objData.contrato);

        fetch("controller/adopcionesController.php",{
            method:'POST',
            body:objData
        })
        .then(r=>r.json())
        .then(response=>{
            if(response["codigo"]=="200"){
                document.getElementById("formEditarAdopcion").reset();
                $("#panelFormularioEditarAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.listarAdopciones();
                Swal.fire({
                    title:"Adopción editada correctamente 😺"
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    registrarAdopcionConArchivo() {
        fetch("controller/adopcionesController.php", {
            method: 'POST',
            body: this._objData // aquí el FormData con archivo
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
            Swal.fire("Adopción registrada correctamente", "", "success");
            $("#panelFormularioAdopciones").hide();
            $("#panelTablaAdopciones").show();
            this.listarAdopciones();
            } else {
            Swal.fire("Error", response["mensaje"], "error");
            }
        })
        .catch(err => console.log(err));
        }

        editarAdopcionConArchivo() {
        fetch("controller/adopcionesController.php", {
            method: 'POST',
            body: this._objData
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
            Swal.fire("Adopción actualizada correctamente", "", "success");
            $("#panelFormularioEditarAdopciones").hide();
            $("#panelTablaAdopciones").show();
            this.listarAdopciones();
            } else {
            Swal.fire("Error", response["mensaje"], "error");
            }
        })
        .catch(err => console.log(err));
    }




    //SELECTS PARA FORMULARIO REGISTRAR ADOPCION

    cargarSelects() {
        this.cargarMascotas();
        this.cargarAdoptantes();
    }

    cargarMascotas() {
        let objData = new FormData();
        objData.append("listarMascotas", "ok");

        fetch("controller/mascotasController.php", {
            method: 'POST',
            body: objData
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
                let select = document.getElementById('select_mascotas');
                select.innerHTML = '<option value="">Seleccione una mascota</option>';
                
                response["listaMascotas"].forEach(mascotas => {
                    select.innerHTML += `<option value="${mascotas.id_mascotas}">${mascotas.nombre} - ${mascotas.especie}</option>`;
                });
            }
        })
        .catch(error => console.log(error));
    }

    cargarAdoptantes() {
        let objData = new FormData();
        objData.append("listarAdoptantes", "ok");

        fetch("controller/adoptantesController.php", {
            method: 'POST',
            body: objData
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
                let select = document.getElementById('select_adoptantes');
                select.innerHTML = '<option value="">Seleccione un adoptante</option>';
                
                response["listaAdoptantes"].forEach(adoptantes => {
                    select.innerHTML += `<option value="${adoptantes.id_adoptantes}">${adoptantes.nombre_completo}</option>`;
                });
            }
        })
        .catch(error => console.log(error));
    }


    // SELECTS PARA FORMULARIO EDITAR ADOPCION
    cargarSelectsEditar(mascotaSeleccionada, adoptanteSeleccionado) {
    // Cargar mascotas
        let objDataMascotas = new FormData();
        objDataMascotas.append("listarMascotas", "ok");
        fetch("controller/mascotasController.php", {
            method: 'POST',
            body: objDataMascotas
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
            let select = document.getElementById('select_edit_mascotas');
            select.innerHTML = '<option value="">Seleccione una mascota</option>';
            response["listaMascotas"].forEach(mascota => {
                let selected = mascota.id_mascotas == mascotaSeleccionada ? "selected" : "";
                select.innerHTML += `<option value="${mascota.id_mascotas}" ${selected}>
                ${mascota.nombre} - ${mascota.especie}
                </option>`;
            });
            }
        });

        // Cargar adoptantes
        let objDataAdoptantes = new FormData();
        objDataAdoptantes.append("listarAdoptantes", "ok");
        fetch("controller/adoptantesController.php", {
            method: 'POST',
            body: objDataAdoptantes
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
            let select = document.getElementById('select_edit_adoptantes');
            select.innerHTML = '<option value="">Seleccione un adoptante</option>';
            response["listaAdoptantes"].forEach(adoptante => {
                let selected = adoptante.id_adoptantes == adoptanteSeleccionado ? "selected" : "";
                select.innerHTML += `<option value="${adoptante.id_adoptantes}" ${selected}>
                ${adoptante.nombre_completo}
                </option>`;
            });
            }
        });
    }


}

