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
            $stmt = $objConexion->prepare($sql);
            $stmt->execute();
            $listaCitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaCitas" => $listaCitas);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlRegistrarCita($id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO citas(id_adoptantes, id_mascotas, fecha_cita, estado, motivo) VALUES (:id_a, :id_m, :f, :e, :m)");
            $stmt->bindParam(":id_a", $id_adoptantes);
            $stmt->bindParam(":id_m", $id_mascotas);
            $stmt->bindParam(":f", $fecha_cita);
            $stmt->bindParam(":e", $estado);
            $stmt->bindParam(":m", $motivo);

            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Cita registrada correctamente");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al registrar la cita");
            }
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }

    public static function mdlEditarCita($id_citas, $id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE citas SET id_adoptantes=:id_a, id_mascotas=:id_m, fecha_cita=:f, estado=:e, motivo=:m WHERE id_citas=:id");
            $stmt->bindParam(":id_a", $id_adoptantes);
            $stmt->bindParam(":id_m", $id_mascotas);
            $stmt->bindParam(":f", $fecha_cita);
            $stmt->bindParam(":e", $estado);
            $stmt->bindParam(":m", $motivo);
            $stmt->bindParam(":id", $id_citas);

            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Cita actualizada correctamente");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al actualizar la cita");
            }
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }


    public static function mdlEliminarCita($id_citas)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM citas WHERE id_citas=:id");
            $stmt->bindParam(":id", $id_citas);
            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Cita eliminada correctamente");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al eliminar la cita");
            }
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }


    static public function mdlContarCitas(){
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM citas");
        $stmt->execute();
        return $stmt->fetch();
    }

    static public function mdlListarCitasAdoptante($id_adoptantes)
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT c.id_citas, c.fecha_cita, c.estado, c.motivo,
                m.nombre AS mascota, m.imagen
            FROM citas c
            INNER JOIN mascotas m ON m.id_mascotas = c.id_mascotas
            WHERE c.id_adoptantes = :id_adoptantes
            ORDER BY c.fecha_cita DESC
        ");

        $stmt->bindParam(":id_adoptantes", $id_adoptantes, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlCancelarCita($id_citas)
    {
        try {
            $sql = Conexion::conectar()->prepare("DELETE FROM citas WHERE id_citas = :id_citas");
            $sql->bindParam(":id_citas", $id_citas);
            $sql->execute();

            return ["codigo" => "200", "mensaje" => "Cita eliminada"];

        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }




    // --- NUEVO: Obtener fechas ocupadas para bloquearlas en el calendario ---
    public static function mdlObtenerFechasOcupadas()
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT fecha_cita FROM citas");
            $stmt->execute();
            // Devuelve un array simple con las fechas (ej: ["2023-10-01 10:00:00", ...])
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            return [];
        }
    }
}

