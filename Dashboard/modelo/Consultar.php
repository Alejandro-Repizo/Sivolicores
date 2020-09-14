<?php 

require_once  'ConexionDB.php';
require_once 'ConexionBD.php';


//Acá se realizan todas las consultas SQL
class Consultar {

    public function conSesion(Administrador $con){
        try{ //nodo
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $email = $con->getEmail();
            $pass = $con->getPassword();
            $sql = "SELECT PK_ID_Administrador, Ad_Nombre, Ad_Apellido, Ad_Email, Ad_Password FROM tbl_administrador WHERE Ad_Email = '$email' AND Ad_Password = '$pass'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res){ ///nodod
                session_start();
                $_SESSION['email'] = $email; //nodo 
                header("Location:../vista/html/Dashboard.php");
            
            }else { //nodo 
                echo("<script>
                $(document).ready(function () {

                    $('#btnIngreso').click(function () {  
                        Swal.fire({        
                            type: 'success',
                            title: 'Éxito', 
                            text: 'Marca registrada con éxito'      
                        });
                    });
                });</script>");
            }

        } catch (Exception $ex) { //nodo
            $ex->getMessage();
        }
    }
    
    //Módulo Marcas
    public function updateUsers(Administrador $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $pk = $con->getId();
            $up_nombre = $con->getNombre();
            $up_apellido = $con->getApellido();
            $up_email = $con->getEmail();
            $up_password = $con->getPassword();
            $sql = "UPDATE tbl_administrador SET Ad_Nombre = '$up_nombre', Ad_Apellido = '$up_apellido', 
            Ad_Email = '$up_email', Ad_Password = '$up_password' WHERE PK_ID_Administrador = '$pk'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();

            if($res == TRUE){
                header("Location:../vista/html/Editar_perfil.php");
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //Módulo Marcas
    public function cargarMarcas(){
        try{
            //Cargar datos a la tabla marcas
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Marca, Ma_Nombre FROM tbl_marca";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function saveMarcas(Marca $con){
        try{
            //Guardar Marca
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $consulta = "INSERT INTO tbl_marca (Ma_nombre) VALUES ('$nombre')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function updateMarcas(Marca $con){
        try{ 
            //Actualizar Marca
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $consulta = "UPDATE tbl_marca SET Ma_nombre = '$nombre' WHERE PK_ID_Marca = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
            
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        // Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function deleteMarcas(Marca $con){
        try{
            //Borrar Marca
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $consulta = "DELETE FROM tbl_marca WHERE PK_ID_Marca = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //Módulo Cliente
    public function cargarCliente(){
        try{
            //Cargar datos a la tabla cliente
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Cliente,Cl_Nombre,Cl_email,Cl_Pedidos_realizado,Cl_Fecha_registro FROM tbl_cliente ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo el un arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            ///Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function deleteCliente(Cliente $con){
        try{    
            //Borrar Cliente
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $consulta = "DELETE FROM tbl_cliente WHERE PK_ID_Cliente = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Cliente,Cl_Nombre,Cl_email,Cl_Pedidos_realizado,Cl_Fecha_registro FROM tbl_cliente ORDER BY PK_ID_Cliente DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

           //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //Módulo Inventario
    public function cargarInventario(){
        try{
            //Cargar datos a la tabla Inventario
            $conexion = new ConexionBD();
            $consulta = "SELECT Pt_Imagen,PK_ID_Producto,Pt_Nombre,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function upInventario(Producto $con){
        try{
            //Actualizar inventario
            $conexion = new ConexionBD();
            $precio = $con->getPt_Precio();
            $stock = $con->getPt_Stock();
            $id = $con->getPK_ID_Producto();
            $consulta = "UPDATE tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto SET Pt_Precio = '$precio', Pt_Stock = '$stock' where PK_ID_Producto = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT Pt_Imagen,PK_ID_Producto,Pt_Nombre,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto ORDER BY PK_ID_Inventario DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
            
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    
    }

    //Módulo Receta Coctel
    public function cargarRecetaCoctel(){
        try{
            //Cargar datos a la tabla receta coctel
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Receta,RC_Image,RC_Nombre,RC_Fecha FROM tbl_receta_coctel";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function saveRecetaCoctel(Coctel $con, $RC_Receta, $RC_Autor, $RC_Descripcion, $RC_Image){
        try{
            //Cargar datos a la tabla receta coctel
            // $RC_Image = $con->getRC_Image();
            $RC_Nombre = $con->getRC_Nombre();
            // $RC_Receta = $con->getRC_Receta();
            // $RC_Autor= $con->getRC_Autor();
            // $RC_Descripcion = $con->getRC_Descripcion();
            // echo $RC_Image["file"]["name"];
            echo '======';
            echo $RC_Autor;
            //acá está el error
            $check = getimagesize($RC_Image['file']['tmp_name']);
           if($check != false){
                $carpeta_destino ='../vista/imagenes/imagenesBD/';
                $archivo_subido = $carpeta_destino . $RC_Image['file']['name'];
                #Con está función movemos la foto
                move_uploaded_file($RC_Image['file']['tmp_name'], $archivo_subido);
                $conexion = new ConexionBD();
                $ImNombre = $RC_Image['file']['name'];
                $consulta = "INSERT INTO tbl_receta_coctel(RC_Nombre,RC_Receta,RC_Autor,RC_Descripcion,RC_Image) VALUES ('$RC_Nombre','$RC_Receta','$RC_Autor','$RC_Descripcion','$ImNombre')";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                
                //Coloca todo en una arreglo
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
                //Cerrar conexión
                $conexion = null;
            }
        }catch (Exception $ex) {
            $ex->getMessage();
        }
         //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function deleteRecetaCoctel(Coctel $con){
        try{
            //Borrar
            $conexion = new ConexionBD();
            $RC_Nombre = $con->getRC_Nombre();
            $id = $con->getPK_ID_Receta();
            $consulta = "DELETE FROM tbl_receta_coctel WHERE PK_ID_Receta = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    //Módulo cargar Reporte Ventas
    public function cargarReporteVentas(){
        try {
            //Cargar datos a la tabla reporte venta
            $conexion = new ConexionBD();
            $consulta = "SELECT Ped_Fecha,Cl_Nombre, Pt_Nombre,Pt_Cantidad, Car_Total 
            FROM tbl_pedido JOIN tbl_carrito_pedidos ON tbl_pedido.FK_ID_Carrito = tbl_carrito_pedidos.PK_ID_Carrito JOIN tbl_cliente ON tbl_carrito_pedidos.FK_ID_Cliente = tbl_cliente.PK_ID_Cliente JOIN tbl_producto ON
            tbl_carrito_pedidos.FK_ID_Producto = tbl_producto.PK_ID_Producto";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


     //Módulo cargar categorias
     public function cargarCategoria(){
        try {
            //Cargar datos a la tabla reporte venta
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM Tbl_Categoria";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function agregarCategoria(Categoria $con){
        try {
            //Guardar categoria
            $conexion = new ConexionBD();
            $Cat_Nombre = $con->getNombre();
            $consulta = "INSERT INTO Tbl_Categoria (Cat_Nombre) VALUES ('$Cat_Nombre') ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM Tbl_Categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function editarCategoria(Categoria $con){
        try {
            //Guardar categoria
            $conexion = new ConexionBD();
            $Cat_Nombre = $con->getNombre();
            $id = $con->getPK_ID_Categoria();
            $consulta = "UPDATE Tbl_Categoria SET Cat_Nombre = '$Cat_Nombre' WHERE PK_ID_Categoria = '$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM Tbl_Categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    
    public function borrarCategoria(Categoria $con){
        try {
            //Guardar categoria
            $conexion = new ConexionBD();
            // $Cat_Nombre = $con->getNombre();
            $id = $con->getPK_ID_Categoria();
            $consulta = "DELETE FROM Tbl_Categoria WHERE PK_ID_Categoria = '$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM Tbl_Categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }
        
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }











    public function upProducto(Producto $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $edit_i  = $con->getPK_ID_Producto();
            $Pt_codigo = $con->getPt_codigo();
            $Pt_Nombre = $con->getPt_Nombre();
            $Pt_Precio = $con->getPt_Precio();

            $Pt_Presentacion = $con->getPt_Presentacion();
            $Pt_Grados_alchol= $con->getPt_Grados_alchol();
            $Pt_Pais = $con->getPt_Pais();
            $Pt_Color = $con->getPt_Color();
            $Pt_Stock = $con->getPt_Stock();
            $sql = "UPDATE tbl_producto SET Pt_codigo='$Pt_codigo', Pt_Nombre ='$Pt_Nombre', Pt_Precio ='$Pt_Precio', Pt_Presentacion = '$Pt_Presentacion', 
            Pt_Grados_alchol ='$Pt_Grados_alchol', Pt_Pais ='$Pt_Pais', Pt_Color ='$Pt_Color', Pt_Stock ='$Pt_Stock' WHERE PK_ID_Producto = '$edit_i'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res == TRUE){
                header("Location:../vista/html/Mod_producto.php");
            }

        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function deleteProducto(Producto $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $edit_i  = $con->getPt_Nombre();
            $sql = "DELETE FROM tbl_producto WHERE PK_ID_Producto = '$edit_i'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res == TRUE){
                header("Location:../vista/html/Mod_productos.php");
            }

        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }


}

