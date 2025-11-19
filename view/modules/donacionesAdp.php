<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-heart"></i> Donaciones
  </h2>
  
  <p class="text-center mb-4">
    ¡Tu apoyo es fundamental! Cada donación nos ayuda a seguir rescatando,
    cuidando y encontrando hogares para nuestros animalitos.
  </p>

  <div id="panelFormularioDonaciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="max-width: 600px; margin: auto;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Realizar una donación</h4>
    
    <form id="formRegistroDonacion" novalidate>
      <div class="row g-3">
        <div class="col-md-12">
            <label>Monto a Donar (en COP)</label>
            <input type="number" id="txt_monto" class="form-control rounded-3" required placeholder="5000" min="5000">
             <div class="invalid-feedback">
                Por favor ingresa un monto (mínimo 5000 COP).
            </div>
        </div>
      </div>
      
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Donar Ahora </button>
        
        </div>
    </form>
  </div>
  
  <div id="panelTablaDonaciones" style="display:none;">
      </div>

</div>