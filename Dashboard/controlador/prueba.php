<?php

//require_once '../modelo/conecPrueba.php';
require_once '../modelo/ConexionDB.php';
require_once '../modelo/ConexionBD.php';
// $objeto = new Conexion();
// $conexion = $objeto->Conectar();

$conexion = new ConexionBD();
    
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $nombreMarca =  (isset($_POST['nombreMarca'])) ? $_POST['nombreMarca'] : '';
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    

    switch ($opcion) {
        case 1:
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        // case 2:
        //     $consulta = "UPDATE tbl_marca SET Ma_nombre = '$nombreMarca' WHERE PK_ID_Marca = '$id'";
        //     $resultado = $conexion->prepare($consulta);
        //     $resultado->execute();
            
        //     $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
        //     $resultado = $conexion->prepare($consulta);
        //     $resultado->execute();

        //     $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        //     break;
    }

   