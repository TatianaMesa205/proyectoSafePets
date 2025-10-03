 <?php

include_once "conexion.php";

class MascotaModel
{

    public static function mdlListarMascotas(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM mascotas");
            $objRespuesta->execute();
            $listaMascotas = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","listaMascotas"=>$listaMascotas);
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }



    public static function mdlEliminarMascota($id_mascotas)
    {

        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM mascotas WHERE id_mascotas=:id_mascotas");
            $objRespuesta->bindParam(":id_mascotas", $idMascota);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La mascota se elimino correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la mascota.");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlRegistrarMascota($nombre, $especie, $raza, $edad, $sexo, $tamaño, $fecha_ingreso, $estado_salud, $estado, $descripcion, $imagen)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO mascotas(nombre, especie, raza, edad, sexo, tamaño, fecha_ingreso, estado_salud, estado, descripcion, imagen) VALUES (:nombre, :especie, :raza, :edad, :sexo, :tamaño, :fecha_ingreso, :estado_salud, :estado, :descripcion, :imagen)");
            $objRespuesta->bindParam(":nombre", $nombre);
            $objRespuesta->bindParam(":especie", $especie);
            $objRespuesta->bindParam(":raza", $raza);
            $objRespuesta->bindParam(":edad", $edad);
            $objRespuesta->bindParam(":sexo", $sexo);
            $objRespuesta->bindParam(":tamaño", $tamaño);
            $objRespuesta->bindParam(":fecha_ingreso", $fecha_ingreso);
            $objRespuesta->bindParam(":estado_salud", $estado_salud);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":imagen", $imagen);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Mascota registrada correctamente");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la mascota");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mldEditarMascota($id_mascotas, $nombre, $especie, $raza, $edad, $sexo, $tamaño, $fecha_ingreso, $estado_salud, $estado, $descripcion, $imagen)
    {
        $mensaje = array();

        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE mascotas SET nombre=:nombre, especie=:especie, raza=:raza, edad=:edad, sexo=:sexo, tamaño=:tamaño, fecha_ingreso=:fecha_ingreso, estado_salud=:estado_salud, estado=:estado, descripcion=:descripcion, imagen=:imagen WHERE id_mascotas=:id_mascotas");
            $objRespuesta->bindParam(":nombre", $nombre);
            $objRespuesta->bindParam(":especie", $especie);
            $objRespuesta->bindParam(":raza", $raza);
            $objRespuesta->bindParam(":edad", $edad);
            $objRespuesta->bindParam(":sexo", $sexo);
            $objRespuesta->bindParam(":tamaño", $tamaño);
            $objRespuesta->bindParam(":fecha_ingreso", $fecha_ingreso);
            $objRespuesta->bindParam(":estado_salud", $estado_salud);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":imagen", $imagen);
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La mascota se editó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la mascota");
            }
            $objRespuesta = null;


        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
}