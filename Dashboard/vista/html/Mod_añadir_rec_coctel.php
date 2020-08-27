<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Recetas cóctel</title>
    <!--css-->
    <link rel="stylesheet" href="css/Style_Mod_añadir_rec_coctel.css">
    <link rel="stylesheet" href="css/Style_dashboard.css">
    <link rel="stylesheet" href="font-awesome/css/all.min.css">
    
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
            <div class="nav-search">
                <input type="search" id="search" placeholder="Buscar" />
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
                        <a href="Index.php"><i class=" user-icons fas fa-lock-open"></i>Cerrar sesión</a></li>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!--Barra de navegación lateral izquierda-->
    <div class="barra-lat-izq">
        <!--logo-->
        <a href="Dashboard.php">
            <img src="imagenes/icons/Logo.jpeg" alt="Logo" class="logo">
        </a>
        <div class="contenedor-menu">
            <ul class="menu">

                <li><a href="Dashboard.php"><i class="cont-icons fas fa-home"></i>Dashboard</a></li>
                <li><a href="#"><i class="cont-icons fas fa-boxes"></i>Cátalogo<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_categorias.php"><i class="cont-icons fas fa-box-open"></i>Categorías</a></li>
                        <li><a href="Mod_productos.php"><i class="cont-icons fas fa-wine-bottle"></i>Productos</a></li>
                        <li><a href="Mod_inventario.php"><i class="cont-icons fas fa-clipboard-list"></i>Inventario</a></li>
                        <li><a href="Mod_marca.php"><i class="cont-icons fab fa-modx"></i>Marca</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="cont-icons fas fa-store"></i>Ventas<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_pedidos.php"><i class="cont-icons fas fa-truck"></i>Pedidos</a></li>
                        <li><a href="Mod_clientes.php"><i class="cont-icons fas fa-users"></i>Clientes</a></li>
                        <li><a href="Mod_envios.php"><i class="cont-icons fas fa-truck-loading"></i>Envíos</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="cont-icons fas fa-chart-area"></i>Reportes<i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <li><a href="Mod_reporte_ventas.php"><i class="cont-icons fas fa-file-invoice-dollar"></i>Reportes ventas</a></li>
                        <li><a href="Mod_reporte_pedidos.php"><i class="cont-icons fas fa-truck"></i>Reportes pedidos</a></li>
                    </ul>
                </li>
                <li><a href="Mod_banner.php"><i class="cont-icons fas fa-images"></i>Banners</a></li>
                <li><a href="Mod_receta_coctel.php"><i class="cont-icons fas fa-cocktail"></i>Recetas cócteles</a></li>

            </ul>
        </div>
        <!--Barra lateral izquierda estadísticas-->
        <div class="barra-lat-information">
            <h6>ESTADÍSTICAS RÁPIDAS</h6>
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
                <li class="inf-date">6:42:00 P.M</li>
                <hr>
            </ul>
        </div>
    </div>


    <!--contendor central-->
    <div class="central-box">
        <!--Nombre página-->
        <div class="name-page">
            <a href="Mod_receta_coctel.php"><i class="name-page-icon fas fa-cocktail"></i></a>
            <h3>Recetas cócteles</h3>
        </div>
        <!--Subcontenedor central-->
        <div class="sub-central-box">
            <div class="parte_superior">
                <h4>Nueva receta cóctel</h4>
            </div>
            <div class="super-form">
                <div class="formulario">
                    <h4>Información básica</h4>
                    <hr>
                    <form action="" method="post">
                        <label for="">Nombre del cóctel:</label>
                        <input type="text" name="" id="" >
    
                        <label for="">Nombre autor:</label>
                        <input type="number" name="" id="" >
    
                        <label for="">Fecha de la publicación:</label>
                        <input type="date" name="" id="date">

                        <h4>Otros datos</h4>
                        <hr>

                        <label for="">Descripción cóctel:</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese texto..."></textarea>
    
                        <h4>Preparación y productos</h4>
                        <hr>
                  
                        <label for="">Preparación:</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese texto..."></textarea>
    
                        <label for="">Cantidad de productos:</label>
                        <input type="number" name="" id="" min="3" max="3" >
    
                        <label for="">Nombre producto n°1:</label>
                        <input type="text" name="" id="" >
    
                        <label for="">Nombre producto n°2:</label>
                        <input type="text" name="" id="" >
    
                        <label for="">Nombre producto n°3:</label>
                        <input type="text" name="" id="" >

                        <input type="file">

                        <div class="button">
                            <button type="submit">Guardar</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
