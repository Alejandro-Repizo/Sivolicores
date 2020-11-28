<?php

    require_once 'config.php';
    require_once 'functions.php';

    try {
        // Conexion
        $conexion = conexion($bd_config);

        // Limipiamos y recibimos los datos:
        $Cl_Nombre = limpiarString($_POST['Cl_Nombre']);
        $Cl_Apellido = limpiarString($_POST['Cl_Apellido']);
        $Cl_Direccion = limpiarString($_POST['Cl_Direccion']);
        $Cl_Telefono = limpiarNumber($_POST['Cl_Telefono']);
        $Cl_email = limpiarEmail($_POST['Cl_email']);
        $Cl_password = limpiarString($_POST['Cl_password']);
        $Cl_password = hash('md5', $Cl_password);
        $Cl_Pedidos_realizado = 0;

        // Insert en la base de datos
        $statement = $conexion->prepare("INSERT INTO tbl_cliente (Cl_Nombre, Cl_Apellido, Cl_Direccion, Cl_Telefono, Cl_Pedidos_realizado, 
        Cl_email, Cl_password) VALUES ('$Cl_Nombre', '$Cl_Apellido', '$Cl_Direccion', '$Cl_Telefono','$Cl_Pedidos_realizado', '$Cl_email', '$Cl_password')");
        $statement->execute() or die ("Error al grabar el registro");

        if ($statement){
            $response['correcto'] = true;
        }else {
            $response['correcto'] = false;
        }


    }catch (Exeption $ex) {
        echo ("Error: $ex");
    }

    // Envíar el arreglo final en formato JSON a JS
    print json_encode($response, JSON_UNESCAPED_UNICODE);






?>