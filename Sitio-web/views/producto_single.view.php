
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title><?php echo $producto['Pt_Nombre'];?></title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_info_producto.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>
    
    <div class="contenedor-breadcumb">
        <ol class="bread">
            <li><a href="index.php">Inicio</a></li>
            <!-- <li><a href="recetas_cocteles.html">Subcategoria</a></li> -->
            <li><?php echo $producto['Pt_Nombre'];?></li>
        </ol>
    </div>

    <div class="super-contenedor">
        <div class="contenedor">
            <!--Fila de la imagen del producto-->
            <div class="fila1">
                <div class="cont-fila1">
                    <img src="../Dashboard/vista/imagenes/Productos/<?php echo $producto['Pt_Imagen'];?>" alt="<?php echo $producto['Pt_Imagen'];?>" title="¿Qué hay, bro?">
                </div>
            </div>
            <!--Fila de la información del producto-->
            <div class="fila2">
                <!--Contenedor información producto-->
                <div class="cont-fila2">
                    <!--tabla superior información producto-->
                    <table class="tbl-top">
                        <tbody>
                            <tr>
                                <td>
                                    <h2><?php echo $producto['Pt_Nombre'];?></h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><?php echo $producto['Pt_Presentacion'];?></h2>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-marca"><?php echo $producto['Ma_Nombre'];?></td>
                            </tr>
                            <tr>
                                <td class="txt-cantidad">Cantidad</td>
                            </tr>
                            <tr>
                                <td><input type="number" name="" id="" value='1' min="0" max="<?php echo $producto['Pt_Stock'];?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>$ <?php echo $producto['Pt_Precio'];?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="button"><button type="submit">agregar al carrito</button></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-marca">Categor&iacute;a: <?php echo $producto['Cat_Nombre']; ?></td>
                            </tr>
                            <tr>
                                <td class="txt-inf">informaci&oacute;n adicional</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--tabla inferior información producto-->
                    <table class="tbl-bottom">
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <img src="imagenes/icons/Botellas_icon.png" alt="">
                                        <p class="txt-bold">Presentaci&oacute;n:</p>
                                        <p class="txt-price"><?php echo $producto['Pt_Presentacion'];?></p>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <img src="imagenes/icons/Tapa_icon.PNG" alt="">
                                        <p class="txt-bold">Grados alcohol:</p>
                                        <p class="txt-price"><?php echo $producto['Pt_Grados_alchol'];?> %</p>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <img src="imagenes/icons/Botellas_icon.png" alt="">
                                        <p class="txt-bold">Pa&iacute;s:</p>
                                        <p class="txt-price"><?php echo $producto['Pt_Pais'];?></p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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