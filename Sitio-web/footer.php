<?php 

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if (!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    $datos =  obtener_categoria($conexion);

    require 'views/footer.view.php';

?>