<?php
    require_once 'config.php';
    require_once 'functions.php';

    try {
        // Conexion
        $conexion = conexion($bd_config);

        // Limpiamos y recibimos los datos;
        $Cl_email = limpiarEmail($_POST['Cl_email']);
        $Cl_password = limpiarString($_POST['Cl_password']);
        $Cl_password = hash('md5',$Cl_password);
       
        // Consulta a la base de datos
        $statement = $conexion->prepare("SELECT PK_ID_Cliente, Cl_Nombre, Cl_Apellido, Cl_Direccion, 
        Cl_Telefono, Cl_Pedidos_realizado, Cl_email, Cl_password FROM tbl_cliente
        WHERE Cl_email = '$Cl_email' AND Cl_password = '$Cl_password'");
        $statement->execute();

        ///Coloca todo en una arreglo
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

        //Se comprueba si la variable data viene vacia y dado el caso envia un error
        if ($resultado != false) {
            session_start();
            $response['mensaje'] = true;
            $_SESSION['email'] = $Cl_email;
            $PK_ID_Cliente = $resultado['0']['PK_ID_Cliente'];
            $_SESSION['PK'] = $PK_ID_Cliente;
        } else {
            $response['mensaje'] = "El usuario o la contraseña que ingresaste no coinciden con nuestros registros. Por favor, intenta de nuevo.";
        }


    } catch (Exception $ex) {
        echo ("Error: $ex");        
    }

    // Envíar el arreglo final en formato JSON a JS
    print json_encode($response, JSON_UNESCAPED_UNICODE);

?>