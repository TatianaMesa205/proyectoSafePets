<?php
include_once "conexion.php";

class AdopcionesModel
{
 
    public static function mdlListarAdopciones()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                SELECT 
                    a.id_adopciones,
                    a.id_mascotas,
                    a.id_adoptantes,
                    a.fecha_adopcion,
                    a.estado,
                    a.observaciones,
                    a.contrato,
                    m.nombre AS nombre_mascota,
                    ad.nombre_completo AS nombre_adoptante
                FROM adopciones a
                INNER JOIN mascotas m ON a.id_mascotas = m.id_mascotas
                INNER JOIN adoptantes ad ON a.id_adoptantes = ad.id_adoptantes
                ORDER BY a.id_adopciones DESC
            ");
            $objRespuesta->execute();
            $listaAdopciones = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaAdopciones" => $listaAdopciones);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    /* ============================
       ELIMINAR ADOPCIÓN
    ============================ */
    public static function mdlEliminarAdopcion($id_adopciones)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                DELETE FROM adopciones WHERE id_adopciones = :id_adopciones
            ");
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones, PDO::PARAM_INT);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La adopción fue eliminada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la adopción.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

  
    public static function mdlRegistrarAdopcion($id_mascotas, $id_adoptantes, $fecha_adopcion, $estado, $observaciones, $contrato)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO adopciones (id_mascotas, id_adoptantes, fecha_adopcion, estado, observaciones, contrato)
                VALUES (:id_mascotas, :id_adoptantes, :fecha_adopcion, :estado, :observaciones, :contrato)
            ");
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha_adopcion", $fecha_adopcion);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":observaciones", $observaciones);
            $objRespuesta->bindParam(":contrato", $contrato);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adopción registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la adopción.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    /* ============================
       EDITAR ADOPCIÓN
    ============================ */
    public static function mdlEditarAdopcion($id_adopciones, $id_mascotas, $id_adoptantes, $fecha_adopcion, $estado, $observaciones, $contrato)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE adopciones 
                SET 
                    id_mascotas = :id_mascotas,
                    id_adoptantes = :id_adoptantes,
                    fecha_adopcion = :fecha_adopcion,
                    estado = :estado,
                    observaciones = :observaciones,
                    contrato = :contrato
                WHERE id_adopciones = :id_adopciones
            ");

            $objRespuesta->bindParam(":id_mascotas", $id_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha_adopcion", $fecha_adopcion);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":observaciones", $observaciones);
            $objRespuesta->bindParam(":contrato", $contrato);
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones, PDO::PARAM_INT);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La adopción fue editada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la adopción.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
