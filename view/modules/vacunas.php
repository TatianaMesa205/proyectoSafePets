<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-syringe"></i> Gestión de Vacunas
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarVacuna" class="btn btn-add">
      <i class="fas fa-plus"></i> Registrar Vacuna
    </button>
  </div>

  <!-- Panel tabla -->
  <div id="panelTablaVacunas" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaVacunas" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Nombre de la Vacuna</th>
          <th>Tiempo de la aplicación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario registrar -->
  <div id="panelFormularioVacunas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Vacuna</h4>
    <form id="formRegistroVacuna" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre Vacuna</label>
          <input type="text" id="txt_nombre_vacuna" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Tiempo de la aplicación</label>
          <input type="text" id="txt_tiempo_aplicacion" class="form-control rounded-3" required>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarVacuna" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario editar -->
  <div id="panelFormularioEditarVacunas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Vacuna</h4>
    <form id="formEditarVacuna" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre Vacuna</label>
          <input type="text" id="txt_edit_nombre_vacuna" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Tiempo de la aplicación</label>
          <input type="text" id="txt_edit_tiempo_aplicacion" class="form-control rounded-3" required>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarVacuna" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarVacuna" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
<?php include("pie.php"); ?>
