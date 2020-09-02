<?php 

require_once 'Controlador.php';


if(isset($_POST['opcion'])){
    
    $opcion = $_POST['opcion'];
    switch ($opcion) {
        case 'agregar':
            $Controlador = new Controlador();
            //$nombreMarca =  (isset($_POST['nombreMarca'])) ? $_POST['nombreMarca'] : '';
            $Controlador->saveMarca($_POST['nombreMarca']);
            break;

        case 'editar':
            $Controlador = new Controlador();
            $id = (isset($_POST['id'])) ? $_POST['id'] : '';
            $nombreMarca =  (isset($_POST['nombreMarca'])) ? $_POST['nombreMarca'] : '';
            $Controlador->updateMarca($_POST['nombreMarca'], $_POST['id']);
            break;

        case 'borrar':
            $Controlador = new Controlador();
            $id = (isset($_POST['id'])) ? $_POST['id'] : '';
            $Controlador->deleteMarca($_POST['nombreMarca'], $_POST['id']);
            break;
            
        default:
                # code...
         break;
    }

}

//Acá se capturan todos los datos
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'login'){
        $ses_password = $_POST['ses_password'];
        var_dump($ses_password);
        $Controlador = new Controlador();
        $Controlador->consulSesion(
        $_POST['ses_email'],$_POST['ses_password'],md5($ses_password));
    }
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'save'){
        $Controlador = new Controlador();
        $Controlador->saveMarca($_POST['Ma_nombre']);
    }
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'updateMarca'){
        $Controlador = new Controlador();
        $a = $_POST['Marca'];
        var_dump($a);
        $Controlador->updateMarca($_POST['Ma_nombre'], $_POST['Marca']);
    }
}
if(isset($_GET['deleteMarca'])){
    $Controlador = new Controlador();
    $Controlador->deleteMarca($_GET['deleteMarca']);
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'updateUsers'){
        $Controlador = new Controlador();
        $ses_password = $_POST['ad_primaria'];
        var_dump($ses_password);
        $Controlador->updateUser($_POST['ad_primaria'], $_POST['ad_apellido'],
        $_POST['ad_nombre'],$_POST['ad_email'], $_POST['ad_password']);
    }
}
if(isset($_GET['deleteCliente'])){
    $Controlador = new Controlador();
    $Controlador->deleteCliente($_GET['deleteCliente']);
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'c'){
        $Controlador = new Controlador();
        $Controlador->updateInventario($_POST['Pt_Nombre'], $_POST['Pt_Precio'], $_POST['Pt_Stock']);
    }
}
if(isset($_GET['accion'])){
    if($_GET['accion'] == 'updateInventario'){
        $Controlador = new Controlador();
        $Controlador->updateInventario($_POST['PK_ID_Producto'],$_POST['Pt_Precio'], $_POST['Pt_Stock']);
    }
} 
//////
if(isset($_GET['editProducto'])){
    $controlador = new Controlador();
    $a= $_GET['editProducto'];
    var_dump($a);
    
}

if(isset($_GET['accion'])){
    if($_GET['accion'] == 'updateProducto'){
        $controlador = new Controlador();
        $controlador->updateProducto($_POST['Pt_Nombre'], $_POST['PK_ID_Producto'], $_POST['Pt_codigo'], $_POST['Pt_Precio'], $_POST['Pt_Presentacion'], $_POST['Pt_Pais'], $_POST['Pt_Color'],
         $_POST['Pt_Stock'], $_POST['Pt_Grados_alchol']);
    }
}
if(isset($_GET['PK_ID_Producto'])){
    $Controlador = new Controlador();
    $Controlador->deleteProducto($_GET['PK_ID_Producto']);
}