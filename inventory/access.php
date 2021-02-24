<!DOCTYPE html>
<html>
	<head>
		<title>Login to inventory</title>
		<?php
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Cannot connect to database');
			}
			$query="select admin_pwd from password where accessTo='main';";
			$pwd='';
			if ($is_query_run = mysqli_query($link,$query)) 
			{ 
				while ($query_executed = mysqli_fetch_assoc ($is_query_run))
				{
					$pwd=$query_executed['admin_pwd'];
				} 
			} 
			else
			{
				die('Error in query execution');
			}
		?>
		<link rel="stylesheet" href="styles.css">
		<script>
			function redirect()
			{
				var pwd=document.getElementById('pwd').value;
				var pwd0="<?php echo $pwd;?>";
				if(pwd===pwd0)
				{
					//window.location.replace('main.php');
					const form=document.createElement('form');
					form.method='post';
					form.action='redirect_main.php';
					//pwd_0.style.visibility='hidden';
					const pwd_0 = document.createElement('input');
					pwd_0.type = 'hidden';
					pwd_0.name = 'pwd_';
					pwd_0.value = pwd;
					form.appendChild(pwd_0);
					document.body.appendChild(form);
					form.submit();
				}
				else
				{
					document.getElementById('wrong').style.display="block";
					document.getElementById('pwd').value="";
				}
			}
		</script>
	</head>
	<body align="center" style="background:url(access-background.png) no-repeat center fixed;background-size:cover">
		<header class="login">
			<div style = "position:absolute; padding:10px; ">
				<image src = "company-logo.ico" 
					style = "filter:drop-shadow(0px 0px 4px rgba(250,37,58,1))"
					height='100' 
					width = "100">
				For company 
				<b><big>
				<?php
					$myfile = fopen("company_name.txt", "r") or die("Unable to open file!");
					echo fread($myfile,filesize("company_name.txt"));
					fclose($myfile);
				?>
				</big></b>
			</div>
			<h1>INVENTORY MANAGER</h1>
			<h2>Login Page</h2>
		</header>
		<hr>
		<div class = "login-form-main">
			<div align="center">
				<h2 class = "_h2"><u>Admin Page</u></h2>
				<b>Enter password:</b>&nbsp <input type="password" id="pwd" name="pwd" required />
				<br><br>
				<button class="btn2"onclick="redirect()"> Login </button><hr>
			<div><br>
			<div id="wrong" class="wrongpwd">
				Incorrect password; please try again.
			</div>
			<table cellspacing="6" style="font-family:garamond">
				<tr><th colspan="2" align="center" fontcolor = "white"><big>Jump To</big></th></tr>
				<tr>
					<td >Employee Manager </td>
					<td> 
						<a href="employee_checkpwd.php">
						<img src="arrow.ico" class = "arrow" height="25px">
						</a>
					</td>
				</tr>
				<tr>
					<td >Godown Manager </td>
					<td> 
						<a href="godown_checkpwd.php">
						<img src="arrow.ico" class = "arrow" height="25px">
						</a>
					</td>
				</tr>
				<tr>
					<td >Stock Manager </td>
					<td> 
						<a href="stock_checkpwd.php">
						<img src="arrow.ico" class = "arrow" height="25px">
						</a>
						</td>
				</tr>
				<tr>
					<td >Inwards Manager </td>
					<td> 
						<a href="inwards_checkpwd.php">
						<img src="arrow.ico" class = "arrow" height="25px">
						</a>
					</td>
				</tr>
				<tr>
					<td >Orders Manager </td>
					<td> 
						<a href="orders_checkpwd.php">
						<img src="arrow.ico" class = "arrow" height="25px">
						</a>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>