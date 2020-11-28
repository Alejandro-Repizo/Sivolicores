
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Finalizar pedido</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_finalizar_pedidos.css">
    
    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>

    <div class="banner"style="background-image: url(../Dashboard/vista/imagenes/Banner/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1">Pedidos</h1>
            <h4 class="h4">Te ofrecemos una gran variedad de productos a los mejores precios y a domicilio. </h4>
        </div>
    </div>
    <div class="super-contenedor">

        <div class="contenedor">
            <!--Fila de los productos-->
            <div class="fila1">
                <div class="cont-fila1">
                    <h3>Detalles pedido</h3>
                    <form action="#" method="post" name="formulario">
                        <input type="text" id="Cl_Direccion" placeholder="Dirección completa. Ej: Calle 98 - 65 / apto 201 / Ed. Barcelona*" value="<?php echo $dato['Cl_Direccion']; ?>">
                        <input type="text" id="Cl_Telefono" placeholder="Teléfono / Celular" value="<?php echo $dato['Cl_Telefono']; ?>"> 
                        <input type="hidden" name="Cl_Nombre" id="Cl_Nombre" value="<?php echo $dato['Cl_Nombre']; ?>">
                        <label for="">Notas del Pedido</label>
                        <textarea name="Ped_Observaciones" id="Ped_Observaciones" cols="30" rows="10"
                            placeholder="Notas sobre tu pedido, indicaciones especiales de entrega."></textarea>
                    </form>
                </div>
            </div>
            <!--Fila de los productos-->
            <div class="fila2">
                <!--Contenedor producto-->
                <div class="cont-fila2">
                    <?php  
                    if(!empty($_SESSION["shopping_cart"])){
                        $total_price = 0;
                        $total_item = 0;
                        
                    ?>
                    <h3>tu pedido</h3>
                    <table class="tbl-top">
                        <thead>
                            <tr>
                                <td>producto</td>
                                <td class="txt-center">cantidad</td>
                                <td>precio</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($_SESSION["shopping_cart"] as $keys => $values)
                            { 
                                ?>
                            <tr>
                                <input type="hidden" id="<?php echo $values['PK_ID_Producto'];?>" value="<?php echo $values['Pt_Cantidad'];?>" class="productoEnvio">
                                <td><?php echo $values['Pt_Nombre']?></td>
                                <td class="txt-center"><?php echo $values['Pt_Cantidad'];?></td>
                                <td class="txt-bold">$ <?php echo number_format($values["Pt_Cantidad"] * $values["Pt_Precio"])?></td>
                            </tr>
                            <?php 
                                $total_price = $total_price + ($values["Pt_Cantidad"] * $values["Pt_Precio"]);
                                $total_item = $total_item + 1;
                            } 
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="txt-sub">Subtotal:</td>
                                <td></td>
                                <td class="txt-num">$ <?php echo number_format($total_price)?></td>
                            </tr>
                            <tr>
                                <td class="txt-sub">Envío:</td>
                                <td></td>
                                <td class="txt-num">$0.000</td>
                            </tr>
                            <tr>
                                <td class="txt-total">Total:</td>
                                <td></td>
                                <td class="txt-size">$ <?php echo number_format($total_price)?></td>
                            </tr>
                        </tfoot>

                    </table>
                    <div class="button">
                        <button type="submit" id="btn_finalizar_pedido">Finalizar Comprar</button>
                    </div>
                </div>
                <?php 
                    }
                ?>
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