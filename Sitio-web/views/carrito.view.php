<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Carrito de pedido</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_pag_cart.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>

    <div class="banner" style="background-image: url(../Dashboard/vista/imagenes/Banner/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1">Carrito de pedidos</h1>
            <h4 class="h4">Te ofrecemos una gran variedad de productos a los mejores precios y a domicilio.</h4>
        </div>
    </div>

    <!--Parte central-->
    <div class="super-contenedor">
        <?php  
        if(!empty($_SESSION["shopping_cart"])){
            $total_price = 0;
            $total_item = 0;
                    
        ?>
        <div class="contenedor-top">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION["shopping_cart"] as $keys => $values)
                        { 
                        $stock = obtener_stock_producto($values["PK_ID_Producto"], $conexion);
                        ?>
                    <tr>
                        <td class="display-product">
                            <div class="cont-producto">
                                <div class="cont-imagen">
                                    <!--Imagen-->
                                    <img src="../Dashboard/vista/imagenes/Productos/<?php echo $values['Pt_Imagen'] ?>"
                                        alt="" class="img-producto">
                                    <div class="opacity-img">
                                        <div class="cont-button">
                                            <button type="submit" name="btn_delete_cart" class="btn_delete_cart"
                                                id="<?php echo $values['PK_ID_Producto']?>">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $values['Pt_Nombre']?></td>
                        <td><?php echo number_format($values['Pt_Precio'])?></td>
                        <td><input type="number" id="<?php echo $values['PK_ID_Producto']?>"  class="cantidad"
                        min="1" max="<?php echo $stock['Pt_Stock'];?>" value="<?php echo $values['Pt_Cantidad'];?>"></td>
                        <td><?php echo number_format($values["Pt_Cantidad"] * $values["Pt_Precio"])?></td>
                    </tr>
                    <?php   
                            $total_price = $total_price + ($values["Pt_Cantidad"] * $values["Pt_Precio"]);
                            $total_item = $total_item + 1;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="contenedor-button">
            <div class="button-delete">
               <a href="#"><button type="submit" id="btn_update_cart">actualizar</button></a>
           </div>
            <div class="button-delete">
                <a href="#"><button type="submit" id="btn_delete_all">eliminar</button></a>
            </div>
        </div>
        <div class="contenedor-bottom">
            <div class="box">
                <h4>TOTAL CARRITO</h4>
                <table>
                    <tbody>

                        <tr>
                            <td class="text-bold">Subtotal:</td>
                            <td class="txt-size">$ <?php echo number_format($total_price)?></td>
                        </tr>
                        <tr>
                            <td class="text-bold">Envío:</td>
                            <td class="txt-size">$0.000</td>
                        </tr>
                        <tr>
                            <td class="text-bold text-size">Total:</td>
                            <td class="txt-size">$<?php echo number_format($total_price)?></td>
                        </tr>

                    </tbody>
                </table>
                <div class="button">
                    <a href="finalizar.php"><button type="submit">Finalizar pedido</button></a>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                El carrito de pedidos se encuentra vac&iacute;o!
            </div>
        <?php    
        }
        ?>
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