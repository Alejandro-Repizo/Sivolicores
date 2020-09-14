<?php

class Categoria{
    private $PK_ID_Categoria;
    private $Cat_Nombre;

    public function __construct($Cat_Nombre){
        $this->Cat_Nombre = $Cat_Nombre;
    }

    public function getNombre(){
        return $this->Cat_Nombre;
    }

    public function getPK_ID_Categoria(){
        return $this->PK_ID_Categoria;
    }

    public function setPK_ID_Categoria($PK_ID_Categoria){
        return $this->PK_ID_Categoria = $PK_ID_Categoria;
    }
}