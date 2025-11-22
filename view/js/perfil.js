document.addEventListener("DOMContentLoaded", function() {
    
    const formPerfil = document.getElementById("formPerfil");

    if(formPerfil){
        formPerfil.addEventListener("submit", function(e) {
            e.preventDefault();

            const nombre = document.getElementById("nombre_usuario").value;
            const pass = document.getElementById("password").value;
            const confirmPass = document.getElementById("confirm_password").value;

            // Validaciones
            if (nombre.trim() === "") {
                Swal.fire({ icon: "error", title: "Oops...", text: "El nombre es obligatorio" });
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
                        text: 'Serás redirigido al inicio.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // --- REDIRECCIÓN AL INICIO ---
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
                Swal.fire("Error", "Error de conexión", "error");
            });
        });
    }
});