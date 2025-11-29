<?php
// Usamos __DIR__ para rutas relativas seguras
include_once __DIR__ . "/../model/publicacionesModel.php";

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



if (isset($_POST["listarPublicaciones"]) && $_POST["listarPublicaciones"] == "ok") {
    $obj = new PublicacionesController();
    $obj->ctrListarPublicaciones();
}

if (isset($_POST["eliminarPublicacion"]) && $_POST["eliminarPublicacion"] == "ok") {
    $obj = new PublicacionesController();
    $obj->id_publicaciones = $_POST["id_publicaciones"];
    $obj->ctrEliminarPublicacion();
}

// --- REGISTRAR ---
if (isset($_POST["registrarPublicacion"]) && $_POST["registrarPublicacion"] == "ok") {
    $obj = new PublicacionesController();
    $obj->tipo = $_POST["tipo"];
    $obj->descripcion = $_POST["descripcion"];
    $obj->fecha_publicacion = $_POST["fecha_publicacion"];
    $obj->contacto = $_POST["contacto"];

    $nombreGuardarBD = ""; 

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        // Ruta para subir al servidor
        $directorio = "../../CarpetaCompartida/Publicaciones/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $rutaDestino = $directorio . $nombreArchivo; 
        
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino)){
            $nombreGuardarBD = $nombreArchivo;
        }
    }
    
    $obj->foto = $nombreGuardarBD;
    $obj->ctrRegistrarPublicacion();
}

// --- EDITAR ---
if (isset($_POST["editarPublicacion"]) && $_POST["editarPublicacion"] == "ok") {
    $obj = new PublicacionesController();
    $obj->id_publicaciones = $_POST["id_publicaciones"];
    $obj->tipo = $_POST["tipo"];
    $obj->descripcion = $_POST["descripcion"];
    $obj->fecha_publicacion = $_POST["fecha_publicacion"];
    $obj->contacto = $_POST["contacto"];

    $nombreGuardarBD = "";

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        // Si hay nueva foto, procesamos la subida
        $directorio = "../../CarpetaCompartida/Publicaciones/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $rutaDestino = $directorio . $nombreArchivo;
        
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino)){
            $nombreGuardarBD = $nombreArchivo;
        }
    } else {
        // Si no, mantenemos la anterior
        $fotoActual = isset($_POST["foto_actual"]) ? $_POST["foto_actual"] : "";
        $nombreGuardarBD = basename($fotoActual);
    }

    $obj->foto = $nombreGuardarBD;
    $obj->ctrEditarPublicacion();
}
?>