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
          <th>Título</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <th>Contacto</th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <input type="hidden" id="rol_usuario" value="<?php echo $_SESSION['rol']; ?>">

  <div id="panelFormularioPublicaciones" class="form-panel shadow-sm rounded-4 p-4 mt-4" style="display:none;">
    <h4 class="mb-3 text-center text-dark fw-semibold">Nueva Publicación</h4>
    <form id="formRegistroPublicacion" novalidate enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label>Título</label>
          <input type="text" id="txt_tipo" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_fecha_publicacion" class="form-control rounded-3" required>
        </div>
        <div class="col-md-12">
          <label>Descripción</label>
          <textarea id="txt_descripcion" class="form-control rounded-3" rows="4" required></textarea>
        </div>
        <div class="col-md-6">
          <label>Contacto</label>
          <input type="text" id="txt_contacto" class="form-control rounded-3" required>
        </div>
        <div class="col-md-6">
          <label>Imagen</label>
          <input type="file" id="txt_foto" class="form-control rounded-3" accept=".jpg,.jpeg,.png" >
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
      <input type="hidden" id="txt_edit_foto_actual" name="foto_actual">

      <div class="row g-3">
        <div class="col-md-6">
          <label>Título</label>
          <input type="text" id="txt_edit_tipo" name="tipo" class="form-control rounded-3" required>
        </div>

        <div class="col-md-6">
          <label>Fecha</label>
          <input type="date" id="txt_edit_fecha_publicacion" name="fecha_publicacion" class="form-control rounded-3" required>
        </div>

        <div class="col-md-12">
          <label>Descripción</label>
          <textarea id="txt_edit_descripcion" name="descripcion" class="form-control rounded-3" rows="4" required></textarea>
        </div>

        <div class="col-md-6" style="margin-top:22px;">
          <label>Contacto</label>
          <input type="text" id="txt_edit_contacto" name="contacto" class="form-control rounded-3" required style="margin-top:10px;">
        </div>

        <div class="col-md-6">
          <label>Imagen (opcional)</label>
          
          <a id="linkFotoActual" 
            href="#" 
            target="_blank" 
            class="btn btn-outline-primary btn-sm mb-2"
            style="display:none; margin-top: 1px;">
              Ver imagen actual
          </a>

          <input type="file" id="txt_edit_foto" name="foto" class="form-control rounded-3" accept=".jpg,.jpeg,.png">
      </div>

      </div>

      <div class="d-flex gap-2 mt-4 justify-content-center">
        <button id="btnEditarPublicacion" class="btn btn-save" type="submit">Guardar Cambios</button>
        <button id="btn-RegresarEditarPublicacion" class="btn btn-secondary rounded-3" type="button">Regresar</button>
      </div>
    </form>

  </div>
</div>
