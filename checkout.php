<?php  ?>
<?php
	
	session_start();
	if(isset($_SESSION['id'])){
	include('function.php');
	$id = $_SESSION['id'];
	$user = retreive_user_by_id($id);
	$addresss = retreive_address($id);
	$cart = retreive_cart();
 	foreach($cart as $c){
		if($c['userid']==$_SESSION['id'] && $c['status'] == 1){

		}
	}
	

	if(isset($_POST['submit'])){
				$prov=$_POST['city'];
				$muni=$_POST['municipality'];
				$street=$_POST['street'];
				$barangay=$_POST['barangay'];
				$landmark=' ('.$_POST['landmark'].')';
				$userid=$_SESSION['id'];
				add_address($userid, $muni, $barangay, $street, $prov, $landmark);
				?> <script> window.location.href="checkout.php";  </script> <?php
			}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<title>EMED - Checkout</title>
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include('style.php'); ?>
		<style>

		</style>
	</head>
    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>				
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/s.jpg" alt="New products" >
				<h4><span>Check Out</span></h4>
			</section>	
			<section class="main-content">

				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Checkout Options</a>
								</div>
								<div id="collapseOne" class="">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span6" style="border-right:solid 1px;padding-right: 20px;border-color:green" >
												<h4>Billing and  Delivery Information</h4>
												<div class="kontain">

													<div style="padding-left:5%;background-color:#EEEEEE;color:green;">
													 <?php echo $user['ufname'].' '.$user['umi'].' '.$user['ulname']; ?><br>
													  email : <?php echo $user['umail']; ?><br>
													  contact no : <?php echo $user['phone'];  ?><br>
													</div>
													<h5>Choose Address :</h5>
													  <form method="post">
													  <input type="radio" name="address" value="<?php echo $user['address'] ?>" required checked ><?php echo $user['address'] ?><br>
													  
													  <?php 
													  	foreach($addresss as $add){
													  		?><input type="radio" name="address" value="<?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?>" required ><?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?><br>
													  	<?php }
													  ?>
													   <br><button type="button" id="myBtn" class="btn">Add another address</button><br>
													
													<input type=submit name=submit1 class="btn btn-inverse pull-right" value="Continue" >
													</form>
												  <div class="btn-holder"><br>
												    
												    <div id="myModal" class="modal">

													  <!-- Modal content -->
													  <div class="modal-content">
													    <div class="modal-header">
													      <span class="close">&times;</span>
													      <h2>Modal Header</h2>
													    </div>
													    <div class="modal-body">
													    <form method="post">	
													      <label><h6>Address</h6></label>
										                    <input type="text" style="height:28px;" name="city" placeholder="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" required=" ">
										                    <input type="text" style="height:28px;" name="municipality" placeholder="municipality" value="<?php if(isset($_POST['municipality'])){ echo $_POST['municipality']; } ?>" required=" "><br>
										                    <input type="text" style="height:28px;" name="street" placeholder="street" value="<?php if(isset($_POST['street'])){ echo $_POST['street']; } ?>" required=" ">
										                    <input type="text" style="height:28px;" name="barangay" placeholder="barangay" value="<?php if(isset($_POST['barangay'])){ echo $_POST['barangay']; } ?>" required=" "><br>
										                    <input type="text" style="height:28px;" name="landmark" placeholder="landmark" value="<?php if(isset($_POST['landmark'])){ echo $_POST['landmark']; } ?>" required=" "><br>
										                    <input type="submit" name="submit" value="Submit">
										                </form>
													    </div>
													    <div class="modal-footer">
													      <h3>Modal Footer</h3>
													    </div>
													  </div>

													</div>
												  </div>
												
												</div>

											</div>
											<div class="span6" style="" >
												<h4>Order Summary </h4>
												<table class="table table-striped" >
							<thead>
								<tr>
									
								 	<th></th>
									<th>Product Name</th>
									<th>Quantity</th>
							 
									<th>Total</th>
									<th></th>
				
								</tr>
							</thead>
							<tbody>
								<?php 
									$itemno = 0;
									$totalprice = 0;
									foreach($cart as $r){
									$total = 0;
									if($r['userid'] == $_SESSION['id'] && $r['status'] == 1){ 
										$item = retreive_item_by_id($r['itemid']);
										$itemno=$itemno + 1;
									?>
								<tr>
									<form method="post">
									
									 <td style="background-color: white;border:solid 0px;"></td>
									<td style="padding-top:2.5%;"><?php echo $item['generics'].' ('.$item['brand'].')'; ?></td>
									<td style="padding-top:;" ><input disabled type="text"   placeholder="1" name="update<?php echo $r['cartid'] ?>" value="<?php echo $r['qtyordered']; ?>" class="input-mini" onkeyup="toggleButton(this,'bttnsubmit<?php echo $r['cartid']; ?>');">&nbsp;&nbsp;</td>
								  
									<td style="padding-top:2%;" ><b>
										<?php 
										 	$price = $item['price'] + $item['markup'];
										 	$qtyordered = $r['qtyordered'];
										 	$total = $price * $qtyordered;
										 	echo 'P'.$total;
										 	$totalprice = $total + $totalprice;
										?>
									</b> 
								 
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



									} 
									if($totalprice >= 1000){
										$totaltotal = $totalprice;
										$fee = "Free";
									} else {
										$totaltotal = $totalprice + 100;
										$fee = "100.00";
									}
									?>	
									<tr style="height: 20px;border:solid 2px"></tr>
						 	  <tr style="border:solid 0px"><td  colspan="3"><h6>Subtotal</h6></td><td >P <?php echo number_format((float)$totalprice, 2, '.', '')  ?></td></tr>
						 	  <tr style="border:solid 0px"><td style="border:solid 0px; color:green" colspan="3"><h6>Delivery Fee</h6></td><td style="border:solid 0px">P <?php echo $fee; ?></td></tr>
						 	  	<tr><td colspan="3"><h5>TOTAL</h5></td><td style="color:red"><b>P <?php echo  number_format((float)$totaltotal, 2, '.', '') ?></b></td></tr>
							</tbody>
						</table>
												
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Confirm Order</a>
								</div>
								<div id="collapseThree" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="control-group">
												<label for="textarea" class="control-label">Comments</label>
												<div class="controls">
													<textarea rows="3" id="textarea" class="span12"></textarea>
												</div>
											</div>									
											

											<?php
												
											?>
										</div>
									</div>
								</div>
							</div>



						</div>				
					</div>
				</div>
			</section>			
			<?php include('footer.php'); ?>
		 
		</div>
			
		<?php

			if(isset($_POST['submit1'])){
				$address = $_POST['address']
				?>
					<script> window.location.href="paypalpayment/checkouts.php?address='<?php echo $address; ?>'" </script>
				<?php
			}




		?>

		<script src="themes/js/common.js"></script>
		<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
		    modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		    modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}
		</script>


    </body>
</html> <?php } else {
 	?><script>window.location.href="logout.php"</script><?php
 } ?>