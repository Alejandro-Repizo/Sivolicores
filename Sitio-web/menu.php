<?php
   
    require_once 'app/config.php';
    require_once 'app/functions.php';
 
    // Traemos la pk;
    if(isset($_SESSION['PK'])) {
        $id = $_SESSION['PK'];
        $dato = obtener_datos_cliente($id, $conexion);
        $dato = $dato['0'];
    }
    require 'views/menu.view.php';
?>