<?php

include_once "conexion.php";

class CitasModel
{

    public static function mdlListarCitas()
    {
        $mensaje = array();
        try {
            $objConexion = Conexion::conectar();

            $sql = "
                SELECT 
                    c.id_citas,
                    c.id_mascotas,
                    c.id_adoptantes,
                    c.fecha_cita,
                    c.estado,
                    c.motivo,
                    m.nombre AS nombre_mascota,
                    a.nombre_completo AS nombre_adoptante
                FROM citas c
                INNER JOIN mascotas m ON c.id_mascotas = m.id_mascotas
                INNER JOIN adoptantes a ON c.id_adoptantes = a.id_adoptantes
                ORDER BY c.id_citas DESC
            ";

            $objRespuesta = $objConexion->prepare($sql);
            $objRespuesta->execute();
            $listaCitas = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);

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
            $objRespuesta = Conexion::conectar()->prepare("
                DELETE FROM citas WHERE id_citas = :id_citas
            ");
            $objRespuesta->bindParam(":id_citas", $id_citas, PDO::PARAM_INT);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La cita se eliminó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la cita.");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlRegistrarCita($id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO citas (id_adoptantes, id_mascotas, fecha_cita, estado, motivo)
                VALUES (:id_adoptantes, :id_mascotas, :fecha_cita, :estado, :motivo)
            ");
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas);
            $objRespuesta->bindParam(":fecha_cita", $fecha_cita);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":motivo", $motivo);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Cita registrada correctamente");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la cita");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEditarCita($id_citas, $id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo)
    {
        $mensaje = array();

        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE citas 
                SET 
                    id_adoptantes = :id_adoptantes,
                    id_mascotas = :id_mascotas,
                    fecha_cita = :fecha_cita,
                    estado = :estado,
                    motivo = :motivo
                WHERE id_citas = :id_citas
            ");

            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha_cita", $fecha_cita);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":motivo", $motivo);
            $objRespuesta->bindParam(":id_citas", $id_citas, PDO::PARAM_INT);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "La cita se editó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la cita.");
            }

            $objRespuesta = null;

        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
    static public function mdlContarCitas(){
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM citas");
        $stmt->execute();
        return $stmt->fetch();
    }
}
