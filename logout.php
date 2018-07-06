<?php

	session_start();
 
	session_unset($_SESSION['id']);
	?><script>window.location.href="login.php"</script><?php
?>