<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="shortcut icon" href="vista/imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Iniciar sesi&oacute;n</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="vista/css/Style_login.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vista/assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="contenedor">
        <img src="vista/imagenes/Login/Login.jpg" alt="Imagen">
        <div class="contenedor-form">
            <h2>Iniciar sesi&oacute;n para continuar </h2>

            <form action="" id='formLogin' method="post">
                <ul>
                    <li>
                        <input type="text" name="ses_email" id="ses_email" placeholder="Correo electrónico">
                    </li>
                    <li>
                        <input type="password" name="ses_password" id="ses_password" placeholder="Contraseña">
                    </li>
                    <li>
                        <button type="submit" id="btnIngreso">Iniciar</button>
                    </li>

                </ul>
            </form>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="display: none;">
                <h4 id="mensaje_error" style="font-size: 13px; line-height: 1.4;"></h4>
            </div>
        </div>
        
    </div>
    <!--Jquery, Bootstrap, Popper-->
    <script src="vista/assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="vista/assets/popper/popper.min.js"></script>
    <script src="vista/assets/bootstrap/js/bootstrap.min.js"></script>
    <!--SweetAlert-->
    <script src="vista/assets/sweetAlert2/sweetalert2.all.min.js"></script>
    <!--Main-->
    <script src="vista/js/login.js"></script>
</body>

</html>