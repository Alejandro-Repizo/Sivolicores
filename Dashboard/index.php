<?php

 $route = $_GET['route'] ?? '/';

 if($route == '/'){
    require 'vista/html/index.php';
 }elseif ($route == 'Login'){
    require 'vista/html/index.php';
 }

