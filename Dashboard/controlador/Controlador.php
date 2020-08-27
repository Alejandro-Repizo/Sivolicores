<?php 


require_once '../modelo/administrador.php';
require_once '../modelo/Consultar.php';
require_once '../modelo/Marca.php';


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
    
    
}