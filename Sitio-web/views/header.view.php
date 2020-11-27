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
        <a href="index.php" class="menu3-logo" id="menu3-logo">
            <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="57">
        </a>
        <div class="contenedor-enlaces-nav">
            <!--Categorías-->
            <?php foreach($categorias as $categoria):?>

                <?php if(!empty($categoria['Cat_Imagen'])):?>

                <li><a href="#"class="dropbtn"><?php echo $categoria['Cat_Nombre'];?><i class="enlaces-icon fas fa-angle-down"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-text"><?php echo $categoria['Cat_Nombre'];?></li>
                        <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                        <?php foreach($subs as $sub):?>
                            <li><a href="productos.php?idS=<?php echo $sub['PK_ID_SubCategoria'];?>"><?php echo $sub['SCat_Nombre'];?></a></li>
                        <?php endforeach; ?>
                        <img src="../Dashboard/vista/imagenes/Categorias/<?php echo $categoria['Cat_Imagen']?>" alt="<?php echo $categoria['Cat_Imagen']?>">
                    </ul>
                </li>

                <?php else: ?>
                    <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                        <li><a href="recetas_cocteles.php" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php else: ?>
                        <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>"class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php endif; ?>
                <?php endif;?>

            <?php endforeach; ?>
        </div>
        <div class="menu3-icons" id="menu3-icons">
            <a href="#" id="btn-user"><i class="fas fa-user-circle menu3-bar"></i></a>
            <a href="carrito.php"><i class="fas fa-shopping-cart"></i><span class="badge">0</span></a>
        </div>
    </nav>

    <?php include 'menu.php' ?>

    <!---Menú pegajoso-->
    <nav class="menu4" id="menu4">
        <!--Logo-->
        <a href="index.php" class="menu4-logo" id="menu4-logo">
            <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="57">
        </a>
        <div class="contenedor-enlaces-nav">
            <!--Categorías-->
            <?php foreach($categorias as $categoria): ?>

            <?php if(!empty($categoria['Cat_Imagen'])):?>
            <li><a href="#" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?><i class="enlaces-icon fas fa-angle-down"></i></a>
                <ul class="nav-sub">
                    <li class="nav-text"><?php echo $categoria['Cat_Nombre'];?></li>
                    <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                    <?php foreach($subs as $sub):?>
                        <li><a href="productos.php?idS=<?php echo $sub['PK_ID_SubCategoria'];?>"><?php echo $sub['SCat_Nombre'];?></a></li>
                    <?php endforeach; ?>
                    <img src="../Dashboard/vista/imagenes/Categorias/<?php echo $categoria['Cat_Imagen']?>" alt="">
                </ul>
            </li>
            <?php else: ?>
                <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                    <li><a href="recetas_cocteles.php" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                <?php else: ?>
                    <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>" class="dropbtn"><?php echo $categoria['Cat_Nombre'];?></a></li>
                <?php endif; ?>
            <?php endif; ?>

            <?php endforeach; ?>
        </div>
        <div class="menu4-icons" id="menu4-icons">
            <a href="#" id="btn-user-peg"><i class="fas fa-user-circle menu4-bar"></i></a>
            <a href="carrito.php"><i class="fas fa-shopping-cart"></i><span class="badge">0</span></a>
        </div>
    </nav>

    <!---Menú mobile-->
    <nav class="menuMobile" id="">
        <!--Logo-->
        <a href="index.php" class="menuMobile-logo">
            <img src="imagenes/icons/logo.jpeg" alt="logo" width="140" height="60">
        </a>

        <div class="menuMobile-icons">
            <a href="#" id="btn-burger"><i class="fas fa-bars"></i></a>
            <a href="#" id="btn-user-mob"><i class="fas fa-user-circle"></i></a>
            <a href="carrito.php"><i class="fas fa-shopping-cart"></i><span class="badge">0</span></a>
        </div>
    </nav>

    <!-- Menu mobile wrapper -->
    <div class="contenedor-menu" id="menuMobileWrapper">
        <ul class="menuMobileWrapper">
            <!--Categorías-->
            <?php foreach($categorias as $categoria): ?>

                <?php if(!empty($categoria['Cat_Imagen'])):?>
                <li><a href="#"><?php echo $categoria['Cat_Nombre'];?><i class="fa fa-chevron-down cont-icons-right"></i></a>
                    <ul>
                        <?php $subs = obtener_subcategoria($categoria['PK_ID_Categoria'], $conexion);?>
                        <?php foreach($subs as $sub):?>
                        <li><a href="productos.php?idS=<?php echo $sub['PK_ID_SubCategoria'];?>"><i class="sub-opciones"></i><?php echo $sub['SCat_Nombre'];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php else: ?>
                    <?php if($categoria['Cat_Nombre'] == 'cócteles' or $categoria['Cat_Nombre'] == 'Cócteles'): ?>
                        <li><a href="recetas_cocteles.php"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php else: ?>
                        <li><a href="productos.php?id=<?php echo $categoria['PK_ID_Categoria'];?>"><?php echo $categoria['Cat_Nombre'];?></a></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

        </ul>
    </div>


</div>