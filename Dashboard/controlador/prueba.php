<?php

require_once '../modelo/conecPrueba.php';
require_once '../modelo/ConexionDB.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
    
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $nombreMarca =  (isset($_POST['nombreMarca'])) ? $_POST['nombreMarca'] : '';
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    

    switch ($opcion) {
        case 1:
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:
            $conexion =  new ConexionDB();
            $conexion->abrir();
            $sql = "UPDATE tbl_marca SET Ma_nombre = '$nombreMarca' WHERE PK_ID_Marca = '$id'";
            $conexion->consulta($sql);
            $result=$conexion->obtenerResult();
            $data = $result->fetch_all();
            echo "<script>alert('buenas');</script>";
        break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
    $conexion = NULL;