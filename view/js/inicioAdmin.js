function crearAdmin() {
    Swal.fire({
        title: 'Registrar Nuevo Administrador',
        html: `
            <div class="text-start">
                <label class="form-label fw-bold">Nombre de Usuario</label>
                <input type="text" id="new_admin_user" class="form-control mb-3" placeholder="Ej: admin2">
                
                <label class="form-label fw-bold">Correo Electrónico</label>
                <input type="email" id="new_admin_email" class="form-control mb-3" placeholder="correo@ejemplo.com">
                
                <label class="form-label fw-bold">Contraseña</label>
                <input type="password" id="new_admin_pass" class="form-control" placeholder="******">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-save me-2"></i>Crear Admin',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#4b3832', 
        preConfirm: () => {
            const usuario = Swal.getPopup().querySelector('#new_admin_user').value;
            const email = Swal.getPopup().querySelector('#new_admin_email').value;
            const pass = Swal.getPopup().querySelector('#new_admin_pass').value;

            if (!usuario || !email || !pass) {
                Swal.showValidationMessage('Por favor completa todos los campos');
                return false;
            }

            return { usuario, email, pass };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('accion', 'crear_admin');
            formData.append('nombre_usuario', result.value.usuario);
            formData.append('email', result.value.email);
            formData.append('contrasena', result.value.pass);

            Swal.fire({
                title: 'Creando...',
                didOpen: () => Swal.showLoading()
            });

            fetch('controller/loginController.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.codigo === '200') {
                    Swal.fire('¡Éxito!', 'Administrador creado correctamente', 'success');
                } else {
                    Swal.fire('Error', data.mensaje || 'No se pudo crear el usuario', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'Fallo de conexión con el servidor', 'error');
            });
        }
    });
}