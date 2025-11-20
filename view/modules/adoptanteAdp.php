<?php
// Asegurar que exista la sesión
if (!isset($_SESSION)) {
    session_start();
}

// Validar email del usuario logueado
$emailUsuario = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
?>


<div class="registro-adoptante-container animate-card">

    <h2><i class="fa-solid fa-user-plus"></i> Registro de Adoptante</h2>

    <form action="controller/adoptantesController.php" method="POST" class="form-registro">

        <input type="hidden" name="registrarAdoptante" value="ok">

        <div class="input-group">
            <label><i class="fa-solid fa-user"></i> Nombre completo</label>
            <input type="text" name="nombre_completo" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-envelope"></i> Correo electrónico</label>
            <input type="email" name="email" value="<?php echo $emailUsuario; ?>" readonly class="readonly-input">
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-phone"></i> Teléfono</label>
            <input type="tel" name="telefono" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-location-dot"></i> Dirección</label>
            <input type="text" name="direccion" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-id-card"></i> Documento de identidad</label>
            <input type="text" name="cedula" required>
        </div>

        <button type="submit" class="btn-registrar">
            <i class="fa-solid fa-paw"></i> Registrarme
        </button>

    </form>
</div>


<style>

.registro-adoptante-container {
    max-width: 520px;
    margin: 40px auto;
    background: #fff5ec;
    padding: 35px;
    border-radius: 35px;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.15);
    font-family: "Poppins", sans-serif;
    animation: fadeIn 0.9s ease;
    border: 3px solid #e7d1bf;
}

.registro-adoptante-container h2 {
    text-align: center;
    color: #a07b61;
    margin-bottom: 25px;
    font-size: 30px;
}

.input-group {
    margin-bottom: 18px;
}

.form-registro label {
    font-weight: 600;
    color: #7c5845;
    margin-bottom: 5px;
    display: block;
}

.form-registro input {
    width: 100%;
    padding: 12px;
    border-radius: 15px;
    border: 2px solid #d6c3b7;
    outline: none;
    background: #fff;
    transition: 0.2s;
}

.form-registro input:focus {
    border-color: #a07b61;
    box-shadow: 0 0 8px rgba(160, 123, 97, 0.4);
}

.readonly-input {
    background: #f0e8e3;
    cursor: not-allowed;
}

/* Botón */
.btn-registrar {
    width: 100%;
    padding: 14px;
    background: #a07b61;
    color: #fff;
    border: none;
    border-radius: 18px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-registrar:hover {
    background: #8b5e3c;
    transform: translateY(-3px);
}

/* Animación suave */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}


@keyframes fadeInUp {
    from {opacity: 0; transform: translateY(15px);}
    to {opacity: 1; transform: translateY(0);}
}

@keyframes slideDown {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}

</style>
