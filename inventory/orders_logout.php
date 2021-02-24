<!DOCTYPE html>
</html>
	<body>
		<?php
			session_start();
			unset($_SESSION['pwd1']);
			unset($_SESSION['user']);
			if(isset($_SESSION['pwd']))
				echo "<script>
					alert('Logging out of orders manager');
					window.location.replace('main.php');
				</script>";
			else
				echo "<script>
					alert('Logging out of orders manager');
					window.location.replace('access.php');
				</script>";
		?>
	</body>
</html>