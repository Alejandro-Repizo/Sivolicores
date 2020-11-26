
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title><?php echo $nombre_banner[0]['Cat_Nombre'];?></title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_productos.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>

    <div class="banner" style="background-image: url(imagenes/Image_Title_Page/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1"><?php echo $nombre_banner[0]['Cat_Nombre'];?></h1>
            <h4 class="h4">Te ofrecemos una gran variedad de <?php echo $nombre_banner[0]['Cat_Nombre'];?> a los mejores precios y a domicilio. </h4>
        </div>
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
                            <div class="cont-button" name="add_to_cart">
                                <input type="hidden" name="hidden_name" id="Pt_Nombre<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Nombre']?>" />
                                <input type="hidden" name="hidden_price" id="Pt_Precio<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Precio']; ?>" />
                                <input type="hidden" id="Pt_Imagen<?php echo $producto['PK_ID_Producto']?>" value="<?php echo $producto['Pt_Imagen']; ?>" />
                                <input type="hidden" name="quantity" value="1" id="Pt_Cantidad<?php echo $producto['PK_ID_Producto']?>" />
                                <button type="submit" class="btn_add_cart" id="<?php echo $producto['PK_ID_Producto']?>">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-producto">
                        <a href="producto_single.php?id=<?php echo $producto['PK_ID_Producto']?>" class="producto-title"><?php echo $producto['Pt_Nombre'];?> - 
                        <?php echo $producto['Pt_Presentacion']?></a>
                        <div class="a">
                            <span class="producto-price"><?php echo "$ ". number_format($producto['Pt_Precio']);?></span>
                        </div>
                    </div>
                </div>
        
            <?php endforeach; ?>
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
