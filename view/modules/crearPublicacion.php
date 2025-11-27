<?php


date_default_timezone_set('America/Bogota'); // <- AÑADE ESTO
$fechaActual = date("Y-m-d");


?>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="publicacionesAdp">𝓢𝓪𝓯𝓮 𝓟𝓮𝓽𝓼</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            <i class="fa-solid fa-circle-user me-2" style="font-size: 25px; color: #8b5e3c;"></i>

            <?php echo $_SESSION['nombre_usuario']; ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
            <li>
              <a class="dropdown-item" href="perfilAdp">
                <i class="fa-solid fa-user me-2"></i> Mi Perfil
              </a>
            </li>

            <button id="btnLogout" class="btn-logout">
              <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión
            </button>
          </ul>
        </li>

      </ul>
    </div> 
  </div>
</nav>

<div class="form-container">

    <input type="hidden" id="rol_usuario" value="<?php echo $_SESSION['rol']; ?>">


    <h2 class="titulo-principal">Crear Publicación</h2>

    <form id="formRegistroPublicacion" enctype="multipart/form-data">

        <input type="hidden" name="crearPublicacion" value="ok">

        <label class="label">Fecha publicación</label>
        <input type="text" class="input" value="<?php echo date("d/m/Y"); ?>" disabled>
        <input type="hidden" id="txt_fecha_publicacion" value="<?php echo $fechaActual; ?>">

        <label class="label">Tipo</label>
        <input type="text" id="txt_tipo" class="input" placeholder="Ej: Mascota perdida" required>

        <label class="label">Descripción</label>
        <textarea id="txt_descripcion" class="input" rows="4" placeholder="Escribe una descripción..." required></textarea>

        <label class="label">Contacto</label>
        <input type="text" id="txt_contacto" class="input" placeholder="Teléfono" required>

        <label class="label">Imagen</label>

        <div class="imagen-preview-container">
            <img id="previewImagen" class="preview-imagen" src="" alt="Sin imagen">
        </div>

        <label for="txt_foto" class="btn-subir-imagen">
            <i class="fa-solid fa-image"></i> Seleccionar imagen
        </label>

        <input type="file" id="txt_foto" class="input-file" accept=".jpg,.jpeg,.png" hidden>


        <button type="submit" class="btn-crear">Crear Publicación</button>
    </form>
</div>


<style>

.form-container {
    max-width: 1000px;     /* 🔥 ANCHADO */
    width: 90%;            /* Responsivo */
    margin: 40px auto;
    background: #ffffff;
    padding: 40px;         /* Más espacio interno */
    border-radius: 25px;
    box-shadow: 0 6px 20px #00000025;
    font-family: "Poppins", sans-serif;
}

.titulo-principal {
    text-align: center;
    font-size: 32px;       /* Título más grande */
    color: #3f5930;
    margin-bottom: 25px;
}

/* Labels */
.label {
    display: block;
    margin-top: 18px;
    margin-bottom: 6px;
    color: #3f5930;
    font-weight: bold;
    font-size: 17px;
}

/* Campos */
.input, .textarea, .input-file {
    width: 100%;
    padding: 16px;
    border-radius: 18px;
    border: 2px solid #cfe3c9;
    background: #e7f3df;
    font-size: 17px;
    outline: none;
    transition: all .3s ease;
}

.input:focus, .textarea:focus {
    border-color: #8bbf73;
    background: #f5fff0;
}


.textarea {
    height: 140px;
    resize: none;
}

/* Botón */
.btn-crear {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    background: #6f8f63;
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 18px;
    cursor: pointer;
    box-shadow: 0 4px 8px #00000025;
    transition: 0.3s;
}

.btn-crear:hover {
    background: #58724f;
    transform: translateY(-3px);
}

/* Contenedor de la vista previa */
.imagen-preview-container {
    width: 100%;
    height: 230px;
    background: #f4f9f2;
    border: 2px dashed #b7c9b1;
    border-radius: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    margin-bottom: 12px;
    transition: 0.3s;
}

.imagen-preview-container:hover {
    border-color: #8eb089;
}

/* Imagen */
.preview-imagen {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none; /* Oculta hasta que el usuario suba una imagen */
}

/* Botón bonito */
.btn-subir-imagen {
    display: inline-block;
    background: #a4c49c;
    color: white;
    padding: 12px 18px;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 600;
    font-size: 16px;
    box-shadow: 0 4px 10px #00000020;
    transition: 0.3s;
}

.btn-subir-imagen:hover {
    background: #8eb089;
    transform: translateY(-2px);
}

/* Ocultar input nativo */
.input-file {
    display: none;
}


</style>

<script>
document.getElementById("txt_foto").addEventListener("change", function(event){
    const file = event.target.files[0];
    const preview = document.getElementById("previewImagen");

    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.style.display = "block";
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>


<?php include("pie.php"); ?>