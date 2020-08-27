<?php 


class Administrador {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        return $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    
    public function setApellido($apellido){
        return $this->apellido = $apellido;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

}