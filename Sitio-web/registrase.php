<?php
    require_once 'app/config.php';
    require_once 'app/functions.php';
  
    // Validacion de conexion
    $conexion = conexion($bd_config);
    if(!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }
  
    // Banner
    $banner = obtener_banner_por_nombre($banner_config['registro'], $conexion); 
    require 'views/registrase.view.php';

?>