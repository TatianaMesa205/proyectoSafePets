document.addEventListener('DOMContentLoaded', function () {
    const formLogin = document.getElementById('formLogin');
    const formRegistro = document.getElementById('formRegistro');
    const btnLogout = document.getElementById('btnLogout');

    // Manejo del formulario de login
    if (formLogin) {
        formLogin.addEventListener('submit', function (e) {
            e.preventDefault();

            if (this.checkValidity()) {
                const nombre_usuario = document.getElementById('nombre_usuario').value;
                const contrasena = document.getElementById('contrasena').value;

                const formData = new FormData();
                formData.append('accion', 'login');
                formData.append('nombre_usuario', nombre_usuario);
                formData.append('contrasena', contrasena);

                fetch('controller/loginController.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.codigo === "200") {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Bienvenido!',
                                text: 'Inicio de sesión exitoso',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Redirigir según el rol
                                if (data.usuario.rol === 'admin') {
                                    window.location.href = 'plantilla.php?ruta=admin';
                                } else if (data.usuario.rol === 'adoptante') {
                                    window.location.href = 'plantilla.php?ruta=inicio';
                                } else {
                                    window.location.href = 'plantilla.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.mensaje
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al iniciar sesión. Por favor, intente de nuevo.'
                        });
                    });
            } else {
                this.classList.add('was-validated');
            }
        });
    }

    // Manejo del formulario de registro
    if (formRegistro) {
        formRegistro.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validar que las contraseñas coincidan
            const contrasena = document.getElementById('contrasena').value;
            const confirmarContrasena = document.getElementById('confirmar_contrasena').value;

            if (contrasena !== confirmarContrasena) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas no coinciden'
                });
                return;
            }

            if (this.checkValidity()) {
                const nombre_usuario = document.getElementById('nombre_usuario').value;
                const email = document.getElementById('email').value;

                const formData = new FormData();
                formData.append('accion', 'registro');
                formData.append('nombre_usuario', nombre_usuario);
                formData.append('email', email);
                formData.append('contrasena', contrasena);

                fetch('controller/loginController.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.codigo === "201") {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Registro exitoso!',
                                text: data.mensaje
                            }).then(() => {
                                window.location.href = 'login.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.mensaje
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al registrar. Por favor, intente de nuevo.'
                        });
                    });
            } else {
                this.classList.add('was-validated');
            }
        });
    }

    // Manejo del logout
    if (btnLogout) {
        btnLogout.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Cerrar sesión?',
                text: "¿Estás seguro de que quieres cerrar sesión?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d6baa5',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('accion', 'logout');

                    fetch('controller/loginController.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.codigo === "200") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sesión cerrada',
                                    text: data.mensaje,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = 'plantilla.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.mensaje
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al cerrar sesión. Por favor, intente de nuevo.'
                            });
                        });
                }
            });
        });
    }
});

// Función para crear administradores (solo disponible para admins)
function crearAdmin() {
    Swal.fire({
        title: 'Crear Administrador',
        html: `
            <input type="text" id="admin_usuario" class="swal2-input" placeholder="Nombre de usuario">
            <input type="email" id="admin_email" class="swal2-input" placeholder="Email">
            <input type="password" id="admin_password" class="swal2-input" placeholder="Contraseña">
        `,
        confirmButtonText: 'Crear Admin',
        confirmButtonColor: '#d6baa5',
        focusConfirm: false,
        preConfirm: () => {
            const usuario = document.getElementById('admin_usuario').value;
            const email = document.getElementById('admin_email').value;
            const password = document.getElementById('admin_password').value;

            if (!usuario || !email || !password) {
                Swal.showValidationMessage('Todos los campos son obligatorios');
                return false;
            }

            return { usuario, email, password };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('accion', 'crear_admin');
            formData.append('nombre_usuario', result.value.usuario);
            formData.append('email', result.value.email);
            formData.append('contrasena', result.value.password);

            fetch('controller/loginController.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.codigo === "201") {
                        Swal.fire('¡Éxito!', data.mensaje, 'success');
                    } else {
                        Swal.fire('Error', data.mensaje, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Problema al crear el administrador', 'error');
                });
        }
    });
}