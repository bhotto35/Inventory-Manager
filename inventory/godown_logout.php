<!DOCTYPE html>
</html>
	<body>
		<?php
			session_start();
			unset($_SESSION['pwd1']);
			if(isset($_SESSION['pwd']))
				echo "<script>
					alert('Logging out of godown manager');
					window.location.replace('main.php');
				</script>";
			else
				echo "<script>
					alert('Logging out of godown manager');
					window.location.replace('access.php');
				</script>";
		?>
	</body>
</html>