<?php

class Categoria{
    private $PK_ID_Categoria;
    private $Cat_Nombre;
    private $Cat_Imagen;
    private $Cat_Banner_Imagen;

    public function __construct($Cat_Nombre){
        $this->Cat_Nombre = $Cat_Nombre;
    }

    public function getNombre(){
        return $this->Cat_Nombre;
    }

    public function getCat_Imagen(){
        return $this->Cat_Imagen;
    }

    public function setCat_Imagen($Cat_Imagen) {
        return $this->Cat_Imagen = $Cat_Imagen;
    }

    public function getCat_Banner_Imagen(){
        return $this->Cat_Banner_Imagen;
    }

    public function setCat_Banner_Imagen($Cat_Banner_Imagen) {
        return $this->Cat_Banner_Imagen = $Cat_Banner_Imagen;
    }
   
    public function getPK_ID_Categoria(){
        return $this->PK_ID_Categoria;
    }

    public function setPK_ID_Categoria($PK_ID_Categoria){
        return $this->PK_ID_Categoria = $PK_ID_Categoria;
    }
}