
<?php
	session_start();
	include('function.php');
	$itemid = $_GET['id'];
	$item = retreive_item_by_id($itemid);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('style.php'); ?>
	</head>
    <body>		
		<?php include('nav1.php'); ?>
		<div id="wrapper" class="container">
			<?php include('nav2.php') ?>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/logo1.jpg" alt="New products" >
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">						
					<div class="span9">
						<div class="row">
							<div class="span4">
								<a href="<?php echo $item['picture'] ?>" style="width:200px;height: 200px;margin-left:10%;margin-right: 10%" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt=""  style="width:90%;height: 90%;" src="<?php echo $item['picture'] ?>"></a>									 
							</div>
							<div class="span5">
								<address>
									<strong>Category:</strong> <span><?php echo $item['itemcategory'] ?></span><br>
									<strong>Generic Name:</strong> <span><?php echo $item['generics'] ?></span><br>
									<strong>Brand Name:</strong> <span><?php echo $item['brand'] ?></span><br>
									<strong>Availability:</strong> <span><?php echo $item['qty']; ?></span><br>								
								</address>									
								<h4><strong>Price: P<?php echo $item['price'] ?></strong></h4>
							</div>
							<div class="span5">
								<form class="form-inline" method="post">
									<label class="checkbox">
										<input type="checkbox" value=""> Option one is this and that
									</label>
									<br/>
									<label class="checkbox">
									  <input type="checkbox" value=""> Be sure to include why it's great
									</label>
									<p>&nbsp;</p>
									<?php if(isset($_SESSION['id'])){ ?><label>Qty:</label>
									<input type="number" name="qtyordered" style="width:20%" class="span1" placeholder="-" required="">
									<button class="btn btn-inverse" name="submit" type="submit">Add to cart</button><?php } ?>
								</form>
							</div>	

							<?php if(isset($_POST['submit'])){
								$itemid = $item['itemid'];
								$userid = $_SESSION['id'];
								$qtyordered = $_POST['qtyordered']; 

								addtocart($itemid, $userid, $qtyordered);

								?>
									<script>
										window.location.href="cart.php";
									</script>
								<?php
								
							} ?>


						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
									<li class=""><a href="#profile">Additional Information</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home">
										<?php echo $item['itemsubcategory'] ?>
									</div>
									<div class="tab-pane" id="profile">
										<table class="table table-striped shop_attributes">	
											<tbody>
												<tr class="">
													<th>Size</th>
													<td><?php echo $item['measurement'] ?></td>
												</tr>		
												<tr class="alt">
													<th>Dosage</th>
													<td><?php echo $item['dosage'] ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>							
							</div>						
	  						<div class="span9">	
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
									<span class="pull-right">
    									</span>
								</h4>
						 
							</div>
						</div>
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list">
								<li class="nav-header">SUB CATEGORIES</li>
								<li><a href="products.html">Nullam semper elementum</a></li>
								<li class="active"><a href="products.html">Phasellus ultricies</a></li>
								<li><a href="products.html">Donec laoreet dui</a></li>
								<li><a href="products.html">Nullam semper elementum</a></li>
								<li><a href="products.html">Phasellus ultricies</a></li>
								<li><a href="products.html">Donec laoreet dui</a></li>
							</ul>
							<br/>
							<ul class="nav nav-list below">
								<li class="nav-header">MANUFACTURES</li>
								<li><a href="products.html">Adidas</a></li>
								<li><a href="products.html">Nike</a></li>
								<li><a href="products.html">Dunlop</a></li>
								<li><a href="products.html">Yamaha</a></li>
							</ul>
						</div>
		 
					 
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
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>
    </body>
</html>