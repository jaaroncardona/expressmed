<?php
	
	session_start();
	include('function.php');
	$id = $_SESSION['id'];
	$user = retreive_user_by_id($id);
	$address = retreive_address($id);
	$cart = retreive_cart();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('style.php'); ?>
		<style>

		</style>
	</head>
    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>				
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
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
											<div class="span6">
												<h4>Your Personal Details</h4>
												<div class="control-group">
													<label class="control-label">First Name</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['ufname'] ?>" class="input-xlarge" disabled="disabled" >
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Last Name</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['ulname'] ?>" class="input-xlarge" disabled="disabled" >
													</div>
												</div>					  
												<div class="control-group">
													<label class="control-label">Email Address</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['umail'] ?>" class="input-xlarge" disabled="disabled" >
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Telephone</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['phone'] ?>" class="input-xlarge" disabled="disabled" >
													</div>
												</div>
												
											</div>
											<div class="span6" >
												<h4>Billing and  Delivery Address</h4>
												<div class="kontain">
													  Choose : <br><button type="button" id="myBtn">Add Address</button>
													  <form method="post">
													  <input type="radio" name="address" value="<?php echo $user['address'] ?>" required ><?php echo $user['address'] ?><br>
													  <?php 
													  	foreach($address as $add){
													  		?><input type="radio" name="address" value="<?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?>" required ><?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?><br>
													  	<?php }
													  ?>
													
													<input type=submit name=submit1 class="btn btn-inverse pull-right" value="Confirm order" >
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
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
			
		<?php

			if(isset($_POST['submit1'])){
				$userid = $_SESSION['id'];
				orders($userid);
				$orid=retreive_order_id();
				foreach($orid as $o){
					$orderid = $o['orderid'];
				}
				echo 'samplesadasdasd';
			
				foreach($cart as $c){
					if($c['userid']==$_SESSION['id'] && $c['status'] == 1){
						echo 'awdawdwadawdawdawdawdawdwadadwad';
						$cartid = $c['cartid'];
						$address = $_POST['address'];
						echo $orderid;
						$orderdate = date("Y-m-d H:i");
						check($orderid, $cartid);

					}
					$status = 2;
					$cartid = $c['cartid'];
					$orderdate = date("Y-m-d H:i")
					$userid=$_SESSION['id'];
					update_cart_item_status($userid, $cartid, $status, $date);
					
				}
			}


			if(isset($_POST['submit'])){
				$prov=$_POST['city'];
				$muni=$_POST['municipality'];
				$street=$_POST['street'];
				$barangay=$_POST['barangay'];
				$landmark=$_POST['landmark'];
				$userid=$_SESSION['id'];
				add_address($userid, $muni, $street, $barangay, $prov, $landmark);
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
</html>