document.addEventListener("DOMContentLoaded", () => {
  const formLogin = document.getElementById("formLogin")
  const formRegistro = document.getElementById("formRegistro")
  const btnLogout = document.getElementById("btnLogout")
  const Swal = window.Swal

  // -------------------------------------------------------------------------
  // MANEJO DEL LOGIN
  // -------------------------------------------------------------------------
  if (formLogin) {
    formLogin.addEventListener("submit", function (e) {
      e.preventDefault()

      if (this.checkValidity()) {
        const submitBtn = this.querySelector('button[type="submit"]')
        const originalText = submitBtn.innerHTML
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Iniciando...'
        submitBtn.disabled = true

        const nombre_usuario = document.getElementById("nombre_usuario").value.trim()
        const contrasena = document.getElementById("contrasena").value

        const formData = new FormData()
        formData.append("accion", "login")
        formData.append("nombre_usuario", nombre_usuario)
        formData.append("contrasena", contrasena)

        fetch("controller/loginController.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("Error de red")
            }
            return response.json()
          })
          .then((data) => {
            if (data.codigo === "200") {
              Swal.fire({
                icon: "success",
                title: "¡Bienvenido!",
                text: "Inicio de sesión exitoso",
                showConfirmButton: false,
                timer: 1500,
              }).then(() => {
                window.location.href = data.redirect || "index.php"
              })
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: data.mensaje || "Error desconocido",
              })
            }
          })
          .catch((error) => {
            console.error("Error:", error)
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo un problema al iniciar sesión. Verifica tu conexión.",
            })
          })
          .finally(() => {
            submitBtn.innerHTML = originalText
            submitBtn.disabled = false
          })
      } else {
        this.classList.add("was-validated")
      }
    })
  }

  // -------------------------------------------------------------------------
  // MANEJO DEL REGISTRO DE USUARIO (CORREGIDO)
  // -------------------------------------------------------------------------
  if (formRegistro) {
    formRegistro.addEventListener("submit", function (e) {
      e.preventDefault()

      const contrasena = document.getElementById("contrasena").value
      const confirmarContrasena = document.getElementById("confirmar_contrasena").value

      // Validaciones visuales rápidas
      if (contrasena !== confirmarContrasena) {
        Swal.fire({ icon: "error", title: "Error", text: "Las contraseñas no coinciden" })
        return
      }
      if (contrasena.length < 6) {
        Swal.fire({ icon: "error", title: "Error", text: "La contraseña debe tener al menos 6 caracteres" })
        return
      }

      if (this.checkValidity()) {
        const submitBtn = this.querySelector('button[type="submit"]')
        const originalText = submitBtn.innerHTML
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...'
        submitBtn.disabled = true

        // 1. CAPTURAR DATOS DE CUENTA
        const nombre_usuario = document.getElementById("nombre_usuario").value.trim()
        const email = document.getElementById("email").value.trim()

        // 2. CAPTURAR DATOS PERSONALES (ADOPTANTE) - AGREGADO
        // Usamos .value con validación simple por si acaso el elemento no existe (aunque debería)
        const nombre_completo = document.querySelector('input[name="nombre_completo"]').value.trim()
        const cedula = document.querySelector('input[name="cedula"]').value.trim()
        const telefono = document.querySelector('input[name="telefono"]').value.trim()
        const direccion = document.querySelector('input[name="direccion"]').value.trim()

        const formData = new FormData()
        formData.append("accion", "registro")
        
        // Agregar datos al FormData
        formData.append("nombre_usuario", nombre_usuario)
        formData.append("email", email)
        formData.append("contrasena", contrasena)
        
        // Agregar los campos nuevos
        formData.append("nombre_completo", nombre_completo)
        formData.append("cedula", cedula)
        formData.append("telefono", telefono)
        formData.append("direccion", direccion)

        fetch("controller/loginController.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => {
            if (!response.ok) throw new Error("Error de red")
            return response.json()
          })
          .then((data) => {
            // Aceptamos 200 como éxito
            if (data.codigo === "200") {
              Swal.fire({
                icon: "success",
                title: "¡Registro exitoso!",
                text: data.mensaje || "Tu cuenta ha sido creada correctamente.",
                confirmButtonColor: "#d6baa5",
                confirmButtonText: "Ir al Login"
              }).then(() => {
                window.location.href = "index.php?ruta=login"
              })
            } else {
              // Si falla (ej: usuario duplicado)
              Swal.fire({
                icon: "error",
                title: "Atención",
                text: data.mensaje || "No se pudo completar el registro.",
              })
            }
          })
          .catch((error) => {
            console.error("Error:", error)
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo un problema técnico al procesar el registro.",
            })
          })
          .finally(() => {
            submitBtn.innerHTML = originalText
            submitBtn.disabled = false
          })
      } else {
        this.classList.add("was-validated")
      }
    })
  }

  // -------------------------------------------------------------------------
  // MANEJO DEL LOGOUT
  // -------------------------------------------------------------------------
  if (btnLogout) {
    btnLogout.addEventListener("click", (e) => {
      e.preventDefault()

      Swal.fire({
        title: "¿Cerrar sesión?",
        text: "¿Estás seguro de que quieres salir?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d6baa5",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, salir",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          const formData = new FormData()
          formData.append("accion", "logout")

          fetch("controller/loginController.php", {
            method: "POST",
            body: formData,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.codigo === "200") {
                Swal.fire({
                  icon: "success",
                  title: "Sesión cerrada",
                  showConfirmButton: false,
                  timer: 1000,
                }).then(() => {
                  window.location.href = "index.php?ruta=inicioAdp" // Redirige al inicio público
                })
              } else {
                window.location.href = "index.php?ruta=inicioAdp"
              }
            })
            .catch(() => {
              window.location.href = "index.php?ruta=inicioAdp"
            })
        }
      })
    })
  }
})