
<!-- Menú Lateral -->
    <div class="right-menu ">
        <div class="icon-menu-top">

            <?php if(isset($_SESSION['PK'])): ?>
                <div class="icon-menu-right">
                <a href="#"><i class="fas fa-user-circle"></i><?php echo $dato['Cl_Nombre']; ?></a>
                </div>
                <div class="icon-menu-right">
                    <a href="#" id="btn-pedido"><i class="fas fa-truck"></i>Tus pedidos</a>
                </div>
                <div class="icon-menu-right">
                    <a href="editar.php"><i class="fa fa-cog"></i>Modificar Informaci&oacute;n</a>
                </div>
            <?php else: ?>
                <div class="icon-menu-right">
                    <a href="login.php"><i class="fas fa-user-circle"></i>Iniciar sesión</a>
                </div>
            <?php endif; ?>
            <div class="icon-menu-right">
                <a href="#" id="btn-beh"><i class="fas fa-arrow-circle-left"></i>Atr&aacute;s</a>
            </div>
        </div>
        <?php if(isset($_SESSION['PK'])): ?>
            <div class="icon-menu-down">
                <div class="icon-menu-right">
                    <a href="#" id="btn_Cerrar_Sesion"><i class="fas fa-power-off"></i>Cerrar Sesi&oacute;n</a>
                </div>
            </div>
        <?php endif;  ?>
    </div>