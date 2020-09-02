<?php 

class ConexionBD extends PDO {

    private $tipo_db = 'mysql'; //tipo de base de datos
    private $host = 'localhost';  //Host
    private $nombre_db = "dbsivolicores"; //Nombre
    private $usuario = "root"; //Usuario
    private $password = ""; //Contraseña

    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        try {
            parent::__construct("{$this->tipo_db}:dbname={$this->nombre_db};host={$this->host};charset=utf8", $this->usuario, $this->password);
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
         }
    }
}