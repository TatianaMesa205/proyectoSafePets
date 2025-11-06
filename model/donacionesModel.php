<?php
include_once "conexion.php";

class DonacionesModel
{
    public static function mdlListarDonaciones()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                SELECT d.id_donaciones, d.monto, d.fecha, d.metodo_pago, u.nombre_usuario AS usuario
                FROM donaciones d
                JOIN usuarios u ON u.id_usuarios = d.id_usuarios
            ");
            $objRespuesta->execute();
            $lista = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaDonaciones" => $lista);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlRegistrarDonacion($id_usuarios, $monto, $fecha, $metodo_pago)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO donaciones (id_usuarios, monto, fecha, metodo_pago)
                VALUES (:id_usuarios, :monto, :fecha, :metodo_pago)
            ");
            $objRespuesta->bindParam(":id_usuarios", $id_usuarios);
            $objRespuesta->bindParam(":monto", $monto);
            $objRespuesta->bindParam(":fecha", $fecha);
            $objRespuesta->bindParam(":metodo_pago", $metodo_pago);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Donación registrada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la donación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEditarDonacion($id_donaciones, $id_usuarios, $monto, $fecha, $metodo_pago)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE donaciones SET id_usuarios = :id_usuarios, monto = :monto, fecha = :fecha, metodo_pago = :metodo_pago
                WHERE id_donaciones = :id_donaciones
            ");
            $objRespuesta->bindParam(":id_donaciones", $id_donaciones);
            $objRespuesta->bindParam(":id_usuarios", $id_usuarios);
            $objRespuesta->bindParam(":monto", $monto);
            $objRespuesta->bindParam(":fecha", $fecha);
            $objRespuesta->bindParam(":metodo_pago", $metodo_pago);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Donación editada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar la donación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarDonacion($id_donaciones)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM donaciones WHERE id_donaciones = :id_donaciones");
            $objRespuesta->bindParam(":id_donaciones", $id_donaciones);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Donación eliminada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la donación.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
