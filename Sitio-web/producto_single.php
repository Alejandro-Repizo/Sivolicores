<?php
    // Iniciamos session
    session_start();
    
    require 'app/config.php';
    require 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if (!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    $id_producto = id_producto($_GET['id']);
    if (empty($id_producto)) {
        header('Location: index.php');
    }

    $producto = obtener_producto_por_id($id_producto, $conexion);
    if (!$producto) {
        header('Location: index.php');
    }

    $producto = $producto[0];
    require 'views/producto_single.view.php';

?>