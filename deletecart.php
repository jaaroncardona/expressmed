<?php

	include("function.php");
	$id = $_GET['id'];
	delete_cart($id);
	header('location:cart.php');

?>