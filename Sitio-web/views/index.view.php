<!DOCTYPE html><?php session_start(); ?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_index.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="assets/sweetAlert2/sweetalert2.min.css">
</head>

<body>
    <!--Header-->
    <div class="header">
        <!--parte superior del header-->
        <div class="header-top">
            <!--Redes sociales-->
            <div class="header-redes-sociales">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-whatsapp"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>
            <!--Logo-->
            <a href="" class="header-logo">
                <img src="imagenes/icons/logo.jpeg" alt="logo" width="170" height="70">
            </a>
            <!--Iconos-->
            <div class="header-icons">
                <a href="#" id="btn-user"><i class="fas fa-user-circle header-bar"></i></a>
                <a href="carrito.php"><i class="fas fa-shopping-cart"></i></a>
            </div>

        </div>
        <!--parte inferior del header-->
        <nav class="menu" id="menu">
            <div class="contenedor-enlaces-nav">
                <!--Categorías-->
                <?php foreach($categorias as $categoria):?>

                <?php if(!empty($categoria['Cat_Imagen'])):?>

                <li><a href="#"class="dropbtn"><?php echo $categoria['Cat_Nombre'];?><i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text"><?php echo $categoria['Cat_Nombre'];?></li>
                        <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                        <?php foreach($subs as $sub):?>
                            <li><a href="productos.php?id=<?php echo $sub['PK_ID_SubCategoria'];?>"><?php echo $sub['SCat_Nombre'];?></a></li>
                        <?php endforeach; ?>
                        <img src="../Dashboard/vista/imagenes/Categorias/<?php echo $categoria['Cat_Imagen']?>" alt="<?php echo $categoria['Cat_Imagen']?>">
                    </ul>
                </li>

                <?php else: ?>
                    <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                        <li><a href="recetas_cocteles.php" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php else: ?>
                        <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>"class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php endif; ?>
                <?php endif;?>

                <?php endforeach; ?>
            </div>
        </nav>

        <!-- Menú Lateral -->
        <?php require 'menu.php'; ?>

        <!---Menú pegajoso-->
        <nav class="menu2" id="menu2">
            <!--Logo-->
            <a href="index.html" class="menu2-logo">
                <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="60">
            </a>
            <div class="contenedor-enlaces-nav">
                <!--Categorías-->
                <?php foreach($categorias as $categoria): ?>

                <?php if(!empty($categoria['Cat_Imagen'])):?>
                <li><a href="#" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?><i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text"><?php echo $categoria['Cat_Nombre'];?></li>
                        <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                        <?php foreach($subs as $sub):?>
                            <li><a href="productos.php?id=<?php echo $sub['PK_ID_SubCategoria'];?>"><?php echo $sub['SCat_Nombre'];?></a></li>
                        <?php endforeach; ?>
                        <img src="../Dashboard/vista/imagenes/Categorias/<?php echo $categoria['Cat_Imagen']?>" alt="">
                    </ul>
                </li>
                <?php else: ?>
                    <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                        <li><a href="recetas_cocteles.php" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php else: ?>
                        <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php endforeach; ?>
            </div>
            <div class="menu2-icons">
                <a href="#" class="" id="btn-user-peg"><i class="fas fa-user-circle menu2-bar"></i></a>
                <a href="carrito.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </nav>

        <!---Menú mobile-->
        <nav class="menuMobile" id="">
            <!--Logo-->
            <a href="index.html" class="menuMobile-logo">
                <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="60">
            </a>

            <div class="menuMobile-icons">
                <a href="#" id="btn-burger"><i class="fas fa-bars"></i></a>
                <a href="#" id="btn-user-mob"><i class="fas fa-user-circle"></i></a>
                <a href="carrito.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </nav>

        <!-- Menu mobile wrapper -->
        <div class="contenedor-menu" id="menuMobileWrapper">
            <ul class="menuMobileWrapper">
                <!--Categorías-->
                <?php foreach($categorias as $categoria): ?>

                <?php if(!empty($categoria['Cat_Imagen'])):?>
                <li><a href="#"><?php echo $categoria['Cat_Nombre'];?><i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                        <?php foreach($subs as $sub):?>
                        <li><a href="productos.php?id=<?php echo $sub['PK_ID_SubCategoria'];?>"><i class="sub-opciones"></i><?php echo $sub['SCat_Nombre'];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php else: ?>
                    <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                        <li><a href="recetas_cocteles.php"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php else: ?>
                        <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <!--Slide-->
    <div class="slide">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="4500">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 tamaño" src="imagenes/Image_Slide/<?php echo $slide_uno['0']['B_Imagen']?>" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 tamaño" src="imagenes/Image_Slide/<?php echo $slide_dos['0']['B_Imagen']?>"
                        alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 tamaño" src="imagenes/Image_Slide/<?php echo $slide_tres['0']['B_Imagen']?>"
                        alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

    </div>


    <!--Texto superior del contenedor-->
    <div class="text-top">
        <div class="text-top-title">
            <h1>Nuestros productos</h1>
        </div>
        <!-- <div class="text-top-opcion">
            <a href="#">
                <li>Nuevos</li>
            </a>
            <a href="#">
                <li>Recomendados</li>
            </a>

        </div> -->
    </div>
    <!--Contenedor princiapl de productos-->
    <div class="contenedor-superior">
        <!--Contenedor de productos-->
        <div class="contenedor">
            <!--Fila de los productos-->
            <?php foreach($productos as $producto): ?>
            <div class="cont-producto">
                <div class="cont-imagen">
                    <!--Imagen-->
                    <img src="../Dashboard/vista/imagenes/Productos/<?php echo $producto['Pt_Imagen']?>" alt="<?php echo $producto['Pt_Imagen']?>" class="img-producto">
                    <div class="opacity-img">
                        <div class="cont-button">
                            <input type="hidden" name="hidden_name" id="Pt_Nombre<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Nombre']?>" />
                            <input type="hidden" name="hidden_price" id="Pt_Precio<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Precio']; ?>" />
                            <input type="hidden" id="Pt_Imagen<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Imagen']; ?>" />
                            <input type="hidden" name="quantity" value="1" id="Pt_Cantidad<?php echo $producto['PK_ID_Producto']?>" />
                            <button type="submit" class="btn_add_cart" id="<?php echo $producto['PK_ID_Producto']?>">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="text-producto">
                    <a href="producto_single.php?id=<?php echo $producto['PK_ID_Producto']?>" class="producto-title"><?php echo $producto['Pt_Nombre']?> - 
                    <?php echo $producto['Pt_Presentacion']?></a>
                    <div class="a">
                        <span class="producto-price"><?php echo "$ ". number_format($producto['Pt_Precio'])?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

    </div>

    <!--Parte del Parrallax-->
    <div class="contenedor-parallax" style="background-image: url(../Dashboard/vista/imagenes/Banner/<?php echo $parallax['0']['B_Imagen']?>);">
        <div class="text-parallax">
            <h4>los mejores</h4>
            <h1>C&oacute;cteles</h1>
            <h5>con nuestros productos</h5>
        </div>
    </div>
    <!--Texto superior de recetas cócteles-->
    <div class="text-bottom">
        <div class="text-bottom-title">
            <h1>¡Mira estos!</h1>
        </div>
    </div>
    <!--Recetas cócteles-->
    <div class="super-contenedor-coctel">
        <div class="contenedor-coctel">
            <!--Fila receta cóctel-->
            <?php foreach($receta_coctel as $receta): ?>
                <div class="cont-coctel">
                    <!--Imagen cóctel-->
                    <div class="cont-cot-img">
                        <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>">
                            <img src="../Dashboard/vista/imagenes/Coctel/<?php echo $receta['RC_Image'];?>" alt="<?php echo $receta['RC_Image'];?>">
                        </a>
                    </div>
                    <div class="text-coctel">
                        <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>"><?php echo $receta['RC_Nombre'];?></a>
                        <span>Por <strong><?php echo $receta['RC_Autor']?></strong>el <strong><?php echo fecha($receta['RC_Fecha'])?></strong></span>
                        <p>
                        <?php echo $receta['RC_Descripcion']; ?>
                        </p>
                        <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>" class="m-t-p-10">Seguir leyendo<i
                                class="icon-a fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <!--Texto inferior de las recetas cócteles-->
    <div class="contenedor-subtexto">
        <!--Fila texto-->
        <div class="subtexto1 b-r">
            <div class="subtexto">
                <h1>Env&iacute;os sin costo</h1>
                <h6>Lorem ipsum</h6>
            </div>
        </div>
        <!--Fila texto-->
        <div class="subtexto2">
            <div class="subtexto">
                <h1>Atenci&oacute;n al cliente</h1>
                <h6>01 8000 183475</h6>
            </div>
        </div>
        <!--Fila texto-->
        <div class="subtexto3 b-l">
            <div class="subtexto">
                <h1>Tienda Abierta</h1>
                <h6>Tienda abierta de lunes a domingo</h6>
            </div>
        </div>
    </div>
    
    <?php require 'modal.view.php';?>

    <?php require 'footer.php';?>
    <!--Jquery, Bootstrap, Popper-->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- sweetAlert -->
    <script src="assets/sweetAlert2/sweetalert2.all.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>