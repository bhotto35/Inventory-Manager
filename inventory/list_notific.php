<?php
	$link = mysqli_connect("localhost","root","","inventory");
	if(!$link)
		die("Error! Could not connect to database");
	session_start();
	if(!isset($_SESSION['user']))
		header("location: access.php");
	$q = "select * from notification;";
	$count=1;
	if($r=mysqli_query($link,$q))
	{
		
		while($ra=mysqli_fetch_assoc($r))
		{
			echo "<div style = 'border:1px solid lightgray;text-shadow:none;padding:5px;text-align:left;width:300px'>";
			echo "<big style='color:blue'>".$count.".</big><br>";
			echo $ra['content']."<br>";
			echo "<small style='color:rgb(50,50,50)'>Created by: ".$ra['created_by'];
			echo " At ".$ra['date_time']."</small>";
			
			
			$str = "
				<form action='notify.php' method='post'>
				<input type='text' name='id' value='".$ra['id']."' hidden>
				<input type='text' name='action' value='delete' hidden>
				<button type='submit' class='btn'>Delete</button></form></td>
			";
			echo $str;
			echo "</div>";
			$count+=1;
		}
	}
	$q1 = "select id,name,threshold,units from stock where units<threshold;";
	$r1 = mysqli_query($link,$q1);
	while($ra1 = mysqli_fetch_assoc($r1))
	{
		echo "<div style = 'border:1px solid lightgray;text-shadow:none;padding:5px;text-align:left;width:300px'>";
		echo "<big style='color:blue'>".$count.".</big><br>";
		echo "Stock of ".$ra1['name'].", (ID: ".$ra1['id'];
		echo ") has fallen below threshold amount by ".($ra1['threshold']-$ra1['units'])." unit(s) <br>";
		echo "<small style='color:rgb(50,50,50)'>Auto generated</small>";
		echo "</div>";
		$count+=1;
	}
	if(mysqli_num_rows($r1)==0 && mysqli_num_rows($r)==0)
		echo "No New Notification";
?>