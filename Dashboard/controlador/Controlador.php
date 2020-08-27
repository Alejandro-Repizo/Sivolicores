<?php 

require_once '../modelo/administrador.php';
require_once '../modelo/Consultar.php';
require_once '../modelo/Marca.php';
require_once '../modelo/Cliente.php';
require_once '../modelo/Producto.php';

class Controlador{

    //Es el puente entre los datos y la sentencia SQL
    public function consulSesion($email, $password){
        $admin = new Administrador($email, $password);
        $consultar =  new Consultar();
        $consultar->conSesion($admin);
    }

    public function saveMarca($nombre){
        $marca = new Marca($nombre);
        $consultar = new consultar();
        $consultar->saveMarcas($marca);
    }

    public function updateMarca($nombre, $id){
        $marca = new Marca($nombre);
        $marca->setId($id);
        $consultar =  new consultar();
        $consultar->updateMarcas($marca);
    }

    public function deleteMarca($nombre){
        $marca = new Marca($nombre);
        $consultar =  new consultar();
        $consultar->deleteMarcas($marca);
    }

    public function updateUser($id, $apellido, $nombre ,$email, $password){
        $admin = new Administrador($email, $password);
        $admin->setNombre($nombre);
        $admin->setApellido($apellido);
        $admin->setId($id);
        $consultar =  new consultar();
        $consultar->updateUsers($admin);
    }
    
    public function deleteCliente($nombre){
        $cliente = new Cliente($nombre);
        $consultar =  new consultar();
        $consultar->deleteCliente($cliente);
    }

    public function updateInventario($id, $precio, $stock){
        $marca = new Productos();
        $marca->setId($id); 
        $marca->setPrecio($precio);
        $marca->setStock($stock);   
        $consultar =  new consultar();
        $consultar->upInventario($marca);
    }

    public function updateProducto($Pt_Nombre, $PK_ID_Producto, $Pt_codigo,$Pt_Precio, $Pt_Presentacion, $Pt_Pais, 
    $Pt_Color,$Pt_Stock, $Pt_Grados_alchol){
        $Producto = new Producto($Pt_Nombre);
        $Producto->setPK_ID_Producto($PK_ID_Producto);
        $Producto->setPt_codigo($Pt_codigo);
        $Producto->setPt_Precio($Pt_Precio);

        $Producto->setPt_Presentacion($Pt_Presentacion);
        $Producto->setPt_Pais($Pt_Pais);
        $Producto->setPt_Color($Pt_Color);
        $Producto->setPt_Stock($Pt_Stock);

        $Producto->setPt_Grados_alchol($Pt_Grados_alchol);
        $conexion =  new Consultar();
        $conexion->upProducto($Producto);
    }

    public function deleteProducto($PK_ID_Producto){

        $Producto = new Producto($PK_ID_Producto);
        $conexion =  new Consultar();
        $conexion->deleteProducto($Producto);
    }
    
    
}
