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
        $tablas = ['tbl_envio', 'tbl_pedido', 'tbl_reporte_pedido', 'tbl_reporte_ventas'];

        // Consulta 
        foreach($tablas as $tabla) {
            $statement = $conexion->prepare("SELECT * FROM $tabla WHERE FK_ID_Carrito = '$id'");
            $statement->execute();
            $resultado = $statement->fetchAll();
            if(!empty($resultado)) {
                break;
            }
        }
        // Revise la consola

    } catch (Exception $ex) {
        echo "Error:  $ex";
    }

    print json_encode($resultado, JSON_UNESCAPED_UNICODE);





?>