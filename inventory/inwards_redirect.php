<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(!empty($_POST))
			{
				$_SESSION['inw_pwd']=$_POST['pwd1'];
				$_SESSION['user'] = $_POST['user'];
				header('location: inwards.php');
			}
			else
			{
				session_destroy();
				header('location: access.php');
			}
		?>
	</body>
</html>