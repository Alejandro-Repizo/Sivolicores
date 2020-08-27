<?php 

require_once  'ConexionDB.php';

//Acá se realizan todas las consultas SQL
class Consultar {

    public function conSesion(Administrador $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $email = $con->getEmail();
            $pass = $con->getPassword();
            $sql = "SELECT PK_ID_Administrador, Ad_Nombre, Ad_Apellido, Ad_Email, Ad_Password FROM tbl_administrador WHERE Ad_Email = '$email' AND Ad_Password = '$pass'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();

            if($res == TRUE){
                session_start();
                $_SESSION['email'] = $email; 
                header("Location:../vista/html/Dashboard.php");
            
            }else {
                echo "<script>alert('Los datos han sido actualizados!'); window.location = '../index.php'</script>";
            }

        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    
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

    public function saveMarcas(Marca $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $nombre = $con->getNombre();
            $sql = "INSERT INTO tbl_marca (Ma_nombre) VALUES ('$nombre')";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res == TRUE){
                header("Location:../vista/html/Mod_añadir_marca.php");
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function updateMarcas(Marca $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $nombre = $con->getNombre();
            $id = $con->getId();
            $sql = "UPDATE tbl_marca SET Ma_nombre = '$nombre' WHERE PK_ID_Marca = '$id'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res == TRUE){
                header("Location:../vista/html/Mod_marca.php");
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function deleteMarcas(Marca $con){
        try{
            $conexion  = new ConexionDB();
            $conexion->abrir();
            $id = $con->getNombre();
            $sql = "DELETE FROM tbl_marca WHERE PK_ID_Marca = '$id'";
            $conexion->consulta($sql);
            $res=$conexion->obtenerFilasAfectadas();
            print($res);
            $conexion->cerrar();
            if($res == TRUE){
                header("Location:../vista/html/Mod_marca.php");
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

}