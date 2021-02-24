<!DOCTYPE html>
<html>
	<body>
		<?php
			if(empty($_POST))
				header('location: access.php');
			session_start();
			$newpwd= $_POST["confpwd"];
			$query="update password set admin_pwd='$newpwd' where accessTo='employee';";
			$link=mysqli_connect('localhost', 'root', '', 'inventory');
			if(!$link)
				die('Could not connect to database');
			else
			{
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('password was changed successfully');
						window.location.replace('employee.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('password change was unsuccessful');
						window.location.replace('employee.php');
					</script>";
				}
			}
		?>
	</body>
</html>