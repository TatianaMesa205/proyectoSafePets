class VacunasMascotas {
    constructor(objData){
        this._objData = objData;
    }

    listarVacunasMascotas(){
        let objData = new FormData();
        objData.append("listarVacunasMascotas", this._objData.listarVacunasMascotas);

        fetch("controller/vacunasMascotasController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .catch(e => console.log(e))
        .then(response => {
            if (response["codigo"] == "200") {
                let dataSet = [];
                response["listaVacunasMascotas"].forEach(item => {
                    let botones = `
                        <div class="btn-group">
                            <button id="btn-editarVacunaMascota" class="btn" style="background-color:pink;border-color:pink;color:white"
                                vacuna_mascota="${item.id_vacunas_mascotas}"
                                mascota="${item.id_mascotas}"
                                vacuna="${item.id_vacunas}"
                                fecha_aplicacion="${item.fecha_aplicacion}"
                                proxima_dosis="${item.proxima_dosis}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button id="btn-eliminarVacunaMascota" class="btn" style="background-color:rgb(158,147,223);color:white"
                                vacuna_mascota="${item.id_vacunas_mascotas}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    dataSet.push([
                        item.id_vacunas_mascotas,
                        item.id_mascotas,
                        item.id_vacunas,
                        item.fecha_aplicacion,
                        item.proxima_dosis,
                        botones
                    ]);
                });

                $("#tablaVacunasMascotas").DataTable({
                    destroy: true,
                    responsive: true,
                    dom: "Bfrtip",
                    buttons: ["colvis", "excel", "pdf", "print"],
                    data: dataSet
                });
            }
        });
    }

    eliminarVacunaMascota(){
        let objData = new FormData();
        objData.append("eliminarVacunaMascota", this._objData.eliminarVacunaMascota);
        objData.append("id_vacunas_mascotas", this._objData.id_vacunas_mascotas);

        fetch("controller/vacunasMascotasController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                this.listarVacunasMascotas();
                Swal.fire({
                    title: "Registro eliminado correctamente 💉",
                    color: "#ba88d1",
                    background: "#fff",
                    timer: 1800
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    registrarVacunaMascota(){
        let objData = new FormData();
        objData.append("registrarVacunaMascota", "ok");
        objData.append("id_mascotas", this._objData.id_mascotas);
        objData.append("id_vacunas", this._objData.id_vacunas);
        objData.append("fecha_aplicacion", this._objData.fecha_aplicacion);
        objData.append("proxima_dosis", this._objData.proxima_dosis);

        fetch("controller/vacunasMascotasController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formRegistroVacunaMascota").reset();
                $("#panelFormularioVacunasMascotas").hide();
                $("#panelTablaVacunasMascotas").show();
                this.listarVacunasMascotas();
                Swal.fire({
                    title: "Vacuna aplicada correctamente 🐶",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    editarVacunaMascota(){
        let objData = new FormData();
        objData.append("editarVacunaMascota", "ok");
        objData.append("id_vacunas_mascotas", this._objData.id_vacunas_mascotas);
        objData.append("id_mascotas", this._objData.id_mascotas);
        objData.append("id_vacunas", this._objData.id_vacunas);
        objData.append("fecha_aplicacion", this._objData.fecha_aplicacion);
        objData.append("proxima_dosis", this._objData.proxima_dosis);

        fetch("controller/vacunasMascotasController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formEditarVacunaMascota").reset();
                $("#panelFormularioEditarVacunasMascotas").hide();
                $("#panelTablaVacunasMascotas").show();
                this.listarVacunasMascotas();
                Swal.fire({
                    title: "Registro actualizado 💊",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }
}
