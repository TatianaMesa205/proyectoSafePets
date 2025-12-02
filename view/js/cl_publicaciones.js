class Publicaciones {
    constructor(objData) {
        this._objData = objData;
    }

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
                // Timestamp para evitar caché de imágenes
                let antiCache = new Date().getTime();

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

                    // --- CORRECCIÓN DE IMAGEN ---
                    let rutaBase = "../CarpetaCompartida/Publicaciones/";
                    let imgHtml = "";

                    if (item.foto && item.foto != "") {
                        imgHtml = `<img src="${rutaBase + item.foto}?v=${antiCache}" alt="foto" width="80" height="80" style="object-fit:cover;border-radius:3 0px;">`;
                    } else {
                        // Imagen por defecto si no hay foto
                        imgHtml = `<img src="view/img/default/anonymous.png" alt="Sin Foto" width="80" height="80" style="object-fit:cover;border-radius:10px;">`;
                    }
                    // ----------------------------

                    dataSet.push([
                        item.tipo,
                        item.descripcion,
                        item.fecha_publicacion,
                        item.contacto,
                        imgHtml, // Usamos la variable con la ruta corregida
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
                    title:"Publicación eliminada correctamente 🐾",
                    color:"#ba88d1",
                    background:"#fff",
                    timer:1500,
                    icon: "success"
                });
            } else {
                Swal.fire("Error", response["mensaje"], "error");
            }
        });
    }

    registrarPublicacion() {
        // Obtenemos el rol, asegurándonos de que el elemento exista
        let rolInput = document.getElementById("rol_usuario");
        let rol = rolInput ? rolInput.value : "";

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
                Swal.fire({
                    title: "Publicación creada 🐾",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    // Si existe el formulario de registro (Admin Panel)
                    let form = document.getElementById("formRegistroPublicacion");
                    if (form) form.reset();

                    if (rol === "admin") {
                        $("#panelFormularioPublicaciones").hide();
                        $("#panelTablaPublicaciones").show();
                        this.recargarTabla();
                    } else {
                        // ADOPTANTE o usuario externo
                        window.location.href = "index.php?ruta=publicacionesAdp";
                    }
                });
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
                
                // Recargar tabla vital para ver cambios
                this.recargarTabla();
            } else {
                Swal.fire("Error", response["mensaje"], "error");
            }
        })
        .catch(error => console.error("Error:", error));
    }
}