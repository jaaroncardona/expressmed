			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.php">Homepage</a></li>  
							<li><a href="./contact.php">Contac Us</a></li>
							
							<?php if(!isset($_SESSION['id'])){ ?>
							<li><a href="./register.php">Login</a></li>			
							<?php } else { ?>	
							<li><a href="./cart.php">Your Cart</a></li>
							<li><a href="./logout.php">Logout</a></li>
							<?php } ?>				
						</ul>					
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<?php  if(isset($_SESSION['id'])){ ?>
							<li><a href="myaccount.php">My Account</a></li>
							<li><a href="trackorder.php">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<?php } ?>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/emed.png" class="site_logo" alt=""></p>
						<p><h5>An Online Pharmacy here in Philippines!!!</h5></p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a> 
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright Emed - An Online  Philippine Pharmacy - All right reserved.</span>
			</section>