<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(!empty($_POST))
			{
				$_SESSION['pwd']=$_POST['pwd_'];
				$_SESSION['user'] = 'Admin';
				echo "<script> alert('login successful');
				window.location.replace('main.php');
				</script>";
			}
			else
				echo "<script> alert('redirecting to login page');
				window.location.replace('access.php');
				</script>";
		?>
	</body>
</html>