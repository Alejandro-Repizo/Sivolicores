<?php 
require_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="../imagenes/icons/favicon.ico" type="image/x-icon">
    <title>Productos</title>
    <!--css-->
    <link rel="stylesheet" href="../css/Style_dashboard.css">
    <link rel="stylesheet" href="../css/Style_Mod_añadir_productos.css">
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
            <a href="Mod_productos.php"><i class="name-page-icon fas fa-wine-bottle"></i></a>
            <h3>Añadir Productos</h3>
        </div>
        <!--Subcontenedor central-->
        <div class="sub-central-box">
            <div class="parte_superior">
                <h4>Nuevo producto</h4>
            </div>
            <div class="super-form">
                <div class="formulario">
                    <h4>Información básica</h4>
                    <hr>
                    <form method="post" enctype="multipart/form-data">
                    <label for="">Nombre del producto:</label>
                        <input type="text" name="Nombre_pro" id="Nombre_pro" >
    
                        <label for="">Presentación:</label>
                        <input type="text" name="Presentacion" id="Presentacion">

                        <h4>Unidades y precio</h4>
                        <hr>

                        <label for="">Unidades:</label>
                        <input type="text" name="Stock" id="Stock" >
    
                        <label for="">Precio:</label>
                        <input type="text" name="Precio" id="Precio">
    
                        <h4>Categoría y marca</h4>
                        <hr>
                        
                        <label for="">Categoría:</label>
                        <input type="text" name="Nom_Categoria" id="Categoria" >
    
                        <label for="">Marca:</label>
                        <input type="text" name="Marca" id="Marca" >

                        <h4>Otros datos</h4>
                        <hr>
                        
                        <label for="">País del producto:</label>
                        <input type="text" name="Pais" id="Pais" >
    
                        <label for="">Grado Alcohol:</label>
                        <input type="text" name="Grados" id="Grados" >

                        <label for="">Color:</label>
                        <input type="text" name="Color" id="Color" >

                        <h4>Imagen del producto</h4>
                        <hr>

                        <input type="file" id="Imagen" name="Imagen">

                        <div class="button">
                            <button type="submit">Guardar</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['Nombre_pro'])){
                        $Pt_Nombre=$_POST['Nombre_pro'];
                        $Pt_Presentacion =$_POST['Presentacion'];
                        $Pt_Stock=$_POST['Stock'];
                        $Pt_Precio =$_POST['Precio'];
                        $Pt_Pais=$_POST['Pais'];
                        $FK_ID_Categoria=$_POST['Nom_Categoria'];
                        $FK_ID_Marca =$_POST['Marca'];
                        $Pt_Grados_alchol =$_POST['Grados'];
                        $Pt_Color =$_POST['Color'];



                        $Pt_Imagen =addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

                        $sql= "INSERT INTO tbl_producto ( Pt_Nombre, Pt_Presentacion, Pt_Stock, Pt_Precio, Pt_Pais, FK_ID_Categoria, FK_ID_Marca, Pt_Grados_alchol, Pt_Color, Pt_Imagen) 
                            VALUES ('$Pt_Nombre', '$Pt_Presentacion','$Pt_Stock', '$Pt_Precio', '$Pt_Pais', 'Cerveza', '1' $Pt_Grados_alchol', '$Pt_Color', '$Pt_Imagen')";
        
                        
                        $result =mysqli_query($conn, $sql); 
                        if ($sql){
                        echo "<script>alert('El producto se a guardado'); </script>";
                        }
                            else {"ERROR";
                            }
                        }     
                    ?> 
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
</body>

</html>