<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(!empty($_POST))
			{
				$_SESSION['emp_pwd']=$_POST['pwd1'];
				header('location: employee.php');
			}
			else
			{
				session_destroy();
				header('location: access.php');
			}
		?>
	</body>
</html>