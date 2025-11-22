<?php
require_once "conexion.php";

class LoginModelo {

    public static function mdlLogin($usuario, $password) {
        try {
            $conexion = Conexion::conectar();
            if ($conexion === null) {
                return ["codigo" => "500", "mensaje" => "Error de conexión a base de datos"];
            }

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
            
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE email = :email OR nombre_usuario = :nombre");
            $check->bindParam(":email", $email);
            $check->bindParam(":nombre", $nombre);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                return ["codigo" => "409", "mensaje" => "El usuario o email ya existe."];
            }

            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $rol = 2; 

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

    // --- NUEVA FUNCIÓN PARA ACTUALIZAR PERFIL ---
    public static function mdlActualizarPerfil($id, $nombre, $password) {
        try {
            $con = Conexion::conectar();
    
            // 1. Validar que el nuevo nombre de usuario no lo tenga OTRA persona
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE nombre_usuario = :nombre AND id_usuarios != :id");
            $check->bindParam(":nombre", $nombre);
            $check->bindParam(":id", $id);
            $check->execute();
    
            if ($check->rowCount() > 0) {
                return ["codigo" => "409", "mensaje" => "Ese nombre de usuario ya está en uso."];
            }
    
            // 2. Preparar la consulta
            if ($password != "") {
                // Si hay contraseña nueva, la encriptamos y actualizamos todo
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET nombre_usuario = :nombre, password = :pass WHERE id_usuarios = :id";
            } else {
                // Si no hay contraseña, solo actualizamos el nombre
                $sql = "UPDATE usuarios SET nombre_usuario = :nombre WHERE id_usuarios = :id";
            }
    
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":id", $id);
            
            if ($password != "") {
                $stmt->bindParam(":pass", $hash);
            }
    
            if ($stmt->execute()) {
                return ["codigo" => "200", "mensaje" => "Perfil actualizado correctamente"];
            } else {
                return ["codigo" => "500", "mensaje" => "Error al actualizar"];
            }
    
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => "Error: " . $e->getMessage()];
        }
    }
}
?>