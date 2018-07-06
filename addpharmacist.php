<html>
<?php include('function.php'); ?>
<body>

	<form method="post">

		<input type="text" name="fname" placeholder="First Name" required>
		<input type="text" name="mi" placeholder="MI" required>
		<input type="text" name="lname" placeholder="Family Name" required>
		<input type="number" name="phone" placeholder="Phone no" required>
		<input type="text" name="email" placeholder="Email" required>
		<input type="text" name="username" placeholder="Username" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="text" name="licenseno" placeholder="License no" required>
		<input type="submit" name="submit" value="submit"> 

	</form>

<?php

	if(isset($_POST['submit'])){
		$fname = $_POST['fname'];
		$mi = $_POST['mi'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$licenseno = $_POST['licenseno'];

		addpharmacist($fname, $mi, $lname, $phone, $email, $username, $password, $licenseno);
	}
?>

</body>
</html>