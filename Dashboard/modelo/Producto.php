<?php 

class Producto{
    private $PK_ID_Producto ;
    private $Pt_Nombre;
    private $Pt_codigo;
    private $Pt_Precio;
    private $Pt_Imagen;
    private $Pt_Presentacion;   
    private $Pt_Pais;
    private $Pt_Color;
    private $Pt_Stock;
    private $FK_ID_Categoria;
    private $FK_ID_SubCategoria;
    private $FK_ID_Marca;
    private $Pt_Grados_alchol;

    public function __construct($Pt_Nombre){
        $this->Pt_Nombre = $Pt_Nombre;
    }


    public function getPK_ID_Producto(){
        return $this->PK_ID_Producto;
    }

    public function setPK_ID_Producto($PK_ID_Producto){
        return $this->PK_ID_Producto = $PK_ID_Producto;
    }


   

    public function getPt_Nombre(){
        return $this->Pt_Nombre;
    }
        
    public function setPt_Nombre($Pt_Nombre){
        return $this->Pt_Nombre = $Pt_Nombre;
    }
    



    public function getPt_codigo(){
        return $this->Pt_codigo;
    }

    public function setPt_codigo($Pt_codigo){
        return $this->Pt_codigo = $Pt_codigo;
    }





    public function getPt_Precio(){
        return $this->Pt_Precio;
    }

    public function setPt_Precio($Pt_Precio){
        return $this->Pt_Precio = $Pt_Precio;
    }    
    


    
    public function getPt_Imagen(){
        return $this->Pt_Imagen;
    }

    public function setPt_Imagen($Pt_Imagen){
        return $this->Pt_Imagen = $Pt_Imagen;
    }    
    



    public function getPt_Presentacion(){
        return $this->Pt_Presentacion;
    }
        
    public function setPt_Presentacion($Pt_Presentacion){
        return $this->Pt_Presentacion = $Pt_Presentacion;
    }
    



    public function getPt_Pais(){
        return $this->Pt_Pais;
    }
        
    public function setPt_Pais($Pt_Pais){
        return $this->Pt_Pais = $Pt_Pais;
    }
 
    


    public function getPt_Color(){
        return $this->Pt_Color;
    }
        
    public function setPt_Color($Pt_Color){
        return $this->Pt_Color = $Pt_Color;
    }
    



    public function getPt_Stock(){
        return $this->Pt_Stock;
    }
        
    public function setPt_Stock($Pt_Stock){
        return $this->Pt_Stock = $Pt_Stock;
    }




    public function getFK_ID_Categoria(){
        return $this->FK_ID_Categoria;
    }
        
    public function setFK_ID_Categoria($FK_ID_Categoria){
        return $this->FK_ID_Categoria = $FK_ID_Categoria;
    }


    public function getFK_ID_SubCategoria(){
        return $this->FK_ID_SubCategoria;
    }
        
    public function setFK_ID_SubCategoria($FK_ID_SubCategoria){
        return $this->FK_ID_SubCategoria = $FK_ID_SubCategoria;
    }



    public function getFK_ID_Marca(){
        return $this->FK_ID_Marca;
    }
        
    public function setFK_ID_Marca($FK_ID_Marca){
        return $this->FK_ID_Marca = $FK_ID_Marca;
    }



    public function getPt_Grados_alchol(){
        return $this->Pt_Grados_alchol;
    }

    public function setPt_Grados_alchol($Pt_Grados_alchol){
        return $this->Pt_Grados_alchol = $Pt_Grados_alchol;
    }



    
    

}
?>