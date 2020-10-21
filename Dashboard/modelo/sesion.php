<?php 

	require_once 'ConexionBD.php';
	// Iniciar sesión
	session_start();

	if (!isset($_SESSION['email'])) {
		header("Location: /mvcproyect/Dashboard/");
	}
 ?>
