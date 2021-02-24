<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(!empty($_POST))
			{
				$_SESSION['orders_pwd']=$_POST['pwd1'];
				$_SESSION['user']=$_POST['user'];
				header('location: orders.php');
			}
			else
			{
				session_destroy();
				header('location: access.php');
			}
		?>
	</body>
</html>