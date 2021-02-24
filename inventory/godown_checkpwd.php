<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			$pwd='';
			$query="select admin_pwd from password where accessTo='godown';";
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
				die('unable to connect to database');
			if($query_ran=mysqli_query($link,$query))
			{
				while($query_executed=mysqli_fetch_assoc($query_ran))
				{
					$pwd=$query_executed['admin_pwd'];
				}
			}
			else
			{
				die('Could not execute query');
			}
		?>
		<link rel = "stylesheet" href = "styles.css">
		<script>
			function checkpwd()
			{
				var pwd1=document.getElementById('pwd1').value;
				var pwd10='<?php echo $pwd;?>';
				if(pwd1!=pwd10)
					document.getElementById('wrong').style.display='block';
				else
				{
					const form=document.createElement('form');
					form.method='post';
					form.action='godown_redirect.php';
					//pwd_0.style.visibility='hidden';
					const pwd_0 = document.createElement('input');
					pwd_0.type = 'hidden';
					pwd_0.name = 'pwd1';
					pwd_0.value = pwd1;
					form.appendChild(pwd_0);
					document.body.appendChild(form);
					form.submit();
				}
			}
			function gohome()
			{
				<?php
					session_destroy();
				?>
				window.location.replace('main.php');
			}
		</script>
	</head>
	<body>
		<div  class = "login-form">
			<big><big>Godown Manager</big></big>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<big>Enter password to continue</big><br><br>
			<input type="password" id="pwd1" name="pwd1"><br><br>
			<button type="button" onclick="checkpwd()" class = "btn2">
				Submit
			</button>&nbsp&nbsp
			<button type="button" onclick="gohome()" class = "btn2">
				Go Back
			</button><br><br>
			<div id="wrong"style="background:rgba(250,26,20,1);display:none;">
				Incorrect password; try again
			</div>
		</div>
	</body>
</html>