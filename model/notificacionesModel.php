<?php
require_once "conexion.php";

class NotificacionesModel {

    public static function registrarInteres($data) {

        $sql = "INSERT INTO notificaciones_interes (id_mascotas, id_usuarios, email_usuario)
                VALUES (:id_mascotas, :id_usuarios, :email)";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute([
            ":id_mascotas" => $data["id_mascotas"],
            ":id_usuarios" => $data["id_usuarios"],
            ":email"      => $data["email"]
        ]);
    }

    public static function obtenerInteresados($idMascota) {
        $sql = "SELECT email_usuario AS email FROM notificaciones_interes WHERE id_mascotas = ?";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([$idMascota]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function marcarEnviadas($id) {
        $sql = "UPDATE notificaciones_interes SET notificar = 0 WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    public static function usuariosInteresados($idMascota) {
        $sql = "SELECT 
                    n.id AS id,
                    n.email_usuario AS email,
                    u.nombre_usuario AS nombre_usuario
                FROM notificaciones_interes n
                LEFT JOIN usuarios u ON n.id_usuarios = u.id_usuarios
                WHERE n.id_mascotas = :idMascota
                AND COALESCE(n.notificar,1) = 1";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([":idMascota" => $idMascota]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function marcarNotificacionEnviada($idNotificacion) {
        $sql = "UPDATE notificaciones_interes 
                SET notificar = 0 
                WHERE id = :idNotificacion";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute([":idNotificacion" => $idNotificacion]);
    }


}
