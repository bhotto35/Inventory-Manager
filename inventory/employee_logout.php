<!DOCTYPE html>
</html>
	<body>
		<?php
			session_start();
			unset($_SESSION['emp_pwd']);
			echo "<script>
				alert('Logging out of employee manager');
				window.location.replace('main.php');
			</script>";
		?>
	</body>
</html>