<?php  ?>
<?php 
	session_start();
	if(isset($_SESSION['id'])){
	include('function.php');
	if(isset($_SESSION['id'])){
	$user = retreive_user_by_id($_SESSION['id']);
}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('style.php'); ?>
	</head>
    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>						
			<!--<section class="google_map">
				<iframe ></iframe>
			</section> -->
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/s.jpg" alt="New products" >
				<h4><span>Contact Us</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">				
					<div class="span5">
						<div>
							<h5>CONTACT INFORMATION</h5>
							<p><strong>Phone:</strong>&nbsp;(+63) 906 969 2609<br>
							<strong>Fax:</strong>&nbsp;+04 (123) 456-7890<br>
							<strong>Email:</strong>&nbsp;<a href="#">jaaroncardona@gmail.com</a>								
							</p>
							<br/>
							<h5>ADDITIONAL INFORMATION</h5>
							<p><strong>Phone:</strong>&nbsp;(+63) 935 101 2573<br>
							<strong>Fax:</strong>&nbsp;+04 (112) 233-4455<br>
							<strong>Email:</strong>&nbsp;<a href="#">jaaroncardona@yahoo.com</a>					
							</p>
						</div>
					</div>
					<div class="span7">
						<p>Please provide the boxes below with your name and contact information along with your <a href="">feedbacks</a>.</p>
						<form method="post">
							<fieldset>
								<div class="clearfix">
									<label for="name"><span>Name:</span></label>
									<div class="input">
										<?php if(isset($_SESSION['id'])){ ?>
										<input tabindex="1" size="18" id="name" name="name" type="text" value="<?php echo $user['ufname'].' '.$user['umi'].'. '.$user['ulname'] ?>" class="input-xlarge" placeholder="Name" >
										<?php } else { ?>
										<input tabindex="1" size="18" id="name" name="name" type="text" value="" class="input-xlarge" placeholder="Name" >
										<?php } ?>
									</div>
								</div>
								
								<div class="clearfix">
									<label for="email"><span>Email:</span></label>
									<div class="input">
										<?php if(isset($_SESSION['id'])){ ?>
										<input tabindex="2" size="25" id="email" name="email" type="text" value="<?php echo $user['umail']  ?>" class="input-xlarge" placeholder="Email Address" >
										<?php } else { ?>
										<input tabindex="2" size="25" id="email" name="email" type="text" value="" class="input-xlarge" placeholder="Email Address">
										<?php } ?>
									</div>
								</div>
								
								<div class="clearfix">
									<label for="message"><span>Message:</span></label>
									<div class="input">
										<textarea tabindex="3" class="input-xlarge" id="message" name="description" rows="7" placeholder="Message"></textarea>
									</div>
								</div>
								
								<div class="actions">
									<button tabindex="3" type="submit" name="submit" class="btn btn-inverse">Send message</button>
								</div>
							</fieldset>
						</form>

						<?php 

							if(isset($_POST['submit'])){
								$name = $_POST['name'];
								$email = $_POST['email'];
								$description = $_POST['description'];
								if(isset($_SESSION['id'])){
									$userid = $_SESSION['id'];
								} else {
									$userid = 0;
								}
								 
								addfeedback($description, $userid, $email, $name);
								?> <script>alert('Your message has been send.')</script> <?php 
						}

						?>

					</div>				
				</div>
			</section>			
			<?php include('footer.php'); ?>
	  
		</div>
		<script src="themes/js/common.js"></script>		
    </body>
</html> <?php } else {
 	?><script>window.location.href="logout.php"</script><?php
 } ?>