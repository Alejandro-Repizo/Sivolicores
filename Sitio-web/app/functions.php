<?php 

# Funcion para conectarnos a la base de datos.
# Return: la conexion o false si hubo un problema.
function conexion($bd_config) {
    try {
        $conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['dbname'], $bd_config['username'], $bd_config['password']);
        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

# Funcion para limpiar y convertir datos como espacios en blanco, barras y caracteres especiales en entidades HTML.
# Return: los datos limpios y convertidos en entidades HTML.
function limpiarDatos($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}


// header - footer
function obtener_categoria($conexion) {
    $consulta = $conexion->prepare("SELECT PK_ID_Categoria, Cat_Nombre, Cat_Imagen FROM  tbl_categoria");
    $consulta->execute();
    return $consulta->fetchAll();
}

function obtener_subcategoria($id, $conexion) {
    $consulta = $conexion->prepare("SELECT PK_ID_SubCategoria, SCat_Nombre FROM tbl_catxsub JOIN tbl_subcategoria 
    ON tbl_catxsub.FK_ID_SubCategoria = tbl_subcategoria.PK_ID_SubCategoria WHERE FK_ID_Categoria = $id");
    $consulta->execute();
    return $consulta->fetchAll();
}


// Productos

function id_producto($id) {
    return (int)limpiarDatos($id);
}

function obtener_producto($id, $conexion) {
    $sentencia = $conexion->prepare("SELECT  * FROM tbl_producto WHERE FK_ID_Categoria = $id");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function obtener_producto_sub( $id, $conexion) {
    $sentencia = $conexion->prepare("SELECT * FROM tbl_producto WHERE FK_ID_SubCategoria = $id");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function validar_subCategoria($id, $conexion) {
    $sentencia = $conexion->prepare("SELECT PK_ID_SubCategoria FROM tbl_SubCategoria WHERE PK_ID_SubCategoria = '$id'");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    return ($resultado) ? true : false;
}

function obtener_id_cat($id, $conexion) {
    $sentencia = $conexion->prepare("SELECT FK_ID_Categoria FROM tbl_catxsub WHERE FK_ID_SubCategoria = '$id'");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function obtener_nombre_banner($id, $conexion) {
    $sentencia = $conexion->prepare("SELECT Cat_Nombre FROM tbl_categoria WHERE PK_ID_Categoria = '$id'");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function obtener_producto_por_id($id, $conexion) {
    $sentencia = $conexion->prepare("SELECT PK_ID_Producto, Pt_codigo, Pt_Nombre, Pt_Precio, Pt_Imagen, 
    Pt_Presentacion, Pt_Grados_alchol, Pt_Pais, Pt_Color, Pt_Stock, FK_ID_Categoria, Cat_Nombre, FK_ID_SubCategoria, Ma_Nombre FROM tbl_producto 
    JOIN tbl_categoria ON tbl_producto.FK_ID_Categoria = tbl_categoria.PK_ID_Categoria 
    JOIN tbl_marca ON tbl_producto.FK_ID_Marca = tbl_marca.PK_ID_Marca
    WHERE PK_ID_Producto = '$id' LIMIT 1");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    return ($resultado) ? $resultado : false;
}




// Receta coctel

# Funcion para obtener un post por ID
# Return: El post, o false si no se encontro ningun post con ese ID.
function obtener_receta($coctel_por_pagina, $conexion) {
    $inicio = (pagina_actual() > 1) ? pagina_actual() * $coctel_por_pagina - $coctel_por_pagina : 0;
    // le pedimos que nos cuente cuantas filas tenemos.
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_receta_coctel LIMIT $inicio, $coctel_por_pagina");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

# Funcion para obtener la pagina actual
# Return: El numero de la pagina si esta seteado, sino entonces retorna 1.
function pagina_actual() {
    return isset($_GET['p']) ? (int)$_GET['p'] : 1;
}


# Funcion para calcular el numero de paginas que tendra la paginacion.
# Return: El numero de paginas
function numero_paginas($coctel_por_pagina, $conexion) {
    // Calculamos el numero de filas / articulos que nos devuelve nuestra consulta
    $total_recetas = $conexion->prepare("SELECT FOUND_ROWS() as total");
    $total_recetas->execute();
    $total_recetas = $total_recetas->fetch()['total'];

    $numero_paginas = ceil($total_recetas / $coctel_por_pagina);
    return $numero_paginas;
}

function numero_paginas_p($coctel_por_pagina, $conexion) {
    // Calculamos el numero de filas / articulos que nos devuelve nuestra consulta
    $total_recetas = $conexion->prepare("SELECT COUNT(PK_ID_Producto) from tbl_producto");
    $total_recetas->execute();
    $total_recetas = $total_recetas->fetch()[0];

    $numero_paginas = ceil($total_recetas / $coctel_por_pagina);
    return $numero_paginas;
}


# Function para obtener el id de los productos / recetas
function id_receta($id) {
    return (int)limpiarDatos($id);
}

# Funcion para obtener un post por ID
# Return: El post, o false si no se encontro ningun post con ese ID.
function obtener_receta_por_id($conexion, $id) {
    $resultado = $conexion->query("SELECT * FROM tbl_receta_coctel WHERE PK_ID_Receta = $id LIMIT 1");
    $resultado = $resultado->fetchAll();
    return ($resultado) ? $resultado : false;
}

# Funcion para traducir la fecha de formato timestamp a español.
# Return: La fecha en español
function fecha($fecha) {
    $timestamp = strtotime($fecha);
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $dia = date('d', $timestamp);

    // -1 porque los meses en la funcion date empiezan desde el 1
	$mes = date('m', $timestamp) - 1;
	$year = date('Y', $timestamp);
    
    $fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
	return $fecha;
}


// Banners

function obtener_banner_por_nombre($nombre, $conexion) {
    $sentencia = $conexion->prepare("SELECT B_Imagen FROM tbl_banner WHERE B_Nombre = '$nombre'");
    $sentencia->execute();
    return $sentencia->fetchAll();
}