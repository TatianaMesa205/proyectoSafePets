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

    // --- NUEVO MÉTODO: VALIDAR SI TIENE CITA ACTIVA ---
    public static function mdlValidarCitaActiva($id_adoptantes) {
        try {
            // Buscamos citas que NO estén Canceladas ni Finalizadas (es decir, Pendientes o Confirmadas)
            $stmt = Conexion::conectar()->prepare("
                SELECT COUNT(*) as total 
                FROM citas 
                WHERE id_adoptantes = :id 
                AND estado != 'Cancelada' 
                AND estado != 'Finalizada'
            ");
            $stmt->bindParam(":id", $id_adoptantes, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return ["total" => 0]; 
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

    static public function mdlObtenerCita($id_citas)
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT * FROM citas 
            WHERE id_citas = :id
        ");
        $stmt->bindParam(":id", $id_citas, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function mdlActualizarEstado($id_citas, $estado)
    {
        $stmt = Conexion::conectar()->prepare("
            UPDATE citas SET estado = :estado 
            WHERE id_citas = :id
        ");

        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id_citas, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ["codigo" => "200"];
        } else {
            return ["codigo" => "500"];
        }
    }
    

    public static function mdlAdmins() {
        $sql = Conexion::conectar()->prepare("
            SELECT nombre_usuario, email 
            FROM usuarios 
            WHERE id_roles = 1
        ");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function mdlInfoCita($id_citas){
        $sql = Conexion::conectar()->prepare("
            SELECT c.*, m.nombre AS mascota
            FROM citas c
            INNER JOIN mascotas m ON m.id_mascotas = c.id_mascotas
            WHERE c.id_citas = :id
        ");
        $sql->bindParam(":id", $id_citas);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }


    public static function mdlCancelarCita($id_citas){
        $query = Conexion::conectar()->prepare("
            UPDATE citas SET estado = 'Cancelada'
            WHERE id_citas = :id_citas
        ");
        $query->bindParam(":id_citas", $id_citas);
        
        if ($query->execute()) {
            return ["codigo" => "200", "mensaje" => "Cita cancelada correctamente"];
        }
        return ["codigo" => "500", "mensaje" => "Error al cancelar cita"];
    }

    public static function mdlListarCitasAdoptante($id_adoptantes)
    {
        $sql = Conexion::conectar()->prepare("
            SELECT c.*, m.imagen, m.nombre AS mascota
            FROM citas c
            INNER JOIN mascotas m ON m.id_mascotas = c.id_mascotas
            WHERE c.id_adoptantes = :id
            ORDER BY c.fecha_cita DESC
        ");
        $sql->bindParam(":id", $id_adoptantes);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function mdlBuscarCitaActiva($id_adoptantes) {

        $sql = "SELECT * FROM citas 
                WHERE id_adoptantes = :id 
                AND (estado = 'Pendiente' OR estado = 'Confirmada')
                AND fecha_cita >= CURDATE()
                LIMIT 1";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id_adoptantes, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}
?>