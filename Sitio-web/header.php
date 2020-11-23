<?php  

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if (!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    $categorias =  obtener_categoria($conexion);
  
    
   
    

    require 'views/header.view.php';
  

?>