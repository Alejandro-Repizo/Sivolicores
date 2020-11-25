<?php 
    session_start();
    require_once 'config.php';
    require_once 'functions.php';

    try {
        // Conexion
        $conexion = conexion($bd_config);

        // Traemos la llave primaria
        if (isset($_SESSION['PK'])) {
            $PK_ID_Cliente = $_SESSION['PK'];
        }

        if (isset($_POST['PK_ID_Producto'])) {
            // Consulta y calculo 
            $PK_ID_Producto = id_producto($_POST['PK_ID_Producto']);
            $Producto = obtener_info_venta_producto($PK_ID_Producto, $conexion);
            $Producto = $Producto[0];
            $Pt_Cantidad = intval($_POST['Pt_Cantidad']);
            $Pt_Precio = intval($Producto['Pt_Precio']);
            $Pt_Nombre = $Producto['Pt_Nombre'];
            $Total = number_format($Pt_Cantidad * $Pt_Precio);
        }
        
        // Limipiamos y recibimos los datos:
        $Cl_Nombre = limpiarString($_POST['Cl_Nombre']);
        $Cl_Dirección = limpiarString($_POST['Cl_Direccion']);
        $Cl_Telefono = limpiarNumber($_POST['Cl_Telefono']);
        $Ped_Observaciones = limpiarString($_POST['Ped_Observaciones']);
        $Estado = 'pendiente';
        // $Cl_Pedidos_realizado = 0;


        // Insert en la base de datos
        $statement = $conexion->prepare("INSERT INTO tbl_pedido (Cl_Nombre,Pt_Nombre, Pt_Cantidad, Ped_Direccion, 
        Cl_Telefono, Total, Ped_Observaciones, Estado, PK_ID_Cliente) 
        VALUES ('$Cl_Nombre', '$Pt_Nombre', '$Pt_Cantidad', '$Cl_Dirección','$Cl_Telefono', '$Total', '$Ped_Observaciones', '$Estado', '$PK_ID_Cliente')");
        $statement->execute() or die ("Error al grabar el registro");

        if ($statement){
            unset($_SESSION["shopping_cart"]);
        }

    }catch (Exeption $ex) {
        echo ("Error: $ex");
    }

?>