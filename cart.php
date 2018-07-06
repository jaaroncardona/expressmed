<?php 
	session_start();
	include('function.php');
	$row = retreive_cart();
    
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<title>EMED - Cart</title>
		<?php include('style.php'); ?>
	</head>



    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>			
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/s.jpg" alt="New products" >
				<h4><span>Shopping Cart</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div id="mydiv" class="span9">					
						<h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
						<table class="table table-striped" >
							<thead>
								<tr>
									
									<th>Image</th>
									<th>Product Name</th>
									<th>Quantity</th>
								 
									<th>Unit Price</th>
									<th>Total</th>
				
								</tr>
							</thead>
							<tbody>
								<?php 
								if(isset($_SESSION['id'])){
									$itemno = 0;
									$totalprice = 0;
									foreach($row as $r){
									$total = 0;
									if($r['userid'] == $_SESSION['id'] && $r['status'] == 1){ 
										$item = retreive_item_by_id($r['itemid']);
										$itemno=$itemno + 1;
									?>
								<tr>
									<form method="post">
									
									<td><a href="product_detail.php?id=<?php echo $item['itemid'] ?>" ><img alt="" style="width:80px!important;height:80px!important;" src="<?php echo $item['picture'] ?>" style="width:100px"></a></td>
									<td style="padding-top:4%;" ><?php echo $item['generics'].' ('.$item['brand'].')'; ?></td>
									<td style="padding-top:2.5%;" ><input type="text" style="margin-top:5%" placeholder="1" name="update<?php echo $r['cartid'] ?>" value="<?php echo $r['qtyordered']; ?>" class="input-mini" onkeyup="toggleButton(this,'bttnsubmit<?php echo $r['cartid']; ?>');">&nbsp;&nbsp;<input type="submit" style ="border-radius: 20px;" onclick="return alert('Item quantity updated')" id="bttnsubmit<?php echo $r['cartid'] ?>" name="update" value="↻" disabled="disabled"></td>
									<td style="padding-top:4%;"><b>P</b> <?php echo $item['price'] + $item['markup']; ?></td>
									<td style="padding-top:4%;" ><b>
										<?php 
										 	$price = $item['price'] + $item['markup'];
										 	$qtyordered = $r['qtyordered'];
										 	$total = $price * $qtyordered;
										 	echo 'P '.$total;
										 	$totalprice = $total + $totalprice;
										?>
									</b></td>
									<td style="padding-top:3.8%;"><a onclick="return confirm('Do You Sure')" href="deletecart.php?id=<?php echo $r['cartid']; ?>" ><img style="width:20px;" src=themes/images/delete.png></a>
								 
									</td>
									</form>
								</tr>	
								<?php
									$string = 'update'.$r['cartid'];
							 
									if(isset($_POST[$string])){

										$cartid = $r['cartid'];
										$qtyordered = $_POST[$string];
										update_cart($cartid, $qtyordered);
										?>
											<script>
												window.location.href="cart.php"
											</script>
										<?php

									}

									}



									}}
									 ?>	
						 	  
							</tbody>
						</table>
						<?php if($itemno == 0){
							?><div style="padding:50px;text-align:center;margin: 0px auto 0px auto" class="alert alert-info">
								  <strong>Info! </strong>You have no Items in your cart.
								</div><?php
						} ?>
						<hr>
						<p class="cart-total right">
							<strong>Sub-Total</strong>:	<?php echo 'P'.$totalprice; ?><br>
							<strong>Delivery Fee</strong>: P100<br>
							<strong>Total</strong>: <?php echo $totalprice + 100; ?><br>
						</p>
						<hr/>
						<p class="buttons center">				
							
							<a href="products.php?cat=1"><button class="btn" type="button">Continue</button>
							<?php if($itemno==0){ ?>
							<a href="checkout.php"><button class="btn btn-inverse" type="submit" id="checkout" disabled>Checkout</button></a>
							<?php } else {
								?><a href="checkout.php"><button class="btn btn-inverse" type="submit" id="checkout">Checkout</button></a><?php
							} ?>
						</p>					
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list below">
								<strong>Sub-Total</strong>:	<?php echo 'P'.$totalprice; ?><br>
						 		<strong>Delivery Fee</strong>: P100<br>
								<strong>Total</strong>: <?php echo $totalprice + 100; ?><br>
							</ul>
							<br/>
							<ul class="nav nav-list below">
								<li class="nav-header">Prescription</li>
								<li><a href="./products.php?cat=Cough & Cold">Coughs & Colds</a></li>
								<li><a href="./products.php?cat=Ear">Ear&Nose&Mouth/Throath</a></li>
									<li><a href="./products.php?cat=Fever">Fever & Pain releif</a></li>	
									<li><a href="./products.php?cat=Stomach">Stomach & Intestinal</a></li>	
									<li><a href="./products.php?cat=Other">Other</a></li>
							</ul>
							<ul class="nav nav-list below"><br>
								<li class="nav-header">Prescription</li>
							<li><a href="./products.php?cat=Allergy">Allergy & Immune System</a></li>
									<li><a href="./products.php?cat=Anti">Anti-infective</a></li>
									<li><a href="./products.php?cat=Cardio">Cardio/Herma System</a></li>
									<li><a href="./products.php?cat=Nervous">Nervous System</a></li>		
									<li><a href="./products.php?cat=Other">Other</a></li>	
								</ul>
						</div>
					 
				</div>
			</section>			
			<?php include('footer.php'); ?>
	 
		</div>
		<script src="themes/js/common.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.php";
				})
			});
			function toggleButton(ref,bttnID){
			  document.getElementById(bttnID).removeAttribute("disabled");
			}
		</script>		
    </body>
</html>
 
