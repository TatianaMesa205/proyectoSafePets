class Donaciones {
    constructor(objData){
        this._objData = objData;
    }

    listarDonaciones(){
        let objData = new FormData();
        objData.append("listarDonaciones", this._objData.listarDonaciones);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .catch(e => console.log(e))
        .then(response => {
            if (response["codigo"] == "200") {
                let dataSet = [];
                response["listaDonaciones"].forEach(item => {
                    let botones = `
                        <div class="btn-group">
                            <button id="btn-editarDonacion" class="btn" style="background-color:pink;border-color:pink;color:white"
                                donacion="${item.id_donaciones}"
                                usuario="${item.id_usuarios}"
                                monto="${item.monto}"
                                fecha="${item.fecha_donacion}"
                                metodo_pago="${item.metodo_pago}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button id="btn-eliminarDonacion" class="btn" style="background-color:rgb(158,147,223);color:white"
                                donacion="${item.id_donaciones}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    dataSet.push([
                        item.id_usuarios,
                        item.monto,
                        item.fecha_donacion,
                        item.metodo_pago,
                        botones
                    ]);
                });

                $("#tablaDonaciones").DataTable({
                    destroy: true,
                    responsive: true,
                    dom: "Bfrtip",
                    buttons: ["colvis", "excel", "pdf", "print"],
                    data: dataSet
                });
            }
        });
    }

    eliminarDonacion(){
        let objData = new FormData();
        objData.append("eliminarDonacion", this._objData.eliminarDonacion);
        objData.append("id_donaciones", this._objData.id_donaciones);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                this.listarDonaciones();
                Swal.fire({
                    title: "Donación eliminada correctamente 💸",
                    color: "#ba88d1",
                    background: "#fff",
                    timer: 1800
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    registrarDonacion(){
        let objData = new FormData();
        objData.append("registrarDonacion", "ok");
        objData.append("id_usuarios", this._objData.id_usuarios);
        objData.append("monto", this._objData.monto);
        objData.append("fecha_donacion", this._objData.fecha_donacion);
        objData.append("metodo_pago", this._objData.metodo_pago);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formRegistroDonacion").reset();
                $("#panelFormularioDonaciones").hide();
                $("#panelTablaDonaciones").show();
                this.listarDonaciones();
                Swal.fire({
                    title: "Donación registrada 💖",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    editarDonacion(){
        let objData = new FormData();
        objData.append("editarDonacion", "ok");
        objData.append("id_donaciones", this._objData.id_donaciones);
        objData.append("id_usuarios", this._objData.id_usuarios);
        objData.append("monto", this._objData.monto);
        objData.append("fecha_donacion", this._objData.fecha_donacion);
        objData.append("metodo_pago", this._objData.metodo_pago);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formEditarDonacion").reset();
                $("#panelFormularioEditarDonaciones").hide();
                $("#panelTablaDonaciones").show();
                this.listarDonaciones();
                Swal.fire({
                    title: "Donación actualizada 💰",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }
}
