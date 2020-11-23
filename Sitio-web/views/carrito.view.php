
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

    <div class="banner">
        <div class="text-banner">
            <h1 class="h1">Carrito de pedidos </h1>
            <h4 class="h4">Te ofrecemos una gran variedad de productos a los mejores precios y a domicilio. </h4>
        </div>
    </div>

    <!--Parte central-->
    <div class="super-contenedor">
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
                    <?php 
                
                    if(!empty($_SESSION["shopping_cart"])){
                        // var_dump($_SESSION["shopping_cart"]);
                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                    ?>
                        <tr>
                            <td class="display-product">
                                <div class="cont-producto">
                                    <div class="cont-imagen">
                                        <!--Imagen-->
                                        <img src="../Dashboard/vista/imagenes/Productos/<?php echo $values['Pt_Imagen'] ?>" alt="" class="img-producto">
                                        <div class="opacity-img">
                                            <div class="cont-button">
                                                <button type="submit" id="btn_delete_cart">X</button>
                                                <input type="hidden" name="hidden_name"  id="PK_ID_Producto" value="<?php echo $values['PK_ID_Producto']?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $values['Pt_Nombre']?></td>
                            <td><?php echo $values['Pt_Precio']?></td>
                            <td><input type="number" name="Aumentador" id="Aumentador" min="1" max="20" value="<?php echo $values['Pt_Cantidad'] ?>"></td>
                            <td><?php echo $values["Pt_Cantidad"] * $values["Pt_Precio"]?></td>
                        </tr>
                    <?php
                            }
                    }else {
                        ?>
                    <h1>El Carro esta vacio</h1>
                    
                        <?php 
                        var_dump($_SESSION["shopping_cart"]);

                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="contenedor-bottom">
            <div class="box">
                <h4>TOTAL CARRITO</h4>
                <table>
                    <tbody>
                        <tr>
                            <td class="text-bold">Subtotal:</td>
                            <td class="txt-size">$0.000</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Envío:</td>
                            <td class="txt-size">$0.000</td>
                        </tr>
                        <tr>
                            <td class="text-bold text-size">Total:</td>
                            <td class="txt-size">$0.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class="button">
                    <a href="finalizar_pedido.html"><button type="submit">Finalizar pedido</button></a>
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