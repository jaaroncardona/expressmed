<?php 
	session_start();
	include('function.php');

    
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
				<h4><span>Past Orders</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div id="mydiv" class="span9">					
						<h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
                        <?php $userid = $_SESSION['id'];
                            $track = track_order_by_id($userid);
                            
                            foreach($track as $t){  ?>
						<table class="table table-striped" >
							<thead>
								<tr>
                                <?php $tracks = track_orderdate_by_ids($t['orderid']);
                                    foreach($tracks as $ts){
                                        $totalprice=0;
                                        if($t['orderid'] = $ts['orderid'])
                                        echo $ts['orderdate'];
                                } ?>	
									<th>Image</th>
									<th>Product Name</th>
									<th>Quantity</th>
								 
									<th>Unit Price</th>
									<th>Total</th>
				
								</tr>
							</thead>
							<tbody>
								<?php 
									$tracks = track_order_by_ids($t['orderid']);
                              
                                    foreach($tracks as $ts){ 
                                        if($t['orderid'] = $ts['orderid'])
                                        $cart = retreive_cart_by_id($ts['cartid']);
				                        $item = retreive_item_by_id($cart['itemid']); ?>
                                        
								<tr>
									<form method="post">
									
									<td><a href="product_detail.php?id=<?php echo $item['itemid'] ?>" ><img alt="" style="width:80px!important;height:80px!important;" src="<?php echo $item['picture'] ?>" style="width:100px"></a></td>
									<td style="padding-top:4%;" ><?php echo $item['generics'].' ('.$item['brand'].')'; ?></td>
									<td style="padding-top:4%;" ><?php echo $cart['qtyordered'] ?> 
									<td style="padding-top:4%;"><?php echo $item['price']; ?></td>
									<td style="padding-top:4%;" ><b>
                                        <?php 
                                        $price = $item['price'];
                                        $qtyordered = $cart['qtyordered'];
                                        $total = $price * $qtyordered;
                                        echo 'P'.$total;
                                        $totalprice = $total + $totalprice;
										 	}
										?>
									</form>
								</tr>	
                                <tr><td colspan=5 style="text-align:right;background-color:rgba(80,255,9,.5  )">
                                    <?php
                                    	 
                                    		$totalprice = $totalprice + 100;
                                    	
                                     echo '<strong>P '.$totsalprice.'</strong>' ; ?>
                                </td></tr>
								
						 	  
							</tbody>
						</table>
                        <?php
					 
									}
									 ?>	
						
						<hr>
						<p class="cart-total right">
							<strong>Sub-Total</strong>:	<?php echo 'P'.$totalprice; ?><br>
							<strong>Delivery Fee</strong>: P100<br>
							<strong>Total</strong>: <?php echo $totalprice + 100; ?><br>
						</p>
						<hr/>
						<p class="buttons center">				
							<button class="btn" type="button">Update</button>
							<a href="javascript:history.go(-1)"><button class="btn" type="button">Continue</button>
							<a href="checkout.php"><button class="btn btn-inverse" type="submit" id="checkout">Checkout</button></a>
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
 
