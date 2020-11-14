<?php
 require 'app/config.php';
 require 'app/functions.php';

 // Validacion de conexion
 $conexion = conexion($bd_config);
 if(!$conexion) {
     // header('location: error.php');
     echo 'error conexion';
 }


if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])) {
    $busqueda = limpiarDatos($_GET['busqueda']);

    $statement = $conexion->prepare(
        'SELECT * FROM tbl_receta_coctel WHERE RC_Nombre lIKE :busqueda or RC_Descripcion LIKE :busqueda'
    );
    $statement->execute([':busqueda' => "%$busqueda%"]);
    $resultados = $statement->fetchAll();

    if (empty($resultados)) {
        $titulo = 'No se encontraron recetas con el resultado: ' . $busqueda;
    }else {
        $titulo = 'Resultados de la busqueda: ' . $busqueda;
    }
} else {
    header('Location: ' . RUTA . '/index.php');
}

require 'views/buscar.view.php';
?>