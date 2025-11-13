<?php
include_once "conexion.php";

class VacunasMascotasModel
{
    /* ==========================================
       LISTAR VACUNAS APLICADAS
    ========================================== */
    public static function mdlListarVacunasMascotas()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                SELECT 
                    vm.id_vacunas_mascotas,
                    vm.id_mascotas,
                    m.nombre AS mascota_nombre,
                    vm.id_vacunas,
                    v.nombre_vacuna AS vacuna_nombre,
                    vm.fecha_aplicacion,
                    vm.proxima_dosis
                FROM vacunas_mascotas vm
                JOIN mascotas m ON m.id_mascotas = vm.id_mascotas
                JOIN vacunas v ON v.id_vacunas = vm.id_vacunas
                ORDER BY vm.id_vacunas_mascotas DESC
            ");
            $objRespuesta->execute();
            $lista = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaVacunasMascotas" => $lista);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    /* ==========================================
       REGISTRAR VACUNA MASCOTA
    ========================================== */
    public static function mdlRegistrarVacunaMascota($id_mascotas, $id_vacunas, $fecha_aplicacion, $proxima_dosis)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO vacunas_mascotas (id_mascotas, id_vacunas, fecha_aplicacion, proxima_dosis)
                VALUES (:id_mascotas, :id_vacunas, :fecha_aplicacion, :proxima_dosis)
            ");
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_vacunas", $id_vacunas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha_aplicacion", $fecha_aplicacion);
            $objRespuesta->bindParam(":proxima_dosis", $proxima_dosis);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Vacuna registrada para la mascota correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la vacuna de la mascota.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    /* ==========================================
       EDITAR VACUNA MASCOTA
    ========================================== */
    public static function mdlEditarVacunaMascota($id_vacunas_mascotas, $id_mascotas, $id_vacunas, $fecha_aplicacion, $proxima_dosis)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE vacunas_mascotas 
                SET id_mascotas = :id_mascotas, id_vacunas = :id_vacunas, fecha_aplicacion = :fecha_aplicacion, proxima_dosis = :proxima_dosis
                WHERE id_vacunas_mascotas = :id_vacunas_mascotas
            ");
            $objRespuesta->bindParam(":id_vacunas_mascotas", $id_vacunas_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_mascotas", $id_mascotas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":id_vacunas", $id_vacunas, PDO::PARAM_INT);
            $objRespuesta->bindParam(":fecha_aplicacion", $fecha_aplicacion);
            $objRespuesta->bindParam(":proxima_dosis", $proxima_dosis);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Registro de vacuna editado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar el registro de vacuna.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    /* ==========================================
       ELIMINAR VACUNA MASCOTA
    ========================================== */
    public static function mdlEliminarVacunaMascota($id_vacunas_mascotas)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM vacunas_mascotas WHERE id_vacunas_mascotas = :id_vacunas_mascotas");
            $objRespuesta->bindParam(":id_vacunas_mascotas", $id_vacunas_mascotas);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Vacuna eliminada correctamente del registro de mascota.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar la vacuna de la mascota.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
