<?php


class Conexion{
   
    public static function Conectar(){
        define("servidor", "localhost");
        define("nombre_bd", "dbsivolicores");
        define("usuario", "root");
        define("password", "");

        $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

        try {
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
            return $conexion;
        } catch (Exception $error) {
            die("El error de la conexión es: ".$error->getMessage());
        }
    }
}