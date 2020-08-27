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
                        