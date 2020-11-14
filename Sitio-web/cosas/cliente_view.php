<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Cliente</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/Style_cliente.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="assets/sweetAlert2/sweetalert2.min.css">
</head>

<body>
    <!--Header-->
    <div class="header">
        <!--parte superior del header-->
        <div class="header-top">
            <!--Redes sociales-->
            <div class="header-redes-sociales">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-whatsapp"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>
            <!--texto-->
            <h6>Tienda abierta de lunes a domingo</h6>
        </div>
        <!---Menú-->
        <nav class="menu3" id="menu3">
            <!--Logo-->
            <a href="index.html" class="menu3-logo" id="menu3-logo">
                <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="57">
            </a>
            <div class="contenedor-enlaces-nav">
                <!--Categorías-->
                <li><a href="productos.html" class="dropbtn">Licores<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Licores</li>
                        <li><a href="productos.html">Aguardiente</li>
                        <li><a href="productos.html">Whisky</a></li>
                        <li><a href="productos.html">Ginebra</a></li>
                        <li><a href="productos.html">Vodka</a></li>
                        <img src="imagenes/barra-navegación/Licores-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Cervezas<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Cervezas</li>
                        <li><a href="productos.html">Importadas</a></li>
                        <li><a href="productos.html">Nacionales</a></li>
                        <li><a href="productos.html">Intenacionales</a></li>
                        <img src="imagenes/barra-navegación/Cervezas-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Vinos<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Vinos</li>
                        <li><a href="productos.html">Jovenes</a></li>
                        <li><a href="productos.html">Espumosos</a></li>
                        <li><a href="productos.html">Reserva</a></li>
                        <img src="imagenes/barra-navegación/Vino-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Bebidas<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Bebidas</li>
                        <li><a href="productos.html">Agua</a></li>
                        <li><a href="productos.html">Gaseosas</a></li>
                        <li><a href="productos.html">Jugos y Té</a></li>
                        <img src="imagenes/barra-navegación/Bebidas-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="#" class="dropbtn">Cócteles</i></a>
                </li>
            </div>
            <div class="menu3-icons" id="menu3-icons">
                <a href="login.html"><i class="fas fa-user-circle menu3-bar"></i></a>
                <a href="#"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </nav>
        <!---Menú pegajoso-->
        <nav class="menu4" id="menu4">
            <!--Logo-->
            <a href="index.html" class="menu4-logo" id="menu4-logo">
                <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="57">
            </a>
            <div class="contenedor-enlaces-nav">
                <!--Categorías-->
                <li><a href="productos.html" class="dropbtn">Licores<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Licores</li>
                        <li><a href="productos.html">Aguardiente</li>
                        <li><a href="productos.html">Whisky</a></li>
                        <li><a href="productos.html">Ginebra</a></li>
                        <li><a href="productos.html">Vodka</a></li>
                        <img src="imagenes/barra-navegación/Licores-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Cervezas<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Cervezas</li>
                        <li><a href="productos.html">Importadas</a></li>
                        <li><a href="productos.html">Nacionales</a></li>
                        <li><a href="productos.html">Intenacionales</a></li>
                        <img src="imagenes/barra-navegación/Cervezas-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Vinos<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Vinos</li>
                        <li><a href="productos.html">Jovenes</a></li>
                        <li><a href="productos.html">Espumosos</a></li>
                        <li><a href="productos.html">Reserva</a></li>
                        <img src="imagenes/barra-navegación/Vino-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="productos.html" class="dropbtn">Bebidas<i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text">Bebidas</li>
                        <li><a href="productos.html">Agua</a></li>
                        <li><a href="productos.html">Gaseosas</a></li>
                        <li><a href="productos.html">Jugos y Té</a></li>
                        <img src="imagenes/barra-navegación/Bebidas-1.jpg" alt="">
                    </ul>
                </li>
                <li><a href="#" class="dropbtn">Cócteles</i></a>
                </li>
            </div>
            <div class="menu4-icons" id="menu4-icons">
                <a href="login.html"><i class="fas fa-user-circle menu4-bar"></i></a>
                <a href="#"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </nav>
    </div>
    <div class="banner">

        <div class="text-banner">
            <h1 class="h1">Bienvenido</h1>
        </div>
    </div>
    <div class="super-contenedor">
        <div class="contenedor-left">
            <div class="text-left-top">
                <h1>Mi cuenta</h1>
            </div>
            <ul>
                <li> <a href="historial_pedidos.html"><i class="fas fa-chevron-right"></i>Historial de pedidos</a></li>
                <li><a href="editar_cliente.html"><i class="fas fa-chevron-right"></i>Modificar información</a></li>
            </ul>
        </div>
        <div class="contenedor">
            <!--Fila de los productos-->
            <div class="text-left-top">
                <h1>inicio</h1>
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
</body>

</html>