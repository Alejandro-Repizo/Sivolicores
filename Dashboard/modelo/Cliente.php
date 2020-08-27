<?php 

class Cliente{
    private $id;
    private $nombre;
    private $correo;
    private $pedidos;
    private $registro;

    public function __construct($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPedidos(){
        return $this->pedidos;
    }

    public function getRegistro(){
        return $this->registro;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }
}
?>