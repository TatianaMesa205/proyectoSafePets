<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-heart"></i> Gestión de Adopciones
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarAdopcion" class="btn btn-add">
      <i class="fas fa-plus"></i> Registrar Adopción
    </button>
  </div>

  <!-- Panel tabla -->
  <div id="panelTablaAdopciones" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaAdopciones" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Mascota</th>
          <th>Adoptante</th>
          <th>Fecha adopción</th>
          <th>Estado</th>
          <th>Observaciones</th>
          <th>Contrato</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario registrar adopción -->
  <div id="panelFormularioAdopciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Adopción</h4>
    <form id="formRegistroAdopcion" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="select_mascotas" class="form-label">Mascota</label>
          <select class="form-select" id="select_mascotas" required>
              <option value="">Seleccione una mascota</option>
          </select>
          <div class="invalid-feedback">
              Por favor seleccione una mascota.
          </div>
        </div>
        <div class="col-md-6">
          <label for="select_adoptantes" class="form-label">Adoptante</label>
          <select class="form-select" id="select_adoptantes" required>
              <option value="">Seleccione un adoptante</option>
          </select>
          <div class="invalid-feedback">
              Por favor seleccione un adoptante.
          </div>
        </div>
        <div class="col-md-6">
          <label>Fecha de adopción</label>
          <input type="date" class="form-control rounded-3" id="txt_fecha_adopcion" required>
        </div>
        <div class="col-md-6">
          <label>Estado</label>
          <select id="select_estado" class="form-select rounded-3" required>
            <option value="">Seleccione...</option>
            <option value="En proceso">En proceso</option>
            <option value="Adoptado">Adoptado</option>
            <option value="Rechazado">Rechazado</option>
          </select>
        </div>
        <div class="col-md-12">
          <label>Observaciones</label>
          <textarea id="txt_observaciones" class="form-control rounded-3" rows="3"></textarea>
        </div>
        <div class="col-md-12">
          <label>Contrato (PDF o imagen)</label>
          <input type="file" id="file_contrato" class="form-control rounded-3" accept=".pdf,.jpg,.jpeg,.png">
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarAdopcion" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario editar adopción -->
  <div id="panelFormularioEditarAdopciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Adopción</h4>
    <form id="formEditarAdopcion" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="select_edit_mascotas" class="form-label">Mascota</label>
          <select class="form-select" id="select_edit_mascotas" required>
              <option value="">Seleccione una mascota</option>
          </select>
          <div class="invalid-feedback">
              Por favor seleccione una mascota.
          </div>
        </div>
        <div class="col-md-6">
          <label for="select_edit_adoptantes" class="form-label">Adoptante</label>
          <select class="form-select" id="select_edit_adoptantes" required>
              <option value="">Seleccione un adoptante</option>
          </select>
          <div class="invalid-feedback">
              Por favor seleccione un adoptante.
          </div>
        </div>
        <div class="col-md-6">
          <label>Fecha de adopción</label>
          <input type="date" class="form-control rounded-3" id="txt_edit_fecha_adopcion" required>
        </div>
        <div class="col-md-6">
          <label>Estado</label>
          <select id="select_edit_estado" class="form-select rounded-3" required>
            <option value="En proceso">En proceso</option>
            <option value="Adoptado">Adoptado</option>
            <option value="Rechazado">Rechazado</option>
          </select>
        </div>
        <div class="col-md-12">
          <label>Observaciones</label>
          <textarea id="txt_edit_observaciones" class="form-control rounded-3" rows="3"></textarea>
        </div>
        <div class="col-md-12">
            <label>Contrato (PDF o imagen)</label>

            <!-- 🔥 ESTE ES EL LINK QUE FALTABA -->
            <a id="linkContratoActual" 
              href="#" 
              target="_blank" 
              class="btn btn-outline-primary btn-sm mb-2"
              style="display:none;">
              Ver contrato actual
            </a>

            <input type="file" id="file_edit_contrato" class="form-control rounded-3" accept=".pdf,.jpg,.jpeg,.png">
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarAdopcion" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarAdopcion" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
<?php include("pie.php"); ?>
