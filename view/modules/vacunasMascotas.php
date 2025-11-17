<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-syringe"></i> Gestión de Vacunas
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarVacunaMascota" class="btn btn-add">
      <i class="fas fa-plus"></i> Registrar Vacuna de la mascota
    </button>
  </div>

  <!-- Panel tabla -->
  <div id="panelTablaVacunasMascotas" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaVacunasMascotas" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Mascota</th>
          <th>Nombre Vacuna</th>
          <th>Fecha Aplicación</th>
          <th>Próxima Dosis</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario registrar -->
  <div id="panelFormularioVacunasMascotas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Vacunas de la mascota</h4>
    <form id="formRegistroVacunaMascota" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Mascota</label>
          <select id="select_mascota" class="form-select" required></select>
        </div>
        <div class="col-md-6">
          <label>Nombre de la Vacuna</label>
          <select id="select_vacuna" class="form-select" required></select>
        </div>
        <div class="col-md-6">
          <label>Fecha Aplicación</label>
          <input type="date" id="txt_fecha_aplicacion" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Próxima Dosis</label>
          <input type="date" id="txt_proxima_dosis" class="form-control" required>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarVacunaMascota" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario editar -->
  <div id="panelFormularioEditarVacunasMascotas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Vacuna de la mascota </h4>
    <form id="formEditarVacunaMascota" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Mascota</label>
          <select id="select_edit_mascota" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Nombre de la Vacuna</label>
          <select id="select_edit_vacuna" class="form-select rounded-3" required></select>
        </div>  
        <div class="col-md-6">
          <label>Fecha Aplicación</label>
          <input type="date" id="txt_edit_fecha_aplicacion" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Próxima Dosis</label>
          <input type="date" id="txt_edit_proxima_dosis" class="form-control rounded-3">
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarVacunaMascota" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarVacunaMascota" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

</div>