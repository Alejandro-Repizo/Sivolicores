<?php 
require_once '../../modelo/ConexionDB.php';
require_once '../../modelo/sesion.php';

//Acá están las funciones para mostrar datos tanto en los input como tablas
function viewMarca(){
    $conexion  = new ConexionDB();
    $conexion->abrir();
    $sql="SELECT PK_ID_Marca,Ma_Nombre from tbl_marca ";
    $conexion->consulta($sql);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){
    
    echo'  
        <tr>
            <td>'.$mostar['PK_ID_Marca'].'</td>
            <td>'.$mostar['Ma_Nombre'].'</td>
                <td>
                    <a href="Mod_editar_marca.php?editar='.$mostar ['PK_ID_Marca'].'">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="../../controlador/DataRoute.php?deleteMarca='.$mostar ['PK_ID_Marca'].'">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>     
        </tr>';
    }
                         
} 

function viewEditMarca(){
    if(isset($_GET['editar'])){
        $editar_id = $_GET['editar'];
        $conexion  = new ConexionDB();
        $conexion->abrir();
        $sql="SELECT PK_ID_Marca, Ma_Nombre FROM tbl_marca WHERE PK_ID_Marca = '$editar_id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResult();
        while($mostar=$result->fetch_assoc()){
            echo '
            <form action="../../controlador/DataRoute.php?accion=updateMarca" method="POST">
                <h4>Información basica</h4>
                <hr>

                <label for="" class="esconder">Id:</label>
                <input type="text" name="Marca" id="ID_Marca" class="esconder"  value="'.$mostar ['PK_ID_Marca'].'">

                <label for="">Nombre de la marca:</label>
                <input type="text" name="Ma_nombre" id="Ma_nombre" value="'.$mostar ['Ma_Nombre'].'">

                <div class="button">
                    <button type="submit" name="actualizar" >Guardar</button>
                </div>
            </form> ';
        }
    }
}

function viewEditUser(){
    $conexion  = new ConexionDB();
    $email = $_SESSION['email'];
    $conexion->abrir();
    $sql="SELECT * FROM tbl_administrador WHERE Ad_Email = '$email'";
    $conexion->consulta($sql);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){

        echo '
        <form action="../../controlador/DataRoute.php?accion=updateUsers" method="POST">
    
             <input type="text" name="ad_primaria" id="ad_primaria" class="esconder" value="'.$mostar['PK_ID_Administrador'].'">

             <label for="Name"> Nombre: </label>
             <input type="text" name="ad_nombre" id="ad_nombre" value="'.$mostar['Ad_Nombre'].'">

             <label for="last_name"> Apellido: </label>
             <input type="text" name="ad_apellido" id="ad_apellido" value="'.$mostar['Ad_Apellido'].'">

             <label for="correo_electronico"> Correo Electrónico: </label>
             <input type="text" name="ad_email" id="email" value="'.$email.'">

             <label for="password"> Contraseña: </label>
             <input type="password" name="ad_password" id="password" value="'.$mostar['Ad_Password'].'">
             <!-- 
             <label for="confrim_password"> Confirmar contraseña: </label>
             <input type="password" name="" id="password"> -->
             <!--..-->
             <div class="button">
                 <button type="submit" name="actualizar">Guardar</button>
             </div>
        </form>
        ';
    }
    
}

function cargarInventario(){
    $conexion  = new ConexionDB();
    $conexion->abrir();
    $sql="SELECT Pt_Imagen,Pt_Nombre,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto";
    $conexion->consulta($sql);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){
        echo "
            <tr>
                <td>".$mostar['Pt_Imagen']."</td>
                <td>".$mostar['Pt_Nombre']."</td>
                <td>".$mostar['Pt_Precio']."</td>
                <td>".$mostar['Pt_Stock']."</td>
                <td>
                    <a href='Mod_editar_inventario.php?editarInventario=".$mostar['Pt_Nombre']."'>
                        <i class='fas fa-edit'></i>
                    </a>
                </td>
        </tr>";                           
    }        
}

function cargarClientes(){
    $conexion  = new ConexionDB();
    $conexion->abrir();
    $sql="SELECT PK_ID_Cliente,Cl_Nombre,Cl_email,Cl_Pedidos_realizado,Cl_Fecha_registro from tbl_cliente ";
    $conexion->consulta($sql);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){
    
        echo 
            "<tr>
                <td>".$mostar['PK_ID_Cliente'] ."</td>
                <td>".$mostar['Cl_Nombre']."</td>
                <td>".$mostar['Cl_email']."</td>
                <td>".$mostar['Cl_Pedidos_realizado']."</td>
                <td>".$mostar['Cl_Fecha_registro']."</td>   
                <td>
                <a href='../../controlador/DataRoute.php?deleteCliente=".$mostar['PK_ID_Cliente']."'>
                        <i class='fas fa-trash-alt'></i></a>
                    </a>
                </td>
        </tr>";             
    }      
}

