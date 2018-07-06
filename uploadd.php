<?php include('function.php'); 
$row = retreive_user();
session_start();

$row = retreive_users()



 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
 

 
</style>
		<?php include('style.php'); ?>
		 
    <link rel="stylesheet" href="css/style.css">
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
	 <div class="form">
      
     
 
      <div class="tab-content">
        <div id="signup">   
          <h6> Fillup the feilds below if you want to register as Senior. press Skip if not!</h6>
          
          <div class="span5">         
            <h4 class="title"><span class="text"><strong>Verification</strong> </span></h4>
             
              
              <fieldset>
                <div class="control-group">
                  
                  <form method="post" enctype="multipart/form-data">
                  	<label>Id number : </label>
                  	<input style="height:28px;width:40%" placeholder="id number" type="text" name="discountid" ><br><br>
				  	
                  	<div>
				    <input type="submit" value="Apply" class="btn btn-inverse" name="submit">
				    
				</form>
				<a href="register.php" style="float:right;margin-right:40px" onclick="return confirm('Are you sure to skip')"  class="btn btn-inverse" >Skip</a>
				</div>
                </div>
              </fieldset>
              
          </div>

          <?php 
          if(isset($_POST['discountid'])){
        	$discountid = $_POST['discountid'];
        	function discountid(){
        		$db=db();
        		$sql = "SELECT * FROM discount";
        		$s=$db->query($sql);
        		$row = $s->fetchAll();
        		$db = null;
        		return $row;

        	}
        	$discounts = discountid();
        	foreach($discounts as $d){
        		if($d['discountid'] == $discountid && $d['status']==1){
        			$status = 'Active';
        			break;
        		} else if($d['discountid'] == $discountid && $d['status'] == 0) {
        			$status =  'Inactive';
        			break;
        		} else if($d['discountid'] != $discountid) {
        			$status = 'invalid';
        		}
        	}
       
        	$user = retreive_users();
        	if($status == 'Active'){
        	foreach($user as $u){
        		$userid = $u['userid'];
        	}	
        		echo $userid;
        		approve($userid, $discountid);
        		?><script>window.location.href="register.php"</script><?php
        	}

        	if($status == 'Inactive'){
        		?><script>alert("The id number is Inactive")</script><?php
        	}

        	if($status == 'invalid'){
        		?><script>alert("The id number is Invalid")</script><?php
        	}
        
        	

        	
        }
          
          ?>

        </div>
        <div id="login">   
          <h1>Sign Up for Free</h1>
          
          <div class="span7" style="width:450px">         
            <h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
            <form action="#" method="post" class="form-stacked">
              <fieldset>
                <div class="control-group">
                 
                        
                <div class="control-group">
                  <input tabindex="3" name="submit2" class="btn btn-inverse large" type="submit" value="create account">
                  <hr>
                  <p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>

                </div>
                <hr>
             
              </fieldset>
            </form>         
          </div>  

        </div>
        
        
        
      </div><!-- tab-content -->


      
</div> <!-- /form -->

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>
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