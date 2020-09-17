<?php 


class Banner{
    private $PK_ID_Banner;
    private $B_Nombre;
    private $B_Imagen;
    private $B_Fecha_actualizacion;

    public function __construct(){}

    public function getPK_ID_Banner(){
        return $this->PK_ID_Banner;
    }
    public function setPK_ID_Banner($PK_ID_Banner){
        return $this->PK_ID_Banner = $PK_ID_Banner;
    }


    public function getB_Nombre(){
        return $this->B_Nombre;
    }
    public function setB_Nombre($B_Nombre){
        return $this->B_Nombre = $B_Nombre;
    }


    public function getB_Imagen(){
        return $this->B_Imagen;
    }
    public function setB_Imagen($B_Imagen){
        return $this->B_Imagen = $B_Imagen;
    }


    public function getB_Fecha_actualizacionr(){
        return $this->B_Fecha_actualizacion;
    }
    public function setB_Fecha_actualizacion($B_Fecha_actualizacion){
        return $this->B_Fecha_actualizacion = $B_Fecha_actualizacion;
    }

    


    


}
