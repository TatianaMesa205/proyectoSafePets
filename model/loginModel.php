<?php
require_once "conexion.php";

class LoginModelo {

    public static function mdlLogin($usuario, $password) {
        try {
            $conexion = Conexion::conectar();
            if ($conexion === null) {
                return ["codigo" => "500", "mensaje" => "Error de conexión a base de datos"];
            }

            // CORRECCIÓN: Usamos JOIN para traer el nombre del rol y alias para el ID
            $sql = "SELECT 
                        u.id_usuarios AS id,
                        u.nombre_usuario,
                        u.email,
                        u.password,
                        r.nombre_rol AS rol
                    FROM usuarios u
                    INNER JOIN roles r ON u.id_roles = r.id_roles
                    WHERE u.nombre_usuario = :usuario";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Eliminamos la contraseña del array por seguridad
                    unset($user['password']);
                    return ["codigo" => "200", "mensaje" => "Login exitoso", "usuario" => $user];
                } else {
                    return ["codigo" => "400", "mensaje" => "Contraseña incorrecta"];
                }
            } else {
                return ["codigo" => "404", "mensaje" => "Usuario no encontrado"];
            }
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => "Error: " . $e->getMessage()];
        }
    }

    public static function mdlRegistrarUsuario($nombre, $email, $pass) {
        try {
            $con = Conexion::conectar();
            
            // Verificar si usuario o email ya existen
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE email = :email OR nombre_usuario = :nombre");
            $check->bindParam(":email", $email);
            $check->bindParam(":nombre", $nombre);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                return ["codigo" => "409", "mensaje" => "El usuario o email ya existe."];
            }

            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $rol = 2; // 2 = Rol adoptante por defecto

            $stmt = $con->prepare("INSERT INTO usuarios (nombre_usuario, email, password, id_roles) VALUES (:n, :e, :p, :r)");
            $stmt->bindParam(":n", $nombre);
            $stmt->bindParam(":e", $email);
            $stmt->bindParam(":p", $hash);
            $stmt->bindParam(":r", $rol);

            if ($stmt->execute()) {
                return ["codigo" => "200", "mensaje" => "Usuario registrado exitosamente"];
            } else {
                return ["codigo" => "500", "mensaje" => "Error al registrar en BD"];
            }
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }
    
    public static function mdlCrearAdmin($nombre, $email, $pass) {
        try {
            $con = Conexion::conectar();
            
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE email = :email OR nombre_usuario = :nombre");
            $check->bindParam(":email", $email);
            $check->bindParam(":nombre", $nombre);
            $check->execute();
            
            if ($check->rowCount() > 0) return ["codigo" => "409", "mensaje" => "Usuario existente"];

            $stmt = $con->prepare("INSERT INTO usuarios (nombre_usuario, email, password, id_roles) VALUES (:n, :e, :p, 1)");
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt->bindParam(":n", $nombre);
            $stmt->bindParam(":e", $email);
            $stmt->bindParam(":p", $hash);
            
            if ($stmt->execute()) return ["codigo" => "200", "mensaje" => "Admin creado"];
            return ["codigo" => "500", "mensaje" => "Error"];
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }
}
?>