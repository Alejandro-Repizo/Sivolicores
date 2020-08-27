<?php

 $route = $_GET['route'] ?? '/';

 if($route == '/'){
    require 'vista/html/index.php';
 }elseif ($route == 'addJob'){
    require '../addJob.php';
 }

