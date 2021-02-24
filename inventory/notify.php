<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location: access.php");
	$link = mysqli_connect("localhost","root","","inventory");
	if(!$link)
		die("Error! Could not connect to database");
	if($_POST['action']=='insert')
	{
		$content = $_POST['content'];
		$creator = $_SESSION['user'];
		$query = "select max(id) from notification;";
		$r = mysqli_query($link,$query);
		$ra = mysqli_fetch_assoc($r);
		$id = $ra['max(id)']+1;
		$date_time=date('Y-m-d')." ".date('H:m:s');
		$q0 = "insert into notification values($id,'$content','$creator','$date_time');";
		if(mysqli_query($link,$q0))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	else if($_POST['action']=='delete')
	{
		$id = $_POST['id'];
		$q0 = "delete from notification where id = ".$id.";";
		if(mysqli_query($link,$q0))
		{
			echo "<script>
				alert('Notification deleted');
				window.location.replace('main.php');
				</script>";
		}
		else
		{
			echo "<script>
				alert('Notification could not be deleted');
				window.location.replace('main.php');
				</script>";
		}
	}
?>