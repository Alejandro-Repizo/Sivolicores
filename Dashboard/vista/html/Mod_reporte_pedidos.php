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
    <title>Reportes pedidos</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" href="../assets/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../css/Style_Mod_reporte_pedidos.css">
    <link rel="stylesheet" href="../css/Style_dashboard.css">
    <!--Font Awesome -->
    <link rel="stylesheet" href="../font-awesome/css/all.min.css">
    <!--SweetAlert-->
    <link rel="stylesheet" href="../assets/sweetAlert2/sweetalert2.min.css">
    <!--css-->
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
            <a href="../../../Sitio-web/index.php">
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
                <li><i class="inf-icons fas fa-truck"></i>TOTAL DE PEDIDOS </a>
                </li>
                <li class="inf-date" id="pedidosEstadisticas"></li>
                <hr>
                <li><i class="inf-icons fas fa-money-bill-alt"></i>TOTAL DE VENTAS </a>
                </li>
                <li class="inf-date" id="ventasEstadisticas"></li>
                <hr>
                <li><i class="inf-icons fas fa-users"></i>TOTAL DE CLIENTES </a>
                </li>
                <li class="inf-date" id="clienteEstadisticas"></li>
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
            <a href="Mod_reporte_pedidos.php"><i class="name-page-icon fas fa-truck"></i></a>
            <h3>Reportes pedidos</h3>
        </div>
        <!--Subcontenedor central-->
        <div class="sub-central-box mt-3" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive mt-4 mb-4">
                            <table id="tablaReportePedido" class="table table-striped table-bordered table-condensed"
                                style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre cliente</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!--Jquery, Bootstrap, Popper-->
     <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!--Datatables JS-->
    <script src="../assets/datatables/datatables.min.js"></script>
    <!--SweetAlert-->
    <script src="../assets/sweetAlert2/sweetalert2.all.min.js"></script>
    <!--Main-->
    <script src="../js/main.js"></script>
    <script src="../js/reportePedidosTable.js"></script>
    <script src="../js/menu.js"></script>
</body>

</html>