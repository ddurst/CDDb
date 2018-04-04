<?php  
	session_start();
	print_r($_SESSION); //Testing
	$currentArgID = intval($_GET["arg"]); 	
	session_destroy();
	header('location: login.php?arg='.$currentArgID);
?>