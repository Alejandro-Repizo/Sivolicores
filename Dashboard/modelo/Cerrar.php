<?php
    require_once  'sesion.php';
    //Terminamos la sesion creada.

    session_unset();
    session_destroy();
    $_SESSION = [];

    //Direccionamos a la pagina principal
    header("Location: /mvcproyect/Dashboard/");

?>