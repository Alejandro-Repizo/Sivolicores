<?php 
require_once "../../modelo/ConexionDB.php";

if(isset($_GET['PK_ID_Producto'])) {
    $PK_ID_Producto = $_GET['PK_ID_Producto'];
    $sql = "DELETE FROM tbl_ptoducto WHERE PK_ID_Producto = $PK_ID_Producto";
    $result=mysqli_query($conn,$sql);

    $alerta="Producto Eliminado";
    
    header ("Location: Mod_productos.php");
}

?>