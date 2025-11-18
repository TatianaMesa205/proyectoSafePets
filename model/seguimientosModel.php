<?php
include_once "conexion.php";

class SeguimientosMascotasModel
{

    public static function mdlListarSeguimientos()
    {
        $mensaje = array();
        try {

            $sql = "
                SELECT 
                    s.id_seguimientos,
                    s.fecha_visita,
                    s.observacion,
                    a.id_adopciones,
                    a.fecha_adopcion,
                    ad.nombre_completo AS adoptante,
                    m.nombre AS mascota
                FROM seguimientos_mascotas s
                JOIN adopciones a ON a.id_adopciones = s.id_adopciones
                JOIN adoptantes ad ON ad.id_adoptantes = a.id_adoptantes
                JOIN mascotas m ON m.id_mascotas = a.id_mascotas
                ORDER BY s.id_seguimientos DESC
            ";

            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->execute();
            $lista = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);

            $mensaje = array("codigo" => "200", "listaSeguimientos" => $lista);

        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarSeguimiento($id_adopciones, $fecha_visita, $observacion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO seguimientos_mascotas (id_adopciones, fecha_visita, observacion)
                VALUES (:id_adopciones, :fecha_visita, :observacion)
            ");
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones);
            $objRespuesta->bindParam(":fecha_visita", $fecha_visita);
            $objRespuesta->bindParam(":observacion", $observacion);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento registrado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar el seguimiento.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEditarSeguimiento($id_seguimientos, $id_adopciones, $fecha_visita, $observacion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE seguimientos_mascotas 
                SET id_adopciones = :id_adopciones, fecha_visita = :fecha_visita, observacion = :observacion
                WHERE id_seguimientos = :id_seguimientos
            ");
            $objRespuesta->bindParam(":id_seguimientos", $id_seguimientos);
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones);
            $objRespuesta->bindParam(":fecha_visita", $fecha_visita);
            $objRespuesta->bindParam(":observacion", $observacion);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento editado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar el seguimiento.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarSeguimiento($id_seguimientos)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM seguimientos_mascotas WHERE id_seguimientos = :id_seguimientos");
            $objRespuesta->bindParam(":id_seguimientos", $id_seguimientos);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento eliminado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar el seguimiento.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
