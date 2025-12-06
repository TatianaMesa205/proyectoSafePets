<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-dog"></i> Gestión de Mascotas
  </h2>

  <!-- Botón agregar -->
  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarMascotas" class="btn btn-add">
      <i class="fas fa-plus"></i> Agregar Mascota
    </button>
  </div>

  <!-- Panel de tabla -->
  <div id="panelTablaMascotas" class="panel-table shadow-sm rounded-4 p-0">
    <table id="tablaMascotas" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Edad</th>
          <th>Sexo</th>
          <th>Tamaño</th>
          <th>Fecha ingreso</th>
          <th>Estado de salud</th>
          <th>Estado</th>
          <th>Descripción</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Formulario de agregar -->
  <div id="panelFormularioMascotas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Registrar Mascota</h4>
    <form id="formRegistroMascotas" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre</label>
          <input type="text" class="form-control rounded-3" id="txt_nombre" required>
        </div>
        <div class="col-md-6">
          <label>Especie</label>
          <input type="text" class="form-control rounded-3" id="txt_especie" required>
        </div>
        <div class="col-md-6">
          <label>Raza</label>
          <input type="text" class="form-control rounded-3" id="txt_raza" required>
        </div>
        <div class="col-md-6">
          <label>Edad</label>
          <input type="number" class="form-control rounded-3" id="txt_edad" required>
        </div>
        <div class="col-md-6">
          <label>Sexo</label>
          <select id="select_sexo" class="form-select rounded-3" required>
            <option value="">Seleccione</option>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Tamaño</label>
          <select id="select_tamano" class="form-select rounded-3" required>
            <option value="">Seleccione</option>
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Fecha de Ingreso</label>
          <input type="date" class="form-control rounded-3" id="txt_fecha_ingreso" required>
        </div>
        <div class="col-md-6">
          <label>Estado de Salud</label>
          <input type="text" class="form-control rounded-3" id="txt_estado_salud" required>
        </div>
        <div class="col-md-12">
          <label>Descripción de la mascota</label>
          <textarea class="form-control rounded-3" id="txt_descripcion" rows="3" required></textarea>
        </div>
        <div class="col-md-6">
          <label>Estado</label>
          <select id="select_estado" class="form-select rounded-3" required>
            <option value="">Seleccione</option>
            <option value="Disponible">Disponible</option>
            <option value="En Tratamiento">En tratamiento</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Imagen de la mascota</label>
          <input type="file" id="txt_imagen" class="form-control rounded-3" accept=".jpg,.jpeg,.png" >
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Guardar</button>
        <button id="btn-RegresarMascota" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <!-- Formulario de editar -->
  <div id="panelFormularioEditarMascotas" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Mascota</h4>
    <form id="formEditarMascotas" novalidate>
      <input type="hidden" id="txt_edit_imagen_actual" name="imagen_actual">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Nombre</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_nombre" required>
        </div>
        <div class="col-md-6">
          <label>Especie</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_especie" required>
        </div>
        <div class="col-md-6">
          <label>Raza</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_raza" required>
        </div>
        <div class="col-md-6">
          <label>Edad</label>
          <input type="number" class="form-control rounded-3" id="txt_edit_edad" required>
        </div>
        <div class="col-md-6">
          <label>Sexo</label>
          <select id="select_edit_sexo" class="form-select rounded-3" required>
            <option value="">Seleccione</option>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Tamaño</label>
          <select id="select_edit_tamano" class="form-select rounded-3" required>
            <option value="">Seleccione</option>
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Fecha de Ingreso</label>
          <input type="date" class="form-control rounded-3" id="txt_edit_fecha_ingreso" required>
        </div>
        <div class="col-md-6">
          <label>Estado de Salud</label>
          <input type="text" class="form-control rounded-3" id="txt_edit_estado_salud" required>
        </div>
        <div class="col-md-12">
          <label>Descripción de la mascota</label>
          <textarea class="form-control rounded-3" id="txt_edit_descripcion" rows="3" required></textarea>
        </div>
        <div class="col-md-6" style="margin-top:22px;">
          <label>Estado</label>
          <select id="select_edit_estado" class="form-select rounded-3" required style="margin-top:10px;">
            <option value="">Seleccione</option>
            <option value="Disponible">Disponible</option>
            <option value="En Tratamiento">En tratamiento</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Imagen (opcional)</label>

          <a id="linkImagenActualMascota" 
            href="#" 
            target="_blank" 
            class="btn btn-outline-primary btn-sm mb-2"
            style="display:none; margin-top: 1px;">
            Ver imagen actual
          </a>
          <input type="file" id="txt_edit_imagen" name="imagen" class="form-control rounded-3" accept=".jpg,.jpeg,.png">
      </div>

      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarMascota" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarMascota" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
<?php include("pie.php"); ?>

