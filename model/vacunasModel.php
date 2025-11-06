<?php
include_once "conexion.php";

class VacunasModel
{
    public static function mdlListarVacunas()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM vacunas");
            $objRespuesta->execute();
            $listaVacunas = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaVacunas" => $listaVacunas);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlRegistrarVacuna($nombre_vacuna, $tiempo_aplicacion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO vacunas (nombre_vacuna, tiempo_aplicacion) 
                VALUES (:nombre_vacuna, :tiempo_aplicacion)
            ");
            $objRespuesta->bindParam(":nombre_vacuna", $nombre_vacuna);
            $objRespuesta->bindParam(":tiempo_aplicacion", $tiempo_aplicacion);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Vacuna registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la vacuna.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEditarVacuna($id_vacunas, $nombre_vacuna, $tiempo_aplicacion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE vacunas 
                SET nombre_vacuna = :nombre_vacuna, tiempo_aplicacion = :tiempo_aplicacion 
                WHERE id_vacunas = :id_vacunas
            ");
            $objRespuesta->bindParam(":id_vacunas", $id_vacunas);
            $objRespuesta->bindParam(":nombre_vacuna", $nombre_vacuna);
            $objRespuesta->bindParam(":tiempo_aplicacion", $tiempo_aplicacion);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Vacuna editada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la vacuna.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarVacuna($id_vacunas)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM vacunas WHERE id_vacunas = :id_vacunas");
            $objRespuesta->bindParam(":id_vacunas", $id_vacunas);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Vacuna eliminada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la vacuna.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
