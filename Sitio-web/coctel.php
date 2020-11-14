<?php

    require 'app/config.php';
    require 'app/functions.php';

    // Validacion de conexion
    $conexion = conexion($bd_config);
    if (!$conexion) {
        // header('location: error.php');
        echo 'error conexion';
    }

    // Obtenemos la PK de la receta cocetel
    $id_receta = id_receta($_GET['id']);
    if (empty($id_receta)) {
        // redirigimos al index
        header('location: index.php');
    }

    // Obtenemos los datos de la receta
    $receta = obtener_receta_por_id($conexion, $id_receta);
    if (!$receta) {
        // redirigimos al index
        header('Location: index.php');
    }

    $receta = $receta[0];
    
    require 'views/coctel_single.view.php';

?>