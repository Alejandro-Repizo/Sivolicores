
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Recetas C&oacute;cteles</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_recetas_cocteles.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>
    
    <div class="banner"  style="background-image: url(../Dashboard/vista/imagenes/Banner/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1">Recetas c&oacute;cteles</h1>
            <h4 class="h4">Te ofrecemos una gran variedad de recetas c&oacute;cteles </h4>
        </div>
    </div>

    <div class="super-contenedor-coctel">
        <div class="contenedor-coctel">
            <!--Fila receta cóctel-->
            <div class="article">
                <?php foreach ($receta_coctel as $receta):?>
                    <div class="cont-coctel">
                        <!--Imagen cóctel-->
                        <div class="cont-cot-img">
                            <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>">
                                <img src="../Dashboard/vista/imagenes/Coctel/<?php echo $receta['RC_Image'];?>" alt="">
                            </a>
                        </div>
                        <div class="text-coctel">
                            <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>"><?php echo $receta['RC_Nombre'];?></a>
                            <span>Por <strong><?php echo $receta['RC_Autor']?></strong> el <strong><?php echo fecha($receta['RC_Fecha'])?></strong></span>
                            <p>
                            <?php echo $receta['RC_Descripcion']; ?>
                            </p>
                        </div>
                        <div class="seguir">
                            <a href="coctel.php?id=<?php echo $receta['PK_ID_Receta'];?>" class="m-t-p-10">Seguir leyendo<i class="icon-a fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        
                    </div>
                <?php endforeach;?>
                
                <div class="paginas">
               
                    <?php for($i = 1; $i <= $numero_paginas; $i++):?>
                        <?php if(pagina_actual() === $i):?>
                            <a class="active" href="#"><?php echo $i;?></a>
                        <?php else:?>
                            <a href="recetas_cocteles.php?p=<?php echo $i;?>"><?php echo $i;?></a>
                        <?php endif;?>
                    <?php endfor; ?>

                </div>

            </div>

            <form action="buscar.php" method="GET" name="buscar">
                <div class="aside">
                    <div class="cont-search">
                        <span class="icon"><i class="fas fa-search" onclick="buscar.submit()"></i></span>
                        <input type="search" name="busqueda" placeholder="Buscar">
                    </div>
                </div>
            </form>
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
    <script src="js/mainSites.js"></script>
</body>

</html>