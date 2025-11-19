<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-user-cog"></i> Gestión de Adoptantes
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarAdoptantes" class="btn btn-add">
      <i class="fas fa-plus"></i> Agregar Adoptante
    </button>
  </div>

  <!-- Panel de tabla -->
  <div id="panelTablaAdoptantes" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaAdoptantes" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Nombre completo</th>
          <th>Cédula</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario de agregar -->
  <div id="panelFormularioAdoptantes" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Adoptante</h4>
    <form id="formRegistroAdoptantes" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
            <label>Nombre completo</label>
            <input type="text" class="form-control rounded-3" id="txt_nombre_completo" required>
        </div>
        <div class="col-md-6">
            <label>Cédula</label>
            <input type="text" class="form-control rounded-3" id="txt_cedula" required>
        </div>
        <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" class="form-control rounded-3" id="txt_telefono" required>
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" class="form-control rounded-3" id="txt_email" required>
        </div>
        <div class="col-md-6">
            <label>Dirección</label>
            <input type="text" class="form-control rounded-3" id="txt_direccion" required>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarAdoptante" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario de editar -->
  <div id="panelFormularioEditarAdoptantes" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Adoptante</h4>
    <form id="formEditarAdoptantes" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre completo</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_nombre_completo" required>
        </div>
        <div class="col-md-6">
          <label>Cédula</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_cedula" required>
        </div>
        <div class="col-md-6">
          <label>Teléfono</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_telefono" required>
        </div>
        <div class="col-md-6">
          <label>Email</label>
          <input type="email" class="form-control rounded-3" id="txt_edit_email" required>
        </div>
        <div class="col-md-6">
          <label>Dirección</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_direccion" required>   
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarAdoptante" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarAdoptante" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
