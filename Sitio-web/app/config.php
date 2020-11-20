<?php

// Ruta
define('RUTA', 'localhost:8080/mvcproyect/Sitio-web');

// Arreglo donde va a ir todo lo de la base de datos

$bd_config = [
    'dbname' => 'dbsivolicores',
    'username' => 'root',
    'password' => ''
];

// Configuracion recetas coctel
$coctel_config = [
    'coctel_por_pagina' => '3'
];

// Configuracion productos 
$producto_config = [
    'producto_por_pagina' => '12'
];

// Nombre banners 
$banner_config = [

    'parallax' => 'Parallax',
    'slide_uno' => 'Slide_uno',
    'slide_dos' => 'Slide_dos',
    'slide_tres' => 'Slide_tres',
    'receta_coctel' => 'Cócteles',
    'carrito' => 'Carrito',
    'finalizar_pedido' => 'Finalizar_pedido',
    'login' => 'Login',
    'registro' => 'Registro'
] 
?>