
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title><?php echo $receta['RC_Nombre'];?></title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_coctel.css">

    <?php require 'link.view.php';?>
</head>

<body>
    
    <?php require 'header.php';?>

    <!--Contenedor de la descripcion del producto-->
    <div class="contenedor-breadcumb">
        <ol class="bread">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="recetas_cocteles.php">C&oacute;cteles</a></li>
            <li><?php echo $receta['RC_Nombre'];?></li>
        </ol>
    </div>
    <div class="contenedor-central">
        <div class="contenedor-coctel">
            <div class="cont-coctel">
                <!--Imagen cóctel-->
                <div class="cont-cot-img">
                    <a href="#">
                        <img src="../Dashboard/vista/imagenes/Coctel/<?php echo $receta['RC_Image'];?>" alt="<?php echo $receta['RC_Image'];?>">
                    </a>
                </div>
                <div class="text-coctel">
                    <a href="#"><?php echo $receta['RC_Nombre'];?></a>
                    <span>Por <strong><?php echo $receta['RC_Autor']?></strong> el <strong><?php echo fecha($receta['RC_Fecha'])?></strong></span>
                    <p>
                        <?php echo $receta['RC_Descripcion']; ?>
                    </p>
                    <h2>Preparaci&oacute;n:</h2>
                    <ol>
                        <?php echo $receta['RC_Receta']; ?>
                    </ol>
                </div>
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
    <script src="js/mainSites.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>