<div class="container py-4">

  <h2 class="text-center mb-4 titulo-donaciones">
    <i class="fas fa-heart"></i> Donaciones
  </h2>

  <p class="text-center descripcion-donaciones">
    ¡Tu apoyo es fundamental! Cada donación nos ayuda a seguir rescatando,
    cuidando y encontrando hogares para nuestros animalitos.
  </p>

  <div id="panelFormularioDonaciones" class="form-donacion-card">
    <h4 class="text-center titulo-form">Realizar una donación</h4>

    <form id="formRegistroDonacion" novalidate>
      <div class="mb-3">
        <label class="label-cafe">Monto a Donar (en COP)</label>
        <input 
          type="number" 
          id="txt_monto" 
          class="form-control input-cafe" 
          required 
          placeholder="$5.000"
          min="5000"
        >
        <div class="invalid-feedback">
          Por favor ingresa un monto (mínimo 5000 COP).
        </div>
      </div>

      <div class="text-center mt-4">
        <button class="btn btn-donar" type="submit">Donar Ahora</button>
      </div>
    </form>
  </div>

  <div id="panelTablaDonaciones" style="display:none;"></div>

</div>
<?php include("pie.php"); ?>

<style>
  /* TITULO */
.titulo-donaciones {
  color: #8b5e3c;
  font-family: "Poppins", sans-serif;
  font-size: 32px;
}

.titulo-donaciones i {
  color: #d5b292;
}

/* TEXTO INFORMATIVO */
.descripcion-donaciones {
  max-width: 600px;
  margin: 0 auto 20px auto;
  font-size: 16px;
  color: #6b4f3a;
  font-family: "Poppins", sans-serif;
}

/* TARJETA FORMULARIO */
.form-donacion-card {
  background: #fff;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  max-width: 550px;
  margin: 0 auto;
  border: 1px solid #e8d7c8;
}

/* TÍTULO DEL FORM */
.titulo-form {
  color: #6b4f3a;
  font-weight: 600;
  margin-bottom: 20px;
}

/* LABEL */
.label-cafe {
  color: #6b4f3a;
  font-weight: 500;
  margin-bottom: 5px;
  display: block;
  font-family: "Poppins", sans-serif;
}

/* INPUT */
.input-cafe {
  border: 1px solid #c9b29c !important;
  border-radius: 10px;
  padding: 10px;
}

.input-cafe:focus {
  border-color: #a07048 !important;
  box-shadow: 0 0 4px rgba(160, 112, 72, 0.4);
}

/* BOTÓN */
.btn-donar {
  background-color: #d5b292;
  color: #fff;
  padding: 10px 35px;
  border-radius: 12px;
  border: none;
  font-size: 16px;
  font-weight: 600;
  transition: 0.3s ease;
}

.btn-donar:hover {
  background-color: #b88f6d;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
</style>