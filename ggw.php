<?php if(isset($_SESSION['id'])){ ?>
<html>

<body>

 
    <?php
    include('function.php');
        

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
        <?php include('nav1.php') ?>
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
                                echo 'ggwp';    
                                $search = trim($_POST['search']);
                                $row = search($search);
                            } 
                            foreach($row as $r){
                            $markup = 0; ?> 
                            <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>">
                            <li class="span3" style="height:350px">
                                <div class="product-box">   
                                <div  style="padding-top:10px;height:204px !important;">
                                    <?php if($cat == 1){ ?>
                                    <div class="top-left"><img style="width:40px;" src="themes/images/rx.png"></div>                                            
                                    <?php } else{ ?>
                                    <div class="top-left"><img style="width:47px;" src="themes/images/otc.png"></div>
                                    <?php } ?>
                                    <center><a href="product_detail.php?id=<?php echo $r['itemid'] ?>"><img alt="" class="animage" src="<?php echo $r['picture'] ?>" style="width: 200px;height: 200px;" ></a><br/></center>
                                </div><br>
                                    <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>"><strong><?php echo $r['brand'] ?></strong></a><br/>
                                    <a   href="product_detail.php?id=<?php echo $r['itemid'] ?>" class="category"><?php echo $r['generics'] ?></a>
                                    <p class="price">₱ <?php 
                                    $markup = $r['price']+$r['markup'];
                                    echo $markup ?></p>
                                </div>
                            </li></a>
                            <?php } ?>      
                        </ul>

                        
                        </div>


                        

        



                    </div>
                
                </div>
     
            <?php include('footer.php'); ?>
            
        </div>
        <script src="themes/js/common.js"></script> 
    </body>
</html>