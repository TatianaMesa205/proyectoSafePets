document.addEventListener("DOMContentLoaded", function() {
    
    const formPerfil = document.getElementById("formPerfil");

    if(formPerfil){
        formPerfil.addEventListener("submit", function(e) {
            e.preventDefault();

            const nombre = document.getElementById("nombre_usuario").value;
            const pass = document.getElementById("password").value;
            const confirmPass = document.getElementById("confirm_password").value;

            if (nombre.trim() === "") {
                Swal.fire({ icon: "error", title: "Oops...", text: "El nombre de usuario es obligatorio" });
                return;
            }

            if (pass !== "" && pass !== confirmPass) {
                Swal.fire({ icon: "error", title: "Error", text: "Las contraseñas no coinciden." });
                return;
            }

            if (pass !== "" && pass.length < 4) {
                 Swal.fire({ icon: "warning", title: "Cuidado", text: "La contraseña es muy corta." });
                 return;
            }

            const formData = new FormData();
            formData.append("accion", "actualizar_perfil");
            formData.append("nombre_usuario", nombre);
            formData.append("password", pass);

            const isAdoptante = document.getElementById("is_adoptante");
            
            if (isAdoptante) {
                const idAdp = document.getElementById("id_adoptante_form").value;
                const nombreCompleto = document.getElementById("nombre_completo").value;
                const cedula = document.getElementById("cedula").value;
                const telefono = document.getElementById("telefono").value;
                const direccion = document.getElementById("direccion").value;
                const email = document.getElementById("email_adoptante").value;

                if (nombreCompleto.trim() === "" || cedula.trim() === "" || telefono.trim() === "" || direccion.trim() === "") {
                    Swal.fire({ icon: "warning", title: "Datos incompletos", text: "Por favor complete todos los campos personales." });
                    return;
                }

                formData.append("editar_adoptante", "true");
                formData.append("id_adoptantes", idAdp);
                formData.append("nombre_completo", nombreCompleto);
                formData.append("cedula", cedula);
                formData.append("telefono", telefono);
                formData.append("direccion", direccion);
                formData.append("email_adoptante", email);
            }

            Swal.fire({
                title: 'Guardando...',
                text: 'Por favor espere',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            fetch("controller/loginController.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.codigo === "200") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Perfil Actualizado!',
                        text: 'Los cambios se han guardado correctamente.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        if(data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload(); 
                        }
                    });
                } else {
                    Swal.fire("Error", data.mensaje, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "Error de conexión o respuesta inválida", "error");
            });
        });
    }
});