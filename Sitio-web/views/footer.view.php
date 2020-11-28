<!--Footer-->
    <footer>
        <div class="contenedor-footer">
            <!--Parte de contactenos-->
            <div class="cont-contacto">
                <h1>Cont&aacute;ctenos</h1>
                <h6>Linea de atenci&oacute;n al cliente 01 8000 183475 </h6>
                <h6>M&oacute;vil: 322 2397</h6>
                <h6>sivolicores@gmail.com</h6>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            <?php foreach($datos as $dato):?>
                <?php if(!empty($dato['Cat_Imagen'])):?>
                    <div class="cont-footer-cat">
                        <ul>
                            <li class="p-t-10 cat-footer-title"><a href="#" class="cat-footer-title"><?php echo $dato['Cat_Nombre'];?></a></li>
                            <?php $subs = obtener_subcategoria($dato['PK_ID_Categoria'], $conexion);?>
                            <?php foreach($subs as $sub):?>
                            <li><a href="productos.php?idS=<?php echo $sub['PK_ID_SubCategoria'];?>"><?php echo $sub['SCat_Nombre'];?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <?php if($dato['Cat_Nombre'] == 'cócteles' or $dato['Cat_Nombre'] == 'Cócteles'): ?>
                        <!--Parte de categorías-->
                        <div class="cont-footer-cat">
                            <ul>
                                <li class="p-t-10 cat-footer-title"><a href="recetas_cocteles.php" class="cat-footer-title"><?php echo $dato['Cat_Nombre'];?></a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!--Parte de categorías-->
                        <div class="cont-footer-cat">
                            <ul>
                                <li class="p-t-10 cat-footer-title"><a href="productos.php?id=<?php echo $dato['PK_ID_Categoria'];?>" class="cat-footer-title"><?php echo $dato['Cat_Nombre'];?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>


        </div>
        <!-- Ley-->
        <div class="sub-cont-footer">
            <div class="ley">
                <p>El exceso de alcohol es perjudicial para la salud. Ley 30 de 1986. Proh&iacute;base el expendio de
                    bebidas
                    embriagantes a menores de edad y mujeres embarazadas. Ley 124 de 1994. </p>
            </div>
            <!--Copyright-->
            <div class="copyright">
                <p>Copyright © 2020 All rights reserved. </p>
            </div>
        </div>
    </footer>