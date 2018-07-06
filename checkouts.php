<?php if(isset($_SESSION['id'])){ ?>
<?php
	
	use PayPal\Rest\ApiContext;
	use PayPal\Auth\OAuthTokenCredentials;

	session_start();
	include('function.php');
	$addresss = $_GET['address'];
	$id = $_SESSION['id'];
	$user = retreive_user_by_id($id);
	$address = retreive_address($id);
	$cart = retreive_cart();
	require _DIR_ . 'paypalpayment/vendor/autoload.php';

	$api = new ApiContext(
		new OAuthTokenCredentials(
			'AXLNB00orx0idTNH_7W-NKdKbfoQJ7B56ipfbk8IbYpH7ygyPKgvz4Da4T7WgYRe-yN5x1lXM7ILsu8v',
			'EAxTs1E_KsJuu6yRmVCWxnrg0P3iEMS02jTreggq28kyp4Fzp-lpAl-KOTagxAtUyJ3FjzEYfLsRuR0v'
		)
	);
 
?>

 