<?php 
    session_start();


    //Terminamos la sesion creada.

    session_unset();
    session_destroy();
    $_SESSION = [];

    // header('Location: index.php');


?>