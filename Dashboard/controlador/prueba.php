<?php

require_once  'ConexionDB.php';

    
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    

    switch ($opcion) {
        case 1:
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $sql="SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ";
            $conexion->consulta($sql);
            $result=$conexion->obtenerResult();
            $data = $result->fetch_assoc();
       
            break;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
    $conexion->cerrar();