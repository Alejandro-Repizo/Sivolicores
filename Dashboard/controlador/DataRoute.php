<?php 

require_once 'Controlador.php';

//Acá se captura la variable opcion y se redirije con un switch
if(isset($_POST['opcion'])){
    $opcion = $_POST['opcion'];
    switch ($opcion) {

        //Módulo login
        case 'login':
            $Controlador = new Controlador();
            $ses_email = $_POST['ses_email'];
            $ses_password = $_POST['ses_password'];
            $_SESSION['password'] = $ses_password;
            $ses_password = hash('md5', $ses_password);
            
            if (!empty($ses_email)){
                $ses_email = trim($ses_email);
                $ses_email = filter_var($ses_email, FILTER_VALIDATE_EMAIL);
            }
            if (!empty($ses_password)){
                $ses_password = trim($ses_password);
                $ses_password = filter_var($ses_password, FILTER_SANITIZE_STRING);
            }
            $Controlador->consulSesion($ses_email, $ses_password);
            break;

        case 'cargarEditarUsuario':
            $Controlador = new Controlador();
            $Controlador->cargarEditarUsuario();
            break;
        
        case 'editarUsuario':
            $Controlador = new Controlador();
            $PK_ID_Administrador = $_POST['id'];
            $Ad_Nombre = $_POST['Ad_Nombre'];
            $Ad_Apellido = $_POST['Ad_Apellido'];
            $Ad_Email = $_POST['Ad_Email'];
            $Ad_Password = $_POST['Ad_Password'];
            
            if (!empty($Ad_Password)) {
                $Ad_Password = hash('md5', $Ad_Password);
            }
            if (!empty($PK_ID_Administrador)) {
                $PK_ID_Administrador = trim( $PK_ID_Administrador);
                $PK_ID_Administrador = filter_var($PK_ID_Administrador, FILTER_VALIDATE_INT);
            }
            if (!empty($Ad_Nombre)) {
                $Ad_Nombre = trim( $Ad_Nombre);
                $Ad_Nombre = filter_var($Ad_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($Ad_Apellido)) {
                $Ad_Apellido = trim( $Ad_Apellido);
                $Ad_Apellido = filter_var($Ad_Apellido, FILTER_SANITIZE_STRING);
            }
            if (!empty($Ad_Email)) {
                $Ad_Email = trim( $Ad_Email);
                $Ad_Email = filter_var($Ad_Email, FILTER_VALIDATE_EMAIL);
            }
            $Controlador->editarUsuario($PK_ID_Administrador, $Ad_Nombre, $Ad_Apellido, $Ad_Email, $Ad_Password );
            break;

        //Módulo Marcas
        case 'agregarMarca':
            $Controlador = new Controlador();
            $nombreMarca = $_POST['nombreMarca'];
            if(!empty($nombreMarca)){
                $nombreMarca = trim($nombreMarca);
                $nombreMarca = filter_var($nombreMarca, FILTER_SANITIZE_STRING);
                $Controlador->saveMarca($nombreMarca);
            }
            break;

        case 'editarMarca':
            $Controlador = new Controlador();
            $nombreMarca = $_POST['nombreMarca'];
            $id = $_POST['id'];
            if(!empty($nombreMarca)){
                $nombreMarca = trim($nombreMarca);
                $nombreMarca = filter_var($nombreMarca, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $Controlador->updateMarca($nombreMarca, $id);
            break;

        case 'borrarMarca':
            $Controlador = new Controlador();
            $id = (isset($_POST['id'])) ? $_POST['id'] : '';
            $Controlador->deleteMarca($_POST['nombreMarca'], $_POST['id']);
            break;
        
        case 'cargarMarca':
            $controlador = new Controlador();
            $controlador->cargarMarca();
            break;
        
        //Módulo Inventario

        case 'cargarInventario':
            $controlador = new Controlador();
            $controlador->cargarInventario();
            break;
        
        case 'editarInventario':
            $Controlador = new Controlador();
            $Pt_Nombre = $_POST['Pt_Nombre'];
            $Pt_Precio = $_POST['Pt_Precio'];
            $Pt_Stock = $_POST['Pt_Stock'];
            $id = $_POST['id'];
            if(!empty($Pt_Nombre)){
                $Pt_Nombre = trim($Pt_Nombre); //Quitar espaciados      Producto 1 
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING); # <b>Producto</b> -> producto
            }
            if(!empty($Pt_Precio)){
                $Pt_Precio = trim($Pt_Precio);
                $Pt_Precio = htmlspecialchars($Pt_Precio); //# <b>Producto</b> -> producto
            }
            if(!empty($Pt_Stock)){
                $Pt_Stock = trim($Pt_Stock);
                $Pt_Stock = filter_var($Pt_Stock, FILTER_VALIDATE_INT);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT); # <b>1</b> -> 1
            }
            $Controlador->updateInventario($id, $Pt_Precio, $Pt_Stock, $Pt_Nombre);
            break;

    
        case 'borrarInventario':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $Pt_Nombre = $_POST['Pt_Nombre'];
            if(!empty($Pt_Nombre)){
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->borrarInventario($id, $Pt_Nombre);
            break;

        //Módulo Cliente
        case 'cargarCliente':
            $controlador = new Controlador();
            $controlador->cargarCliente();
            break;

        case 'borrarCliente':
            $controlador = new Controlador();
            $Cl_Nombre = $_POST['Cl_Nombre'];
            $id = $_POST['id'];
            if(!empty($Cl_Nombre)){
                $Cl_Nombre = trim($Cl_Nombre);
                $Cl_Nombre = filter_var($Cl_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->deleteCliente($id, $Cl_Nombre);
            break;
        
        //Módulo Receta Cóctel
        case 'cargarRecetaCoctel':
            $controlador = new Controlador();
            $controlador->cargarRecetaCoctel();
            break;  

        case 'agregarRecetaCoctel':
            $Controlador = new Controlador();
            $RC_Nombre = $_POST['RC_Nombre'];
            $RC_Receta = $_POST['RC_Receta'];
            $RC_Autor = $_POST['RC_Autor'];
            $RC_Descripcion = $_POST['RC_Descripcion'];
            $RC_Image = $_FILES;
    
            // echo $RC_Image['file']['name'];
            // echo $RC_Image['file']['tmp_name'];
            if(!empty($RC_Nombre)){
                $RC_Nombre = trim($RC_Nombre);
                $RC_Nombre = filter_var($RC_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Autor)) {
                $RC_Autor = trim($RC_Autor);
                $RC_Autor = filter_var($RC_Autor, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Descripcion)) {
                $RC_Descripcion = trim($RC_Descripcion);
                $RC_Descripcion = filter_var($RC_Descripcion, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Receta)) {
                $RC_Receta = trim($RC_Receta);
                $RC_Receta = filter_var($RC_Receta , FILTER_SANITIZE_STRING);
            }
            $Controlador->saveRecetaCoctel($RC_Nombre, $RC_Receta, $RC_Autor, $RC_Descripcion, $RC_Image);
            break;

        case 'cargarEditarReceta':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $RC_Nombre = $_POST['RC_Nombre'];
            if(!empty($RC_Nombre)){
                $RC_Nombre = trim($RC_Nombre);
                $RC_Nombre = filter_var($RC_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->cargarEditarReceta($id, $RC_Nombre);
            break;

        case 'editarCoctel':
            $controlador =  new Controlador();
            $id = $_POST['id'];
            $RC_Nombre = $_POST['RC_Nombre'];
            $RC_Receta = $_POST['RC_Receta'];
            $RC_Autor = $_POST['RC_Autor'];
            $RC_Descripcion = $_POST['RC_Descripcion'];
        
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            if(!empty($RC_Nombre)){
                $RC_Nombre = trim($RC_Nombre);
                $RC_Nombre = filter_var($RC_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Autor)) {
                $RC_Autor = trim($RC_Autor);
                $RC_Autor = filter_var($RC_Autor, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Descripcion)) {
                $RC_Descripcion = trim($RC_Descripcion);
                $RC_Descripcion = filter_var($RC_Descripcion, FILTER_SANITIZE_STRING);
            }
            if (!empty($RC_Receta)) {
                $RC_Receta = trim($RC_Receta);
                $RC_Receta = filter_var($RC_Receta , FILTER_SANITIZE_STRING);
            }
            $controlador->editarCoctel($id, $RC_Nombre, $RC_Receta, $RC_Autor, $RC_Descripcion);
            break;
            
        case 'borrarRecetaCoctel':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $RC_Nombre = $_POST['RC_Nombre'];
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            if (!empty($RC_Nombre)) {
                $RC_Nombre = trim($RC_Nombre);
                $RC_Nombre = filter_var($RC_Nombre, FILTER_SANITIZE_STRING);
            }
            $controlador->deleteRecetaCoctel($id, $RC_Nombre);
            break;

        //Módulo Reporte Ventas
        case 'cargarReporteVentas':
            $controlador = new Controlador();
            $controlador->cargarReporteVentas();
            break;

        //Módulo reporte pedidos
        case 'cargarReportePedidos':
            $controlador = new Controlador();
            $controlador->cargarReportePedidos();
            break;
        
        //Módulo Categoria
        case 'cargarCategoria':
            $controlador = new Controlador();
            $controlador->cargarCategoria();
            break;

        case 'agregarCategoria':
            $controlador = new Controlador();
            $Cat_Nombre = $_POST['Cat_Nombre'];
            if (!empty($Cat_Nombre)) {
                $Cat_Nombre = trim($Cat_Nombre);
                $Cat_Nombre = filter_var($Cat_Nombre, FILTER_SANITIZE_STRING);
            }
            $controlador->agregarCategoria($Cat_Nombre);
            break;

        case 'editarCategoria':
            $controlador = new Controlador();
            $Cat_Nombre = $_POST['Cat_Nombre'];
            $id = $_POST['id'];
            if (!empty($Cat_Nombre)) {
                $Cat_Nombre = trim($Cat_Nombre);
                $Cat_Nombre = filter_var($Cat_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->editarCategoria($id,$Cat_Nombre);
            break;
        
        case 'borrarCategoria':
            $controlador = new Controlador();
            $Cat_Nombre = $_POST['Cat_Nombre'];
            $id = $_POST['id'];
            if (!empty($Cat_Nombre)) {
                $Cat_Nombre = trim($Cat_Nombre);
                $Cat_Nombre = filter_var($Cat_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->borrarCategoria($id,$Cat_Nombre);
            break;  
        
        //Módulo Banner
        case 'cargarBanner':
            $controlador = new Controlador();
            $controlador->cargarBanner();
            break;
        
        case 'editarBanner':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $B_Nombre = $_POST['B_Nombre'];
            $B_Imagen = $_FILES;
            if (!empty($id)) {
                $id = trim($id);
                $id =  filter_var($id, FILTER_VALIDATE_INT);
            }
            if (!empty($B_Nombre)) {
                $B_Nombre = trim($B_Nombre);
                $$B_Nombre = filter_var($B_Nombre, FILTER_SANITIZE_STRING);
            }
            $controlador->editarBanner($id, $B_Nombre, $B_Imagen);
            break;

        //Módulo Pedidos
        case 'cargarPedido':
            $controlador = new Controlador();
            $controlador->cargarPedido();
            break;

        case 'enviarPedido':
            $controlador = new Controlador();
            $id = $_POST['id'];
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->enviarPedido($id);
            break;

        case 'reportePedido':
            $controlador = new Controlador();
            $id = $_POST['id'];
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->reportePedido($id);
            break;

        //Módulo Envíos
        case 'cargarEnvio':
            $controlador = new Controlador();
            $controlador->cargarEnvio();
            break;

        case 'envioReporteVenta':
            $controlador = new Controlador();
            $id = $_POST['id'];
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->envioReporteVenta($id);
            break;

        case 'envioReportePedido':
            $controlador = new Controlador();
            $id = $_POST['id'];
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->envioReportePedido($id);
            break;




        // Modulo SubCategoria
        case 'cargarSubCategoria':
            $controlador = new Controlador();
            $controlador->cargarSubCategoria();
            break;

        case 'agregarSubCategoria':
            $controlador = new Controlador();
            $SCat_Nombre = $_POST['SCat_Nombre'];
            $PK_ID_Categoria = $_POST['PK_ID_Categoria'];
            if (!empty($SCat_Nombre)) {
                $SCat_Nombre = trim($SCat_Nombre);
                $SCat_Nombre = filter_var($SCat_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($PK_ID_Categoria)) {
                $PK_ID_Categoria = trim($PK_ID_Categoria);
                $PK_ID_Categoria = filter_var($PK_ID_Categoria, FILTER_VALIDATE_INT);
            }
            $controlador->agregarSubCategoria($SCat_Nombre, $PK_ID_Categoria);
            break;
            
        case 'editarSubCategoria':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $SCat_Nombre = $_POST['SCat_Nombre'];
            $PK_ID_Categoria = $_POST['PK_ID_Categoria'];
            if (!empty($SCat_Nombre)) {
                $SCat_Nombre = trim($SCat_Nombre);
                $SCat_Nombre = filter_var($SCat_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            if (!empty($PK_ID_Categoria)) {
                $PK_ID_Categoria = trim($PK_ID_Categoria);
                $PK_ID_Categoria = filter_var($PK_ID_Categoria, FILTER_VALIDATE_INT);
            }
            $controlador->editarSubCategoria($id,$SCat_Nombre,$PK_ID_Categoria);
            break;
        
        case 'borrarSubCategoria':
            $controlador = new Controlador();
            $SCat_Nombre = $_POST['SCat_Nombre'];
            $id = $_POST['id'];
            if (!empty($SCat_Nombre)) {
                $SCat_Nombre = trim($SCat_Nombre);
                $SCat_Nombre = filter_var($SCat_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($id)) {
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->borrarSubCategoria($id,$SCat_Nombre);
            break;  

        case 'cargarCategoriaCombo':
            $controlador = new Controlador();
            $id = $_POST['PK_ID_Categoria'];

            $controlador->cargarCategoriaCombo($id);
            break;
        
        //Módulo producto
        case 'cargarProducto':
            $controlador = new Controlador();
            $controlador->cargarProducto();
            break;

        case 'agregarProducto':
            $controlador = new Controlador();
            $Pt_Nombre = $_POST['Pt_Nombre'];
            $Pt_codigo = $_POST['Pt_codigo'];
            $Pt_Presentacion = $_POST['Pt_Presentacion'];
            $Pt_Stock = $_POST['Pt_Stock'];
            $Pt_Precio = $_POST['Pt_Precio'];
            $FK_ID_Categoria = $_POST['FK_ID_Categoria'];
            $FK_ID_Marca = $_POST['FK_ID_Marca'];
            $Pt_Pais = $_POST['Pt_Pais'];
            $Pt_Grados_alchol = $_POST['Pt_Grados_alchol'];
            $Pt_Color = $_POST['Pt_Color'];
            $Pt_Imagen = $_FILES;

            if (!empty($Pt_Nombre)) {
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_codigo)) {
                $Pt_codigo = trim($Pt_codigo);
                $Pt_codigo = filter_var($Pt_codigo, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Presentacion)) {
                $Pt_Presentacion = trim($Pt_Presentacion);
                $Pt_Presentacion = filter_var($Pt_Presentacion, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Stock)) {
                $Pt_Stock = trim($Pt_Stock);
                $Pt_Stock = filter_var($Pt_Stock, FILTER_VALIDATE_INT);
            }
            if (!empty($FK_ID_Categoria)) {
                $FK_ID_Categoria = trim($FK_ID_Categoria);
                $FK_ID_Categoria = filter_var($FK_ID_Categoria, FILTER_VALIDATE_INT);
            }
            if (!empty($FK_ID_Marca)) {
                $FK_ID_Marca = trim($FK_ID_Marca);
                $FK_ID_Marca = filter_var($FK_ID_Marca, FILTER_VALIDATE_INT);
            }
            if (!empty($Pt_Pais)) {
                $Pt_Pais = trim($Pt_Pais);
                $Pt_Pais = filter_var($Pt_Pais, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Grados_alchol)) {
                $Pt_Grados_alchol = trim($Pt_Grados_alchol);
                $Pt_Grados_alchol = filter_var($Pt_Grados_alchol, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Color)) {
                $Pt_Color = trim($Pt_Color);
                $Pt_Color = filter_var($Pt_Color, FILTER_SANITIZE_STRING);
            }
            $controlador->agregarProducto($Pt_Nombre,$Pt_codigo,$Pt_Presentacion,$Pt_Stock,$Pt_Precio, $FK_ID_Categoria,$FK_ID_Marca,$Pt_Pais,$Pt_Grados_alchol, $Pt_Color, $Pt_Imagen);
            break;
        
        case 'cargarEditarProducto':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $Pt_Nombre = $_POST['Pt_Nombre'];
            if(!empty($Pt_Nombre)){
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->cargarEditarProducto($id, $Pt_Nombre);
        break;

        case 'editarProducto':
            $controlador = new Controlador();
            $Pt_Nombre = $_POST['Pt_Nombre'];
            $Pt_codigo = $_POST['Pt_codigo'];
            $Pt_Presentacion = $_POST['Pt_Presentacion'];
            $Pt_Stock = $_POST['Pt_Stock'];
            $Pt_Precio = $_POST['Pt_Precio'];
            $Pt_Pais = $_POST['Pt_Pais'];
            $Pt_Grados_alchol = $_POST['Pt_Grados_alchol'];
            $Pt_Color = $_POST['Pt_Color'];
            $Pt_Imagen = $_FILES;
            $id = $_POST['id'];

            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            if (!empty($Pt_Nombre)) {
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_codigo)) {
                $Pt_codigo = trim($Pt_codigo);
                $Pt_codigo = filter_var($Pt_codigo, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Presentacion)) {
                $Pt_Presentacion = trim($Pt_Presentacion);
                $Pt_Presentacion = filter_var($Pt_Presentacion, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Stock)) {
                $Pt_Stock = trim($Pt_Stock);
                $Pt_Stock = filter_var($Pt_Stock, FILTER_VALIDATE_INT);
            }
            if (!empty($Pt_Pais)) {
                $Pt_Pais = trim($Pt_Pais);
                $Pt_Pais = filter_var($Pt_Pais, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Grados_alchol)) {
                $Pt_Grados_alchol = trim($Pt_Grados_alchol);
                $Pt_Grados_alchol = filter_var($Pt_Grados_alchol, FILTER_SANITIZE_STRING);
            }
            if (!empty($Pt_Color)) {
                $Pt_Color = trim($Pt_Color);
                $Pt_Color = filter_var($Pt_Color, FILTER_SANITIZE_STRING);
            }
            $controlador->editarProducto($id,$Pt_Nombre,$Pt_codigo,$Pt_Presentacion,$Pt_Stock,$Pt_Precio,$Pt_Pais,$Pt_Grados_alchol, $Pt_Color, $Pt_Imagen);
            break;
        
        case 'borrarProducto':
            $controlador = new Controlador();
            $id = $_POST['id'];
            $Pt_Nombre = $_POST['Pt_Nombre'];
            if(!empty($Pt_Nombre)){
                $Pt_Nombre = trim($Pt_Nombre);
                $Pt_Nombre = filter_var($Pt_Nombre, FILTER_SANITIZE_STRING);
            }
            if(!empty($id)){
                $id = trim($id);
                $id = filter_var($id, FILTER_VALIDATE_INT);
            }
            $controlador->borrarProducto($id, $Pt_Nombre);
            break;

        case 'cargarTablaClienteDashboard':
            $Controlador = new Controlador();
            $Controlador->cargarTablaClienteDashboard();
            break;

        case 'cargarTablaPedidoDashboard':
            $Controlador = new Controlador();
            $Controlador->cargarTablaPedidoDashboard();
            break;
        
        case 'cargarGraficaDashboard':
            $Controlador = new Controlador();
            $Controlador->cargarGraficaDashboard();
            break;
    }

}


