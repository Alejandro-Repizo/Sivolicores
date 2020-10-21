<?php 

require_once '../modelo/Administrador.php';
require_once '../modelo/Consultar.php';
require_once '../modelo/Marca.php';
require_once '../modelo/Cliente.php';
require_once '../modelo/Producto.php';
require_once '../modelo/Coctel.php';
require_once '../modelo/Categoria.php';
require_once '../modelo/SubCategoria.php';
require_once '../modelo/Banner.php';

//Es el puente entre los datos y la sentencia SQL
class Controlador{

    //Módulo Login
    public function consulSesion($email, $password){
        $admin = new Administrador($email, $password);
        $consultar =  new Consultar();
        $consultar->conSesion($admin);
    }

    public function cargarEditarUsuario(){
        $consultar = new consultar();
        $consultar->cargarEditarUsuario();
    }

    public function editarUsuario($PK_ID_Administrador, $Ad_Nombre, $Ad_Apellido, $Ad_Email, $Ad_Password){
        $admin = new Administrador($Ad_Email, $Ad_Password);
        $admin->setNombre($Ad_Nombre);
        $admin->setApellido($Ad_Apellido);
        $admin->setId($PK_ID_Administrador);
        $consultar =  new consultar();
        $consultar->editarUsuario($admin);
    }



    //Módulo Marcas
    public function cargarMarca(){
        $consultar = new consultar();
        $consultar->cargarMarcas();
    }

    public function saveMarca($nombre){
        $marca = new Marca($nombre);
        $consultar = new consultar();
        $consultar->saveMarcas($marca);
    }

    public function updateMarca($nombre, $id){
        $marca = new Marca($nombre);
        $marca->setId($id);
        $consultar =  new consultar();
        $consultar->updateMarcas($marca);
    }

    public function deleteMarca($nombre, $id){
        $marca = new Marca($nombre);
        $marca->setId($id);
        $consultar =  new consultar();
        $consultar->deleteMarcas($marca);
    }

    public function cargarInventario(){
        $consultar = new consultar();
        $consultar->cargarInventario();
    }


    //Módulo Inventario
    public function updateInventario($id, $precio, $stock, $nombre){
        $Producto = new Producto($nombre);
        $Producto->setPK_ID_Producto($id); 
        $Producto->setPt_Precio($precio);
        $Producto->setPt_Stock($stock);   
        $consultar =  new consultar();
        $consultar->upInventario($Producto);
    }

    public function borrarInventario($id, $Pt_Nombre){
        $Producto = new Producto($Pt_Nombre);
        $Producto->setPK_ID_Producto($id);
        $Consultar =  new consultar();
        $Consultar->borrarInventario($Producto);
    }


    //Módulo Cliente
    public function deleteCliente($id, $nombre){
        $cliente = new Cliente($nombre);
        $cliente->setId($id);
        $consultar =  new consultar();
        $consultar->deleteCliente($cliente);
    }

    public function cargarCliente(){
        $consultar = new consultar();
        $consultar->cargarCliente();
    }


    //Módulo Receta Cóctel
    public function cargarRecetaCoctel(){
        $consultar = new consultar();
        $consultar->cargarRecetaCoctel();
    }

    public function saveRecetaCoctel($RC_Nombre, $RC_Receta, $RC_Autor, $RC_Descripcion, $RC_Image){
        $Coctel = new Coctel($RC_Nombre);
        $Coctel->setRC_Receta($RC_Receta);
        $Coctel->setRC_Autor($RC_Autor);
        $Coctel->setRC_Descripcion($RC_Descripcion);
        $Coctel->setRC_Image($RC_Image);
        $consultar = new consultar();
        $consultar->saveRecetaCoctel($Coctel);
    }

    public function cargarEditarReceta($id, $RC_Nombre){
        $Coctel = new Coctel($RC_Nombre);
        $Coctel->setPK_ID_Receta($id);
        $consultar = new consultar();
        $consultar->cargarEditarReceta($Coctel);
    }

    public function editarCoctel($id, $RC_Nombre, $RC_Receta, $RC_Autor, $RC_Descripcion){
        $Coctel = new Coctel($RC_Nombre);
        $Coctel->setPK_ID_Receta($id);
        $Coctel->setRC_Receta($RC_Receta);
        $Coctel->setRC_Autor($RC_Autor);
        $Coctel->setRC_Descripcion($RC_Descripcion);
        $consultar = new consultar();
        $consultar->editarCoctel($Coctel);
    }

    public function deleteRecetaCoctel($id, $RC_Nombre){
        $Coctel = new Coctel($RC_Nombre);
        $Coctel->setPK_ID_Receta($id);
        $consultar = new consultar();
        $consultar->deleteRecetaCoctel($Coctel);
    }


    //Módulo Reportes Ventas
    public function cargarReporteVentas(){
        $consultar = new consultar();
        $consultar->cargarReporteVentas();
    }

    //Módulo Reportes pedidos
    public function cargarReportePedidos(){
        $consultar = new consultar();
        $consultar->cargarReportePedidos();
    }
    
    //Módulo Categorias
    public function cargarCategoria(){
        $consultar = new consultar();
        $consultar->cargarCategoria();
    }

    public function agregarCategoria($Cat_Nombre){
        $Consultar = new consultar();
        $Categoria = new Categoria($Cat_Nombre);
        $Consultar->agregarCategoria($Categoria);
    }

    public function editarCategoria($id, $Cat_Nombre){
        $Consultar = new consultar();
        $Categoria = new Categoria($Cat_Nombre);
        $Categoria->setPK_ID_Categoria($id);
        $Consultar->editarCategoria($Categoria);
    }

