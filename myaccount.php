<?php
	
	session_start();
	if(isset($_SESSION['id'])){
	include('function.php');
	$id = $_SESSION['id'];
	$user = retreive_user_by_id($id);
	$address = retreive_address($id);
	$cart = retreive_cart();
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
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">View Account</a>
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
													<label class="control-label">Middle Initial</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['umi'] ?>" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" disabled >
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
												<h4>Address</h4>
												<div class="kontain">
													  <form method="post">
													  <div style="border:solid 1px;padding:20px;border-color:green">
													  <?php echo $user['address'] ?><br>
													  </div><?php 
													  	foreach($address as $add){
													  		?><input type="radio" name="address" value="<?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?>" required ><?php echo $add['street'].' '.$add['barangay'].' '.$add['muni'].' '.$add['prov'].' '.$add['landmark']; ?><br>
													  	<?php }
													  ?>

													
												
													</form>
												  <div class="btn-holder"><br>
												  </div>
												
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Update Account</a>
								</div>
								<div id="collapseThree" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<form method="post">
												<div class="control-group">
													<label class="control-label">First Name</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['ufname'] ?>" name="ufname" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" >
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Middle Initial</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['umi'] ?>" name="umi" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" >
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Last Name</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['ulname'] ?>" name="ulname" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" >
													</div>
												</div>					  
												<div class="control-group">
													<label class="control-label">Email Address</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['umail'] ?>" name="umail" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" >
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Telephone</label>
													<div class="controls">
														<input type="text" placeholder="" value="<?php echo $user['phone'] ?>" name="phone" class="input-xlarge" onkeyup="toggleButton(this,'bttnsubmit');" >
													</div>
												</div>
												<div class="control-group">
										 
													<div class="controls">
														<input type="submit" style ="border-radius: 20px;" id="bttnsubmit" name="update" value="Update" disabled="disabled" >
													</div>
												</div>
											</form>
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

			if(isset($_POST['update'])){
				$ufname = $_POST['ufname'];
			    $ulname = $_POST['ulname'];
			    $umi = $_POST['umi'];
			    $umail = $_POST['umail'];
			    $phone = $_POST['phone'];
				$userid= $_SESSION['id'];
				update_user_by_id($userid, $ufname, $umi, $ulname, $umail, $phone);
			}


			if(isset($_POST['submit'])){
				$prov=$_POST['city'];
				$muni=$_POST['municipality'];
				$street=$_POST['street'];
				$barangay=$_POST['barangay'];
				$landmark=$_POST['landmark'];
				$userid=$_SESSION['id'];
				add_address($userid, $muni, $street, $barangay, $prov, $landmark);
				?> <script> window.location.href="checkout.php";  </script> <?php
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
</html> <?php } else {
 	?><script>window.location.href="logout.php"</script><?php
 } ?>