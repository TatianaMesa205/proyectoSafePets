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
                    adopciones.id_adopciones,
                    adopciones.fecha_adopcion,
                    adopciones.estado,
                    adopciones.observaciones,
                    adopciones.contrato,
                    adoptantes.nombre_completo AS adoptante,
                    mascotas.nombre AS mascota
                FROM adopciones
                JOIN adoptantes ON adoptantes.id_adoptantes = adopciones.id_adoptantes
                JOIN mascotas ON mascotas.id_mascotas = adopciones.id_mascotas
            ");
            $objRespuesta->execute();
            $listaAdopciones = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $objRespuesta = null;
            $mensaje = array("codigo" => "200", "listaAdopciones" => $listaAdopciones);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarAdopcion($id_adopciones)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                DELETE FROM adopciones WHERE id_adopciones = :id_adopciones
            ");
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La adopción se eliminó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la adopción.");
            }

            $objRespuesta = null;
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

            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            $objRespuesta->bindParam(":fecha_adopcion", $fecha_adopcion);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":observaciones", $observaciones);
            $objRespuesta->bindParam(":contrato", $contrato);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adopción registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la adopción.");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


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

            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            $objRespuesta->bindParam(":fecha_adopcion", $fecha_adopcion);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":observaciones", $observaciones);
            $objRespuesta->bindParam(":contrato", $contrato);
            $objRespuesta->bindParam(":id_adopciones", $id_adopciones);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La adopción se editó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la adopción.");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
}