    public function borrarCategoria($id, $Cat_Nombre){
        $Consultar = new consultar();
        $Categoria = new Categoria($Cat_Nombre);
        $Categoria->setPK_ID_Categoria($id);
        $Consultar->borrarCategoria($Categoria);
    }

    //Módulo Banner
    public function cargarBanner(){
        $consultar = new consultar();
        $consultar->cargarBanner();
    }

    public function editarBanner($id, $B_Nombre, $B_Imagen){
        $Banner = new Banner();
        $Banner->setPK_ID_Banner($id);
        $Banner->setB_Nombre($B_Nombre);
        $Banner->setB_Imagen($B_Imagen);
        $consultar = new consultar();
        $consultar->editarBanner($Banner);

    }

    //Módulo Pedido
    public function cargarPedido(){
        $consultar = new consultar();
        $consultar->cargarPedido();
    }

    public function enviarPedido($id){
        $consultar = new consultar();
        $consultar->enviarPedido($id);
    }

    public function reportePedido($id){
        $consultar = new consultar();
        $consultar->reportePedido($id);
    }

    //Módulo Envíos
    public function cargarEnvio(){
        $consultar = new consultar();
        $consultar->cargarEnvio();
    }

    public function envioReporteVenta($id){
        $consultar = new consultar();
        $consultar->envioReporteVenta($id);
    }

    public function envioReportePedido($id){
        $consultar = new consultar();
        $consultar->envioReportePedido($id);
    }

    //Módulo SubCategoria
    public function cargarSubCategoria(){
        $consultar = new consultar();
        $consultar->cargarSubCategoria();
    }

    public function agregarSubCategoria($SCat_Nombre, $PK_ID_Categoria){
        $Consultar = new consultar();
        $SubCategoria = new SubCategoria($SCat_Nombre);
        $Consultar->agregarSubCategoria($SubCategoria, $PK_ID_Categoria);
    }

    public function editarSubCategoria($id,$SCat_Nombre,$PK_ID_Categoria){
        $Consultar = new consultar();
        $SubCategoria = new SubCategoria($SCat_Nombre);
        $SubCategoria->setPK_ID_SubCategoria($id);
        $Consultar->editarSubCategoria($SubCategoria, $PK_ID_Categoria);
    }

    public function borrarSubCategoria($id, $SCat_Nombre){
        $Consultar = new consultar();
        $SubCategoria = new SubCategoria($SCat_Nombre);
        $SubCategoria->setPK_ID_SubCategoria($id);
        $Consultar->borrarSubCategoria($SubCategoria);
    }

    public function cargarCategoriaCombo($id){
        $consultar = new consultar();
        $consultar->cargarCategoriaCombo($id);
    }

    //Módulo Producto

    public function cargarProducto(){
        $Consultar =  new consultar();
        $Consultar->cargarProducto();
    }

    public function agregarProducto($Pt_Nombre,$Pt_codigo,$Pt_Presentacion,$Pt_Stock,$Pt_Precio, 
    $FK_ID_Categoria,$FK_ID_Marca,$Pt_Pais,$Pt_Grados_alchol, $Pt_Color, $Pt_Imagen){

        $Producto = new Producto($Pt_Nombre);
        $Producto->setPt_codigo($Pt_codigo);
        $Producto->setPt_Presentacion($Pt_Presentacion);
        $Producto->setPt_Stock($Pt_Stock);
        $Producto->setPt_Precio($Pt_Precio);
        $Producto->setFK_ID_Categoria($FK_ID_Categoria);
        $Producto->setFK_ID_Marca($FK_ID_Marca);
        $Producto->setPt_Pais($Pt_Pais);
        $Producto->setPt_Grados_alchol($Pt_Grados_alchol);
        $Producto->setPt_Color($Pt_Color);
        $Producto->setPt_Imagen($Pt_Imagen);
        $Consultar =  new consultar();
        $Consultar->agregarProducto($Producto);


    }

    public function cargarEditarProducto($id, $Pt_Nombre){
        $Producto = new Producto($Pt_Nombre);
        $Producto->setPK_ID_Producto($id);
        $Consultar =  new consultar();
        $Consultar->cargarEditarProducto($Producto);
    }

    public function editarProducto($id,$Pt_Nombre,$Pt_codigo,$Pt_Presentacion,$Pt_Stock,$Pt_Precio, 
    $Pt_Pais,$Pt_Grados_alchol, $Pt_Color, $Pt_Imagen){

        $Producto = new Producto($Pt_Nombre);
        $Producto->setPK_ID_Producto($id);
        $Producto->setPt_codigo($Pt_codigo);
        $Producto->setPt_Presentacion($Pt_Presentacion);
        $Producto->setPt_Stock($Pt_Stock);
        $Producto->setPt_Precio($Pt_Precio);
       
        $Producto->setPt_Pais($Pt_Pais);
        $Producto->setPt_Grados_alchol($Pt_Grados_alchol);
        $Producto->setPt_Color($Pt_Color);
        $Producto->setPt_Imagen($Pt_Imagen);
        $Consultar =  new consultar();
        $Consultar->editarProducto($Producto);
        

    }

    public function borrarProducto($id, $Pt_Nombre){
        $Producto = new Producto($Pt_Nombre);
        $Producto->setPK_ID_Producto($id);
        $Consultar =  new consultar();
        $Consultar->borrarProducto($Producto);
    }


    public function cargarTablaClienteDashboard(){
        $consultar = new consultar();
        $consultar->cargarTablaClienteDashboard();
    }

    public function cargarTablaPedidoDashboard(){
        $consultar = new consultar();
        $consultar->cargarTablaPedidoDashboard();
    }

    public function cargarGraficaDashboard(){
        $consultar = new consultar();
        $consultar->cargarGraficaDashboard();
    }



























  
    
    
}
