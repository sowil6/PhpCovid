<?php 
session_start();
 define("RUTA_BASE", dirname(realpath(__FILE__))."/");
//echo "en index.php " .RUTA_BASE;
include "libreria/core.php";
//echo "en index la ruta de model esss" .RUTA_MODELO."manager";
/*	 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login');
	}
if (isset($_GET['logout'])) {
		
		session_destroy();
		unset($_SESSION['username']);
		header("location: /");
	}/**/
 
?>
