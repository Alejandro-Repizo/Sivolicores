<?php 

require_once 'Controlador.php';

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

if(isset($_GET['accion'])){
    if($_GET['accion'] == 'login'){
        $ses_password = $_POST['ses_password'];
        var_dump($ses_password);
        $Controlador = new Controlador();
        $Controlador->consulSesion(
        $_POST['ses_email'],$_POST['ses_password'],md5($ses_password));
    }
}