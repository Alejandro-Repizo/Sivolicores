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

    public function cargarMarcas(){
        try{
            //Cargar datos a la tabla marcas
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Marca, Ma_Nombre FROM tbl_marca";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);
            
        }catch (Exception $ex) {
            $ex->getMessage();
        }

    }
    public function saveMarcas(Marca $con){
        $prueba = true;
        // try{
        //     //Actualizar
        //     $conexion = new ConexionBD();
        //     $nombre = $con->getNombre();
        //     $consulta = "INSERT INTO tbl_marca (Ma_nombre) VALUES ('$nombre')";
        //     $resultado = $conexion->prepare($consulta);
        //     $resultado->execute();

        //     //Consulta del último registro genererado
        //     $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
        //     $resultado = $conexion->prepare($consulta);
        //     $resultado->execute();
    

        //     //Coloca todo en una arreglo
        //     $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        //     //Cerrar conexión
        //     $conexion = null;
        // } catch (Exception $ex) {
        //     $ex->getMessage();
        //     $data = ['error'=> true];
        // }
        // print json_encode($data, JSON_UNESCAPED_UNICODE);
        if($prueba){
            //Actualizar
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $consulta = "INSERT INTO tbl_marca (Ma_nombre) VALUES ('$nombre')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
    

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }else{
            $data = ['error'=> true];
        }   
        print json_encode($data, JSON_UNESCAPED_UNICODE);

       
    }

    public function updateMarcas(Marca $con){
        try{
            //Actualizar
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $consulta = "UPDATE tbl_marca SET Ma_nombre = '$nombre' WHERE PK_ID_Marca = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Envíar el arreglo final en formato JSON a JS
            print json_encode($data, JSON_UNESCAPED_UNICODE);

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function deleteMarcas(Marca $con){
        try{
            
            //Borrar
            $conexion = new ConexionBD();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $consulta = "DELETE FROM tbl_marca WHERE PK_ID_Marca = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ORDER BY PK_ID_Marca DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Envíar el arreglo final en formato JSON a JS
            print json_encode($data, JSON_UNESCAPED_UNICODE);

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //Módulo Cliente
    public function cargarCliente(){
        try{
            //Cargar datos a la tabla cliente
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Cliente,Cl_Nombre,Cl_email,Cl_Pedidos_realizado,Cl_Fecha_registro FROM tbl_cliente ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Envíar el arreglo final en formato JSON a JS
            print json_encode($data, JSON_UNESCAPED_UNICODE);
            
        }catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    public function deleteCliente(Cliente $con){
        try{
              
            //Borrar
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

            //Envíar el arreglo final en formato JSON a JS
            print json_encode($data, JSON_UNESCAPED_UNICODE);

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //Módulo Inventario
    public function cargarInventario(){
        try{
            //Cargar datos a la tabla Inventario
            $conexion = new ConexionBD();
            $consulta = "SELECT Pt_Imagen,PK_ID_Producto,Pt_Nombre,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);
            
        }catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    public function upInventario(Producto $con){
        try{
            //Actualizar
            $conexion = new ConexionBD();
            $precio = $con->getPt_Precio();
            $stock = $con->getPt_Stock();
            $id = $con->getPK_ID_Producto();
            $consulta = "UPDATE tbl_inventarioo inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto SET Pt_Precio = '$precio', Pt_Stock = '$stock' where PK_ID_Producto = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta del último registro genererado
            $consulta = "SELECT Pt_Imagen,Pt_Nombre,PK_ID_Producto,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto ORDER BY PK_ID_Producto DESC LIMIT 1";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
            $data = ['error'=> true];
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

