<?php
    require_once 'app/config.php';
    require_once 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if(!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

   // Traemos la pk;
    if(isset($_SESSION['PK'])) {
        $id = $_SESSION['PK'];
        $dato = obtener_datos_cliente($id, $conexion);
        $dato = $dato['0'];
    }
    
    require 'views/editar_cliente.view.php';

?>