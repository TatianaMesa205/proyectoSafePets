<?php

include_once "conexion.php";

class MusuarioModelo
{

    public static function mdlListarMusuario()
    {
        $mensaje = array();
        try {
            $objRespuestaMusuario = Conexion::conectar()->prepare("SELECT mascota.idmascota, mascota.nombre, mascota.edad, usuario.nombre as usuario, tipo_mascota.descripcion as tipo_mascota, raza.descripcion_raza as raza
                 FROM mascota 
                 JOIN usuario ON usuario.idusuario = mascota.usuario_idusuario
                 JOIN tipo_mascota on tipo_mascota.idtipo_mascota = mascota.tipo_mascota_idtipo_mascota
                 JOIN raza ON raza.idraza=mascota.raza_idraza");
            $objRespuestaMusuario->execute();
            $listaMusuarios = $objRespuestaMusuario->fetchAll(PDO::FETCH_ASSOC);
            $objRespuestaMusuario = null;
            $mensaje = array("codigo" => "200", "listaMusuarios" => $listaMusuarios);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarMusuario($idMascota)
    {

        $mensaje = array();
        try {
            $objRespuestaMusuario = Conexion::conectar()->prepare("DELETE FROM mascota WHERE idmascota=:idmascota");
            $objRespuestaMusuario->bindParam(":idmascota", $idMascota);
            if ($objRespuestaMusuario->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "El usuario se elimino correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar el usuario.");
            }
            $objRespuestaMusuario = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlRegistrarMusuario($nombreM, $edadM, $usuario_id, $raza_id, $tipo_mascota_id)
    {
        $mensaje = array();
        try {
            $objRespuestaMusuario = Conexion::conectar()->prepare("INSERT INTO mascota(nombre, edad, usuario_idusuario, raza_idraza, tipo_mascota_idtipo_mascota) VALUES (:nombre, :edad, :usuario_id, :raza_id, :tipo_mascota_id)");
            $objRespuestaMusuario->bindParam(":nombre", $nombreM);
            $objRespuestaMusuario->bindParam(":edad", $edadM);
            $objRespuestaMusuario->bindParam(":usuario_id", $usuario_id);
            $objRespuestaMusuario->bindParam(":raza_id", $raza_id);
            $objRespuestaMusuario->bindParam(":tipo_mascota_id", $tipo_mascota_id);

            if ($objRespuestaMusuario->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Mascota registrada correctamente");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la mascota");
            }

            $objRespuestaMusuario = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mldEditarMusuario($idMascota, $nombreM, $edadM)
    {
        $mensaje = array();

        try {
            $objRespuestaMusuario = Conexion::conectar()->prepare("UPDATE mascota SET nombre=:nombre,edad=:edad WHERE idmascota=:idmascota");
            $objRespuestaMusuario->bindParam(":nombre", $nombreM);
            $objRespuestaMusuario->bindParam(":edad", $edadM);
            $objRespuestaMusuario->bindParam(":idmascota", $idMascota);

            if ($objRespuestaMusuario->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "El usuario se editó correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al editar el usuario");
            }
            $objRespuestaMusuario = null;


        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
}