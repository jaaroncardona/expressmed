<?php 
	session_start();
	if(isset($_SESSION['id'])){
	include('function.php');
	$cart = retreive_cart();
 	foreach($cart as $c){
		if($c['userid']==$_SESSION['id'] && $c['status'] == 1){

		}
	}
if(isset($_SESSION['order'])){
	$orderid = $_SESSION['order'];
	foreach($cart as $c){
					if($c['userid']==$_SESSION['id'] && $c['status'] == 1){
						$item = retreive_item_by_id($c['itemid']);
						$qty = $item['qty'] - $c['qtyordered'];
						$cartid = $c['cartid'];
						update_item_qty($item['itemid'], $qty);
						$address = $_SESSION['address'];
						$userid=$_SESSION['id'];
						$orderdate = date("Y-m-d H:i");
						$status = 5;
						check($orderid, $cartid, $orderdate, $userid, $status);

					}
					$status = 2;
					$cartid = $c['cartid'];
					$userid=$_SESSION['id'];
					update_cart_item_status($userid, $cartid, $status);
					
				}
	update_payment($orderid);
	$_SESSION['order']=null;
	$_SESSION['address']=null;
	}
    
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
						<h4 class="title"><span class="text"><strong>Your</strong> PAST ORDERS</span></h4>
                        <?php $userid = $_SESSION['id'];
                            $track = track_order_by_id($userid);
                            $count = 0;
                            foreach($track as $t){ 
                            	$count++;

                             ?>
						<table class="table table-striped" >
							<thead>
								<tr>
                                <?php $tracks = track_orderdate_by_ids($t['orderid']);
                                    foreach($tracks as $ts){
                                    	echo '<hr><b>Order # : &nbsp;&nbsp;</b>'.$t['orderid'].'<br>';
                                        $totalprice=0;
                                        if($t['orderid'] = $ts['orderid'])
                                        echo date("F d, Y",strtotime($ts['orderdate']));
                                } ?>	

									<th>Image</th>
									<th>Product Name</th>
									<th>Quantity</th>
								 
									<th>Unit Price</th>
									<th>Total</th>	
									<th>Status</th>
				
								</tr>
							</thead>
							<tbody>
								<?php 
									$tracks = track_order_by_ids($t['orderid']);
                              		$orders = retreive_order();

                                    foreach($tracks as $ts){ 
                                        if($t['orderid'] = $ts['orderid'])
                                        $cart = retreive_cart_by_id($ts['cartid']);
				                        $item = retreive_item_by_id($cart['itemid']); ?>
                                        
								<tr>
									<form method="post">
									<?php if($item['generics'] != null){ ?>
									<td><a href="product_detail.php?id=<?php echo $item['itemid'] ?>" ><img alt="" style="width:80px!important;height:80px!important;" src="<?php echo $item['picture'] ?>" style="width:100px"></a></td>

									<td style="padding-top:4%;" ><?php echo $item['generics'].' ('.$item['brand'].')'; ?></td>
									<td style="padding-top:4%;" ><?php echo $cart['qtyordered'] ?> 
									<td style="padding-top:4%;"><?php echo $item['price'] + $item['markup']; ?></td>
									<td style="padding-top:4%;" ><b>
                                        <?php 
                                        $price = $item['price'] + $item['markup'];
                                        $qtyordered = $cart['qtyordered'];
                                        $total = $price * $qtyordered;
                                        echo 'P'.number_format((float)$total, 2, '.', '');;
										$totalprice = $total + $totalprice;
										
		                            	if($ts['delivered']==1){
		                            		$status = "delivered";
		                            	} else if($ts['delivered']==2){
		                            		$status = "cancelled";
		                            	} else if($ts['status'] == 'pending'){
		                            		$status = "pending";
		                            	} else {
		                            		$status ='shipping';
		                            	}
		                            	if($ts['status'] == 'packaging'){
		                            		$status = "packaging";
		                            	}


		                            	 										echo "<td style='padding-top:4%'>".$status."</td>";
										 	}
										 }
										?>
										
									</form>
								</tr>	
                                <tr><td style="text-align:right;background-color:rgba(80,255,9,.5  )""><b>Total : </b></td><td colspan=5 style="text-align:right;background-color:rgba(80,255,9,.5  )">

                                    <?php 
                                    if($totalprice <= 999){
                                    		$totalprice = $totalprice + 100;
                                    		echo '( delivery fee included ) '.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.' ' ;
                                    	}
                                    echo '<strong>P '.$totalprice.'</strong>' ; ?>
                                </td></tr>
								
						 	  
							</tbody>
						</table>
                        <?php

									}
									if($count== 0){

									?><div style="padding:50px;" class="alert alert-info">
										  <center><strong>Info!</strong> You're order history is  empty.</center>
										</div><?php
								}
									 ?>	
						
						<hr>
			 
						<hr/>
									
					</div>
					<div class="span3 col">
						<div class="block">	
							 
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
 
 <?php } else {
 	?><script>window.location.href="logout.php"</script><?php
 } ?>