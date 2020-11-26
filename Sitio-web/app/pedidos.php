<?php 
    session_start();
    require_once 'config.php';
    require_once 'functions.php';

    try {

        //Conexion 
        $conexion = conexion($bd_config);

        // Traemos la llave primaria
        if (isset($_SESSION['PK'])) {
            $id = $_SESSION['PK'];
        }

        //Arreglo de las tablas
        $tablas = ['tbl_envio', 'tbl_pedido'];
        $respuesta = [];


        // Consulta 
        foreach($tablas as $tabla) {
            $statement = $conexion->prepare("SELECT Pt_Nombre, Ped_Fecha, Pt_Cantidad, Total, Estado FROM $tabla WHERE PK_ID_Cliente = '$id'");
            $statement->execute();
            $resultado = $statement->fetchAll();
            // if(!empty($resultado)) {
            //     break;
            // }
            array_push($respuesta, $resultado);
        }

        // $respuesta = [];

        // while($fila = $resultado->fetch_assoc()){
        //     $pedido = [
        //         'Pt_Nombre' => $fila['Pt_Nombre'],
        //         'Ped_Fecha' => $fila['Ped_Fecha'],
        //         'Pt_Cantidad' => $fila['Pt_Cantidad'],
        //         'Total' => $fila['Total'],
        //         'Estado' => $fila['Estado'],
        //     ];
        //     array_push($respuesta, $pedido);
        // }
        // Revise la consola

    } catch (Exception $ex) {
        echo "Error:  $ex";
    }

    print json_encode($respuesta, JSON_UNESCAPED_UNICODE);





?>