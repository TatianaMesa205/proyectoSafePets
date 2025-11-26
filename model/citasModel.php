<?php
include_once "conexion.php";

class CitasModel
{
    public static function mdlListarCitas() {
        try {
            $stmt = Conexion::conectar()->prepare("
                SELECT c.id_citas, c.id_mascotas, c.id_adoptantes, c.fecha_cita, c.estado, c.motivo,
                       m.nombre AS nombre_mascota, a.nombre_completo AS nombre_adoptante
                FROM citas c
                INNER JOIN mascotas m ON c.id_mascotas = m.id_mascotas
                INNER JOIN adoptantes a ON c.id_adoptantes = a.id_adoptantes
                ORDER BY c.id_citas DESC
            ");
            $stmt->execute();
            return array("codigo" => "200", "listaCitas" => $stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }

    public static function mdlRegistrarCita($id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO citas(id_adoptantes, id_mascotas, fecha_cita, estado, motivo) VALUES (:id_a, :id_m, :f, :e, :m)");
            $stmt->bindParam(":id_a", $id_adoptantes); $stmt->bindParam(":id_m", $id_mascotas);
            $stmt->bindParam(":f", $fecha_cita); $stmt->bindParam(":e", $estado); $stmt->bindParam(":m", $motivo);
            if ($stmt->execute()) return array("codigo" => "200", "mensaje" => "Registro exitoso");
            return array("codigo" => "401", "mensaje" => "Error al registrar");
        } catch (Exception $e) { return array("codigo" => "401", "mensaje" => $e->getMessage()); }
    }

    public static function mdlEditarCita($id_citas, $id_adoptantes, $id_mascotas, $fecha_cita, $estado, $motivo) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE citas SET id_adoptantes=:id_a, id_mascotas=:id_m, fecha_cita=:f, estado=:e, motivo=:m WHERE id_citas=:id");
            $stmt->bindParam(":id_a", $id_adoptantes); $stmt->bindParam(":id_m", $id_mascotas);
            $stmt->bindParam(":f", $fecha_cita); $stmt->bindParam(":e", $estado);
            $stmt->bindParam(":m", $motivo); $stmt->bindParam(":id", $id_citas);
            if ($stmt->execute()) return array("codigo" => "200", "mensaje" => "Actualización correcta");
            return array("codigo" => "401", "mensaje" => "Error al actualizar");
        } catch (Exception $e) { return array("codigo" => "401", "mensaje" => $e->getMessage()); }
    }

    public static function mdlEliminarCita($id_citas) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM citas WHERE id_citas=:id");
            $stmt->bindParam(":id", $id_citas);
            if ($stmt->execute()) return array("codigo" => "200", "mensaje" => "Eliminado correctamente");
            return array("codigo" => "401", "mensaje" => "Error al eliminar");
        } catch (Exception $e) { return array("codigo" => "401", "mensaje" => $e->getMessage()); }
    }

    static public function mdlContarCitas(){
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM citas");
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function mdlObtenerFechasOcupadas() {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT fecha_cita FROM citas");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) { return []; }
    }
}
?>