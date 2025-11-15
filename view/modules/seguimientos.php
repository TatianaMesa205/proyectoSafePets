<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-paw"></i> Seguimiento de Mascotas
  </h2>

  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarSeguimiento" class="btn btn-add">
      <i class="fas fa-plus"></i> Registrar Seguimiento
    </button>
  </div>

  <div id="panelTablaSeguimientos" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaSeguimientos" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Adopciones</th>
          <th>Fecha de la visita</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div id="panelFormularioSeguimientos" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Seguimiento</h4>
    <form id="formRegistroSeguimientos" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="select_adopciones" class="form-label">Adopciones</label>
          <select class="form-select" id="select_adopciones" required>
              <option value="">Seleccione un adopciones</option>
          </select>
          <div class="invalid-feedback">
              Por favor seleccione un adoptante.
          </div>
        </div>
        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_fecha_seguimiento" class="form-control rounded-3" required>
        </div>
        <div class="col-md-12">
          <label>Observaciones</label>
          <textarea id="txt_observaciones_seguimiento" class="form-control rounded-3" rows="3"></textarea>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarSeguimiento" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <div id="panelFormularioEditarSeguimientos" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Seguimiento</h4>
    <form id="formEditarSeguimientos" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Adoptante</label>
          <select id="select_edit_adoptante_seguimiento" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_edit_fecha_seguimiento" class="form-control rounded-3" required>
        </div>
        <div class="col-md-12">
          <label>Observaciones</label>
          <textarea id="txt_edit_observaciones_seguimiento" class="form-control rounded-3" rows="3"></textarea>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarSeguimiento" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarSeguimiento" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
