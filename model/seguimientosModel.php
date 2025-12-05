<?php
include_once "conexion.php";

class SeguimientosMascotasModel
{
    public static function mdlListarSeguimientos()
    {
        $mensaje = array();
        try {
            $sql = "
                SELECT 
                    s.id_seguimientos,
                    s.fecha_visita,
                    s.observacion,
                    a.id_adopciones,
                    a.fecha_adopcion,
                    ad.nombre_completo AS nombre_adoptante,
                    m.nombre AS nombre_mascota
                FROM seguimientos_mascotas s
                INNER JOIN adopciones a ON a.id_adopciones = s.id_adopciones
                INNER JOIN adoptantes ad ON ad.id_adoptantes = a.id_adoptantes
                INNER JOIN mascotas m ON m.id_mascotas = a.id_mascotas
                ORDER BY s.id_seguimientos DESC
            ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaSeguimientos" => $lista);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlListarAdopcionesParaSelect()
    {
        $mensaje = array();
        try {
            $sql = "
                SELECT 
                    a.id_adopciones,
                    a.estado,
                    m.nombre AS nombre_mascota,
                    ad.nombre_completo AS nombre_adoptante
                FROM adopciones a
                INNER JOIN mascotas m ON m.id_mascotas = a.id_mascotas
                INNER JOIN adoptantes ad ON ad.id_adoptantes = a.id_adoptantes
            ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaAdopciones" => $lista);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // 3. REGISTRAR
    public static function mdlRegistrarSeguimiento($id_adopciones, $fecha_visita, $observacion)
    {
        $mensaje = array();
        try {
            $sql = "INSERT INTO seguimientos_mascotas (id_adopciones, fecha_visita, observacion) VALUES (:id_adopciones, :fecha_visita, :observacion)";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":id_adopciones", $id_adopciones);
            $stmt->bindParam(":fecha_visita", $fecha_visita);
            $stmt->bindParam(":observacion", $observacion);

            if ($stmt->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento registrado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // 4. EDITAR
    public static function mdlEditarSeguimiento($id_seguimientos, $id_adopciones, $fecha_visita, $observacion)
    {
        $mensaje = array();
        try {
            $sql = "UPDATE seguimientos_mascotas SET id_adopciones=:id_adopciones, fecha_visita=:fecha_visita, observacion=:observacion WHERE id_seguimientos=:id_seguimientos";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":id_seguimientos", $id_seguimientos);
            $stmt->bindParam(":id_adopciones", $id_adopciones);
            $stmt->bindParam(":fecha_visita", $fecha_visita);
            $stmt->bindParam(":observacion", $observacion);

            if ($stmt->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento actualizado.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al actualizar.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // 5. ELIMINAR
    public static function mdlEliminarSeguimiento($id_seguimientos)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM seguimientos_mascotas WHERE id_seguimientos = :id_seguimientos");
            $stmt->bindParam(":id_seguimientos", $id_seguimientos);
            if ($stmt->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento eliminado.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>