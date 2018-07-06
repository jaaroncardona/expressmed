<?php include('function.php'); 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('style.php'); ?>
	</head>
    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>
			<img class="pageBanner" src="themes/images/s.jpg" alt="New products" >		
			<section class="header_text sub">

				<h4><span>Login or Regsiter</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5" style="width:100%">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
								<select name="itemcategory">
									<option value="1">Prescription</option>
									<option value="2">Over The Counter</option>
								</select>
								<input type="text" name="itemsubcategory" placeholder="itemsubcategory" required>
								<input type="text" name="itemname" placeholder="item name" required>
								<input type="text" name="generics" placeholder="generics name" required>
								<input type="text" name="brand" placeholder="brand name" required>
								<input type="number" name="price" placeholder="price" required>
								<input type="text" name="measurement" placeholder="measurement" required>
								<input type="text" name="dosage" placeholder="dosage" required>
								<input type="number" name="qty" placeholder="quantity added" required>
								<input name="file" type="file" id="imagee" />
						        <input type="submit" value='Upload' name="submit" onclick="return validateForm()"/>

							</form>
	
					</div>
				</div>
			</section>			
			<?php include('footer.php'); ?>
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>		
    </body>
</html>