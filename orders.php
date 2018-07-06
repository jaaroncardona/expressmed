<html>
<body>

<?php 
	session_start();
	include('function.php');

$orderid = $_GET['id'];
$orderitem = retreive_orders();

foreach($orderitem as $oi){
	if($oi['orderid'] == $orderid){
	echo $oi['cartid'];
	$cart = retreive_cart_by_id($oi['cartid']);
	$item = retreive_item_by_id($cart['itemid']);

	?><img src="<?php echo $cart['picture']; ?>"><img src="<?php echo $item['picture']; ?>"><?php
	echo $item['itemname'];
}
}	

?>




</body>
</html>