<html>

<body>

 
    <?php
    include('function.php');
    $count = 0;

    ?>

    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
    <?php 
    session_start();
    include('style.php'); 
    
    $cat = $_GET['cat'];
    $row = retreive_item_by_category($cat);
     ?>

    </head>
    <body>      
        <div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<input type="text" name="search" class="input-block-level search-query" style="color:black" Placeholder="eg. medicine">
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
        <div id="wrapper" class="container">
            <?php include('nav2.php'); ?>   
            <section class="header_text sub">
            <img class="pageBanner" src="themes/images/s.jpg" alt="New products" >
                <h4><span><?php  
                    if(isset($_POST['search'])){
                        echo 'Showing results for '.$_POST['search'];
                       	
                    }
                    else if($cat==2){
                        echo 'OVER THE COUNTER';
                    } else if($cat==1){
                         echo'PRESCRIPTION';
                    }
                ?></span></h4>
            </section>
            <div id="myCarousel" class="myCarousel carousel slide">
                <div class="carousel-inner" style="width:100%; margin: auto;" >
                    <div class="active item" style=" ">                         
                        <ul class="thumbnails listing-products" >
                            <?php 
                            if(isset($_POST['search'])){
                                    
                                $search = trim($_POST['search']);
                                $row = search($search);
                                
                            } 
                        
                            foreach($row as $r){
                                if($r['status']==0){
                            $markup = 0;
                            $count = $count+1;
                            ?> 
                            <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>">
                            <li class="span3" style="height:350px">
                                <div class="product-box">   
                                <div  style="padding-top:10px;height:204px !important;">
                                    <?php if($r['itemcategory'] == 1){ ?>
                                    <div class="top-left"><img style="width:40px;" src="themes/images/rx.png"></div>                                            
                                    <?php } else{ ?>	
                                    <div class="top-left"><img style="width:47px;" src="themes/images/otc.png"></div>
                                    <?php } ?>
                                    <center><a href="product_detail.php?id=<?php echo $r['itemid'] ?>"><img alt="" class="animage" src="<?php echo $r['picture'] ?>" style="width: 200px;height: 200px;" ></a><br/></center>
                                </div><br>
                                    <?php $arr = explode(' ',trim($r['measurement'])) ?>
                                    <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>"><strong><?php echo $r['brand'].' ('. $arr[0] .')' ?></strong></a><br/>
                                    <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>" class="category"><?php echo $r['generics'] ?></a>
                                    <p class="price">₱ <?php 
                                    $markup = $r['price']+$r['markup'];
                                    echo $markup ?></p>
                                </div>
                            </li></a>
                            <?php }
                            } ?>      
                        </ul>
                        <?php 

                            if(isset($_POST['search']) && $count==0){
                                ?><div style="text-align: center;padding:50px" class="alert alert-danger">
                                  <strong>Info!</strong> No results found for <b><?php echo $_POST['search'] ?></b>
                                </div><?php 
                            }
                                
                            else if(isset($_GET['cat'])){
                        	if($count == 0){
                        		?><div style="text-align: center;padding:50px" class="alert alert-danger">
								  <strong>Info!</strong> No results found 
								</div><?php 
                        	}
                            }
                             
                        
                        ?>
                        
                        </div>


                        

        



                    </div>
                
                </div>
     
            <?php include('footer.php'); ?>
            
        </div>
        <script src="themes/js/common.js"></script> 
    </body>
</html>