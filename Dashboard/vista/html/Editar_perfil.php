<?php 
    require_once('../../modelo/sesion.php');
    date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="../imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Editar perfil</title>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../css/Style_editar_perfil.css">
    <link rel="stylesheet" href="../css/Style_dashboard.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!--Font Awesome -->
    <link rel="stylesheet" href="../font-awesome/css/all.min.css">
    <!--SweetAlert-->
    <link rel="stylesheet" href="../assets/sweetAlert2/sweetalert2.min.css">

</head>

<body>
    <!--header-->
    <div class="contenedor header">
        <!--Barra de navegación superior-->
        <div class=" contenedor header-barra-nav">
            <!-- <a href="#">
                <i class="fas fa-align-justify"></i>
            </a> -->
            <div class="nav-search">
            </div>
            <a href="#">
                <i class="external-icon-nav fas fa-external-link-alt"></i>
            </a>
        </div>
        <div class="user-nav">
            <div class="btn-administrador" id="btn-administrador">
                <i class="up user-icons fas fa-user"></i>
                <p>Administrador</p>
                <i class="down fas fa-caret-down"></i>
            </div>

            <div class="user-opcion" id="user-opcion">
                <div class="opcion" id="opcion">
                    <div class="categorias">
                        <a href="Editar_perfil.php"><i class=" user-icons fas fa-user-edit"></i>Editar perfil</a></li>
                        <a href="../../modelo/Cerrar.php"><i class=" user-icons fas fa-lock-open"></i>Cerrar sesión</a></li>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!--Barra de navegación lateral izquierda-->
    <div class="barra-lat-izq">
        <!--logo-->
        <a href="Dashboard.php">
            <img src="../imagenes/icons/Logo.jpeg" alt="Logo" class="logo">
        </a>
        <div class="contenedor-menu">
            <ul class="menu">

                <li><a href="Dashboard.php"><i class="cont-icons fas fa-home"></i>Dashboard</a></li>
                <li><a href="#"><i class="cont-icons fas fa-boxes"></i>C&aacute;talogo<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_categorias.php"><i class="cont-icons fas fa-box-open"></i>Categor&iacute;as</a></li>
                        <li><a href="Mod_sub_categorias.php"><i class="cont-icons fas fa-box-open"></i>Sub categor&iacute;as</a></li>
                        <li><a href="Mod_productos.php"><i class="cont-icons fas fa-wine-bottle"></i>Productos</a></li>
                        <li><a href="Mod_inventario.php"><i class="cont-icons fas fa-clipboard-list"></i>Inventario</a></li>
                        <li><a href="Mod_marca.php"><i class="cont-icons fab fa-modx"></i>Marca</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="cont-icons fas fa-store"></i>Ventas<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_pedidos.php"><i class="cont-icons fas fa-truck"></i>Pedidos</a></li>
                        <li><a href="Mod_clientes.php"><i class="cont-icons fas fa-users"></i>Clientes</a></li>
                        <li><a href="Mod_envios.php"><i class="cont-icons fas fa-truck-loading"></i>Env&iacute;os</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="cont-icons fas fa-chart-area"></i>Reportes<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_reporte_ventas.php"><i class="cont-icons fas fa-file-invoice-dollar"></i>Reportes ventas</a></li>
                        <li><a href="Mod_reporte_pedidos.php"><i class="cont-icons fas fa-truck"></i>Reportes pedidos</a></li>
                    </ul>
                </li>
                <li><a href="Mod_banner.php"><i class="cont-icons fas fa-images"></i>Banners</a></li>
                <li><a href="Mod_receta_coctel.php"><i class="cont-icons fas fa-cocktail"></i>Recetas c&oacute;cteles</a></li>

            </ul>
        </div>
        <!--Barra lateral izquierda estadísticas-->
        <div class="barra-lat-information">
            <h6>ESTAD&Iacute;STICAS R&Aacute;PIDAS</h6>
            <ul>
                <hr>
                <li><i class="inf-icons fas fa-truck"></i>NUEVOS PEDIDOS HOY</a>
                </li>
                <li class="inf-date">0</li>
                <hr>
                <li><i class="inf-icons fas fa-money-bill-alt"></i>TOTAL DE VENTAS HOY</a>
                </li>
                <li class="inf-date">0</li>
                <hr>
                <li><i class="inf-icons fas fa-users"></i>TOTAL DE CLIENTES HOY</a>
                </li>
                <li class="inf-date">0</li>
                <hr>
                <li><i class="inf-icons far fa-clock"></i>HORA</a>
                </li>
                <li class="inf-date"><?php echo date('h:i:s A');?></li>
                <hr>
            </ul>
        </div>
    </div>


    <!--contendor central-->
    <div class="central-box">
        <!--Nombre página-->
        <div class="name-page">
            <a href="#"><i class="name-page-icon fas fa-user-edit"></i></a>
            <h3>Editar perfil</h3>
        </div>
        <!--Subcontenedor central-->
        <div class="sub-central-box">
            <!--Formulario-->
            <div class="contenedor_formulario">
                <!--formulario para editar perfil-->
                <div class="formulario_2">
                    <hr>
                        <form action="" id='formEditarPerfil' method="POST">
                        <!-- class="esconder"  -->
                            <input type="text" name="ad_primaria" class="esconder" id="ad_primaria" value="">

                            <label for="Name"> Nombre: </label>
                            <input type="text" name="Ad_Nombre" id="Ad_Nombre" value="">

                            <label for="last_name"> Apellido: </label>
                            <input type="text" name="Ad_Apellido" id="Ad_Apellido" value="">

                            <label for="correo_electronico"> Correo Electr&oacute;nico: </label>
                            <input type="email" name="Ad_Email" id="Ad_Email" value="">

                            <label for="password"> Contraseña: </label>
                            <input type="password" name="Ad_Password" id="Ad_Password">
                            
                            <label for="confrim_password"> Confirmar contraseña: </label>
                            <input  class="color-prueba" type="password"  name="Ad_Password2" id="Ad_Password2" >

                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="display: none;">
                                <h4 id="mensaje_error" style="font-size: 13px; line-height: 1.4;"></h4>
                            </div>
                            <!--..-->
                            <div class="button">
                                <button type="submit" name="actualizar">Guardar</button>
                            </div>
                        </form>
                    <hr>
                </div>
            </div>

        </div>
    </div>

    <!--Jquery, Bootstrap, Popper-->
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!--SweetAlert-->
    <script src="../assets/sweetAlert2/sweetalert2.all.min.js"></script>
    <!--Main-->
    <script src="../js/main.js"></script>
    <script src="../js/editarPerfil.js"></script>
</body>

</html>