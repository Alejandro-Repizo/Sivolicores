<?php

class Coctel{
    private $PK_ID_Receta;
    private $RC_Nombre;
    private $RC_Receta;
    private $RC_Fecha;
    private $RC_Autor;
    private $RC_Descripcion;
    private $RC_Image;

    public function __construct($RC_Nombre){
        $this->RC_Nombre = $RC_Nombre;
    }

    public function getPK_ID_Receta(){
        return $this->PK_ID_Receta;
    }
    public function setPK_ID_Receta($PK_ID_Receta){
        return $this->PK_ID_Receta = $PK_ID_Receta;
    }


    public function getRC_Nombre(){
        return $this->RC_Nombre;
    }


    public function getRC_Receta(){
        return $this->RC_Receta;
    }
    public function setRC_Receta($RC_Receta){
        return $this->RC_Receta = $RC_Receta;
    }


    public function getRC_Fecha(){
        return $this->RC_Fecha;
    }
    public function setRC_Fecha($RC_Fecha){
        return $this->RC_Fecha = $RC_Fecha;
    }


    public function getRC_Autor(){
        return $this->RC_Autor;
    }
    public function setRC_Autor($RC_Autor){
        return $this->RC_Autor = $RC_Autor;
    }


    public function getRC_Descripcion(){
        return $this->RC_Descripcion;
    }
    public function setRC_Descripcion($RC_Descripcion){
        return $this->RC_Descripcion = $RC_Descripcion;
    }


    public function getRC_Image(){
        return $this->RC_Image;
    }
    public function setRC_Image($RC_Image){
        return $this->RC_Image = $RC_Image;
    }

   
}