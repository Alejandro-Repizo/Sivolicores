
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Registrarse</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_registro.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>

    <div class="banner" style="background-image: url(../Dashboard/vista/imagenes/Banner/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1">Registrase</h1>
        </div>
    </div>
    <div class="super-contenedor">
        <div class="contenedor">
            <form action="#" method="GET">
                <div class="fila1">
                    <div class="login-form">
                        <h2>Registrase</h2>
                        <label for="Cl_Nombre">Nombres:</label>
                        <input type="text" name="Cl_Nombre" id="Cl_Nombre" required>

                        <label for="Cl_Apellido">Apellidos:</label>
                        <input type="text" name="Cl_Apellido" id="Cl_Apellido" required>

                        <label for="Cl_Direccion">Direcci&oacute;n:</label>
                        <input type="text" name="Cl_Direccion" id="Cl_Direccion" required>

                        <label for="Cl_Telefono">Tel&eacute;fono:</label>
                        <input type="tel" name="Cl_Telefono" id="Cl_Telefono" required>

                    </div>
                </div>
                <div class="fila2">
                    <div class="register-form">

                        <label for="Cl_email" class="m-t-3">Correo electr&oacute;nico:</label>
                        <input type="email" name="Cl_email" id="Cl_email" required>

                        <label for="Cl_password">Contrase&ntilde;a:</label>
                        <input type="password" name="Cl_password" id="Cl_password" required>

                        <label for="Cl_password2">Confirmar contrase&ntilde;a:</label>
                        <input type="password" name="Cl_password2" id="Cl_password2" required>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="Display: none;">
                            <h4 id="mensaje_error" style="font-size: 13px; line-height: 1.4;"></h4>
                        </div>
                        <div class="button">
                            <button type="submit" id="btn_registrase">Reg&iacute;strase</button>
                        </div>
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
    <script src="js/functions.js"></script>
</body>

</html>