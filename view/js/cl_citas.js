class Citas {
    constructor(objData){
        this._objData = objData;
    }
    listarCitas(){
        let objData = new FormData();
        objData.append("listarCitas",this._objData.listarCitas);

        fetch("controller/citasController.php",{
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

                response["listaCitas"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += `
                    <button id="btn-editarCita" type="button"
                        class="btn"
                        style="background-color:rgba(223, 179, 147, 1); border-color:pink; color:white"
                        citas="${item.id_citas}"
                        mascotas="${item.id_mascotas}"
                        adoptantes="${item.id_adoptantes}"
                        fecha_cita="${item.fecha_cita}"
                        estado="${item.estado}"
                        motivo="${item.motivo}">
                        <i class="bi bi-pencil"></i>
                    </button>`;
                    objBotones += '<button id="btn-eliminarCita" type="button" style="background-color:rgba(112, 110, 120, 1); color:white" class="btn" citas="'+item.id_citas+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    dataSet.push([
                        item.nombre_mascota,     // nombre visible
                        item.nombre_adoptante,   // nombre visible
                        item.fecha_cita,
                        item.estado,
                        item.motivo,
                        objBotones
                    ]);
                });

                $("#tablaCitas").DataTable({
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



    eliminarCita(){
        let objData = new FormData();
        objData.append("eliminarCita",this._objData.eliminarCita);
        objData.append("id_citas",this._objData.id_citas);
        fetch("controller/citasController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.listarCitas();
                Swal.fire({
                    title: "Cita eliminada correctamente:)",
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

    registrarCita(){

        console.log(this._objData.registrarCita);

        let objDataCita = new FormData();
        objDataCita.append("registrarCita",this._objData.registrarCita);
        objDataCita.append("id_adoptantes",this._objData.id_adoptantes);
        objDataCita.append("id_mascotas",this._objData.id_mascotas);
        // Convertir formato datetime-local a formato MySQL
        let fechaCitaInput = this._objData.fecha_cita;
        let fechaFormateada = fechaCitaInput.replace("T", " ") + ":00";
        objDataCita.append("fecha_cita", fechaFormateada);

        objDataCita.append("estado",this._objData.estado);
        objDataCita.append("motivo",this._objData.motivo);

        fetch('controller/citasController.php',{
            method: 'POST',
            body:objDataCita
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{

            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroCitas');
                formulario.reset();
                $("#panelFormularioCitas").hide();
                $("#panelTablaCitas").show();
                this.listarCitas();

                    Swal.fire({
                    title: "Cita registrada correctamente :D",
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


    editarCita(){
        let objDataCita = new FormData();

        objDataCita.append("editarCita","ok");

        // id de la cita (asegúrate de pasarlo al constructor)
        if (this._objData.id_citas) {
        objDataCita.append("id_citas", this._objData.id_citas);
        } else {
        console.error("editarCita(): falta id_citas");
        }

        // Mascota y adoptante (asegúrate de pasarlos desde el form)
        if (this._objData.id_mascotas) objDataCita.append("id_mascotas", this._objData.id_mascotas);
        if (this._objData.id_adoptantes) objDataCita.append("id_adoptantes", this._objData.id_adoptantes);

        // Fecha: la recibimos en varios formatos posibles. Protegemos contra undefined.
        let fechaCitaInput = this._objData.fecha_cita; // puede ser "2025-11-11T12:30" o "2025-11-11 12:30:00" etc.
        let fechaFormateada = null;

        if (fechaCitaInput && typeof fechaCitaInput === "string") {
        // si viene con 'T' (datetime-local) -> reemplazamos y añadimos segundos
        if (fechaCitaInput.indexOf("T") !== -1) {
            fechaFormateada = fechaCitaInput.replace("T", " ");
            // si viene sin segundos agrega :00
            if (!/:..\s*$/.test(fechaFormateada) && fechaFormateada.length <= 16) {
            fechaFormateada = fechaFormateada + ":00";
            }
        }
        // si viene ya en formato MySQL "YYYY-MM-DD HH:mm:ss" lo usamos tal cual
        else if (fechaCitaInput.indexOf(" ") !== -1) {
            fechaFormateada = fechaCitaInput;
            // si sólo trae "YYYY-MM-DD HH:mm" agregamos :00
            if (!/:\d{2}$/.test(fechaFormateada)) {
            fechaFormateada = fechaFormateada + ":00";
            }
        }
        // si sólo trae fecha "YYYY-MM-DD" asignamos hora 00:00:00
        else if (/^\d{4}-\d{2}-\d{2}$/.test(fechaCitaInput)) {
            fechaFormateada = fechaCitaInput + " 00:00:00";
        } else {
            // formato inesperado: lo imprimimos para debug y no añadimos fecha
            console.warn("editarCita(): formato de fecha inesperado:", fechaCitaInput);
        }
        } else {
        console.warn("editarCita(): fecha no proporcionada o no es string:", fechaCitaInput);
        }

        if (fechaFormateada) {
        objDataCita.append("fecha_cita", fechaFormateada);
        }

        objDataCita.append("estado", this._objData.estado ?? "");
        objDataCita.append("motivo", this._objData.motivo ?? "");

        fetch('controller/citasController.php', {
        method: 'POST',
        body: objDataCita
        })
        .then(response => response.json())
        .catch(error => {
        console.error("editarCita() - fetch error:", error);
        Swal.fire("Error", "Ocurrió un error en la petición. Revisa la consola.", "error");
        })
        .then(response => {
        if (!response) return; // si falló el parse o ya se manejó en catch
        if (response["codigo"] == "200") {
            let formulario = document.getElementById('formEditarCitas');
            if (formulario) formulario.reset();
            $("#panelFormularioEditarCitas").hide();
            $("#panelTablaCitas").show();
            this.listarCitas();
            Swal.fire("Cita editada correctamente :D");
        } else {
            Swal.fire("Error", response["mensaje"] ?? "Error desconocido", "error");
        }
        });
    }




//SELECTS FORMULARIO DE LA MASCOTA //

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
                
                response["listaMascotas"].forEach(mascota => {
                    select.innerHTML += `<option value="${mascota.id_mascotas}">${mascota.nombre} - ${mascota.especie}</option>`;
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

    // --- NUEVO MÉTODO PARA CARGAR SELECTS EN EDICIÓN ---
    cargarSelectsEditar(id_adoptanteSel, id_mascotaSel) {
    // Cargar mascotas
    let objDataMascotas = new FormData();
    objDataMascotas.append("listarMascotas", "ok");

    fetch("controller/mascotasController.php", {
        method: "POST",
        body: objDataMascotas
    })
        .then(res => res.json())
        .then(res => {
        if (res["codigo"] === "200") {
            let selectMascotas = document.getElementById("select_edit_mascotas");
            selectMascotas.innerHTML = '<option value="">Seleccione una mascota</option>';
            res["listaMascotas"].forEach(m => {
            let selected = m.id_mascotas == id_mascotaSel ? "selected" : "";
            selectMascotas.innerHTML += `<option value="${m.id_mascotas}" ${selected}>${m.nombre} - ${m.especie}</option>`;
            });
        }
        });

    // Cargar adoptantes
    let objDataAdoptantes = new FormData();
    objDataAdoptantes.append("listarAdoptantes", "ok");

    fetch("controller/adoptantesController.php", {
        method: "POST",
        body: objDataAdoptantes
    })
        .then(res => res.json())
        .then(res => {
        if (res["codigo"] === "200") {
            let selectAdoptantes = document.getElementById("select_edit_adoptantes");
            selectAdoptantes.innerHTML = '<option value="">Seleccione un adoptante</option>';
            res["listaAdoptantes"].forEach(a => {
            let selected = a.id_adoptantes == id_adoptanteSel ? "selected" : "";
            selectAdoptantes.innerHTML += `<option value="${a.id_adoptantes}" ${selected}>${a.nombre_completo}</option>`;
            });
        }
        });
    }

}
