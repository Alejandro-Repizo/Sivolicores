<?php 

require_once 'Controlador.php';

//Acá se captura la variable opcion y se redirije con un switch
if(isset($_POST['opcion'])){
    $opcion = $_POST['opcion'];
    switch ($opcion) {
        case 'agregarMarca':
            $Controlador = new Controlador();
            $nombreMarca = $_POST['nombreMarca'];
            if(!empty($nombreMarca)){
                $nombreMarca = trim($nombreMarca);
                $nombreMarca = filter_var($nombreMarca, FILTER_SANITIZE_STRING);
                $Controlador->saveMarca($nombreMarca);
            }
            break;

        case 'editarMarca':
            $Controlador = new Controlador();
            $nombreMarca = $_POST['nombreMarca'];
            $id = $_POST['id'];
            if(!empty($nombreMarca)){
                $nombreMarca = trim($nombreMarca);
                $nombreMarca = filter_var($nombreMarca, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $Controlador->updateMarca($nombreMarca, $id);
            break;

        case 'borrarMarca':
            $Controlador = new Controlador();
            $id = (isset($_POST['id'])) ? $_POST['id'] : '';
            $Controlador->deleteMarca($_POST['nombreMarca'], $_POST['id']);
            break;
        
        case 'cargarMarca':
            $controlador = new Controlador();
            $controlador->cargarMarca();
            break;
        
        case 'editarInventario':
            $Controlador = new Controlador();
            $Pt_Nombre = $_POST['Pt_Nombre'];
            $Pt_Precio = $_POST['Pt_Precio'];
            $Pt_Stock = $_POST['Pt_Stock'];
            $id = $_POST['id'];
            if(!empty($Pt_Nombre)){
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($Pt_Precio)){
                $Pt_Precio = trim($Pt_Precio);
                $Pt_Precio = htmlspecialchars($Pt_Precio);
            }
            if(!empty($Pt_Stock)){
                $Pt_Stock = trim($Pt_Stock);
                $Pt_Stock = filter_var($Pt_Stock, FILTER_VALIDATE_INT);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $Controlador->updateInventario($id, $Pt_Precio, $Pt_Stock, $Pt_Nombre);
            break;

        case 'cargarInventario':
            $controlador = new Controlador();
            $controlador->cargarInventario();
            break;

        case 'cargarCliente':
            $controlador = new Controlador();
            $controlador->cargarCliente();
            break;

        case 'borrarCliente':
            $controlador = new Controlador();
            $Cl_Nombre = $_POST['Cl_Nombre'];
            $id = $_POST['id'];
            if(!empty($Cl_Nombre)){
                $Cl_Nombre = trim($Cl_Nombre);
                $Cl_Nombre = filter_var($Cl_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->deleteCliente($id, $Cl_Nombre);
            break;

    }

}
//Acá se captura la variable opcion y se redirije con un switch
if(isset($_POST['opcionInventario'])){
    $opcionInventario = $_POST['opcionInventario'];
    switch ($opcionInventario) {
        case 'cargarInventario':
            $controlador = new controlador();
            $controlador->cargarMarca();
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
        $Controlador = new Controlador();
        $Controlador->consulSesion(
        $_POST['ses_email'],$_POST['ses_password'],md5($ses_password));
    }
}
// if(isset($_GET['accion'])){
//     if($_GET['accion'] == 'save'){
//         $Controlador = new Controlador();
//         $Controlador->saveMarca($_POST['Ma_nombre']);
//     }
// }
// if(isset($_GET['accion'])){
//     if($_GET['accion'] == 'updateMarca'){
//         $Controlador = new Controlador();
//         $a = $_POST['Marca'];
//         var_dump($a);
//         $Controlador->updateMarca($_POST['Ma_nombre'], $_POST['Marca']);
//     }
// }
// if(isset($_GET['deleteMarca'])){
//     $Controlador = new Controlador();
//     $Controlador->deleteMarca($_GET['deleteMarca']);
// }
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
// if(isset($_GET['accion'])){
//     if($_GET['accion'] == 'c'){
//         $Controlador = new Controlador();
//         $Controlador->updateInventario($_POST['Pt_Nombre'], $_POST['Pt_Precio'], $_POST['Pt_Stock']);
//     }
// }
// if(isset($_GET['accion'])){
//     if($_GET['accion'] == 'updateInventario'){
//         $Controlador = new Controlador();
//         $Controlador->updateInventario($_POST['PK_ID_Producto'],$_POST['Pt_Precio'], $_POST['Pt_Stock']);
//     }
// } 
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