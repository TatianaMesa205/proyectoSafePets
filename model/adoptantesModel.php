<?php
include_once "conexion.php";

class AdoptantesModel
{

    public static function mdlListarAdoptantes()
    {
        $mensaje = array();
        try {
            // Usamos INNER JOIN para combinar 'adoptantes' y 'usuarios' usando el campo 'email'
            $sql = "SELECT 
                        a.*, 
                        u.nombre_usuario,
                        u.email AS email_usuario  /* Se mantiene 'email' de adoptantes y se añade alias para el de usuario por si acaso */
                    FROM adoptantes a
                    INNER JOIN usuarios u 
                        ON a.email = u.email
                    WHERE u.id_roles = 2  /* Asumimos que el rol 2 es Adoptante */
                    ORDER BY a.nombre_completo ASC";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $mensaje = array("codigo" => "200", "listaAdoptantes" => $lista);
            
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlMostrarAdoptante($item, $valor)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM adoptantes WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }


    public static function mdlRegistrarAdoptante($nombre, $cedula, $tel, $email, $dir)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO adoptantes(nombre_completo, cedula, telefono, email, direccion) VALUES (:n, :c, :t, :e, :d)");
            $stmt->bindParam(":n", $nombre);
            $stmt->bindParam(":c", $cedula);
            $stmt->bindParam(":t", $tel);
            $stmt->bindParam(":e", $email);
            $stmt->bindParam(":d", $dir);

            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Registro exitoso");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al registrar");
            }
        } catch (Exception $e) {
            // Capturar error de duplicados
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return array("codigo" => "401", "mensaje" => "El adoptante ya existe.");
            }
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }

    public static function mdlEditarAdoptante($id, $nombre, $cedula, $tel, $email, $dir)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE adoptantes SET nombre_completo=:n, cedula=:c, telefono=:t, email=:e, direccion=:d WHERE id_adoptantes=:id");
            $stmt->bindParam(":n", $nombre);
            $stmt->bindParam(":c", $cedula);
            $stmt->bindParam(":t", $tel);
            $stmt->bindParam(":e", $email);
            $stmt->bindParam(":d", $dir);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Actualizado correctamente");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al actualizar");
            }
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }

    public static function mdlEliminarAdoptante($id)
    {
        $mensaje = array();
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM adoptantes WHERE id_adoptantes=:id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return array("codigo" => "200", "mensaje" => "Eliminado correctamente");
            } else {
                return array("codigo" => "401", "mensaje" => "Error al eliminar");
            }
        } catch (Exception $e) {
            return array("codigo" => "401", "mensaje" => $e->getMessage());
        }
    }
    
    static public function mdlContarAdoptantes(){
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM adoptantes");
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>