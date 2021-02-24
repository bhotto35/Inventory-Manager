<!DOCTYPE html>
<html>
	<body>
		<?php
			if(empty($_POST))
				header('location: access.php');
			session_start();
			$newpwd= $_POST["confpwd"];
			$query="update password set pwd='$newpwd' where accessTo='main';";
			$link=mysqli_connect('localhost', 'root', '', 'inventory');
			if(!$link)
				die('Could not connect to database');
			else
			{
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('password was changed successfully');
						window.location.replace('main.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('password change was unsuccessful');
						window.location.replace('main.php');
					</script>";
				}
			}
		?>
	</body>
</html>