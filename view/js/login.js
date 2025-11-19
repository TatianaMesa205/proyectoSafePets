document.addEventListener("DOMContentLoaded", () => {
  const formLogin = document.getElementById("formLogin")
  const formRegistro = document.getElementById("formRegistro")
  const btnLogout = document.getElementById("btnLogout")
  const Swal = window.Swal


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
              text: "Hubo un problema al iniciar sesión. Por favor, intente de nuevo.",
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

  // Manejo del formulario de registro
  if (formRegistro) {
    formRegistro.addEventListener("submit", function (e) {
      e.preventDefault()

      const contrasena = document.getElementById("contrasena").value
      const confirmarContrasena = document.getElementById("confirmar_contrasena").value

      if (contrasena !== confirmarContrasena) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Las contraseñas no coinciden",
        })
        return
      }

      if (contrasena.length < 6) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "La contraseña debe tener al menos 6 caracteres",
        })
        return
      }

      if (this.checkValidity()) {
        const submitBtn = this.querySelector('button[type="submit"]')
        const originalText = submitBtn.innerHTML
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...'
        submitBtn.disabled = true

        const nombre_usuario = document.getElementById("nombre_usuario").value.trim()
        const email = document.getElementById("email").value.trim()

        const formData = new FormData()
        formData.append("accion", "registro")
        formData.append("nombre_usuario", nombre_usuario)
        formData.append("email", email)
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
            if (data.codigo === "201") {
              Swal.fire({
                icon: "success",
                title: "¡Registro exitoso!",
                text: data.mensaje,
              }).then(() => {
                window.location.href = "index.php?ruta=login"
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
              text: "Hubo un problema al registrar. Por favor, intente de nuevo.",
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

  // Manejo del logout
  if (btnLogout) {
    btnLogout.addEventListener("click", (e) => {
      e.preventDefault()

      Swal.fire({
        title: "¿Cerrar sesión?",
        text: "¿Estás seguro de que quieres cerrar sesión?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d6baa5",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, cerrar sesión",
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
                  text: data.mensaje,
                  showConfirmButton: false,
                  timer: 1500,
                }).then(() => {
                  window.location.href = "index.php"
                })
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: data.mensaje,
                })
              }
            })
            .catch((error) => {
              console.error("Error:", error)
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hubo un problema al cerrar sesión. Por favor, intente de nuevo.",
              })
            })
        }
      })
    })
  }
})

function crearAdmin() {
  const Swal = window.Swal // Declare the Swal variable
  Swal.fire({
    title: "Crear Administrador",
    html: `
            <div class="mb-3">
                <input type="text" id="admin_usuario" class="swal2-input" placeholder="Nombre de usuario" maxlength="50">
            </div>
            <div class="mb-3">
                <input type="email" id="admin_email" class="swal2-input" placeholder="Email" maxlength="100">
            </div>
            <div class="mb-3">
                <input type="password" id="admin_password" class="swal2-input" placeholder="Contraseña (mín. 6 caracteres)" minlength="6">
            </div>
        `,
    confirmButtonText: "Crear Admin",
    confirmButtonColor: "#d6baa5",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    focusConfirm: false,
    preConfirm: () => {
      const usuario = document.getElementById("admin_usuario").value.trim()
      const email = document.getElementById("admin_email").value.trim()
      const password = document.getElementById("admin_password").value

      if (!usuario || !email || !password) {
        Swal.showValidationMessage("Todos los campos son obligatorios")
        return false
      }

      if (password.length < 6) {
        Swal.showValidationMessage("La contraseña debe tener al menos 6 caracteres")
        return false
      }

      // Validate email format
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!emailRegex.test(email)) {
        Swal.showValidationMessage("El formato del email no es válido")
        return false
      }

      return { usuario, email, password }
    },
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData()
      formData.append("accion", "crear_admin")
      formData.append("nombre_usuario", result.value.usuario)
      formData.append("email", result.value.email)
      formData.append("contrasena", result.value.password)

      fetch("controller/loginController.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.codigo === "201") {
            Swal.fire("¡Éxito!", data.mensaje, "success")
          } else {
            Swal.fire("Error", data.mensaje, "error")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
          Swal.fire("Error", "Problema al crear el administrador", "error")
        })
    }
  })
}
