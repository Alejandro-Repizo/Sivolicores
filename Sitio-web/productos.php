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
    $id = id_producto($_GET['id']);
    if (empty($id)) {
        // redirigimos al index
        header('location: index.php');
    }

    if (validar_subCategoria($id, $conexion)) {
        $productos = obtener_producto_sub($id, $conexion);
        $id_cat = obtener_id_cat($id, $conexion);
        $nombre_banner = obtener_nombre_banner($id_cat['0']['FK_ID_Categoria'], $conexion); 
    }else {
        $productos = obtener_producto($id, $conexion);
        $nombre_banner = obtener_nombre_banner($id, $conexion);
    }

    // Banner
    $banner = obtener_banner_por_nombre($nombre_banner[0]['Cat_Nombre'], $conexion);

    if(!$productos) {
        header('location: index.php');
    }





    require 'views/productos.view.php';

?>