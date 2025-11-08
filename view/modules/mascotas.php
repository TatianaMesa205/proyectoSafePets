<div class="container py-4">
    <h2 class="text-center mb-4 text-dark"><i class="fas fa-dog"></i> Gestión de Mascotas</h2>

    <!-- Botón agregar -->
    <div class="d-flex justify-content-end mb-3">
        <button id="btn-AgregarMascotas" class="btn btn-pink" style="background-color:#d5b292ff; color:#fff;">
        <i class="fas fa-plus"></i> Agregar Mascota
        </button>
    </div>

    <!-- Panel de tabla -->
    <div id="panelTablaMascotas">
        <table id="tablaMascotas" class="table table-striped table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
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
    <div id="panelFormularioMascotas" style="display:none;">
        <h4 class="mb-3">Registrar Mascota</h4>
        <form id="formRegistroMascotas" novalidate>
        <div class="row">
            <div class="col-md-6 mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" id="txt_nombre" required>
            </div>
            <div class="col-md-6 mb-3">
            <label>Especie</label>
            <input type="text" class="form-control" id="txt_especie" required>
            </div>
            <div class="col-md-6 mb-3">
            <label>Raza</label>
            <input type="text" class="form-control" id="txt_raza" required>
            </div>
            <div class="col-md-6 mb-3">
            <label>Edad</label>
            <input type="number" class="form-control" id="txt_edad" required>
            </div>
            <div class="col-md-6 mb-3">
            <label>Sexo</label>
            <select id="select_sexo" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Macho">Macho</option>
                <option value="Hembra">Hembra</option>
            </select>
            </div>
            <div class="col-md-6 mb-3">
            <label>Tamaño</label>
            <select id="select_tamano" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Pequeño">Pequeño</option>
                <option value="Mediano">Mediano</option>
                <option value="Grande">Grande</option>
            </select>
            </div>
            <div class="col-md-6 mb-3">
            <label>Fecha de Ingreso</label>
            <input type="date" class="form-control" id="txt_fecha_ingreso" required>
            </div>
            <div class="col-md-6 mb-3">
            <label>Estado de Salud</label>
            <input type="text" class="form-control" id="txt_estado_salud" required>
            </div>
            <div class="col-md-12 mb-3">
                <label>Descripción</label>
                <textarea class="form-control" id="txt_descripcion" rows="3" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
            <label>Estado</label>
            <select id="select_estado" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Disponible">Disponible</option>
                <option value="Adoptado">Adoptado</option>
            </select>
            </div>
            <div class="col-md-12 mb-3">
                <label>Imagen URL</label>
                <input type="text" class="form-control" id="txt_imagen" required>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button class="btn" type="submit">Guardar</button>
            <button id="btn-RegresarMascota" class="btn btn-secondary" type="button">Regresar</button>
        </div>
        </form>
    </div>

    <!-- Formulario de editar -->
    <div id="panelFormularioEditarMascotas" style="display:none;">
    <h4 class="mb-3">Editar Mascota</h4>
    <form id="formEditarMascotas" novalidate>
        <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" id="txt_edit_nombre" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Especie</label>
            <input type="text" class="form-control" id="txt_edit_especie" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Raza</label>
            <input type="text" class="form-control" id="txt_edit_raza" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Edad</label>
            <input type="number" class="form-control" id="txt_edit_edad" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Sexo</label>
            <select id="select_edit_sexo" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Tamaño</label>
            <select id="select_edit_tamano" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Fecha de Ingreso</label>
            <input type="date" class="form-control" id="txt_edit_fecha_ingreso" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Estado de Salud</label>
            <input type="text" class="form-control" id="txt_edit_estado_salud" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Descripción</label>
            <textarea class="form-control" id="txt_edit_descripcion" rows="3" required></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label>Estado</label>
            <select id="select_edit_estado" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Disponible">Disponible</option>
            <option value="Adoptado">Adoptado</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label>Imagen URL</label>
            <input type="text" class="form-control" id="txt_edit_imagen" required>
        </div>
        </div>
        <div class="d-flex gap-2">
        <button id="btnEditarMascota" class="btn" type="submit" style="background-color:#d5b292ff; color:#fff;">Guardar Cambios</button>
        <button id="btn-RegresarEditarMascota" class="btn btn-secondary" type="button">Regresar</button>
        </div>
    </form>
    </div>

</div>


