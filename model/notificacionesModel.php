<?php
require_once "conexion.php";

class NotificacionesModel {

    /*=============================================
    REGISTRAR INTERÉS
    =============================================*/
    public static function registrarInteres($data) {

        // Opcional: Evitar duplicados al insertar
        if(self::verificarNotificacion($data["id_usuarios"], $data["id_mascotas"])){
            return true; // Ya existe, lo tomamos como éxito
        }

        $sql = "INSERT INTO notificaciones_interes (id_mascotas, id_usuarios, email_usuario)
                VALUES (:id_mascotas, :id_usuarios, :email)";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute([
            ":id_mascotas" => $data["id_mascotas"],
            ":id_usuarios" => $data["id_usuarios"],
            ":email"      => $data["email"]
        ]);
    }

    /*=============================================
    VERIFICAR SI YA EXISTE LA NOTIFICACIÓN
    =============================================*/
    public static function verificarNotificacion($idUsuario, $idMascota) {
        $sql = "SELECT id FROM notificaciones_interes 
                WHERE id_usuarios = :id_usuarios 
                AND id_mascotas = :id_mascotas";
        
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([
            ":id_usuarios" => $idUsuario,
            ":id_mascotas" => $idMascota
        ]);
        
        return $stmt->fetch(); // Retorna la fila si existe, o false si no
    }

    /*=============================================
    OBTENER CORREOS DE INTERESADOS
    =============================================*/
    public static function obtenerInteresados($idMascota) {
        $sql = "SELECT email_usuario AS email FROM notificaciones_interes WHERE id_mascotas = ?";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([$idMascota]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*=============================================
    MARCAR COMO ENVIADA (Individual)
    =============================================*/
    public static function marcarEnviadas($id) {
        $sql = "UPDATE notificaciones_interes SET notificar = 0 WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    /*=============================================
    LISTAR USUARIOS INTERESADOS (Para Admin/Panel)
    =============================================*/
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
?>