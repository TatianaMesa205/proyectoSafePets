class SeguimientosMascotas {
    constructor(objData){
        this._objData = objData;
    }

    listarSeguimientos(){
        let objData = new FormData();
        objData.append("listarSeguimientos", this._objData.listarSeguimientos);

        fetch("controller/seguimientosController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .catch(e => console.log(e))
        .then(response => {
            if (response["codigo"] == "200") {
                let dataSet = [];
                response["listaSeguimientos"].forEach(item => {
                    let botones = `
                        <div class="btn-group">
                            <button id="btn-editarSeguimiento" class="btn" style="background-color:#d3a67c; border-color:pink;color:white"
                                seguimiento="${item.id_seguimientos}"
                                adopcion="${item.id_adopciones}"
                                fecha="${item.fecha_visita}"
                                observacion="${item.observacion}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button id="btn-eliminarSeguimiento" class="btn" style="background-color:#706e78;color:white"
                                seguimiento="${item.id_seguimientos}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    dataSet.push([
                        item.mascota,
                        item.adoptante,
                        item.fecha_adopcion,
                        item.fecha_visita,
                        item.observacion,
                        botones
                    ]);
                });

                $("#tablaSeguimientos").DataTable({
                    destroy:true,
                    responsive:true,
                    dom:"Bfrtip",
                    buttons:["colvis","excel","pdf","print"],
                    data:dataSet
                });
            }
        });
    }

    eliminarSeguimiento(){
        let objData = new FormData();
        objData.append("eliminarSeguimiento", this._objData.eliminarSeguimiento);
        objData.append("id_seguimientos", this._objData.id_seguimientos);

        fetch("controller/seguimientosController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                this.listarSeguimientos();
                Swal.fire({
                    title: "Seguimiento eliminado 🐾",
                    color: "#ba88d1",
                    background: "#fff",
                    timer: 1800
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    registrarSeguimiento(){
        let objData = new FormData();
        objData.append("registrarSeguimiento", "ok");
        objData.append("id_adopciones", this._objData.id_adopciones);
        objData.append("fecha_visita", this._objData.fecha_visita);
        objData.append("observacion", this._objData.observacion);

        fetch("controller/seguimientosController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formRegistroSeguimiento").reset();
                $("#panelFormularioSeguimientos").hide();
                $("#panelTablaSeguimientos").show();
                this.listarSeguimientos();
                Swal.fire({
                    title: "Seguimiento registrado 🐕",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    editarSeguimiento(){
        let objData = new FormData();
        objData.append("editarSeguimiento", "ok");
        objData.append("id_seguimientos", this._objData.id_seguimientos);
        objData.append("id_adopciones", this._objData.id_adopciones);
        objData.append("fecha_visita", this._objData.fecha_visita);
        objData.append("observacion", this._objData.observacion);

        fetch("controller/seguimientosController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formEditarSeguimiento").reset();
                $("#panelFormularioEditarSeguimientos").hide();
                $("#panelTablaSeguimientos").show();
                this.listarSeguimientos();
                Swal.fire({
                    title: "Seguimiento actualizado 🐾",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }


    cargarSelect(){
        this.cargarAdopciones();
    }

cargarAdopciones(){
    let objData = new FormData();
    objData.append("listarAdopciones", "ok");

    fetch("controller/adopcionesController.php", {
        method: "POST",
        body: objData
    })
    .then(r => r.json())
    .then(response => {

        if (response["codigo"] == "200") {

            let select = document.getElementById("select_adopciones");
            select.innerHTML = '<option value="">Seleccione una adopción</option>';

            response["listaAdopciones"].forEach(a => {
                select.innerHTML += `
                    <option value="${a.id_adopciones}">
                        ${a.mascota} - ${a.adoptante}
                    </option>
                `;
            });
        }
    });
}



    cargarSelectsEditar(adopcionesSeleccionado) {

        let objDataAdoptantes = new FormData();
        objDataAdoptantes.append("listarAdopciones", "ok");
        fetch("controller/adopcionesController.php", {
            method: 'POST',
            body: objDataAdoptantes
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
            let select = document.getElementById('select_edit_adopciones');
            select.innerHTML = '<option value="">Seleccione un adopciones</option>';
            response["listarAdopciones"].forEach(adopciones => {
                let selected = adoptante.id_adopciones == adopcionesSeleccionado ? "selected" : "";
                select.innerHTML += `<option value="${adopciones.id_adopciones}" ${selected}>
                ${adopciones.observaciones}
                </option>`;
            });
            }
        });
    }

}
