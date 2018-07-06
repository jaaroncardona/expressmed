<html>
<head><title>asdasd</title></head>
<body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<div class="alert alert-success" style="margin-bottom: 0px;">
						  <strong>EMED!</strong> An Online Philippine Pharmacy
						</div>
					</form>
				</div>
				<?php if(!isset($_SESSION['id'])){ ?>
				<a style="float:right" href="register.php">login  </a>
				<a style="float:right;padding-right:20px" href="index.php">Home </a>
				<?php } ?>
				<div class="span8">
					<div class="account pull-right">
						<nav >
						<ul class="user-menu" style="float:right;">	
							<?php if(isset($_SESSION['id'])){ ?>
							<li><a href="index.php">Home</a></li>
							<li><a href="myaccount.php">My Account</a></li>
							<li><a href="cart.php">Your Cart</a></li>
					 
							<li><a href="trackorder.php">Track Order</a></li>
							<li><a href="logout.php">Logout</a></li>
 
							<?php	}else{ ?>					
						
									
								<?php } ?>


						</ul>
					</nav>
					</div>
				</div>
			</div>
		</div>
</body>
</html>