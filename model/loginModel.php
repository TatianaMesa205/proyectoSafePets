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
            
            // CAMBIO: Se cambió u.contrasena por u.password en el SELECT
            $stmt = $conexion->prepare("SELECT u.id_usuarios as id, u.nombre_usuario, u.password, r.nombre_rol as rol 
                                       FROM usuarios u 
                                       JOIN roles r ON u.id_roles = r.id_roles 
                                       WHERE u.nombre_usuario = :nombre_usuario");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // CAMBIO: Se verifica contra $usuario['password'] en lugar de ['contrasena']
            if ($usuario && password_verify($contrasena, $usuario['password'])) {
                // Por seguridad eliminamos el hash antes de enviar la respuesta
                unset($usuario['password']);
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

            // Validar contraseña (usar empty() evita notice si la variable no está definida)
            if (empty($contrasena) || strlen($contrasena) < 6) {
                return array("codigo" => "400", "mensaje" => "La contraseña debe tener al menos 6 caracteres");
            }

            // Encriptar contraseña
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // CAMBIO: Se cambió el INSERT para usar la columna 'password' en lugar de 'contrasena'
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email, password, id_roles) VALUES (:nombre_usuario, :email, :password, 2)");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            // Vinculamos el hash al parámetro :password
            $stmt->bindParam(":password", $contrasenaHash, PDO::PARAM_STR);
            
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

            // Validar contraseña (usar empty() evita notice si la variable no está definida)
            if (empty($contrasena)) {
                return array("codigo" => "400", "mensaje" => "La contraseña no puede estar vacía");
            }

            if (strlen($contrasena) < 6) {
                return array("codigo" => "400", "mensaje" => "La contraseña debe tener al menos 6 caracteres");
            }

            // Encriptar contraseña
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // CAMBIO: Se cambió el INSERT para usar la columna 'password'
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email, password, id_roles) VALUES (:nombre_usuario, :email, :password, 1)");
            $stmt->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $contrasenaHash, PDO::PARAM_STR);
            
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