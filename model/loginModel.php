<?php
require_once "conexion.php";

class LoginModelo {

    /* ==============================================
       LOGIN DE USUARIO
    ============================================== */
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

    /* ==============================================
       REGISTRO UNIFICADO (USUARIO + ADOPTANTE)
       Usa transacciones para asegurar integridad
    ============================================== */
    public static function mdlRegistrarUsuarioYAdoptante($datos) {
        $con = Conexion::conectar();
        
        try {
            // Iniciar transacción (Todo o nada)
            $con->beginTransaction();

            // 1. VERIFICAR SI EL USUARIO O EMAIL YA EXISTEN EN USUARIOS
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE email = :email OR nombre_usuario = :nombre");
            $check->bindParam(":email", $datos['email']);
            $check->bindParam(":nombre", $datos['usuario']);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $con->rollBack();
                return ["codigo" => "409", "mensaje" => "El usuario o email ya están registrados."];
            }

            // 2. VERIFICAR SI LA CÉDULA YA EXISTE EN ADOPTANTES
            $check2 = $con->prepare("SELECT id_adoptantes FROM adoptantes WHERE cedula = :ced");
            $check2->bindParam(":ced", $datos['cedula']);
            $check2->execute();

            if ($check2->rowCount() > 0) {
                $con->rollBack();
                return ["codigo" => "409", "mensaje" => "La cédula ya está registrada."];
            }

            // 3. INSERTAR EN LA TABLA USUARIOS
            $hash = password_hash($datos['password'], PASSWORD_DEFAULT);
            $rol = 2; // Rol 2 = Adoptante

            $stmtUser = $con->prepare("INSERT INTO usuarios (nombre_usuario, email, password, id_roles) VALUES (:n, :e, :p, :r)");
            $stmtUser->bindParam(":n", $datos['usuario']);
            $stmtUser->bindParam(":e", $datos['email']);
            $stmtUser->bindParam(":p", $hash);
            $stmtUser->bindParam(":r", $rol);

            if (!$stmtUser->execute()) {
                throw new Exception("Error al crear el usuario.");
            }

            // 4. INSERTAR EN LA TABLA ADOPTANTES
            // Nota: Se usa el email para vincular lógicamente si tu base de datos no tiene la FK 'id_usuario' en 'adoptantes'
            $stmtAdp = $con->prepare("INSERT INTO adoptantes (nombre_completo, cedula, telefono, email, direccion) VALUES (:nc, :ced, :tel, :em, :dir)");
            $stmtAdp->bindParam(":nc", $datos['nombre_completo']);
            $stmtAdp->bindParam(":ced", $datos['cedula']);
            $stmtAdp->bindParam(":tel", $datos['telefono']);
            $stmtAdp->bindParam(":em", $datos['email']); // Se usa el mismo email
            $stmtAdp->bindParam(":dir", $datos['direccion']);

            if (!$stmtAdp->execute()) {
                throw new Exception("Error al crear el perfil de adoptante.");
            }

            // Si todo salió bien, confirmamos los cambios
            $con->commit();
            return ["codigo" => "200", "mensaje" => "Registro completado exitosamente. ¡Bienvenido!"];

        } catch (Exception $e) {
            // Si algo falla, revertimos todos los cambios
            $con->rollBack();
            return ["codigo" => "500", "mensaje" => "Error interno: " . $e->getMessage()];
        }
    }

    /* ==============================================
       REGISTRO SIMPLE DE USUARIO (Legacy/Admin)
    ============================================== */
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
    
    /* ==============================================
       CREAR ADMINISTRADOR
    ============================================== */
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

    /* ==============================================
       ACTUALIZAR PERFIL
    ============================================== */
    public static function mdlActualizarPerfil($id, $nombre, $password) {
        try {
            $con = Conexion::conectar();
    
            // Validar que el nuevo nombre de usuario no lo tenga OTRA persona
            $check = $con->prepare("SELECT id_usuarios FROM usuarios WHERE nombre_usuario = :nombre AND id_usuarios != :id");
            $check->bindParam(":nombre", $nombre);
            $check->bindParam(":id", $id);
            $check->execute();
    
            if ($check->rowCount() > 0) {
                return ["codigo" => "409", "mensaje" => "Ese nombre de usuario ya está en uso."];
            }
    
            // Preparar la consulta
            if ($password != "") {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET nombre_usuario = :nombre, password = :pass WHERE id_usuarios = :id";
            } else {
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

    public static function mdlEliminarAdoptanteYUsuario($idAdoptante, $emailUsuario) {
        $con = Conexion::conectar();
        
        try {
            // Iniciar transacción (Todo o nada)
            $con->beginTransaction();

            // 1. ELIMINAR DE LA TABLA ADOPTANTES (Usando el ID)
            $stmtAdp = $con->prepare("DELETE FROM adoptantes WHERE id_adoptantes = :id");
            $stmtAdp->bindParam(":id", $idAdoptante, PDO::PARAM_INT);
            if (!$stmtAdp->execute()) {
                throw new Exception("Error al eliminar el perfil de adoptante.");
            }
            
            // 2. ELIMINAR DE LA TABLA USUARIOS (Usando el email, que es el campo de vinculación lógica)
            $stmtUser = $con->prepare("DELETE FROM usuarios WHERE email = :email AND id_roles = 2"); // id_roles=2 es Adoptante
            $stmtUser->bindParam(":email", $emailUsuario, PDO::PARAM_STR);

            if (!$stmtUser->execute()) {
                throw new Exception("Error al eliminar el usuario.");
            }

            // Si todo salió bien, confirmamos los cambios
            $con->commit();
            return ["codigo" => "200", "mensaje" => "Adoptante y usuario eliminados exitosamente."];

        } catch (Exception $e) {
            // Si algo falla, revertimos todos los cambios
            if ($con->inTransaction()) {
                $con->rollBack();
            }
            return ["codigo" => "500", "mensaje" => "Error interno en la eliminación: " . $e->getMessage()];
        }
    }
}
?>