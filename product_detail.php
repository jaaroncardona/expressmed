
<?php
	session_start();
	include('function.php');
 
	$itemid = $_GET['id'];

	$item = retreive_item_by_id($itemid);
 	$ww =0;
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
								<a href="<?php echo $item['picture']; ?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img class="prodimage" alt="" src="<?php echo $item['picture'] ?>"></a>												
								 
							</div>
							<div class="span5">
								<address>
									<strong>Brand</strong> <span> : <?php echo $item['brand']; ?></span><br>
									<strong>Generic Name</strong> <span> : <?php echo $item['generics']; ?></span><br>
									<strong>Category</strong> <span> : <?php echo $item['itemsubcategory']; ?></span><br>
									<?php if($item['qty'] <=  100){
										$instock = $item['qty'].' remaining';
										$ww = $item['qty'];
									}  else {
										$instock = "In Stock";
									} ?>
									<strong>Availability:</strong> <span> : <?php echo $instock; ?></span><br>								
								</address>									
								<h4><strong><?php $markup = $item['price']+$item['markup'];
								
									echo $markup ?></strong></h4>
							</div>
							<div class="span5">
								<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
							 
									<p>&nbsp;</p>
									<label>Qty:</label>
									<input type="number" class="span1" min="1" max="<?php echo $item['qty'] ?>" name="qtyordered" value="1" placeholder="1">
								<?php if($item['itemcategory'] == 1){
								if(isset($_SESSION['id'])){ ?>
								<button class="btn btn-inverse" id="myBtn" type="button" >Add to cart</button>
								<?php } else { ?>
								<button class="btn btn-inverse" id="myBtn" type="button" disabled>Add to cart</button> You must <a href="register.php"><b>login</b></a> to order
								<?php } ?>
								<div id="myModal" class="modal">	

										  <!-- Modal content -->
										  <div class="modal-content">
										    <div class="modal-header">
										      <span class="close">&times;</span>
										      <h2>Prescription</h2>
										    </div>
										    <div class="modal-body">
										    
										      <label><h6>Prescription</h6></label><br>
										        <input style="border-color:white;color:white;width:2px;" type="text" name="itemid" value="<?php echo $item['itemid']; ?>"><br>
								                <input name="file" type="file" id="imagee" required="required" />
						   					    <input type="submit" value='Upload' name="submit" onclick="return validateForm()"/>
 										    </div>
										  </div>

										</div>
										<?php } else {  ?>
											<input style="border-color:white;color:white;width:2px;" type="text" name="itemid" value="<?php echo $item['itemid']; ?>">
											<?php if(isset($_SESSION['id'])){ ?> 
											<input class="btn btn-inverse" name="submits" type="submit" value="Add to Cart">
											<?php } else { ?>
											<input class="btn btn-inverse" name="submits" type="submit" disabled value="Add to Cart">
										<?php }
										} ?>

							</form>
							
	<?php
	 

	 	if(isset($_POST['submits'])){
	 		$userid = $_SESSION['id'];
				$itemid = $_POST['itemid'];
				$qtyordered = $_POST['qtyordered'];


				$picture = 'images/none.png';

				addtocart($itemid, $userid, $qtyordered, $picture);
			 	echo "<script>window.location.href='cart.php'</script>";
	 	}

		function uploadFile ($file_field = null, $check_image = false, $random_name = false) {
			$picture='none';
			//Config Section    
			//Set file upload path
			$path = 'images/pres/'; //with trailing slash
			//Set max file size in bytes
			$max_size = 1000000;
			//Set default file extension whitelist
			$whitelist_ext = array('jpeg','jpg','png','gif');
			//Set default file type whitelist
			$whitelist_type = array('image/jpeg', 'image/jpg', 'image/png','image/gif');
			
			//The Validation
			// Create an array to hold any output
			$out = array('error'=>null);
			
			if (!$file_field) {
			  $out['error'][] = "Please specify a valid form field name";           
			}
			
			if (!$path) {
			  $out['error'][] = "Please specify a valid upload path";               
			}
			
			if (count($out['error'])>0) {
			  return $out;
			  
			}
			if(!file_exists($_FILES[$file_field]['tmp_name']) || !is_uploaded_file($_FILES[$file_field]['tmp_name'])) {
	 
				$userid = $_SESSION['id'];
				$itemid = $item['itemid'];
				$qtyordered = $_POST['qtyordered'];


				$picture = 'images/pres/none.png';

				addtocart($itemid, $userid, $qtyordered, $picture);
				echo "<script>window.location.href='cart.php'</script>";
			}
			//Make sure that there is a file
			if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {
			
			// Get filename
			$file_info = pathinfo($_FILES[$file_field]['name']);
			$name = $file_info['filename'];
			$ext = $file_info['extension'];
			
			//Check file has the right extension           
			if (!in_array($ext, $whitelist_ext)) {
			  $out['error'][] = "Invalid file Extension";
			}
			
			//Check that the file is of the right type
			if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) {
			  $out['error'][] = "Invalid file Type";
			}
			
			//Check that the file is not too big
			if ($_FILES[$file_field]["size"] > $max_size) {
			  $out['error'][] = "File is too big";
			}
			
			//If $check image is set as true
			if ($check_image) {
			  if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
				$out['error'][] = "Uploaded file is not a valid image";
			  }
			}
			
			//Create full filename including path
			if ($random_name) {
			  // Generate random filename
			  $tmp = str_replace(array('.',' '), array('',''), microtime());
			
			  if (!$tmp || $tmp == '') {
				$out['error'][] = "File must have a name";
			  }     
			  $newname = $tmp.'.'.$ext;                                
			} else {
				$newname = $name.'.'.$ext;
			}
			
			//Check if file already exists on server
			if (file_exists($path.$newname)) {
			  $out['error'][] = "A file with this name already exists";
			}
			
			if (count($out['error'])>0) {
			  //The file has not correctly validated
			  return $out;
			} 
			
			if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname)) {
			  //Success
			$itemid = $_GET['id'];
			$item = retreive_item_by_id($itemid);
			$out['filepath'] = $path;
			$out['filename'] = $newname;
			$userid = $_SESSION['id'];
			$itemid = $_POST['itemid'];
			$qtyordered = $_POST['qtyordered'];
			
			$picture = 'images/pres/'.$out['filename'];

			addtocart($itemid, $userid, $qtyordered, $picture);
			echo "<script>window.location.href='cart.php'</script>";

			return $out;
			} else {
			  $out['error'][] = "Server Error!";
	 
			  
			}
			
			 } else {
			  $out['error'][] = "No file uploaded";
			  return $out;
			  echo 'awdawdawd';
			  
			 }    
			  
			}
			
			
			if (isset($_POST['submit'])) {
			 $file = uploadFile('file', true, true);
			 if (is_array($file['error'])) {
			  $message = '';
			  foreach ($file['error'] as $msg) {
			  $message .= '<p>'.$msg.'</p>';    
			 }
			} else {
				 	
		 
			}
			 
			}
 
 

			
		
	
