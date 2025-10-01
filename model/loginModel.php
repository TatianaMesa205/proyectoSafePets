<?php
include_once "conexion.php";

class LoginModelo
{
    public static function mdlLogin($nombre_usuario, $contrasena)
    {
        try {
            $conexion = Conexion::conectar();
            if ($conexion === null) {
                return array("codigo" => "500", "mensaje" => "Error de conexión a la base de datos");
            }
            
            // Query corregida para la base de datos safe_pets
            $stmt = $conexion->prepare("SELECT u.id_usuarios as id, u.nombre_usuario, u.contrasena, r.nombre_rol as rol 
                                       FROM usuarios u 
                                       JOIN roles r ON u.id_roles = r.id_roles 
                                       WHERE u.nombre_usuario = :nombre_usuario");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                unset($usuario['contrasena']);
                return array("codigo" => "200", "usuario" => $usuario);
            } else {
                return array("codigo" => "401", "mensaje" => "Nombre de usuario o contraseña incorrectos");
            }
        } catch (Exception $e) {
            error_log("Error en mdlLogin: " . $e->getMessage());
            return array("codigo" => "500", "mensaje" => "Error interno del servidor");
        }
    }

    public static function mdlRegistrarUsuario($nombre_usuario, $email, $contrasena)
    {
        try {
            $conexion = Conexion::conectar();
            if ($conexion === null) {
                return array("codigo" => "500", "mensaje" => "Error de conexión a la base de datos");
            }
            
            // Verificar si el usuario ya existe
            $stmt = $conexion->prepare("SELECT id_usuarios FROM usuarios WHERE nombre_usuario = :nombre_usuario OR email = :email");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetch()) {
                return array("codigo" => "409", "mensaje" => "El usuario o email ya existe");
            }

            if (strlen($contrasena) < 6) {
                return array("codigo" => "400", "mensaje" => "La contraseña debe tener al menos 6 caracteres");
            }

            // Encriptar contraseña
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario con rol adoptante por defecto (id_roles = 2)
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email, contrasena, id_roles) VALUES (:nombre_usuario, :email, :contrasena, 2)");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasenaHash, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return array("codigo" => "201", "mensaje" => "Usuario registrado exitosamente");
            } else {
                return array("codigo" => "500", "mensaje" => "Error al registrar usuario");
            }
        } catch (Exception $e) {
            error_log("Error en mdlRegistrarUsuario: " . $e->getMessage());
            return array("codigo" => "500", "mensaje" => "Error interno del servidor");
        }
    }

    public static function mdlCrearAdmin($nombre_usuario, $email, $contrasena)
    {
        try {
            $conexion = Conexion::conectar();
            if ($conexion === null) {
                return array("codigo" => "500", "mensaje" => "Error de conexión a la base de datos");
            }
            
            // Verificar si el usuario ya existe
            $stmt = $conexion->prepare("SELECT id_usuarios FROM usuarios WHERE nombre_usuario = :nombre_usuario OR email = :email");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetch()) {
                return array("codigo" => "409", "mensaje" => "El usuario o email ya existe");
            }

            // Encriptar contraseña
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario con rol admin (id_roles = 1)
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email, contrasena, id_roles) VALUES (:nombre_usuario, :email, :contrasena, 1)");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasenaHash, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return array("codigo" => "201", "mensaje" => "Administrador creado exitosamente");
            } else {
                return array("codigo" => "500", "mensaje" => "Error al crear administrador");
            }
        } catch (Exception $e) {
            error_log("Error en mdlCrearAdmin: " . $e->getMessage());
            return array("codigo" => "500", "mensaje" => "Error interno del servidor");
        }
    }
}