function seleccionar(){
    if(isset($_GET['editarInventario'])){
        $editar_id = $_GET['editarInventario'];
        $conexion  = new ConexionDB();
        $conexion->abrir();
        $sql = "SELECT PK_ID_Producto,Pt_Nombre,Pt_Precio,Pt_Stock from tbl_inventario inner join tbl_producto on tbl_inventario.FK_ID_Productoinventario = tbl_producto.PK_ID_Producto where Pt_Nombre = '$editar_id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResult();
        while($mostar=$result->fetch_assoc()){

            echo '
            <form action="../../controlador/DataRoute.php?accion=updateInventario" method="post">
                <label for="">Nombre del producto:</label>
                <input type="text" name="Pt_Nombre" id="Pt_Nombre" disabled value="'.$mostar['Pt_Nombre'].'">

                <label for="">Precio:</label>
                <input type="text" name="Pt_Precio" id="Pt_Precio" value="'.$mostar['Pt_Precio'].'">

                <label for="">Stock:</label>
                <input type="text" name="Pt_Stock" id="Pt_Stock" value="'.$mostar['Pt_Stock'].'">

               
                <input type="text" name="PK_ID_Producto" id="Pt_Nombre" class="esconder" value="'.$mostar['PK_ID_Producto'].'">

                <div class="button">
                    <button type="submit" name="actualizar" >Guardar</button>
                </div>
             </form>'; 
        } 
    }  
}

function cargarClientesDash(){
    $conexion  = new ConexionDB();
    $conexion->abrir();
    $sql="SELECT PK_ID_Cliente,Cl_Nombre,Cl_email from tbl_cliente ";
    $conexion->consulta($sql);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){
    
        echo 
            "<tr>
                <td>".$mostar['Cl_Nombre']."</td>
                <td>".$mostar['Cl_email']."</td>
                <td>
                <a href='../../controlador/DataRoute.php?deleteCliente=".$mostar['PK_ID_Cliente']."'>
                        <i class='fas fa-trash-alt'></i></a>
                    </a>
                </td>
        </tr>";             
    }      
}
function mostrarProductos(){

    $conexion  = new ConexionDB();
    $conexion->abrir();
    $abc="SELECT Pt_Imagen, PK_ID_Producto, Pt_Nombre, Pt_Precio from tbl_producto";
    $conexion->consulta($abc);
    $result=$conexion->obtenerResult();
    while($mostar=$result->fetch_assoc()){
        echo '
        
         <tr>
            <td>'.$mostar['Pt_Imagen'].'</td>
            <td>'.$mostar['PK_ID_Producto'].'</td>
            <td>'.$mostar['Pt_Nombre'].'</td>
            <td>'.$mostar['Pt_Precio'].'</td>
            <td>
                <a href="Mod_editar_producto.php?editar='.$mostar ['PK_ID_Producto'].'">
                <i class="fas fa-edit"></i>
                </a>
                <a href=../../controlador/DataRoute.php?PK_ID_Producto='.$mostar ['PK_ID_Producto'].'">
                <i class="fas fa-trash-alt"></i>
                </a>
            </td>     
        </tr>
        ';                          
    }
            

}

function mostrarEditProducto(){
    if(isset($_GET['editar'])){
        $edit_i = $_GET['editar'];
        $conexion  = new ConexionDB();
        $conexion->abrir();
        $abc="SELECT PK_ID_Producto, Pt_codigo, Pt_Nombre, Pt_Precio, Pt_Imagen, Pt_Presentacion, Pt_Grados_alchol, Pt_Pais, Pt_Color, Pt_Stock, FK_ID_Categoria, FK_ID_Marca 
        FROM tbl_producto WHERE PK_ID_Producto = '$edit_i'";
        $conexion->consulta($abc);
        $result=$conexion->obtenerResult();
        while($mostar=$result->fetch_assoc()){
            echo '
            <form action="../../controlador/DataRoute.php?accion=updateProducto" method="POST">

                <label for="">id:</label>
                <input type="text" name="PK_ID_Producto" id="" Class="ocultar" value="'.$mostar['PK_ID_Producto'].'">

                <label for="">Nombre del producto:</label>
                <input type="text" name="Pt_Nombre" id="" value="'.$mostar['Pt_Nombre'].'" >

                <label for="">Codigo:</label>
                <input type="text" name="Pt_codigo" id="" value="'.$mostar['Pt_codigo'].'" >
                      
                <label for="">Presentación:</label>
                <input type="text" name="Pt_Presentacion" id="" value="'.$mostar['Pt_Presentacion'].'" >



                <h4>Unidades y precio</h4>
                <hr>
                <label for="">Unidades:</label>
                <input type="text" name="Pt_Stock" id="" value="'.$mostar['Pt_Stock'].'" >
    
                <label for="">Precio:</label>
                <input type="text" name="Pt_Precio" id="" value="'.$mostar['Pt_Precio'].'" >
                <h4>Categoría y marca</h4>
                <hr>
                
                <label for="">Categoría:</label>
                <input type="text" name="FK_ID_Categoria " id="" Class="ocultar" value="'.$mostar['FK_ID_Categoria'].'" >

                <label for="">Marca:</label>
                <input type="text" name="FK_ID_Marca " id="" Class="ocultar" value="'.$mostar['FK_ID_Marca'].'" > 



                <h4>Otros datos</h4>
                <hr>
                
                <label for="">País del producto:</label>
                <input type="text" name="Pt_Pais" id="" value="'.$mostar['Pt_Pais'].'" >

                <label for="">Grado Alcohol:</label>
                <input type="text" name="Pt_Grados_alchol" id="" value="'.$mostar['Pt_Grados_alchol'].'" > 

                <label for="">Color:</label>
                <input type="text" name="Pt_Color" id="" value="'.$mostar['Pt_Color'].'" >
                
                
                <h4>Imagen del producto</h4>
                <hr>
                <input type="file" id="" name="Pt_Imagen">
                <div class="button">
                    <button type="submit" name="actualizar">Guardar</button>
                </div>
            </form>
            ';
            
        
        }
    }  
}
                        