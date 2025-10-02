<?php

class Conexion {
    public static function conectar() {
        $nombreServidor = "localhost";
        $usuarioServidor = "root";
        $baseDatos = "safe_pets";
        $password = "";

        try {
            $objConexion = new PDO(
                'mysql:host=' . $nombreServidor . ';dbname=' . $baseDatos . ';',
                $usuarioServidor,
                $password
            );
            
            // Configurar PDO para que lance excepciones en caso de error
            $objConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $objConexion->exec("set names utf8");

            return $objConexion;

        } catch (PDOException $e) {
            // Si la conexión falla, devolvemos null para poder manejar el error.
            // En un entorno de producción, aquí se registraría el error en un log.
            // error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return null;
        }
    }
}