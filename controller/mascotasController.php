<?php
// Usamos __DIR__ para evitar errores de rutas
include_once __DIR__ . "/../model/mascotasModel.php";

class MascotasController
{
    public $id_mascotas;
    public $nombre;
    public $especie;
    public $raza;
    public $edad;
    public $sexo;
    public $tamano;
    public $fecha_ingreso;
    public $estado_salud;
    public $estado;
    public $descripcion;
    public $imagen;

    static public function ctrContarMascotas(){
        return MascotasModel::mdlContarMascotas();
    }

    public function ctrListarMascotas()
    {
        $objRespuestaMascota = MascotasModel::mdlListarMascotas();
        echo json_encode($objRespuestaMascota);
    }

    public function ctrEliminarMascota()
    {
        $objRespuestaMascota = MascotasModel::mdlEliminarMascota($this->id_mascotas);
        echo json_encode($objRespuestaMascota);
    }

    public function ctrRegistrarMascota()
    {
        $objRespuestaMascota = MascotasModel::mdlRegistrarMascota(
            $this->nombre, 
            $this->especie, 
            $this->raza, 
            $this->edad,
            $this->sexo, 
            $this->tamano,
            $this->fecha_ingreso,
            $this->estado_salud, 
            $this->estado, 
            $this->descripcion, 
            $this->imagen
        );
        echo json_encode($objRespuestaMascota);
    }

    public function ctrEditarMascota()
    {
        $objRespuestaMascota = MascotasModel::mdlEditarMascota(
            $this->id_mascotas, 
            $this->nombre, 
            $this->especie, 
            $this->raza, 
            $this->edad, 
            $this->sexo, 
            $this->tamano, 
            $this->fecha_ingreso, 
            $this->estado_salud, 
            $this->estado, 
            $this->descripcion, 
            $this->imagen
        );
        echo json_encode($objRespuestaMascota);
    }
}



if (isset($_POST["listarMascotas"]) && $_POST["listarMascotas"] == "ok") {
    $objMascotas = new MascotasController();
    $objMascotas->ctrListarMascotas();
}

if (isset($_POST["eliminarMascota"]) == "ok") {
    $objMascotas = new MascotasController();
    $objMascotas->id_mascotas = $_POST["id_mascotas"];
    $objMascotas->ctrEliminarMascota();
}

// --- LOGICA DE REGISTRO CORREGIDA ---
if (isset($_POST["registrarMascota"]) == "ok") {
    $objMascotas = new MascotasController();
    $objMascotas->nombre = $_POST["nombre"];
    $objMascotas->especie = $_POST["especie"];
    $objMascotas->raza = $_POST["raza"];
    $objMascotas->edad = $_POST["edad"];
    $objMascotas->sexo = $_POST["sexo"];
    $objMascotas->tamano = $_POST["tamano"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];

    $nombreImagen = ""; // Variable para la BD

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        // 1. Definimos la carpeta física
        $directorio = "../../CarpetaCompartida/Mascotas/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        // 2. Definimos el nombre único del archivo
        $nombreArchivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
        
        // 3. Movemos el archivo a la carpeta completa
        $rutaFisica = $directorio . $nombreArchivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFisica);

        // 4. Guardamos SOLO el nombre en la variable para la BD
        $nombreImagen = $nombreArchivo;
    }
    
    $objMascotas->imagen = $nombreImagen;
    $objMascotas->ctrRegistrarMascota();
}

// --- LOGICA DE EDICIÓN CORREGIDA ---
if (isset($_POST["editarMascota"]) && $_POST["editarMascota"] == "ok") {

    $objMascotas = new MascotasController();
    $objMascotas->id_mascotas = $_POST["id_mascotas"];
    $objMascotas->nombre = $_POST["nombre"];
    $objMascotas->especie = $_POST["especie"];
    $objMascotas->raza = $_POST["raza"];
    $objMascotas->edad = $_POST["edad"];
    $objMascotas->sexo = $_POST["sexo"];
    $objMascotas->tamano = $_POST["tamano"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];

    $nombreImagen = ""; 

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        // Si suben nueva imagen, repetimos el proceso
        $directorio = "../../CarpetaCompartida/Mascotas/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $nombreArchivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
        
        // Mover a carpeta completa
        $rutaFisica = $directorio . $nombreArchivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFisica);

        // Guardar solo nombre
        $nombreImagen = $nombreArchivo;

    } else {
        $nombreImagen = isset($_POST["imagen_actual"]) ? $_POST["imagen_actual"] : "";
    }

    $objMascotas->imagen = $nombreImagen;
    $objMascotas->ctrEditarMascota();
}
?>