<?php 

require_once 'ConexionBD.php';


//Acá se realizan todas las consultas SQL
class Consultar {
    
    //Módulo Login
    public function conSesion(Administrador $con){

        try{ 
            //Login
            $conexion = new ConexionBD();
            $email = $con->getEmail();
            $pass = $con->getPassword();
            $consulta = "SELECT PK_ID_Administrador, Ad_Nombre, Ad_Apellido, Ad_Email, Ad_Password FROM tbl_administrador WHERE Ad_Email = '$email' AND Ad_Password = '$pass'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetch(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if ($data != false) {
                session_start();
                $_SESSION['email'] = $email; //nodo    
                $PK_ID_Administrador = $data['PK_ID_Administrador'];
                $_SESSION['llave'] = $PK_ID_Administrador;
                
            } else {
                $data = ['error'=> 'El usuario o la contraseña que ingresaste no coinciden con nuestros registros. Por favor, intenta de nuevo.'];
            }
            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        // Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    public function cargarEditarUsuario(){
        try{
            //Cargar datos al formulario editar administrador
            include 'sesion.php';
            $id = $_SESSION['llave'];
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Administrador, Ad_Nombre, Ad_Apellido, Ad_Email, Ad_Password FROM tbl_administrador WHERE PK_ID_Administrador = '$id'";
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

    public function editarUsuario(Administrador $con){
        try{
            $conexion = new ConexionBD();
            $pk = $con->getId();
            $up_nombre = $con->getNombre();
            $up_apellido = $con->getApellido();
            $up_email = $con->getEmail();
            $up_password = $con->getPassword();
          
            if (empty($up_password)) {
                //Actualizamos los datos sin la contrasena
                $consulta = "UPDATE tbl_administrador SET Ad_Nombre = '$up_nombre', Ad_Apellido = '$up_apellido', 
                Ad_Email = '$up_email'WHERE PK_ID_Administrador = '$pk'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }else {
                //Actualizamos losd datos con contrasena
                $consulta = "UPDATE tbl_administrador SET Ad_Nombre = '$up_nombre', Ad_Apellido = '$up_apellido', 
                Ad_Email = '$up_email', Ad_Password = '$up_password' WHERE PK_ID_Administrador = '$pk'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }
            
            //Cargar datos al formulario editar administrador
            $consulta = "SELECT PK_ID_Administrador, Ad_Nombre, Ad_Apellido, Ad_Email FROM tbl_administrador WHERE PK_ID_Administrador = '$pk'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
           
            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error'=> true];
            }else{
                $data = ['correcto' => true];
            }

            //Cerrar conexión
            $conexion = null;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
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

    public function borrarInventario(Producto $con){
        try{
            //Borrar producto
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Producto();
            $Pt_Nombre = $con->getPt_Nombre();

            //Consulta para traer nombre imagen
            $consulta = "SELECT Pt_Imagen FROM tbl_producto WHERE PK_ID_Producto = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Traemos el nombre de la imagen que esta en la base de datos
            $Producto_Image = $resultado->fetch(PDO::FETCH_ASSOC);
            $Nombre_img_producto = $Producto_Image['Pt_Imagen'];

            //Con esta funcion la eliminamos
            unlink("../vista/imagenes/Productos/".$Nombre_img_producto);

            //Consulta para eliminar
            $consulta = "DELETE FROM tbl_inventario WHERE FK_ID_ProductoInventario = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
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

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function saveRecetaCoctel(Coctel $con){
        try{
            //Guardar receta 
            $RC_Image = $con->getRC_Image();
            $RC_Nombre = $con->getRC_Nombre();
            $RC_Receta = $con->getRC_Receta();
            $RC_Autor= $con->getRC_Autor();
            $RC_Descripcion = $con->getRC_Descripcion();
            //acá está el error
            $check = getimagesize($RC_Image['file']['tmp_name']);
           if($check != false){
                $carpeta_destino ='../vista/imagenes/Coctel/';
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

    public function cargarEditarReceta(Coctel $con){
        try{
            //Cargar datos para editar
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Receta();
            $RC_Nombre = $con->getRC_Nombre();
            $consulta = "SELECT RC_Nombre,RC_Receta,RC_Autor,RC_Descripcion FROM tbl_receta_coctel WHERE PK_ID_Receta = '$id'";
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

    public function editarCoctel(Coctel $con){
        try{
            //Editar receta 
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Receta();
            $RC_Nombre = $con->getRC_Nombre();
            $RC_Receta = $con->getRC_Receta();
            $RC_Autor= $con->getRC_Autor();
            $RC_Descripcion = $con->getRC_Descripcion();
            $consulta = "UPDATE tbl_receta_coctel SET RC_Nombre = '$RC_Nombre', RC_Receta = '$RC_Receta',RC_Autor = '$RC_Autor',RC_Descripcion = '$RC_Descripcion'  WHERE PK_ID_Receta = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta último registro generado
            $consulta = "SELECT PK_ID_Receta,RC_Image,RC_Nombre,RC_Fecha FROM tbl_receta_coctel ORDER BY PK_ID_Receta DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Se comprueba si la variable data viene vacia y dado el caso envia un error
            if($data != TRUE){
                $data = ['error' => true];
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function deleteRecetaCoctel(Coctel $con){
        try{
            //Borrar receta coctel
            $conexion = new ConexionBD();
            $RC_Nombre = $con->getRC_Nombre();
            $id = $con->getPK_ID_Receta();

            //Consulta para traer nombre imagen
            $consulta = "SELECT RC_Image FROM tbl_receta_coctel WHERE PK_ID_Receta = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            
            //Traemos el nombre de la imagen que esta en la base de datos
            $Receta_Image = $resultado->fetch(PDO::FETCH_ASSOC);
            $Nombre_img_receta = $Receta_Image['RC_Image'];

            //Con esta funcion la eliminamos
            unlink("../vista/imagenes/Coctel/".$Nombre_img_receta);
            
            //Consulta para eliminar
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
    
    //Módulo Reporte Ventas
    public function cargarReporteVentas(){
        try {
            //Cargar datos a la tabla reporte venta
            $conexion = new ConexionBD();
            $consulta = "SELECT Ped_Fecha, Cl_Nombre, Pt_Nombre,Pt_Cantidad,Total,Estado FROM tbl_reporte_ventas";
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

    //Módulo Reporte Pedidos
    public function cargarReportePedidos(){
        try {
            //Cargar datos a la tabla reporte pedidos
            $conexion = new ConexionBD();
            $consulta = "SELECT Ped_Fecha, Cl_Nombre, Pt_Nombre,Pt_Cantidad,Total,Estado FROM tbl_reporte_pedido";
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


     //Módulo cargar categorias
     public function cargarCategoria(){
        try {
            //Cargar datos a la tabla categorias
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM tbl_categoria";
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

    public function agregarCategoria(Categoria $con){
        try {
            //Guardar categoria
            $conexion = new ConexionBD();
            $Cat_Nombre = $con->getNombre();
            $Cat_Imagen = $con->getCat_Imagen();
            $Cat_Banner_Imagen = $con->getCat_Banner_Imagen();
            $carpeta_destino = '../vista/imagenes/Categorias/';
            $carpeta_destino_banner ='../vista/imagenes/Banner/';

            if (!empty($Cat_Imagen) and !empty($Cat_Banner_Imagen)) {
               
                $archivo_subido = $carpeta_destino . $Cat_Imagen['file']['name'];
                move_uploaded_file($Cat_Imagen['file']['tmp_name'], $archivo_subido);

                $archivo_subido = $carpeta_destino_banner . $Cat_Banner_Imagen['file2']['name'];
                move_uploaded_file($Cat_Banner_Imagen['file2']['tmp_name'], $archivo_subido);
                
                $ImNombre = $Cat_Imagen['file']['name'];
                $ImNombre2 = $Cat_Banner_Imagen['file2']['name'];

                $consulta = "INSERT INTO tbl_categoria (Cat_Nombre, Cat_Imagen, Cat_Banner_Imagen) VALUES ('$Cat_Nombre', '$ImNombre', '$ImNombre2')";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }elseif (!empty($Cat_Banner_Imagen)) {
              
                $archivo_subido = $carpeta_destino_banner . $Cat_Banner_Imagen['file2']['name'];
                move_uploaded_file($Cat_Banner_Imagen['file2']['tmp_name'], $archivo_subido);
                
                $ImNombre2 = $Cat_Banner_Imagen['file2']['name'];

                $consulta = "INSERT INTO tbl_categoria (Cat_Nombre, Cat_Banner_Imagen) VALUES ('$Cat_Nombre', '$ImNombre2')";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }else {
                $consulta = "INSERT INTO tbl_categoria (Cat_Nombre) VALUES ('$Cat_Nombre')";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            } 
            
            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM tbl_categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
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
            //Editar categoria
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Categoria();
            $Cat_Nombre = $con->getNombre();
            $Cat_Imagen = $con->getCat_Imagen();
            $Cat_Banner_Imagen = $con->getCat_Banner_Imagen();
            $carpeta_destino = '../vista/imagenes/Categorias/';
            $carpeta_destino_banner ='../vista/imagenes/Banner/';

            if (!empty($Cat_Imagen) and !empty($Cat_Banner_Imagen)) {
                //Consulta para traer nombre imagen
                $consulta = "SELECT Cat_Imagen, Cat_Nombre FROM tbl_categoria WHERE PK_ID_Categoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                //Traemos el nombre de la imagen que esta en la base de datos
                $Categoria_Image = $resultado->fetch(PDO::FETCH_ASSOC);
                $Nombre_img_categoria = $Categoria_Image['Cat_Imagen'];
                $Nombre_Categoria = $Categoria_Image['Cat_Nombre'];

                if (!empty($Nombre_img_categoria)) {
                    //Con esta funcion la eliminamos
                    unlink("../vista/imagenes/Categorias/".$Nombre_img_categoria);
                }

                // Treamos la imagen de banners
                $consulta = "SELECT B_Imagen FROM tbl_banner WHERE B_Nombre = '$Nombre_Categoria'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                //Traemos el nombre de la imagen que esta en la base de datos
                $banner_Image = $resultado->fetch(PDO::FETCH_ASSOC);
                $Nombre_img_banner = $banner_Image['B_Imagen'];

                if (!empty($Nombre_img_banner)) {
                    //Con esta funcion la eliminamos
                    unlink("../vista/imagenes/Banner/".$Nombre_img_banner);
                }
                
                $archivo_subido = $carpeta_destino . $Cat_Imagen['file']['name'];
                move_uploaded_file($Cat_Imagen['file']['tmp_name'], $archivo_subido);

                $archivo_subido = $carpeta_destino_banner . $Cat_Banner_Imagen['file2']['name'];
                move_uploaded_file($Cat_Banner_Imagen['file2']['tmp_name'], $archivo_subido);
                
                $ImNombre = $Cat_Imagen['file']['name'];
                $ImNombre2 = $Cat_Banner_Imagen['file2']['name'];

                $consulta = "UPDATE tbl_categoria SET Cat_Nombre = '$Cat_Nombre', 
                Cat_Imagen = '$ImNombre', Cat_Banner_Imagen = '$ImNombre2' WHERE PK_ID_Categoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }elseif (!empty($Cat_Banner_Imagen)) {
                //Consulta para traer nombre imagen
                $consulta = "SELECT Cat_Nombre FROM tbl_categoria WHERE PK_ID_Categoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                //Traemos el nombre de la imagen que esta en la base de datos
                $Categoria_Image = $resultado->fetch(PDO::FETCH_ASSOC);
                $Nombre_Categoria = $Categoria_Image['Cat_Nombre'];
                
                // Treamos la imagen de banners
                $consulta = "SELECT B_Imagen FROM tbl_banner WHERE B_Nombre = '$Nombre_Categoria'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                //Traemos el nombre de la imagen que esta en la base de datos
                $banner_Image = $resultado->fetch(PDO::FETCH_ASSOC);
                $Nombre_img_banner = $banner_Image['B_Imagen'];

                if (!empty($Nombre_img_banner)) {
                    //Con esta funcion la eliminamos
                    unlink("../vista/imagenes/Banner/".$Nombre_img_banner);
                }
                
                $archivo_subido = $carpeta_destino_banner . $Cat_Banner_Imagen['file2']['name'];
                move_uploaded_file($Cat_Banner_Imagen['file2']['tmp_name'], $archivo_subido);
                
                $ImNombre2 = $Cat_Banner_Imagen['file2']['name'];

                $consulta = "UPDATE tbl_categoria SET Cat_Nombre = '$Cat_Nombre', Cat_Banner_Imagen = '$ImNombre2' WHERE PK_ID_Categoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }else {
                $consulta = "UPDATE tbl_categoria SET Cat_Nombre = '$Cat_Nombre' WHERE PK_ID_Categoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }  
            
            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM tbl_categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
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
            //Borrar categoria
            $conexion = new ConexionBD();
            $Cat_Nombre = $con->getNombre();
            $id = $con->getPK_ID_Categoria();

            //Consulta para traer nombre imagen
            $consulta = "SELECT Cat_Imagen FROM tbl_categoria WHERE PK_ID_Categoria = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Traemos el nombre de la imagen que esta en la base de datos
            $Categoria_Image = $resultado->fetch(PDO::FETCH_ASSOC);
            $Nombre_img_categoria = $Categoria_Image['Cat_Imagen'];

            if (!empty($Nombre_img_categoria)) {
                //Con esta funcion la eliminamos
                unlink("../vista/imagenes/Categorias/".$Nombre_img_categoria);
            }

            // Treamos la imagen de banners
            $consulta = "SELECT B_Imagen FROM tbl_banner WHERE B_Nombre = '$Cat_Nombre'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Traemos el nombre de la imagen que esta en la base de datos
            $banner_Image = $resultado->fetch(PDO::FETCH_ASSOC);
            $Nombre_img_banner = $banner_Image['B_Imagen'];

            if (!empty($Nombre_img_banner)) {
                //Con esta funcion la eliminamos
                unlink("../vista/imagenes/Banner/".$Nombre_img_banner);
            }
            
            //Consulta para elminar en la tabla banners
            $consulta = "DELETE FROM tbl_banner WHERE B_Nombre = '$Cat_Nombre'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta para eliminar
            $consulta = "DELETE FROM tbl_categoria WHERE PK_ID_Categoria = '$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM tbl_categoria ORDER BY PK_ID_Categoria DESC LIMIT 1";
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

    //Módulo Banner
    public function cargarBanner(){
        try{
            //Cargar datos de la tabla tbl_banner
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Banner, B_Imagen, B_Nombre, B_Fecha_actualizacion FROM tbl_banner";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function editarBanner(Banner $con){
        try{
            //Editar
            $conexion = new ConexionBD();
            $B_Imagen = $con->getB_Imagen();
            $PK_ID_Banner = $con->getPK_ID_Banner();
            $check = getimagesize($B_Imagen['file']['tmp_name']);
            if($check != false){

                //Consulta para traer nombre imagen
                $consulta = "SELECT B_Imagen FROM tbl_banner WHERE PK_ID_Banner = '$PK_ID_Banner'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                //Traemos el nombre de la imagen que esta en la base de datos
                $Banner_Image = $resultado->fetch(PDO::FETCH_ASSOC);
                $Nombre_img_banner = $Banner_Image['B_Imagen'];

                //Con esta funcion la eliminamos
                unlink("../vista/imagenes/Banner/".$Nombre_img_banner);

                //Agregamos la nueva imagen
                $carpeta_destino ='../vista/imagenes/Banner/';
                $archivo_subido = $carpeta_destino . $B_Imagen['file']['name'];
                #Con está función movemos la foto
                move_uploaded_file($B_Imagen['file']['tmp_name'], $archivo_subido);
                $ImNombre = $B_Imagen['file']['name'];
                $consulta = "UPDATE tbl_banner SET B_Imagen = '$ImNombre' WHERE PK_ID_Banner = '$PK_ID_Banner'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            
            }
            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
         //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    //Módulo Pedidos
    public function cargarPedido(){
        try{
            //Cargar datos a pedidos
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Pedido, Cl_Nombre, Ped_Fecha, Pt_Nombre, Pt_Cantidad, Ped_Direccion, 
            Cl_Telefono, Total, Estado FROM tbl_pedido";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function enviarPedido($id){
        try{
            //Traemos los datos de los campos deacuerdo al id
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Pedido, Ped_Fecha, Ped_Estado, Ped_Direccion, 
            Ped_observaciones, FK_ID_Carrito FROM tbl_pedido WHERE PK_ID_Pedido = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Hacemos un insert con los datos anteriores a la tabla envios
            $datosPedido = $resultado->fetch(PDO::FETCH_ASSOC);
            $PK_ID_Pedido = $datosPedido['PK_ID_Pedido'];
            $Ped_Fecha = $datosPedido['Ped_Fecha'];
            $Ped_Estado = "Por completar";
            $Ped_Direccion = $datosPedido['Ped_Direccion'];
            $Ped_observaciones = $datosPedido['Ped_observaciones'];
            $FK_ID_Carrito = $datosPedido['FK_ID_Carrito'];
            
            $consulta = "INSERT INTO tbl_envio(PK_ID_Envio, Env_Fecha,Env_Estado,Env_Direccion,Env_Observaciones,FK_ID_Carrito)
            VALUES ('$PK_ID_Pedido','$Ped_Fecha','$Ped_Estado','$Ped_Direccion','$Ped_observaciones','$FK_ID_Carrito')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Ahora si eliminamos el pedido de la tabla pedido
            $consulta = "DELETE FROM tbl_pedido WHERE PK_ID_Pedido = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta último registro generado
            $consulta = "SELECT PK_ID_Pedido, Ped_Fecha, Ped_Estado, Ped_Direccion, 
            Ped_observaciones, FK_ID_Carrito FROM tbl_pedido ORDER BY PK_ID_Pedido DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function reportePedido($id){
        try{
            //Traemos los datos de los campos deacuerdo al id
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Envio, Ped_Fecha, Ped_Estado, Ped_Direccion, 
            Ped_observaciones, FK_ID_Carrito FROM tbl_pedido WHERE PK_ID_Pedido = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Hacemos un insert con los datos anteriores a la tabla reporte pedidos
            $datosPedido = $resultado->fetch(PDO::FETCH_ASSOC);
            $PK_ID_Pedido = $datosPedido['PK_ID_Pedido'];
            $Ped_Fecha = $datosPedido['Ped_Fecha'];
            $Ped_Estado = "Cancelado";
            $Ped_Direccion = $datosPedido['Ped_Direccion'];
            $Ped_observaciones = $datosPedido['Ped_observaciones'];
            $FK_ID_Carrito = $datosPedido['FK_ID_Carrito'];
            
            $consulta = "INSERT INTO tbl_reporte_pedido(PK_ID_reporte, RepP_Fecha,RepP_Estado,RepP_Direccion,RepP_Observaciones,FK_ID_Carrito)
            VALUES ('$PK_ID_Pedido','$Ped_Fecha','$Ped_Estado','$Ped_Direccion','$Ped_observaciones','$FK_ID_Carrito')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Ahora si eliminamos el pedido de la tabla pedido
            $consulta = "DELETE FROM tbl_pedido WHERE PK_ID_Pedido = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta último registro generado
            $consulta = "SELECT PK_ID_Pedido, Ped_Fecha, Ped_Estado, Ped_Direccion, 
            Ped_observaciones, FK_ID_Carrito FROM tbl_pedido ORDER BY PK_ID_Pedido DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //Módulo Envíos
    public function cargarEnvio(){
        try{
            //Cargar datos a pedidos
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Envio, Cl_Nombre, Pt_Nombre,Pt_Cantidad, Ped_Direccion, Cl_Telefono, Total,
            Ped_Observaciones, Estado FROM tbl_envio";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function envioReporteVenta($id){
        try{
            //Traemos los datos de los campos deacuerdo al id
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Envio, Env_Fecha,Env_Estado,Env_Direccion,Env_Observaciones,
            FK_ID_Carrito FROM tbl_envio WHERE PK_ID_Envio = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Hacemos un insert con los datos anteriores a la tabla envios
            $datosEnvio = $resultado->fetch(PDO::FETCH_ASSOC);
            $PK_ID_Envio = $datosEnvio['PK_ID_Envio'];
            $Env_Fecha = $datosEnvio['Env_Fecha'];
            $Env_Estado = "Completado";
            $Env_Direccion = $datosEnvio['Env_Direccion'];
            $Env_Observaciones = $datosEnvio['Env_Observaciones'];
            $FK_ID_Carrito = $datosEnvio['FK_ID_Carrito'];
            
            $consulta = "INSERT INTO tbl_reporte_ventas(PK_ID_reporte, RepV_Fecha,RepV_Estado,RepV_Direccion,RepV_Observaciones,FK_ID_Carrito)
            VALUES ('$PK_ID_Envio','$Env_Fecha','$Env_Estado','$Env_Direccion','$Env_Observaciones','$FK_ID_Carrito')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Ahora si eliminamos el pedido de la tabla pedido
            $consulta = "DELETE FROM tbl_envio WHERE PK_ID_Envio = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta último registro generado
            $consulta = "SELECT PK_ID_Envio, Env_Fecha,Env_Estado,Env_Direccion,Env_Observaciones,
            FK_ID_Carrito FROM tbl_envio ORDER BY PK_ID_Envio DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function envioReportePedido($id){
        try{
            //Traemos los datos de los campos deacuerdo al id
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Envio, Env_Fecha,Env_Estado,Env_Direccion,Env_Observaciones,
            FK_ID_Carrito FROM tbl_envio WHERE PK_ID_Envio = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Hacemos un insert con los datos anteriores a la tabla envios
            $datosEnvio = $resultado->fetch(PDO::FETCH_ASSOC);
            $PK_ID_Envio = $datosEnvio['PK_ID_Envio'];
            $Env_Fecha = $datosEnvio['Env_Fecha'];
            $Env_Estado = "Cancelado";
            $Env_Direccion = $datosEnvio['Env_Direccion'];
            $Env_Observaciones = $datosEnvio['Env_Observaciones'];
            $FK_ID_Carrito = $datosEnvio['FK_ID_Carrito'];
            
            $consulta = "INSERT INTO tbl_reporte_pedido(PK_ID_reporte, RepP_Fecha,RepP_Estado,RepP_Direccion,RepP_Observaciones,FK_ID_Carrito)
            VALUES ('$PK_ID_Envio','$Env_Fecha','$Env_Estado','$Env_Direccion','$Env_Observaciones','$FK_ID_Carrito')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Ahora si eliminamos el pedido de la tabla pedido
            $consulta = "DELETE FROM tbl_envio WHERE PK_ID_Envio = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Consulta último registro generado
            $consulta = "SELECT PK_ID_Envio, Env_Fecha,Env_Estado,Env_Direccion,Env_Observaciones,
            FK_ID_Carrito FROM tbl_envio ORDER BY PK_ID_Envio DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    //Módulo Subcategorias
    public function cargarSubCategoria(){
        try {
            //Cargar datos a la tabla subcategoria
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_SubCategoria, SCat_Nombre, Cat_Nombre FROM tbl_catxsub JOIN tbl_subcategoria 
            ON tbl_catxsub.FK_ID_SubCategoria = tbl_subcategoria.PK_ID_SubCategoria 
            JOIN tbl_categoria ON tbl_catxsub.FK_ID_Categoria = tbl_categoria.PK_ID_Categoria";
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

    public function cargarSubCatxCat($PK_ID_Categoria){
        try {
            //Cargar datos a la tabla subcategoria
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_SubCategoria, SCat_Nombre FROM tbl_catxsub JOIN tbl_subcategoria 
            ON tbl_catxsub.FK_ID_SubCategoria = tbl_subcategoria.PK_ID_SubCategoria  WHERE FK_ID_Categoria = '$PK_ID_Categoria'";
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

    public function agregarSubCategoria(SubCategoria $con, $PK_ID_Categoria){
        try {
            //Guardar Subcategoria
            $conexion = new ConexionBD();
            $SCat_Nombre = $con->getNombre();
            $consulta = "INSERT INTO tbl_subcategoria (SCat_Nombre) VALUES ('$SCat_Nombre') ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta el id del último registro genererado
            $consulta = "SELECT PK_ID_SubCategoria FROM tbl_subcategoria ORDER BY PK_ID_SubCategoria DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca el ID en una arreglo 
            $llave = $resultado->fetch(PDO::FETCH_ASSOC);
            $PK_ID_SubCategoria = $llave['PK_ID_SubCategoria'];
        

            // Guarda consulta en la tabla de categoria por subcategoria
            $consulta = "INSERT INTO tbl_catxsub(FK_ID_Categoria, FK_ID_SubCategoria) VALUES  ('$PK_ID_Categoria', '$PK_ID_SubCategoria')";
            $resultados = $conexion->prepare($consulta);
            $resultados->execute();


            // Consulta el id del último registro genererado
            $consulta = "SELECT PK_ID_SubCategoria, SCat_Nombre FROM tbl_subcategoria ORDER BY PK_ID_SubCategoria DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

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

    public function editarSubCategoria(SubCategoria $con, $PK_ID_Categoria){
        try {
            //Editar subcategoria
            $conexion = new ConexionBD();
            $SCat_Nombre = $con->getNombre();
            $id = $con->getPK_ID_SubCategoria();
            $consulta = "UPDATE tbl_subcategoria SET SCat_Nombre = '$SCat_Nombre' WHERE PK_ID_SubCategoria = '$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            if(!empty($PK_ID_Categoria)) {
                $consulta = "UPDATE tbl_catxsub SET FK_ID_Categoria ='$PK_ID_Categoria' WHERE FK_ID_SubCategoria = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_SubCategoria, SCat_Nombre FROM tbl_subcategoria ORDER BY PK_ID_SubCategoria DESC LIMIT 1";
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

    
    public function borrarSubCategoria(SubCategoria $con){
        try {
            //Guardar Subcategoria
            $conexion = new ConexionBD();
            // $SCat_Nombre = $con->getNombre();
            $id = $con->getPK_ID_SubCategoria();

            $consulta = "DELETE FROM tbl_subcategoria WHERE PK_ID_SubCategoria = '$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            // Consulta del último registro genererado
            $consulta = "SELECT PK_ID_SubCategoria, SCat_Nombre FROM tbl_subcategoria ORDER BY PK_ID_SubCategoria DESC LIMIT 1";
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

    public function cargarCategoriaCombo($id){
        try {
            //Cargar datos a la tabla subcategoria
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Categoria, Cat_Nombre FROM tbl_catxsub JOIN tbl_categoria 
            ON tbl_catxsub.FK_ID_Categoria = tbl_categoria.PK_ID_Categoria WHERE FK_ID_SubCategoria = '$id'";
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


    //Módulo Producto
    public function cargarProducto(){
        try{
            //Cargar datos de la tabla productos
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Producto, Pt_codigo, Pt_Imagen, Pt_Nombre, Pt_Precio, Cat_Nombre from tbl_producto 
            JOIN tbl_categoria ON tbl_producto.FK_ID_Categoria = tbl_categoria.PK_ID_Categoria ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        
    }


    public function agregarProducto(Producto $con){
        try{
            //Cargar datos a la tabla productos
            $Pt_Nombre = $con->getPt_Nombre();
            $Pt_codigo = $con->getPt_codigo();
            $Pt_Presentacion = $con->getPt_Presentacion();
            $Pt_Stock = $con->getPt_Stock();
            $Pt_Precio = $con->getPt_Precio();
            $FK_ID_Categoria = $con->getFK_ID_Categoria();
            $FK_ID_Marca = $con->getFK_ID_Marca();
            $Pt_Pais = $con->getPt_Pais();
            $Pt_Grados_alchol= $con->getPt_Grados_alchol();
            $Pt_Color = $con->getPt_Color();
            $Pt_Imagen = $con->getPt_Imagen();

            $FK_ID_SubCategoria = $con->getFK_ID_SubCategoria();
            if(!empty($FK_ID_SubCategoria)) {
                //acá está el error
                $check = getimagesize($Pt_Imagen['file']['tmp_name']);
                if($check != false){
                    $carpeta_destino ='../vista/imagenes/Productos/';
                    $archivo_subido = $carpeta_destino . $Pt_Imagen['file']['name'];
                    #Con está función movemos la foto
                    move_uploaded_file($Pt_Imagen['file']['tmp_name'], $archivo_subido);
                    $conexion = new ConexionBD();
                    $ImNombre = $Pt_Imagen['file']['name'];

                    $consulta = "INSERT INTO tbl_producto (Pt_codigo, Pt_Nombre, Pt_Precio,Pt_Imagen,Pt_Presentacion,Pt_Grados_alchol,Pt_Pais,Pt_Color,Pt_Stock,FK_ID_Categoria,FK_ID_Marca, FK_ID_SubCategoria) 
                    VALUES ('$Pt_codigo', '$Pt_Nombre', '$Pt_Precio', '$ImNombre', '$Pt_Presentacion','$Pt_Grados_alchol', '$Pt_Pais', '$Pt_Color', '$Pt_Stock', '$FK_ID_Categoria', '$FK_ID_Marca', '$FK_ID_SubCategoria')";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                
                    //Cerrar conexión
                    $conexion = null;
                }
            }else {
                $check = getimagesize($Pt_Imagen['file']['tmp_name']);
                if($check != false){
                    $carpeta_destino ='../vista/imagenes/Productos/';
                    $archivo_subido = $carpeta_destino . $Pt_Imagen['file']['name'];
                    #Con está función movemos la foto
                    move_uploaded_file($Pt_Imagen['file']['tmp_name'], $archivo_subido);
                    $conexion = new ConexionBD();
                    $ImNombre = $Pt_Imagen['file']['name'];

                    $consulta = "INSERT INTO tbl_producto (Pt_codigo, Pt_Nombre, Pt_Precio,Pt_Imagen,Pt_Presentacion,Pt_Grados_alchol,Pt_Pais,Pt_Color,Pt_Stock,FK_ID_Categoria,FK_ID_Marca) 
                    VALUES ('$Pt_codigo', '$Pt_Nombre', '$Pt_Precio', '$ImNombre', '$Pt_Presentacion','$Pt_Grados_alchol', '$Pt_Pais', '$Pt_Color', '$Pt_Stock', '$FK_ID_Categoria', '$FK_ID_Marca')";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                
                    //Cerrar conexión
                    $conexion = null;
                }
            }
            var_dump($FK_ID_SubCategoria);
            
        }catch (Exception $ex) {
            $ex->getMessage();
        }
         //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    
    public function cargarEditarProducto(Producto $con){
        try{
            //Cargar datos para editar producto
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Producto();
            $Pt_Nombre = $con->getPt_Nombre();
            $consulta = "SELECT PK_ID_Producto, Pt_codigo, Pt_Nombre, Pt_Precio, Pt_Imagen, Pt_Presentacion, 
            Pt_Grados_alchol, Pt_Pais, Pt_Color, Pt_Stock, FK_ID_Categoria, FK_ID_Marca FROM tbl_producto
            WHERE PK_ID_Producto = '$id'";
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


    public function editarProducto(Producto $con){
        try{
            //Editar producto
            $id = $con->getPK_ID_Producto();
            $Pt_Nombre = $con->getPt_Nombre();
            $Pt_codigo = $con->getPt_codigo();
            $Pt_Presentacion = $con->getPt_Presentacion();
            $Pt_Stock = $con->getPt_Stock();
            $Pt_Precio = $con->getPt_Precio();
       
            $Pt_Pais = $con->getPt_Pais();
            $Pt_Grados_alchol= $con->getPt_Grados_alchol();
            $Pt_Color = $con->getPt_Color();
            $Pt_Imagen = $con->getPt_Imagen();
            
      
            //acá está el error
            $check = getimagesize($Pt_Imagen['file']['tmp_name']);
            if($check != false){
                $carpeta_destino ='../vista/imagenes/Productos/';
                $archivo_subido = $carpeta_destino . $Pt_Imagen['file']['name'];
                #Con está función movemos la foto
                move_uploaded_file($Pt_Imagen['file']['tmp_name'], $archivo_subido);
                $conexion = new ConexionBD();
                $ImNombre = $Pt_Imagen['file']['name'];

                $consulta = "UPDATE tbl_producto SET Pt_codigo = '$Pt_codigo', Pt_Nombre = '$Pt_Nombre', Pt_Precio = '$Pt_Precio', 
                Pt_Imagen = '$ImNombre', Pt_Presentacion = '$Pt_Presentacion', Pt_Grados_alchol = '$Pt_Grados_alchol', Pt_Pais = '$Pt_Pais',
                Pt_Color='$Pt_Color', Pt_Stock = '$Pt_Stock'  WHERE PK_ID_Producto = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            
            }else{
                $conexion = new ConexionBD();
                $consulta = "UPDATE tbl_producto SET Pt_codigo = '$Pt_codigo', Pt_Nombre = '$Pt_Nombre', Pt_Precio = '$Pt_Precio', 
                Pt_Presentacion = '$Pt_Presentacion', Pt_Grados_alchol = '$Pt_Grados_alchol', Pt_Pais = '$Pt_Pais',
                Pt_Color='$Pt_Color', Pt_Stock = '$Pt_Stock'  WHERE PK_ID_Producto = '$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
         //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function borrarProducto(Producto $con){
        try{
            //Borrar producto
            $conexion = new ConexionBD();
            $id = $con->getPK_ID_Producto();
            $Pt_Nombre = $con->getPt_Nombre();

            //Consulta para traer nombre imagen
            $consulta = "SELECT Pt_Imagen FROM tbl_producto WHERE PK_ID_Producto = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Traemos el nombre de la imagen que esta en la base de datos
            $Producto_Image = $resultado->fetch(PDO::FETCH_ASSOC);
            $Nombre_img_producto = $Producto_Image['Pt_Imagen'];

            //Con esta funcion la eliminamos
            unlink("../vista/imagenes/Productos/".$Nombre_img_producto);

            //Consulta para eliminar
            $consulta = "DELETE FROM tbl_producto WHERE PK_ID_Producto = '$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        
    }


    public function cargarTablaClienteDashboard(){
        try{
            //Cargar datos a la tabla cliente dashboard
            $conexion = new ConexionBD();
            $consulta = "SELECT Cl_Nombre, Cl_Apellido, Cl_email FROM tbl_cliente ORDER BY PK_ID_Cliente DESC LIMIT 10";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    public function cargarTablaPedidoDashboard(){
        try{
            //Cargar datos a la tabla pedidos Dashboard
            $conexion = new ConexionBD();
            $consulta = "SELECT PK_ID_Pedido, Cl_Nombre, Ped_Estado, Car_Total  FROM tbl_pedido
            JOIN tbl_carrito_pedidos ON tbl_carrito_pedidos.PK_ID_Carrito = tbl_pedido.FK_ID_Carrito 
            JOIN tbl_cliente ON tbl_cliente.PK_ID_Cliente = tbl_carrito_pedidos.FK_ID_Cliente 
            JOIN tbl_producto ON tbl_carrito_pedidos.FK_ID_Producto = tbl_producto.PK_ID_Producto ORDER BY PK_ID_Pedido DESC LIMIT 10";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function cargarGraficaDashboard(){
        try{
            //Cargar datos a la grafica
            $conexion = new ConexionBD();
            $consulta = "SELECT Ped_Estado, COUNT(PK_ID_Pedido) FROM tbl_pedido GROUP BY Ped_Estado ORDER BY COUNT(PK_ID_Pedido) DESC ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = [];

            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, array($fila['Ped_Estado'], $fila['COUNT(PK_ID_Pedido)']));
            }
            
            //Consulta para traer los envios
            $consulta = "SELECT Env_Estado, COUNT(PK_ID_Envio) FROM tbl_envio GROUP BY Env_Estado ORDER BY COUNT(PK_ID_Envio) DESC ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, array($fila['Env_Estado'], $fila['COUNT(PK_ID_Envio)']));
            }

            //Consulta para traer los reporte envios
            $consulta = "SELECT Repv_Estado, COUNT(PK_ID_reporte)FROM tbl_reporte_ventas GROUP BY Repv_Estado ORDER BY COUNT(PK_ID_reporte) DESC ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, array($fila['Repv_Estado'], $fila['COUNT(PK_ID_reporte)']));
            }

            //Consulta para traer los reporte pedidos
            $consulta = "SELECT RepP_Estado, COUNT(PK_ID_reporte)FROM tbl_reporte_pedido GROUP BY RepP_Estado ORDER BY COUNT(PK_ID_reporte) DESC ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, array($fila['RepP_Estado'], $fila['COUNT(PK_ID_reporte)']));
            }

            //Cerrar conexión
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_NUMERIC_CHECK);
    }


    public function TotalClientes(){
        try{
            //Cargar datos a la tabla pedidos Dashboard
            $conexion = new ConexionBD();
            $consulta = "SELECT COUNT(RepV_Fecha) FROM tbl_reporte_ventas";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            //Coloca todo en una arreglo
            $data = $resultado->fetch();

            //Cerrar conexión 
            $conexion = null;
        }catch (Exception $ex) {
            $ex->getMessage();
        }
        //Envíar el arreglo final en formato JSON a JS
        print json_encode($data, JSON_UNESCAPED_UNICODE);
    }
   


}

