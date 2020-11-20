<?php 
   
    require_once 'app/config.php';
    require_once 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if(!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    // header
    $categorias =  obtener_categoria($conexion);

    // Slides
    $slide_uno = obtener_banner_por_nombre($banner_config['slide_uno'], $conexion);
    $slide_dos = obtener_banner_por_nombre($banner_config['slide_dos'], $conexion);
    $slide_tres = obtener_banner_por_nombre($banner_config['slide_tres'], $conexion);

    // Productos
    $productos = obtener_productos_index($producto_config['producto_por_pagina'],$conexion);

    // Parallax
    $parallax = obtener_banner_por_nombre($banner_config['parallax'], $conexion);

    // Recetas cocteles

    $receta_coctel = obtener_coctel_index($conexion);

    require 'views/index.view.php';




?>