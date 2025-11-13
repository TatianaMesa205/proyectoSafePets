(function () {
    listarTablaPublicaciones();

    function listarTablaPublicaciones() {
        let objData = { listarPublicaciones: "ok" };
        let objTabla = new Publicaciones(objData);
        objTabla.listarPublicaciones();
    }

    // Mostrar formularios
    $("#btn-AgregarPublicacion").on("click", () => {
        $("#panelTablaPublicaciones").hide();
        $("#panelFormularioPublicaciones").show();
    });

    $("#btn-RegresarPublicacion").on("click", () => {
        $("#panelFormularioPublicaciones").hide();
        $("#panelTablaPublicaciones").show();
    });

    $("#btn-RegresarEditarPublicacion").on("click", () => {
        $("#panelFormularioEditarPublicaciones").hide();
        $("#panelTablaPublicaciones").show();
    });

    // 🗑️ Eliminar
    $("#tablaPublicaciones").on("click", "#btn-eliminarPublicacion", function () {
        Swal.fire({
            title: "¿Está seguro?",
            text: "No podrá recuperar este registro.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                let id_publicaciones = $(this).attr("publicacion");
                let objData = { eliminarPublicacion: "ok", id_publicaciones };
                let obj = new Publicaciones(objData);
                obj.eliminarPublicacion();
            }
        });
    });

    // ✏️ Editar
    $("#tablaPublicaciones").on("click", "#btn-editarPublicacion", function () {
        $("#panelTablaPublicaciones").hide();
        $("#panelFormularioEditarPublicaciones").show();

        let id_publicaciones = $(this).attr("publicacion");
        let tipo = $(this).attr("tipo");
        let descripcion = $(this).attr("descripcion");
        let foto = $(this).attr("foto");
        let fecha_publicacion = $(this).attr("fecha");
        let contacto = $(this).attr("contacto");

        $("#txt_edit_tipo").val(tipo);
        $("#txt_edit_descripcion").val(descripcion);
        $("#txt_edit_fecha_publicacion").val(fecha_publicacion);
        $("#txt_edit_contacto").val(contacto);
        $("#btnEditarPublicacion").attr("publicacion", id_publicaciones);
        $("#txt_edit_foto_actual").val(foto);
    });

    // 🐾 Registrar
    $("#formRegistroPublicacion").on("submit", function (event) {
        event.preventDefault();

        let tipo = $("#txt_tipo").val();
        let descripcion = $("#txt_descripcion").val();
        let fecha_publicacion = $("#txt_fecha_publicacion").val();
        let contacto = $("#txt_contacto").val();
        let foto = $("#txt_foto")[0].files[0];

        let objData = { tipo, descripcion, fecha_publicacion, contacto, foto };
        let obj = new Publicaciones(objData);
        obj.registrarPublicacion();
    });

    // 📝 Editar
    $("#formEditarPublicacion").on("submit", function (event) {
        event.preventDefault();

        let id_publicaciones = $("#btnEditarPublicacion").attr("publicacion");
        let tipo = $("#txt_edit_tipo").val();
        let descripcion = $("#txt_edit_descripcion").val();
        let fecha_publicacion = $("#txt_edit_fecha_publicacion").val();
        let contacto = $("#txt_edit_contacto").val();
        let foto = $("#txt_edit_foto")[0].files[0];
        let foto_actual = $("#txt_edit_foto_actual").val();

        let objData = {
            id_publicaciones,
            tipo,
            descripcion,
            fecha_publicacion,
            contacto,
            foto,
            foto_actual
        };

        let obj = new Publicaciones(objData);
        obj.editarPublicacion();
    });
})();
