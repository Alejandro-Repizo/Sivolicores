<?php
    session_start();
    require 'app/config.php';
    require 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if (!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }
    
    // Obtenemos el id de la categoria
    if(!empty($_GET['idS'])) {
        $id = id_producto($_GET['idS']);
        $productos = obtener_producto_sub($id, $conexion);
        $id_cat = obtener_id_cat($id, $conexion);
        $nombre_banner = obtener_nombre_banner($id_cat['0']['FK_ID_Categoria'], $conexion);
    }elseif(!empty($_GET['id'])) {
        $id = id_producto($_GET['id']);
        $productos = obtener_producto($id, $conexion);
        $nombre_banner = obtener_nombre_banner($id, $conexion);
    }else {
        header('location: index.php');
    }

    // Validamos que hayan productos, si es false devolvemos a index
    if(!$productos) {
        header('location: index.php');
    }

    // Banner
    $banner = obtener_banner_por_nombre($nombre_banner[0]['Cat_Nombre'], $conexion);


    require 'views/productos.view.php';

?>