?>
							</div>							
						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
									<li class=""><a href="#profile">Additional Information</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home"><table class="table table-striped shop_attributes">	
											<tbody>
												<tr class="">
													<th>Manufacturer</th>
													<td><?php echo $item['manufacturers'] ?></td>
												</tr>		
												<tr class="alt">
													<th>Supplier</th>
													<td><?php echo $item['supplier'] ?></td>
												</tr>
											</tbody>
										</table></div>
									<div class="tab-pane" id="profile">
										<table class="table table-striped shop_attributes">	
											<tbody>
												<tr class="">
													<th>Dosage</th>
													<td><?php echo $item['dosage'] ?></td>
												</tr>		
												<tr class="alt">
													<th>Measurement</th>
													<td><?php echo $item['measurement'] ?></td>
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
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>
								
							</div>
						</div>
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list below">
								<li class="nav-header">Prescription</li>
								<li><a href="./products.php?cat=3">Coughs & Colds</a></li>
								<li><a href="./products.php?cat=4">Ear&Nose&Mouth/Throath</a></li>
									<li><a href="./products.php?cat=5">Fever & Pain releif</a></li>	
									<li><a href="./products.php?cat=6">Stomach & Intestinal</a></li>	
									<li><a href="./products.php?cat=7">Other</a></li>
							</ul>
							<ul class="nav nav-list below"><br>
								<li class="nav-header">Prescription</li>
							<li><a href="./products.php?cat=8">Allergy & Immune System</a></li>
									<li><a href="./products.php?cat=9">Anti-infective</a></li>
									<li><a href="./products.php?cat=10">Cardio/Herma System</a></li>
									<li><a href="./products.php?cat=11">Nervous System</a></li>		
									<li><a href="./products.php?cat=12">Other</a></li>	
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