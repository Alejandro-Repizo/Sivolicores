<?php 

    require_once 'app/config.php';
    require_once 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if(!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    // Recetas cocteles
    $receta_coctel = obtener_receta($coctel_config['coctel_por_pagina'], $conexion);
    $numero_paginas = numero_paginas($coctel_config['coctel_por_pagina'], $conexion); 
    

    // Banner
    $banner = obtener_banner_por_nombre($banner_config['receta_coctel'], $conexion);


    require 'views/recetas_cocteles.view.php';

?>