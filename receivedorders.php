<?php include('style.php'); ?>

<html>
<body>

<?php	

	include('function.php');
 
		$order = retreive_order();

	foreach($order as $or){
		echo $or['orderid'];
		echo $or['userid'];
		$user = retreive_user_by_id($or['userid']);
		echo $user['ufname'];
		echo "<a href='orders.php?id=".$or['orderid']."'><input type='submit'></a>";
		echo '<br><br>';

	}


?>

</body>
</html>	