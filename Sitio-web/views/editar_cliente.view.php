
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
   
    <?php require 'header.php';?>

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
            <form action="" method="POST">
                <div class="fila1">
                    <div class="login-form">
                        <h2>Cambio de informaci&oacute;n</h2>
                        <hr>    
                        <!-- <hr class="m-t-3"> -->
                        <label for="Cl_Nombre">Nombres:</label>
                        <input type="text" name="Cl_Nombre" id="Cl_Nombre" value="<?php echo $dato['Cl_Nombre']; ?>">

                        <label for="Cl_Apellido">Apellidos:</label>
                        <input type="text" name="Cl_Apellido" id="Cl_Apellido" value="<?php echo $dato['Cl_Apellido']; ?>">

                        <label for="Cl_Dirección" class="">Dirección:</label>
                        <input type="text" name="Cl_Dirección" id="Cl_Dirección" value="<?php echo $dato['Cl_Dirección']; ?>">

                        <label for="Cl_Telefono">Teléfono:</label>
                        <input type="text" name="Cl_Telefono" id="Cl_Telefono" value="<?php echo $dato['Cl_Telefono']; ?>">
                    </div>
                </div>
                <div class="fila2">
                    <div class="register-form">
                        <h2>Cambio de contrase&ntilde;a:</h2>
                        <hr>
                        <label for="Cl_password">Nueva contrase&ntilde;a:</label>
                        <input type="password" name="Cl_password" id="Cl_password">

                        <label for="Cl_password2">Confirmar contrase&ntilde;a:</label>
                        <input type="password" name="Cl_password2" id="Cl_password2">
                        
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="display: none;">
                            <h4 id="mensaje_error" style="font-size: 13px; line-height: 1.4;"></h4>
                        </div>
                        
                        <div class="button">
                            <button type="submit" id="btn_editar">Actualizar</button>
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