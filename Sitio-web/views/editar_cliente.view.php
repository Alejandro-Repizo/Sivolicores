
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Cliente</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_modificar_cliente.css">

    <?php require 'link.view.php';?>
</head>

<body>
   
    <?php require 'header.view.php';?>

    <div class="banner">
        <div class="text-banner">
            <h1 class="h1">Modificar informaci&oacute;n</h1>
        </div>
    </div>
    <div class="super-contenedor">
        <div class="contenedor">
            <!--Fila de los productos-->
            <div class="text-left-top">
                <h1>Modificar informaci&oacute;n</h1>
            </div>
            <form action="" method="get">
                <div class="fila1">
                    <div class="login-form">
                        <h2>Cambio de informaci&oacute;n</h2>
                        <hr>
                        <!-- <hr class="m-t-3"> -->
                        <label for="">Nombres:</label>
                        <input type="text" name="" id="">

                        <label for="">Apellidos:</label>
                        <input type="text" name="" id="">

                        <label for="" class="">Dirección:</label>
                        <input type="text" name="" id="">

                        <label for="">Teléfono:</label>
                        <input type="text" name="" id="">



                    </div>
                </div>
                <div class="fila2">
                    <div class="register-form">
                        <h2>Cambio de contrase&ntilde;a:</h2>
                        <hr>
                        <label for="">Nueva contrase&ntilde;a:</label>
                        <input type="password" name="" id="">

                        <label for="">Confirmar contrase&ntilde;a:</label>
                        <input type="password" name="" id="">

                        <div class="button">
                            <button type="submit">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <?php require 'modal.view.php';?>

    <?php require 'footer.view.php';?>
    
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