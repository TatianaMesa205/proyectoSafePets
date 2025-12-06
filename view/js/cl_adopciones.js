class Adopciones {
    constructor(objData) {
        this._objData = objData;
    }

    recargarTabla() {
        let obj = new Adopciones({ listarAdopciones: "ok" });
        obj.listarAdopciones();
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
                        item.nombre_mascota,    
                        item.nombre_adoptante,  
                        item.fecha_adopcion,
                        item.estado,
                        item.observaciones,
                        item.contrato ? `<a href="../../../CarpetaCompartida/Contratos/${item.contrato}" target="_blank">Ver contrato</a>`: '—',
                        botones
                    ]);

                });
                $("#tablaAdopciones").DataTable({
                    dom: "Bfrtip",
                    responsive: true,
                    destroy:true,
                    data:dataSet
                });
            }
        });
    }

    eliminarAdopcion(){
        let objData = new FormData();
        objData.append("eliminarAdopcion", this._objData.eliminarAdopcion);
        objData.append("id_adopciones", this._objData.id_adopciones);

        fetch("controller/adopcionesController.php", {
            method:'POST',
            body:objData
        })
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

        fetch("controller/adopcionesController.php",{
            method:'POST',
            body:objData
        })
        .then(r=>r.json()).then(response=>{
            if(response["codigo"]=="200"){
                document.getElementById("formRegistroAdopcion").reset();
                $("#panelFormularioAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.recargarTabla();
                Swal.fire({
                    title:"Adopción registrada 🐶",timer:1600});
            }else Swal.fire(response["mensaje"]);
        });
    }

    editarAdopcion() {
        let objData = new FormData();
        objData.append("editarAdopcion", "ok");
        objData.append("id_adopciones", this._objData.id_adopciones);
        objData.append("mascotas_id", this._objData.mascotas_id);
        objData.append("adoptantes_id", this._objData.adoptantes_id);
        objData.append("fecha_adopcion", this._objData.fecha_adopcion);
        objData.append("estado", this._objData.estado);
        objData.append("observaciones", this._objData.observaciones);

        let archivoNuevo = document.getElementById("edit_contrato").files[0];
        if (archivoNuevo) {
            objData.append("contrato", archivoNuevo);
        }
 
        objData.append("contrato_actual", this._objData.contrato);

        fetch("controller/adopcionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {

            if (response["codigo"] == "200") {
                document.getElementById("formEditarAdopcion").reset();
                $("#panelFormularioEditarAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.recargarTabla();


                Swal.fire("Adopción editada correctamente 😺");
            } else {
                Swal.fire(response["mensaje"]);
            }
        })
    }


    registrarAdopcionConArchivo() {
        fetch("controller/adopcionesController.php", {
            method: "POST",
            body: this._objData
        })
        .then(r => r.json())
        .then(response => {

            if (response["codigo"] == "200") {
                Swal.fire("Adopción registrada 🐶", "", "success");

                $("#panelFormularioAdopciones").hide();
                $("#panelTablaAdopciones").show();

                this.recargarTabla();
            } else {
                Swal.fire("Error", response["mensaje"], "error");
            }
        });
    }

    editarAdopcionConArchivo() {

        fetch("controller/adopcionesController.php", {
            method: "POST",
            body: this._objData
        })
        .then(r => r.json())
        .then(response => {

            if (response["codigo"] == "200") {

                Swal.fire("Adopción actualizada 😺", "", "success");

                $("#panelFormularioEditarAdopciones").hide();
                $("#panelTablaAdopciones").show();

                this.recargarTabla();

            } else {
                Swal.fire("Error", response["mensaje"], "error");
            }
        })
        .catch(err => console.log(err));
    }



    cargarSelects() {
        this.cargarMascotas();
        this.cargarAdoptantes();
    }

    // Dentro de la clase Adopciones:

    cargarMascotas() {
        let objData = new FormData();
        objData.append("listarMascotas", "ok");

        fetch("controller/mascotasController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                let select = document.getElementById("select_mascotas");
                select.innerHTML = '<option value="">Seleccione una mascota</option>';

                // 🛑 MODIFICACIÓN AQUÍ: Filtramos las mascotas por estado "Adoptado"
                response["listaMascotas"].forEach(mascota => {
                    if (mascota.estado === "Disponible") { // Solo si el estado es 'Adoptado'
                        select.innerHTML += `<option value="${mascota.id_mascotas}">
                            ${mascota.nombre} - ${mascota.especie}
                        </option>`;
                    }
                });
                // 🛑 FIN MODIFICACIÓN
            }
        });
    }

    cargarAdoptantes() {
        let objData = new FormData();
        objData.append("listarAdoptantes", "ok");

        fetch("controller/adoptantesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                let select = document.getElementById("select_adoptantes");

                select.innerHTML = '<option value="">Seleccione un adoptante</option>';

                response["listaAdoptantes"].forEach(adoptante => {
                    select.innerHTML += `<option value="${adoptante.id_adoptantes}">
                        ${adoptante.nombre_completo}
                    </option>`;
                });
            }
        });
    }

    // Dentro de la clase Adopciones:

    cargarSelectsEditar(mascotaSel, adoptanteSel) {

        let objMascotas = new FormData();
        objMascotas.append("listarMascotas", "ok");

        fetch("controller/mascotasController.php", {
            method: "POST",
            body: objMascotas
        })
        .then(r => r.json())
        .then(response => {

            let select = document.getElementById("select_edit_mascotas");
            select.innerHTML = '<option value="">Seleccione una mascota</option>';

            // 🛑 MODIFICACIÓN AQUÍ: Filtramos las mascotas por estado "Adoptado"
            response["listaMascotas"].forEach(m => {
                // Aseguramos que la mascota esté adoptada O que sea la mascota seleccionada originalmente
                // (para que no desaparezca del select si su estado cambió después)
                if (m.estado === "Disponible" || m.id_mascotas == mascotaSel) { 
                    let selected = m.id_mascotas == mascotaSel ? "selected" : "";
                    select.innerHTML += `
                        <option value="${m.id_mascotas}" ${selected}>
                            ${m.nombre} - ${m.especie}
                        </option>`;
                }
            });
            // 🛑 FIN MODIFICACIÓN
        });

        // ... (El resto del código para cargar Adoptantes permanece igual)
        // ...
        // ...
    }
}


