<?php

class SubCategoria{
    private $PK_ID_SubCategoria;
    private $SCat_Nombre;

    public function __construct($SCat_Nombre){
        $this->SCat_Nombre = $SCat_Nombre;
    }

    public function getNombre(){
        return $this->SCat_Nombre;
    }

    public function getPK_ID_SubCategoria(){
        return $this->PK_ID_SubCategoria;
    }

    public function setPK_ID_SubCategoria($PK_ID_SubCategoria){
        return $this->PK_ID_SubCategoria = $PK_ID_SubCategoria;
    }
}