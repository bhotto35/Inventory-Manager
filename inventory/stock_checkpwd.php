<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "styles.css">
		<?php
			session_start();
			$query="select pwd, admin_pwd,manager from password where accessTo='stock';";
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
				die('unable to connect to database');
			$r = mysqli_query($link,$query);
			$ra=mysqli_fetch_assoc($r);
			$admin_pwd = $ra['admin_pwd'];
			$pwd = $ra['pwd'];
			$managers = explode(',',$ra['manager']);
		?>
		<script>
			function checkpwd()
			{
				var pwd1=document.getElementById('pwd1').value;
				var pwd10='<?php echo $pwd;?>';
				var admin_pwd = '<?php echo $admin_pwd;?>';
				var user = document.getElementById('user').value;
				if(user == "")
					alert('Please specify user');
				else if(user == "Admin" && pwd1!=admin_pwd)
				{
					document.getElementById('wrong').style.display='block';
				}
				else if(pwd1!=pwd10)
					document.getElementById('wrong').style.display='block';
				else
				{
					const form=document.createElement('form');
					form.method='post';
					form.action='stock_redirect.php';
					//pwd_0.style.visibility='hidden';
					const pwd_0 = document.createElement('input');
					pwd_0.type = 'hidden';
					pwd_0.name = 'pwd1';
					pwd_0.value = pwd1;
					const user_0 = document.createElement('input');
					user_0.type = 'hidden';
					user_0.name = 'user';
					user_0.value = user;
					form.appendChild(pwd_0);
					form.appendChild(user_0);
					document.body.appendChild(form);
					form.submit();
				}
			}
			function gohome()
			{
				window.location.replace('main.php');
			}
		</script>
	</head>
	<body>
		<div class = "login-form">
			<big><big>Stock Manager</big></big>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<big>Select User ID</big><br><br>
			<select name = "user" id = "user">
				<option value=""></option>
				<?php
					for($i = 0;$i<count($managers);$i++)
					{
						echo "<option value='".$managers[$i]."'>".$managers[$i]."</option>";
					}
				?>
			</select><br>
			<big>Enter password</big><br><br>
			<input type="password" id="pwd1" name="pwd1"><br><br>
			<button type="button" onclick="checkpwd()" class = "btn2">
				Submit
			</button>&nbsp &nbsp
			<button class = "btn2" type="button" onclick="gohome()" >
				Go Back
			</button><br><br>
			<div id="wrong"style="background:rgba(250,26,20,1);display:none;">
				Incorrect password; try again
			</div>
		</div>
	</body>
</html>