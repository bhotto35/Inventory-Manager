<!DOCTYPE html>
</html>
	<body>
		<?php
			session_start();
			unset($_SESSION['inw_pwd']);
			echo "<script>
					alert('Logging out of inwards manager');
					window.location.replace('main.php');
				</script>";
		?>
	</body>
</html>