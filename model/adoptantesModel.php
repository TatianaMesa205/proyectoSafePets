<?php
include_once "conexion.php";

class AdoptantesModel
{

    public static function mdlListarAdoptantes()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM adoptantes");
            $objRespuesta->execute();
            $listaAdoptantes = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaAdoptantes" => $listaAdoptantes);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlRegistrarAdoptante($nombre_completo, $cedula, $telefono, $email, $direccion)
    {
        $mensaje = array();
        try {
            // Solo insertamos en la tabla ADOPTANTES
            $objRespuesta = Conexion::conectar()->prepare("
                INSERT INTO adoptantes (nombre_completo, cedula, telefono, email, direccion) 
                VALUES (:nombre_completo, :cedula, :telefono, :email, :direccion)
            ");
            
            $objRespuesta->bindParam(":nombre_completo", $nombre_completo);
            $objRespuesta->bindParam(":cedula", $cedula);
            $objRespuesta->bindParam(":telefono", $telefono);
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":direccion", $direccion);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adoptante registrado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar el adoptante.");
            }
        } catch (Exception $e) {
            // Manejo de duplicados (Cédula o Correo ya existentes en adoptantes)
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $mensaje = array("codigo" => "401", "mensaje" => "El adoptante ya existe (Cédula o Correo duplicado).");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        }
        return $mensaje;
    }

    public static function mdlEditarAdoptante($id_adoptantes, $nombre_completo, $cedula, $telefono, $email, $direccion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("
                UPDATE adoptantes 
                SET nombre_completo = :nombre_completo,
                    cedula = :cedula,
                    telefono = :telefono,
                    email = :email,
                    direccion = :direccion
                WHERE id_adoptantes = :id_adoptantes
            ");

            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            $objRespuesta->bindParam(":nombre_completo", $nombre_completo);
            $objRespuesta->bindParam(":cedula", $cedula);
            $objRespuesta->bindParam(":telefono", $telefono);
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":direccion", $direccion);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adoptante actualizado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al actualizar los datos.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarAdoptante($id_adoptantes)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM adoptantes WHERE id_adoptantes = :id_adoptantes");
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adoptante eliminado correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar el adoptante.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>