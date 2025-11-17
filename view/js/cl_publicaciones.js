class Publicaciones {
    constructor(objData) {
        this._objData = objData;
    }

    /* ============================
       RECARGAR TABLA
    ============================= */
    recargarTabla() {
        let obj = new Publicaciones({ listarPublicaciones: "ok" });
        obj.listarPublicaciones();
    }

    listarPublicaciones() {
        let objData = new FormData();
        objData.append("listarPublicaciones", this._objData.listarPublicaciones);

        fetch("controller/publicacionesController.php", {
            method: "POST",
            body: objData
        })
            .then(response => response.json())
            .then(response => {
                if (response["codigo"] == "200") {
                    let dataSet = [];

                    response["listaPublicaciones"].forEach(item => {
                        let objBotones = `
                            <div class="btn-group" role="group">
                                <button id="btn-editarPublicacion" type="button" class="btn" 
                                    style="background-color:#d3a67c;color:white"
                                    publicacion="${item.id_publicaciones}"
                                    tipo="${item.tipo}"
                                    descripcion="${item.descripcion}"
                                    foto="${item.foto}"
                                    fecha="${item.fecha_publicacion}"
                                    contacto="${item.contacto}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button id="btn-eliminarPublicacion" type="button" class="btn" 
                                    style="background-color:#706e78;color:white"
                                    publicacion="${item.id_publicaciones}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>`;

                        dataSet.push([
                            item.tipo,
                            item.descripcion,
                            item.fecha_publicacion,
                            item.contacto,
                            `<img src="${item.foto}" alt="foto" width="80" height="80" style="object-fit:cover;border-radius:10px;">`,
                            objBotones
                        ]);
                    });

                    $("#tablaPublicaciones").DataTable({
                        dom: "Bfrtip",
                        responsive: true,
                        destroy: true,
                        data: dataSet
                    });
                }
            })
            .catch(error => console.error("Error al listar:", error));
    }

    eliminarPublicacion() {
        let objData = new FormData();
        objData.append("eliminarPublicacion", this._objData.eliminarPublicacion);
        objData.append("id_publicaciones", this._objData.id_publicaciones);

        fetch("controller/publicacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
                this.recargarTabla();
                Swal.fire({
                    title:"Publicacion eliminada correctamente 🐾",
                    color:"#ba88d1",
                    background:"#fff",
                    timer:1500
                });
            } else {
                Swal.fire("Error", response["mensaje"], "error");
            }
        });
    }

    registrarPublicacion() {
        let objData = new FormData();
        objData.append("registrarPublicacion", "ok");
        objData.append("tipo", this._objData.tipo);
        objData.append("descripcion", this._objData.descripcion);
        objData.append("fecha_publicacion", this._objData.fecha_publicacion);
        objData.append("contacto", this._objData.contacto);
        objData.append("foto", this._objData.foto);

        fetch("controller/publicacionesController.php", {
            method: "POST",
            body: objData
        })
            .then(response => response.json())
            .then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire("Éxito", "Publicación registrada correctamente 🐶📢", "success");
                    document.getElementById("formRegistroPublicacion").reset();
                    $("#panelFormularioPublicaciones").hide();
                    $("#panelTablaPublicaciones").show();
                    this.recargarTabla();
                } else {
                    Swal.fire("Error", response["mensaje"], "error");
                }
            })
            .catch(error => console.error("Error:", error));
    }

    editarPublicacion() {
        let objData = new FormData();
        objData.append("editarPublicacion", "ok");
        objData.append("id_publicaciones", this._objData.id_publicaciones);
        objData.append("tipo", this._objData.tipo);
        objData.append("descripcion", this._objData.descripcion);
        objData.append("fecha_publicacion", this._objData.fecha_publicacion);
        objData.append("contacto", this._objData.contacto);
        objData.append("foto_actual", this._objData.foto_actual);

        if (this._objData.foto) {
            objData.append("foto", this._objData.foto);
        }

        fetch("controller/publicacionesController.php", {
            method: "POST",
            body: objData
        })
            .then(response => response.json())
            .then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire("Éxito", "Publicación editada correctamente ✏️", "success");
                    document.getElementById("formEditarPublicacion").reset();
                    $("#panelFormularioEditarPublicaciones").hide();
                    $("#panelTablaPublicaciones").show();
                    this.recargarTabla();
                } else {
                    Swal.fire("Error", response["mensaje"], "error");
                }
            })
            .catch(error => console.error("Error:", error));
    }
}
