<?php

include_once "conexion.php";

class CitasModel
{

    public static function mdlListarCitas()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT citas.id_citas, citas.fecha_cita, citas.estado, citas.motivo, adoptantes.nombre_completo as adoptantes, mascotas.nombre as mascotas
                 FROM citas 
                 JOIN adoptantes ON adoptantes.id_adoptantes = citas.adoptantes_id_adoptantes
                 JOIN mascotas ON mascotas.id_mascotas = citas.mascotas_id_mascotas");
            $objRespuesta->execute();
            $listaCitas = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $objRespuesta = null;
            $mensaje = array("codigo" => "200", "listaCitas" => $listaCitas);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarCita($id_citas)
    {

        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM citas WHERE id_citas=:id_citas");
            $objRespuesta->bindParam(":id_citas", $id_citas);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La cita se elimino correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la cita.");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlRegistrarCita($adoptanteId, $mascotaId, $fechaCita, $estado, $motivo)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO citas(adoptantes_id_adoptantes, mascotas_id_mascotas, fecha_cita, estado, motivo) VALUES (:adoptantes_id, :mascotas_id, :fecha_cita, :estado, :motivo)");
            $objRespuesta->bindParam(":adoptantes_id", $adoptanteId);
            $objRespuesta->bindParam(":mascotas_id", $mascotaId);
            $objRespuesta->bindParam(":fecha_cita", $fechaCita);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":motivo", $motivo);

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

    public static function mdlEditarCita($idMascota, $nombreM, $edadM)
    {
        $mensaje = array();

        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE citas SET id_adoptantes=:id_adoptantes, id_mascotas=:id_mascotas, fecha_cita=:fecha_cita, estado=:estado, motivo=:motivo WHERE id_citas=:id_citas");
            $objRespuesta->bindParam(":id_adoptantes", $adoptanteId);
            $objRespuesta->bindParam(":id_mascotas", $mascotaId);
            $objRespuesta->bindParam(":idmascota", $idMascota);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "El usuario se editó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar el usuario");
            }
            $objRespuesta = null;


        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
}