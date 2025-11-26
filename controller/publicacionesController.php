<?php
include_once "../model/publicacionesModel.php";

class PublicacionesController
{
    public $id_publicaciones;
    public $tipo;
    public $descripcion;
    public $foto;
    public $fecha_publicacion;
    public $contacto;

    public function ctrListarPublicaciones()
    {
        $objRespuesta = PublicacionesModel::mdlListarPublicaciones();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarPublicacion()
    {
        $objRespuesta = PublicacionesModel::mdlEliminarPublicacion($this->id_publicaciones);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarPublicacion()
    {
        $objRespuesta = PublicacionesModel::mdlRegistrarPublicacion(
            $this->tipo,
            $this->descripcion,
            $this->foto,
            $this->fecha_publicacion,
            $this->contacto
        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarPublicacion()
    {
        $objRespuesta = PublicacionesModel::mdlEditarPublicacion(
            $this->id_publicaciones,
            $this->tipo,
            $this->descripcion,
            $this->foto,
            $this->fecha_publicacion,
            $this->contacto
        );
        echo json_encode($objRespuesta);
    }
}

// ---------------------------------------------------
// MANEJO DE PETICIONES
// ---------------------------------------------------

if (isset($_POST["listarPublicaciones"]) && $_POST["listarPublicaciones"] == "ok") {
    $obj = new PublicacionesController();
    $obj->ctrListarPublicaciones();
}

if (isset($_POST["eliminarPublicacion"]) && $_POST["eliminarPublicacion"] == "ok") {
    $obj = new PublicacionesController();
    $obj->id_publicaciones = $_POST["id_publicaciones"];
    $obj->ctrEliminarPublicacion();
}

// --- REGISTRAR (CORREGIDO) ---
if (isset($_POST["registrarPublicacion"])) {
    $obj = new PublicacionesController();
    $obj->tipo = $_POST["tipo"];
    $obj->descripcion = $_POST["descripcion"];
    $obj->fecha_publicacion = $_POST["fecha_publicacion"];
    $obj->contacto = $_POST["contacto"];

    $nombreGuardarBD = ""; // Variable para la base de datos

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $directorio = "../../CarpetaCompartida/Publicaciones/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        // Generamos el nombre único
        $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        
        // Ruta completa SOLO para mover el archivo físico
        $rutaDestino = $directorio . $nombreArchivo; 
        
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino)){
            // Si se movió correctamente, guardamos SOLO el nombre en la variable del modelo
            $nombreGuardarBD = $nombreArchivo;
        }
    }
    
    $obj->foto = $nombreGuardarBD;
    $obj->ctrRegistrarPublicacion();
}

// --- EDITAR (CORREGIDO) ---
if (isset($_POST["editarPublicacion"])) {
    $obj = new PublicacionesController();
    $obj->id_publicaciones = $_POST["id_publicaciones"];
    $obj->tipo = $_POST["tipo"];
    $obj->descripcion = $_POST["descripcion"];
    $obj->fecha_publicacion = $_POST["fecha_publicacion"];
    $obj->contacto = $_POST["contacto"];

    $nombreGuardarBD = "";

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $directorio = "../../CarpetaCompartida/Publicaciones/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $rutaDestino = $directorio . $nombreArchivo;
        
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino)){
            $nombreGuardarBD = $nombreArchivo; // Guardamos solo el nombre nuevo
        }
    } else {
        // Si no sube foto nueva, mantenemos la anterior.
        // Usamos basename() por seguridad, en caso de que la BD antigua tenga rutas completas.
        $fotoActual = isset($_POST["foto_actual"]) ? $_POST["foto_actual"] : "";
        $nombreGuardarBD = basename($fotoActual);
    }

    $obj->foto = $nombreGuardarBD;
    $obj->ctrEditarPublicacion();
}
?>