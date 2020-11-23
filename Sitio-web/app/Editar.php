<?php 
    session_start();
    require_once 'config.php';
    require_once 'functions.php';

    try {

        //Conexion
        $conexion = conexion($bd_config);
        
        // Limipiamos y recibimos los datos:
        $Cl_Nombre = limpiarString($_POST['Cl_Nombre']);
        $Cl_Apellido = limpiarString($_POST['Cl_Apellido']);
        $Cl_Dirección = limpiarString($_POST['Cl_Dirección']);
        $Cl_Telefono = limpiarNumber($_POST['Cl_Telefono']);

        // Traemos la llave primaria
        if(isset($_SESSION['PK'])) {
            $id = $_SESSION['PK'];
        }

        if(isset($_POST['Cl_password'])) {
            // Hasheamos la password
            $Cl_password = limpiarString($_POST['Cl_password']);
            $Cl_password = hash('md5', $Cl_password);

            // Consulta a la base de datos
            $statement = $conexion->prepare("UPDATE tbl_cliente SET Cl_Nombre = '$Cl_Nombre', Cl_Apellido = '$Cl_Apellido', Cl_Dirección = '$Cl_Dirección',
            Cl_Telefono = '$Cl_Telefono', Cl_password = '$Cl_password' WHERE PK_ID_Cliente = '$id'");
    
        }else {
            // Consulta a la base de datos
            $statement = $conexion->prepare("UPDATE tbl_cliente SET Cl_Nombre = '$Cl_Nombre', Cl_Apellido = '$Cl_Apellido', Cl_Dirección = '$Cl_Dirección',
            Cl_Telefono = '$Cl_Telefono' WHERE PK_ID_Cliente = '$id'");
     
        }
    
        // Executamos la sentencia
        $statement->execute() or die ("Error al actualizar el registro");

        if ($statement){
            $response['correcto'] = true;
        }else {
            $response['correcto'] = false;
        }

    } catch (Exception $ex) {
        echo ("Error $ex");
    }
    
    // Envíar el arreglo final en formato JSON a JS
    print json_encode($response, JSON_UNESCAPED_UNICODE);

?>