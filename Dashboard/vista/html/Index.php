
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="shortcut icon" href="vista/imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Iniciar sesión</title>
    <!--css -->
    <link rel="stylesheet" href="vista/css/Style_login.css">
    <link rel="stylesheet" href="../js/plugins/sweetAlert2/sweetalert2.min.css">
    <!-- script-->
</head>

<body>
    <div class="contenedor">
        <img src="vista/imagenes/Login/Login.jpg" alt="Imagen">
        <div class="contenedor-form">
            <h2>Iniciar sesión para continuar </h2>
            
            <form action="controlador/DataRoute.php?accion=login" enctype="multipart/form-data" method="post">
                <ul>
                    <li>
                        <input type="text" name="ses_email" id="ses_email" placeholder="Correo electrónico"  required>
                    </li>
                    <li>
                        <input type="password" name="ses_password" id="ses_password" placeholder="Contraseña" required>
                    </li>
                    <li>
                        <button type="submit">Iniciar</button>
                    </li>
                </ul>

            </form>
        </div>
        
        <button id="btn1">Básico</button>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/plugins/sweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../js/prueba.js"></script>
</body>     