
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Iniciar sesi&oacute;n</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_login.css">

    <?php require 'link.view.php';?>
</head>

<body>

    <?php require 'header.php';?>

    <div class="banner" style="background-image: url(imagenes/Image_Title_Page/<?php echo $banner['0']['B_Imagen']?>);">
        <div class="text-banner">
            <h1 class="h1">Iniciar sesi&oacute;n</h1>
        </div>
    </div>
    <div class="super-contenedor">
        <div class="contenedor">
            <div class="fila1">
                <div class="login-form">
                    <h2>Iniciar sesi&oacute;n</h2>
                    <form action="#" method="post" name="form_login">
                        <label for="">Correo electronico:</label>
                        <input type="email" name="Cl_email" id="Cl_email" required>
                        <label for="">Contraseña:</label>
                        <input type="password" name="Cl_password" id="Cl_password" required>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="display: none;">
                            <h4 id="mensaje_error" style="font-size: 13px; line-height: 1.4;"></h4>
                        </div>
                        <div class="button">
                            <button type="submit" id="btn_Iniciar_Sesion">Iniciar sesi&oacute;n</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="fila2">
                <div class="register-form">
                    <h2>Registrase</h2>
                    <p>Al registrase en nuestra tienda en linea, tendrá acceso al estado e historial de sus pedidos.para eso sólo tiene que rellanar los espacios que aparecerán a continuación para crear un nueva cuenta.
                    </p>
                    <div class="button" src="registrase.php">
                        <a href="registrase.php"><button type="submit">Regístrate</button></a>
                    </div>
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