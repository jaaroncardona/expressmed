<?php

	include("function.php");
	$cartid = $_GET['cartid'];
	$qtyordered = $_GET['qtyordered'];
	update_cart($cartid, $qtyordered);
 

?>