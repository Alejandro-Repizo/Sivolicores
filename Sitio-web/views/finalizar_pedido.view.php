
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

    <?php require 'header.view.php';?>

    <div class="banner">
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
                    <form action="" method="post">
                        <input type="text"
                            placeholder="Dirección completa. Ej: Calle 98 - 65 / apto 201 / Ed. Barcelona*">
                        <input type="text" placeholder="Teléfono / Celular">
                        <label for="">Notas del Pedido</label>
                        <textarea name="" id="" cols="30" rows="10"
                            placeholder="Notas sobre tu pedido, indicaciones especiales de entrega."></textarea>
                    </form>
                </div>
            </div>
            <!--Fila de los productos-->
            <div class="fila2">
                <!--Contenedor producto-->
                <div class="cont-fila2">
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
                            <tr>
                                <td>Lorem ipsumn</td>
                                <td class="txt-center">0</td>
                                <td class="txt-bold">$0.000</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsumn</td>
                                <td class="txt-center">0</td>
                                <td class="txt-bold">$0.000</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="txt-sub">Subtotal:</td>
                                <td></td>
                                <td class="txt-num">$0.000</td>
                            </tr>
                            <tr>
                                <td class="txt-sub">Envío:</td>
                                <td></td>
                                <td class="txt-num">$0.000</td>
                            </tr>
                            <tr>
                                <td class="txt-total">Total:</td>
                                <td></td>
                                <td class="txt-size">$0.000</td>
                            </tr>
                        </tfoot>

                    </table>
                    <div class="button">
                        <button type="submit">Finaliza Compra</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--Modal para pedidos-->
    <div class="modal fade" id="modalPedidos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contenedor-top">
                        <table>
                            <thead>
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>FECHA</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cerveza Corona Six pack Botella - 355ml</td>
                                    <td>29/10/2020</td>
                                    <td>0</td>
                                    <td>$0.000</td>
                                    <td>Completo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.view.php';?>
    
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