<?php
$fechaActual = date("Y-m-d");
?>

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
    max-width: 750px;
    margin: 30px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 25px;
    box-shadow: 0 6px 20px #00000025;
    font-family: "Poppins", sans-serif;
}

.titulo-principal {
    text-align: center;
    font-size: 28px;
    color: #3f5930;
    margin-bottom: 25px;
}

/* Labels */
.label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    color: #3f5930;
    font-weight: bold;
}

/* Campos */
.input, .textarea, .input-file {
    width: 100%;
    padding: 14px;
    border-radius: 18px;
    border: 2px solid #cfe3c9;
    background: #e7f3df;
    font-size: 16px;
    outline: none;
}

.input:focus, .textarea:focus {
    border-color: #9dbc91;
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


