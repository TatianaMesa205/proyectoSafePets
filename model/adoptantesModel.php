<?php

include_once "conexion.php";

class AdoptantesModel
{

    public static function mdlListarAdoptantes(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM adoptantes");
            $objRespuesta->execute();
            $listaAdoptantes = $objRespuesta->fetchAll(PDO::FETCH_ASSOC);
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","listaAdoptantes"=>$listaAdoptantes);
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarAdoptante($id_adoptantes)
    {

        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM adoptantes WHERE id_adoptantes=:id_adoptantes");
            $objRespuesta->bindParam(":id_adoptantes", $id_adoptantes);
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "El usuario se elimino correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar el usuario.");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlRegistrarAdoptante($nombre_completo, $cedula, $telefono, $email, $direccion)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO adoptantes(nombre_completo, cedula, telefono, email, direccion) 
                VALUES (:nombre_completo, :cedula, :telefono, :email, :direccion)");
            $objRespuesta->bindParam(":nombre_completo", $nombre_completo);
            $objRespuesta->bindParam(":cedula", $cedula);
            $objRespuesta->bindParam(":telefono", $telefono);
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":direccion", $direccion);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Adoptante registrada correctamente");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar el adoptante");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
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
                if ($objRespuesta->rowCount() > 0) {
                    $mensaje = array("codigo" => "200", "mensaje" => "El adoptante fue actualizado correctamente.");
                } else {
                    $mensaje = array("codigo" => "200", "mensaje" => "No se realizaron cambios (datos iguales).");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar el adoptante.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

}