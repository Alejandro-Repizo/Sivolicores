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
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="../css/Style_dashboard.css">
    <link rel="stylesheet" href="../font-awesome/css/all.min.css">
    <!--scritp-->
</head>

<body>
    <!--header-->
    <div class="contenedor header">
        <!--Barra de navegación superior-->
        <div class=" contenedor header-barra-nav">
            <!-- <a href="#">
                <i class="fas fa-align-justify"></i>
            </a> -->
            <div class="nav-search"></div>
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
                        <a href="../../modelo/Cerrar.php"><i class=" user-icons fas fa-lock-open"></i>Cerrar sesi&oacute;n</a></li>
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
            <a href="Dashboard.php"><i class="name-page-icon fas fa-home"></i></a>
            <h3>Inicio</h3>
        </div>
        <!--Subcontenedor central-->
        <div class="sub-central-box">
           <!--Opciones centrales-->
           <div class="sbc-opcion">
                <div class="sbc-box"><a href="Mod_categorias.php"><i class="sbc-icons fas fa-box-open"></i>Categor&iacute;as</a></div>
                <div class="sbc-box"><a href="Mod_productos.php"><i class="sbc-icons fas fa-wine-bottle"></i>Productos</a></div>
                <div class="sbc-box"><a href="Mod_inventario.php"><i class="sbc-icons fas fa-clipboard-list"></i>Inventario</a></div>
                <div class="sbc-box"><a href="Mod_clientes.php"><i class="sbc-icons fas fa-users"></i>Clientes</a></div>
                <div class="sbc-box"><a href="Mod_pedidos.php"><i class="sbc-icons fas fa-truck"></i>Pedidos</a></div>
            </div>
            <!--Primer sub contenedor central-->
            <div class="first-sub-central-box">
                <!-- Tabla información pedidos -->
                <div class="sbc-inf-pedido">
                    <div class="sbc-inf-top">
                        <div class="sbc-inf-top-left">
                            <i class="sbc-icons-top-left fas fa-truck"></i>
                            <h6>&Uacute;ltimos 10 pedidos</h6>
                        </div>
                        <a href="Mod_pedidos.php">Todos los pedidos</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Pedido id</th>
                                <th>Nombre cliente</th>
                                <th>Estado</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id='TablaDashboardPedido'>
                            
                        </tbody>
                    </table>
                </div>
                <!-- Tabla clientes registrados -->
                <div class="sbc-inf-cliente">
                    <div class="sbc-cli-top">
                        <div class="sbc-cli-top-left">
                            <i class="sbc-cli-icons-top-left fas fa-users"></i>
                            <h6>&Uacute;ltimos clientes registrados</h6>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo electr&oacute;nico</th>
                            </tr>
                        </thead>
                        <tbody id="TablaDashboardCliente">
                    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="second-sub-central-box">
                <!--Tabla visión general-->
                <div class="sbc-vis-gen">
                    <div class="sbc-vis-top">
                        <div class="sbc-vis-top-left">
                            <i class="sbc-vis-icons-top-left fas fa-chart-area"></i>
                            <h6>Visión general</h6>
                        </div>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>Total ventas</td>
                                <td>$0.000.000</td>
                            </tr>
                            <tr>
                                <td>Total ventas este año</td>
                                <td>$0.000.000</td>
                            </tr>
                            <tr>
                                <td>Total pedidos</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Número de clientes</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Número de productos</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--Tabla estadística-->
                <div class="sbc-tbl-est">
                    <div class="sbc-est-top">
                        <div class="sbc-est-top-left">
                            <i class="sbc-est-icons-top-left fas fa-chart-area"></i>
                            <h6>Estad&iacute;sticas</h6>
                        </div>
                    </div>
                    <!-- En este container se muestran los graficos -->
                    <div id="container" style="min-width: 280px; width: 90%; height: 350px; margin: 0 auto"></div>
                </div>
            </div>
            
        </div>
    </div>


    <!--Jquery, Bootstrap, HighChart-->
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../assets/highcharts/code/highcharts.js"></script>
    <script src="../assets/highcharts/code/modules/exporting.js"></script>
    <script src="../assets/highcharts/code/modules/export-data.js"></script>
    <!--Main-->
    <script src="../js/main.js"></script>
    <script src="../js/dashboard.js"></script>
</body>

</html>