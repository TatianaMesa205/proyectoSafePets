<?php
include_once "conexion.php";

class PublicacionesModel
{
    public static function mdlListarPublicaciones()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM publicaciones");
            $objRespuesta->execute();
            $lista = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaPublicaciones" => $lista);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarPublicacion($tipo, $descripcion, $foto, $fecha_publicacion, $contacto)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO publicaciones (tipo, descripcion, foto, fecha_publicacion, contacto)
                VALUES (:tipo, :descripcion, :foto, :fecha_publicacion, :contacto)
            ");
            $objRespuesta->bindParam(":tipo", $tipo);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":foto", $foto);
            $objRespuesta->bindParam(":fecha_publicacion", $fecha_publicacion);
            $objRespuesta->bindParam(":contacto", $contacto);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Publicación registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la publicación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEditarPublicacion($id_publicaciones, $tipo, $descripcion, $foto, $fecha_publicacion, $contacto)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE publicaciones 
                SET tipo = :tipo, descripcion = :descripcion, foto = :foto, fecha_publicacion = :fecha_publicacion, contacto = :contacto 
                WHERE id_publicaciones = :id_publicaciones
            ");
            $objRespuesta->bindParam(":id_publicaciones", $id_publicaciones);
            $objRespuesta->bindParam(":tipo", $tipo);
            $objRespuesta->bindParam(":descripcion", $descripcion);
            $objRespuesta->bindParam(":foto", $foto);
            $objRespuesta->bindParam(":fecha_publicacion", $fecha_publicacion);
            $objRespuesta->bindParam(":contacto", $contacto);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Publicación editada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la publicación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    

    public static function mdlEliminarPublicacion($id_publicaciones)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM publicaciones WHERE id_publicaciones = :id_publicaciones");
            $objRespuesta->bindParam(":id_publicaciones", $id_publicaciones);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Publicación eliminada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la publicación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
