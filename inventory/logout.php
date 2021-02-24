<html>
	<body>
		<?php
			session_start();
			session_destroy();
		?>
		<script>
			alert('logging out');
			window.location.replace('access.php');
		</script>
	</body>
</html>