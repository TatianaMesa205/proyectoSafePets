<?php

include_once "conexion.php";

class MascotasModel
{
    public static function mdlListarMascotas()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM mascotas");
            $objRespuesta->execute();
            $listaMascotas = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaMascotas" => $listaMascotas);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarMascota($id_mascotas)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM mascotas WHERE id_mascotas=:id_mascotas");
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La mascota se eliminó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la mascota.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarMascota($nombre, $especie, $raza, $edad, $sexo, $tamano, $fecha_ingreso, $estado_salud, $estado, $descripcion, $imagen)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO mascotas(nombre, especie, raza, edad, sexo, tamano, fecha_ingreso, estado_salud, estado, descripcion, imagen)
                VALUES (:nombre, :especie, :raza, :edad, :sexo, :tamano, :fecha_ingreso, :estado_salud, :estado, :descripcion, :imagen)");
            $objRespuesta->bindParam(":nombre", $nombre);
            $objRespuesta->bindParam(":especie", $especie);
            $objRespuesta->bindParam(":raza", $raza);
            $objRespuesta->bindParam(":edad", $edad);
            $objRespuesta->bindParam(":sexo", $sexo);
            $objRespuesta->bindParam(":tamano", $tamano);
            $objRespuesta->bindParam(":fecha_ingreso", $fecha_ingreso);
            $objRespuesta->bindParam(":estado_salud", $estado_salud);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":imagen", $imagen);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Mascota registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la mascota.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    

    public static function mdlEditarMascota($id_mascotas, $nombre, $especie, $raza, $edad, $sexo, $tamano, $fecha_ingreso, $estado_salud, $estado, $descripcion, $imagen)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE mascotas 
                SET nombre=:nombre, especie=:especie, raza=:raza, edad=:edad, sexo=:sexo, tamano=:tamano, fecha_ingreso=:fecha_ingreso, estado_salud=:estado_salud, estado=:estado, descripcion=:descripcion, imagen=:imagen
                WHERE id_mascotas=:id_mascotas");
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);
            $objRespuesta->bindParam(":nombre", $nombre);
            $objRespuesta->bindParam(":especie", $especie);
            $objRespuesta->bindParam(":raza", $raza);
            $objRespuesta->bindParam(":edad", $edad);
            $objRespuesta->bindParam(":sexo", $sexo);
            $objRespuesta->bindParam(":tamano", $tamano);
            $objRespuesta->bindParam(":fecha_ingreso", $fecha_ingreso);
            $objRespuesta->bindParam(":estado_salud", $estado_salud);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":imagen", $imagen);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Mascota editada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la mascota.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    
    static public function mdlContarMascotas(){
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM mascotas");
        $stmt->execute();
        return $stmt->fetch(); // Retorna array con 'total'
    }

    public static function mdlObtenerMascotaPorId($id_mascotas)
    {
        try {
            $sql = "SELECT * FROM mascotas WHERE id_mascotas = ?";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute([$id_mascotas]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

}
?>
