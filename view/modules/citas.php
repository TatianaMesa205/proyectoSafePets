<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-calendar-check"></i> Gestión de Citas
  </h2>

  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarCitas" class="btn btn-add">
      <i class="fas fa-plus"></i> Registrar Cita
    </button>
  </div>

  <div id="panelTablaCitas" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaCitas" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Mascota</th>
          <th>Adoptante</th>
          <th>Fecha de cita</th>
          <th>Estado</th>
          <th>Motivo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div id="panelFormularioCitas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Cita</h4>
    <form id="formRegistroCitas" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Mascota</label>
          <select id="select_mascotas" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Adoptante</label>
          <select id="select_adoptantes" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Fecha de cita</label>
          <input type="datetime-local" id="txt_fecha_cita" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Estado</label>
          <select id="select_estado" class="form-select rounded-3" required>
            <option value="">Seleccione...</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Confirmada">Confirmada</option>
            <option value="Finalizada">Finalizada</option> <option value="Cancelada">Cancelada</option>
          </select>
        </div>
        <div class="col-md-12">
          <label>Motivo</label>
          <textarea id="txt_motivo" class="form-control rounded-3" rows="3"></textarea>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarCita" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <div id="panelFormularioEditarCitas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Cita</h4>
    <form id="formEditarCitas" novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label>Mascota</label>
          <select id="select_edit_mascotas" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Adoptante</label>
          <select id="select_edit_adoptantes" class="form-select rounded-3" required></select>
        </div>
        <div class="col-md-6">
          <label>Fecha de cita</label>
          <input type="datetime-local" id="txt_edit_fecha_cita" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Estado</label>
          <select id="select_edit_estado" class="form-select rounded-3" required>
            <option value="Pendiente">Pendiente</option>
            <option value="Confirmada">Confirmada</option>
            <option value="Finalizada">Finalizada</option> <option value="Cancelada">Cancelada</option>
          </select>
        </div>
        <div class="col-md-12">
          <label>Motivo</label>
          <textarea id="txt_edit_motivo" class="form-control rounded-3" rows="3"></textarea>
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarCita" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarCita" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
<?php include("pie.php"); ?>