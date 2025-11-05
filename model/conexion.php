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
            
           
            $objConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $objConexion->exec("set names utf8");

            return $objConexion;

        } catch (PDOException $e) {
            return null;
        }
    }
}