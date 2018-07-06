<?php 
session_start();
 ?>
<?php

		
	include('function.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>EMED - HOME</title>
		
		<style>
			.centered {
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		    background-color:white !important;
}
		</style>
	<?php include('style.php') ?>
	</head>
    <body>		
    	 
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php'); ?>
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/banner-1.png" alt="" style="height:460px;" />
							<div class="centered" style="background-color:white;"></h1></div>
						</li>
						<li>
							<img src="themes/images/carousel/banner-2.jpg" alt="" style="height:460px;" />
							<div class="intro">
								<h1>EMED</h1>
								<p><span>An Online Philippine </span></p>
								<p><span>Pharmacy</span></p>
							</div>
						</li>
					</ul>
				</div>			
			</section>
			<section class="header_text">
				
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">													
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">EMED <strong>Features</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
															
								</div>
							</div>						
						</div>
						<br/>
						
						<div class="row feature_box">						
							<div class="span4">
								<div class="service">
									<div class="responsive">	
										<img src="themes/images/feature_img_2.png" alt="" />
										<h4>FREE <strong>DELIVERY</strong></h4>
										<p>EMED's future feature description.</p>									
									</div>
								</div>
							</div>
							<div class="span4">	
								<div class="service">
									<div class="customize">			
										<img src="themes/images/feature_img_1.png" alt="" />
										<h4>ONLINE <strong>SHOPPING</strong></h4>
										<p>EMED's future feature description.</p>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="service">
									<div class="support">	
										<img src="themes/images/feature_img_3.png" alt="" />
										<h4>24/7 LIVE <strong>SUPPORT</strong></h4>
										<p>EMED's future feature description.</p>
									</div>
								</div>
							</div>	
						</div>		
					</div>				
				</div>
			</section>
		 
			<?php include('footer.php'); ?>
 
		</div>
		<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
		<script>
		window.onscroll = function() {myFunction()};

		var navbar = document.getElementById("navbar");
		var sticky = navbar.offsetTop;

		function myFunction() {
		  if (window.pageYOffset >= sticky) {
		    navbar.classList.add("sticky")
		  } else {
		    navbar.classList.remove("sticky");
		  }
		}
		</script>
    </body>
</html>
