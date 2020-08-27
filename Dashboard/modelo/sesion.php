<?php 
	
	require_once  'ConexionDB.php';
	// Iniciar sesión
	session_start();

	if (!isset($_SESSION['email'])) {
		header("/mvcproyect/Dashboard/");
	}
 ?>
