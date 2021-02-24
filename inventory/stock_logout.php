<!DOCTYPE html>
</html>
	<body>
		<?php
			session_start();
			unset($_SESSION['stoc_pwd']);
			echo "<script>
					alert('Logging out of stock manager');
					window.location.replace('main.php');
				</script>";
			/*if(isset($_SESSION['pwd']))
				echo "<script>
					alert('Logging out of stock manager');
					window.location.replace('main.php');
				</script>";
			else
				echo "<script>
					alert('Logging out of stock manager');
					window.location.replace('access.php');
				</script>";*/
		?>
	</body>
</html>