<?php include('function.php'); 
$row = retreive_user();
session_start();
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
      
      <ul class="tab-group">
      	<?php if(isset($_SESSION['erremail']) || isset($_SESSION['erruser'])){ ?>
        <li class="tab"><a href="#signup">Log In</a></li>
        <li class="tab active"  ><a href="#login">Sign Up</a></li><?php
        $_SESSION['erremail']=null;
		$_SESSION['erruser']=null;
         } else { ?>
      	<li class="tab active"><a href="#signup">Log In</a></li>
        <li class="tab"  ><a href="#login">Sign Up</a></li><?php } ?>

      </ul>
 
      <div class="tab-content">
        <div id="signup">   
          <h1>Welcome Back!</h1>
          
          <div class="span5">         
            <h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
            <form method="post">
              <input type="hidden" name="next" value="/">
              <fieldset>
                <div class="control-group">
                  
                  <div class="controls">
                  <label class="control-label">Username</label>
                    <input type="text" style="height:28px;width:65%" placeholder="Enter your username" name="usernamelogin" class="input-xlarge">
                  <label class="control-label">Password</label>
                    <input type="password" minlength="8" style="height:28px;width:65%" placeholder="Enter your username" name="passwordlogin" class="input-xlarge"> 
                  </div>
                </div>
                <?php
					  if(isset($_POST['submit1'])){
					    
					    $username = $_POST['usernamelogin'];
					    $password = $_POST['passwordlogin'];
					    $pass=1;
					    foreach($row as $r){
					      if($username == $r['username'] && $password == $r['password']){
					        $_SESSION['id'] = $r['userid'];
					        ?> <script>
					              window.location.href="index.php";
					        </script> <?php
					    
					      } else {
					        $pass=0;
					      }
					  
					    }

					    if($pass == 0){
					      ?><div class="alert alert-danger">
							  <strong>Warning!</strong> Incorrect Username/Password
							</div><?php
					    }

					  }

					  if(isset($_POST['submit2'])){
					    $checkuser =0;
					    $checkemail =0;
					    $ufname = $_POST['ufname'];
					    $ulname = $_POST['ulname'];
					    $umi = $_POST['umi'];
					    $umail = $_POST['umail'];
					    $phone = $_POST['phone'];
					    $username = $_POST['username'];
					    $password = $_POST['password'];
					    $city = $_POST['city'];
					    $municipality = $_POST['municipality'];
					    $street = $_POST['street'];
					    $barangay = $_POST['barangay'];
					    $landmark = $_POST['landmark'];
					    $birthdate = $_POST['birthdate'];
					    $pic = 'gg';
					    $discountid = 'awd';
					    $address = $barangay.' '.$street.' '.$municipality.' '.$city.' ('.$landmark.') ';
				 
					    foreach($row as $r){

					      if($umail == $r['umail']){
					        $checkemail=1;

					      }
					      
					      if($username == $r['username']){
					        $checkuser=1; 
					      }
					    }

					    if($checkemail == 1){
					      $_SESSION['erremail'] =  "(email already exist)";
					      ?><script>alert("Signup failed ( Email already Exists )")</script><?php
					    }
					    if($checkuser == 1){
					      $_SESSION['erruser'] = "(username already exists}";
					      ?><script>alert("Signup failed ( Username already Exists )")</script><?php
					    }

					    if($checkemail==0 && $checkuser==0){
					    register_user($ufname, $ulname, $umi, $umail, $phone, $username, $password, $address, $birthdate, $pic);
					    ?><script>alert("You successfuly registered")</script><?php
					    $birthDate = $birthdate;
						  //explode the date to get month, day and year
						  $birthDate = explode("/", $birthDate);
						  //get age from date or birthdate
						  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
						    ? ((date("Y") - $birthDate[2]) - 1)
						    : (date("Y") - $birthDate[2]));
						  $age;
						  if($age >= 60){
					    ?><script>window.location.href="uploadd.php"</script><?php
					    }
					    $_POST['ufname'] = "";
					    $ulname = $_POST['ulname'];
					    $_POST['umi'] = "";
					    $_POST['umail'] = "";
					    $_POST['phone'] = "";
					    $_POST['username'] = "";
					    $_POST['password'] = "";
					    $_POST['city'] = "";
					    $_POST['municipality'] = "";
					    $_POST['street'] = "";
					    $_POST['barangay'] = "";
					    $_POST['landmark'] = "";
					    }
					  }
					?>  

                <div class="control-group">
                  <input tabindex="3" name="submit1" class="btn btn-inverse large" type="submit" value="Sign into your account">
                  <hr>
                  <p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>

                </div>
              </fieldset>
            </form>       
          </div>

        </div>
        <div id="login">   
          <h1>Sign Up for Free</h1>
          
          <div class="span7" style="width:450px">         
            <h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
            <form action="#" method="post" class="form-stacked">
              <fieldset>
                <div class="control-group">
                  <label class="control-label"><h6>Personal Information</h6></label>
                   <input type="text" style="height:28px;width:35%" name="ufname" placeholder="First Name" value="<?php if(isset($_POST['ufname'])){ echo $_POST['ufname']; } ?>" required=" ">
                    <input type="text" style="height:28px;width:10%" name="umi" placeholder="MI" value="<?php if(isset($_POST['umi'])){ echo $_POST['umi']; } ?>" required=" ">
                    <input type="text" style="height:28px;width:35%" name="ulname" placeholder="Family Name" value="<?php if(isset($_POST['ulname'])){ echo $_POST['ulname']; } ?>" required=" ">
                    <input type="date" style="height:28px;width:35%" name="birthdate" placeholder="birthdate" value="<?php if(isset($_POST['birthdate'])){ echo $_POST['city']; } ?>" required=" ">
                    <label class="control-label"><b>Login Credentials</b> <strong style="font-weight:normal;color:orange;"><?php if(isset($_SESSION['erruser'])){
                      echo $_SESSION['erruser'];
                      $_SESSION['erruser'] == "";
                    } ?> </strong></label>
                    <br>
                    <input type="text" style="height:28px;width:45%" style="<?php if(isset($_SESSION['erruser'])){ echo  "color:#ff4500;"; } ?>" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" required=" "><br>
                    <input type="password" style="height:28px;width:45%" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" minlength="8" required=" ">
                    <label class="control-label"><b>Contact Information</b> <strong style="font-weight: normal;color:orange;"><?php if(isset($_SESSION['erremail'])){
                      echo $_SESSION['erremail'];
                      $_SESSION['erremail'] = "";
                    } ?> </strong></label><br>
                    <input type="email" style="height:28px;width:45%;"" name="umail" style="<?php if(isset($_SESSION['erremail'])){ echo "color:#ff4500;"; } ?>" placeholder="Email Address" value="<?php if(isset($_POST['umail'])){ echo $_POST['umail']; } ?>" required=" ">
                    <input type="number" style="height:28px;width:45%" name="phone" placeholder="Phone Number"  value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>" required=" ">

                    <label><h6>Address</h6></label>
                    <input type="text" style="height:28px;width:55%" name="city" placeholder="Province/City" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" required=" ">
                    <input type="text" style="height:28px;width:55%" name="municipality" placeholder="municipality" value="<?php if(isset($_POST['municipality'])){ echo $_POST['municipality']; } ?>" required=" "><br>
                    <input type="text" style="height:28px;width:55%" name="street" placeholder="street" value="<?php if(isset($_POST['street'])){ echo $_POST['street']; } ?>" required=" ">
                    <input type="text" style="height:28px;width:55%" name="barangay" placeholder="barangay" value="<?php if(isset($_POST['barangay'])){ echo $_POST['barangay']; } ?>" required=" "><br>
                    <input type="text" style="height:28px;width:55%" name="landmark" placeholder="landmark" value="<?php if(isset($_POST['landmark'])){ echo $_POST['landmark']; } ?>" required=" ">

                </div>
                        
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