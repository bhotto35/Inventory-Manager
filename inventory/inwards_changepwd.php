<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(empty($_POST)||!isset($_SESSION['user']))
				header('location: access.php');
			$newpwd= $_POST["confpwd"];
			$query = "";
			if($_SESSION['user']!='Admin')
				$query="update password set pwd='$newpwd' where accessTo='inwards';";
			else
				$query="update password set admin_pwd='$newpwd' where accessTo='inwards';";
			$link=mysqli_connect('localhost', 'root', '', 'inventory');
			if(!$link)
				die('Could not connect to database');
			else
			{
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('password was changed successfully');
						window.location.replace('inwards.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('password change was unsuccessful');
						window.location.replace('inwards.php');
					</script>";
				}
			}
		?>
	</body>
</html>