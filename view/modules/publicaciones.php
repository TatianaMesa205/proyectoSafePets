<div class="container py-4">
  <h2 class="text-center mb-4 text-dark fw-bold">
    <i class="fas fa-bullhorn"></i> Gestión de Publicaciones
  </h2>

  <div class="d-flex justify-content-end mb-3">
    <button id="btn-AgregarPublicacion" class="btn btn-add">
      <i class="fas fa-plus"></i> Nueva Publicación
    </button>
  </div>

  <div id="panelTablaPublicaciones" class="panel-table shadow-sm rounded-4 p-3">
    <table id="tablaPublicaciones" class="table align-middle table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Contenido</th>
          <th>Fecha</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div id="panelFormularioPublicaciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Nueva Publicación</h4>
    <form id="formRegistroPublicacion" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Título</label>
          <input type="text" id="txt_titulo" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_fecha_publicacion" class="form-control rounded-3" required>
        </div>
        <div class="col-md-12">
          <label>Contenido</label>
          <textarea id="txt_contenido" class="form-control rounded-3" rows="4" required></textarea>
        </div>
        <div class="col-md-12">
          <label>Imagen</label>
          <input type="file" id="file_imagen_publicacion" class="form-control rounded-3" accept=".jpg,.jpeg,.png">
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button class="btn btn-save" type="submit">Publicar</button>
        <button id="btn-RegresarPublicacion" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>

  <div id="panelFormularioEditarPublicaciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Editar Publicación</h4>
    <form id="formEditarPublicacion" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Título</label>
          <input type="text" id="txt_edit_titulo" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_edit_fecha_publicacion" class="form-control rounded-3" required>
        </div>
        <div class="col-md-12">
          <label>Contenido</label>
          <textarea id="txt_edit_contenido" class="form-control rounded-3" rows="4" required></textarea>
        </div>
        <div class="col-md-12">
          <label>Imagen (opcional)</label>
          <input type="file" id="file_edit_imagen_publicacion" class="form-control rounded-3" accept=".jpg,.jpeg,.png">
        </div>
      </div>
      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarPublicacion" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarPublicacion" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>
  </div>
</div>
