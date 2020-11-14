
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Registrase</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_registro.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.view.php';?>

    <div class="banner">
        <div class="text-banner">
            <h1 class="h1">Registrase</h1>
        </div>
    </div>
    <div class="super-contenedor">
        <div class="contenedor">
            <form action="cliente.html" method="get">
                <div class="fila1">
                    <div class="login-form">
                        <h2>Registrase</h2>
                        <label for="">Nombres:</label>
                        <input type="text" name="" id="" required>

                        <label for="">Apellidos:</label>
                        <input type="text" name="" id="" required>

                        <label for="">Direcci&oacute;n:</label>
                        <input type="text" name="" id="" required>

                        <label for="">Tel&eacute;fono:</label>
                        <input type="tel" name="" id="" required>

                    </div>
                </div>
                <div class="fila2">
                    <div class="register-form">

                        <label for="" class="m-t-3">Correo electr&oacute;nico:</label>
                        <input type="email" name="" id="" required>

                        <label for="">Contrase&ntilde;a:</label>
                        <input type="password" name="" id="" required>

                        <label for="">Confirmar contrase&ntilde;a:</label>
                        <input type="password" name="" id="" required>

                        <div class="button">
                            <button type="submit">Reg&iacute;strase</button>
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