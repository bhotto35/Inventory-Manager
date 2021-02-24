<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			if(!isset($_SESSION['godw_pwd']))
			{
				echo "<script> window.location.replace('main.php');</script>";
			}
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Database did not connect');
			}
			$pwd=$_SESSION['godw_pwd'];
			$query1="select * from godown;";
			if($is_query_run=mysqli_query($link,$query1))
			{
				echo '<table cellpadding="5px" id="godown" name="godown" class="tbl" align="center" >
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="5">GODOWN</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Location</td>
						<td>Manager ID</td>
						<td>Capacity</td>
						<td></td>
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['location']."</td>";
					echo "<td>".$query_executed['manager']."</td>";
					echo "<td>".$query_executed['capacity']."</td>";
					$str = "<td>
						<form action='godown_action.php' method='post'>
						<input type='text' name='id' value='".$query_executed['id']."' hidden>
						<input type='text' name='formtype' value='delete' hidden>
						<button type='submit' class='btn'>Delete</button></form></td>
					";
					echo $str;
					echo "</tr>";
				}
				echo '</table>';
			}
		?>
		<title> Godown Manager </title>
		<link rel="stylesheet" href="styles.css">
		<script>
			var x=0;
			var search =0;
			function godlogout()
			{
				window.location.replace('godown_logout.php');
			}
			function logout()
			{
				window.location.replace('logout.php');
			}
			function view()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('godownfound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				if(x==0)
				{document.getElementById('godown').style.visibility="visible";
				x=1;}
				else{
					document.getElementById('godown').style.visibility="hidden";
					x=0;
				}
			}
			/*function delform()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('godown').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				if(x==0)
				{
					document.getElementById('delete').style.visibility="visible";
					x=1;
				}
				else
				{
					document.getElementById('delete').style.visibility="hidden";
					x=0;
				}
			}*/
			function insform()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('godown').style.visibility="hidden";
				document.getElementById('godownfound').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				if(x==0)
				{
					document.getElementById('insert').style.visibility="visible";
					x=1;
				}
				else
				{
					document.getElementById('insert').style.visibility="hidden";
					x=0;
				}
			}
			function updform()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('godown').style.visibility="hidden";
				document.getElementById('godownfound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				if(x==0)
				{
					document.getElementById('update').style.visibility="visible";
					x=1;
				}
				else
				{
					document.getElementById('update').style.visibility="hidden";
					x=0;
				}
			}
			function changePasswordMenu()
			{
				document.getElementById('godown').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('oldpwd').value='';
				document.getElementById('newpwd').value='';
				document.getElementById('confpwd').value='';
				if(x==0)
				{
					document.getElementById('pwdchange').style.display="block";
					x=1;
				}
				else
				{
					document.getElementById('pwdchange').style.display="none";
					document.getElementById('new_wrong').style.display="none";
					document.getElementById('old_wrong').style.display="none";
					x=0;
				}
			}
			function validatePassword()
			{
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				var f=0;
				var old0="<?php echo $pwd;?>";
				var old=document.getElementById('oldpwd').value;
				var new1=document.getElementById('newpwd').value;
				var new2=document.getElementById('confpwd').value;
				if(old0!=old)
				{
					document.getElementById('old_wrong').style.display="block";
					document.getElementById('oldpwd').value='';
					document.getElementById('newpwd').value='';
					document.getElementById('confpwd').value='';
					f=1;
				}
				if(new1!=new2||new1==''||new2=='')
				{
					document.getElementById('new_wrong').style.display="block";
					document.getElementById('oldpwd').value='';
					document.getElementById('newpwd').value='';
					document.getElementById('confpwd').value='';
					f=1;
				}
				if(f==0)
				{
					const form = document.createElement('form');
					form.method = "post";
					form.action = "godown_changepwd.php";
					form.style.visibility='hidden';
					const pwd=document.getElementById('confpwd');
					form.appendChild(pwd);
					document.body.appendChild(form);
					form.submit();
				}
			}
			function srchform()
			{
				//console.log(search);
				//document.getElementById('search').style.display='block';
				document.getElementById('godownfound').style.visibility='hidden';
				if(search == 0)
				{
					document.getElementById('search').style.display='block';
					search=1;
				}
				else{
					document.getElementById('search').style.display='none';
					search=0;
				}
			}
			function search_()
			{
				
				var flag=0;
				var div=document.getElementById("godownfound");
				div.innerHTML="";
				var rows=document.getElementById("godown").rows.length;
				var cols = document.getElementById("godown").rows[1].cells.length;
				var table=document.createElement("table");
				table.border="1";
				table.cellpadding="1";
				
				var index=parseInt(document.getElementById('category_').value);
				var keyword=(document.getElementById('keyword_').value).toLowerCase();
				var i=0;
				var j=0;
				var row0=document.createElement("tr");
				row0.style.fontWeight="bold";
				var headers=["ID", "Location","Manager ID","Capacity"];
				
				for(j=0;j<cols-1;j++)
				{
					var cell=document.createElement("td");
					cell.innerHTML=headers[j];
					row0.appendChild(cell);
				}
				table.appendChild(row0);
				
				//var row=document.createElement("tr");
				for(i=2;i<rows;i++)
				{
					var x_=(document.getElementById("godown").rows[i].cells.item(index).innerHTML).toLowerCase();
					if(x_.includes(keyword))
					{
						var row=document.createElement("tr");
						for(j=0;j<cols-1;j++)
						{
							var cell=document.createElement("td");
							cell.innerHTML=document.getElementById("godown").rows[i].cells.item(j).innerHTML;
							row.appendChild(cell);
							console.log(cell);
						}
						table.appendChild(row);
						flag=1;
					}
				}
				//var div=document.getElementById("stockfound");
				if(flag==1)
				{	
					div.innerHTML+="<b>Match Found</b><br>";
					div.appendChild(table);	
				}
				else
					div.innerHTML+="<b>No Match Found</b>";
				div.style.visibility="visible";
				document.getElementById('search').style.display='none';
				search=0;
			}
		</script>
	</head>
	<body >
		<header align="center"class="main"style="border-radius:25px 25px 25px 25px">
			<div style = "position:absolute; padding:10px; text-align:center">
				<image src = "company-logo.ico" style = "filter:drop-shadow(0px 0px 4px rgba(213,0,21,1))"height='100' width = "100">
				<br>
				For company 
				<b><big>
				<?php
					$myfile = fopen("company_name.txt", "r") or die("Unable to open file!");
					echo fread($myfile,filesize("company_name.txt"));
					fclose($myfile);
				?>
				</big></b>
			</div>
			<h1 align="center">INVENTORY MANAGER</h1>
			<h2 align="center">Godown Manager</h2>
			<hr>
			<div class = 'main-menubar'>
			<big style="text-shadow:0px">Log out of:</big>&nbsp&nbsp
			<button class="btn"onclick="godlogout()">Godown Manager</button>&nbsp&nbsp
			<button class="btn"onclick="logout()">Inventory</button>&nbsp&nbsp
			</div>
		</header><br>
		<div class="menu" align="center">
			<button class="btn1" onclick="view()"><img src="eye-icon.ico" height="18" width='18'>&nbsp VIEW/DELETE</button><br><br>
			<!--<button class="btn1" onclick="delform()">DELETE</button><br><br>-->
			<button class="btn1" onclick="insform()"><img src="insert.ico">&nbsp INSERT</button><br><br>
			<div>
				<button class="btn1" onclick="srchform()"><img src="find.ico">&nbsp FIND</button><br><br>
				<div id='search'class = "find">
					<table><tr>
					<td>Enter keyword:</td><td> <input type='text' id='keyword_'></td></tr>
					<tr><td>Choose category:</td><td> <select id='category_' type='number'>
						<option value='0'>ID</option>
						<option value='1'>Location</option>
						<option value='2'>Manager ID</option>
					</select></td></tr>
					</table>
					<div style='text-align:center'><button type='button' class='btn'onclick='search_()'>Filter</button></div>
				</div>
			</div>
			<button class="btn1" onclick="updform()"><img src="update.ico">&nbsp UPDATE</button><br>
		</div>
		<div id="godownfound" style="position:absolute;background:white;left:200px;top:250px;padding:10px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden"> 
			
		</div>
		
		<!--PASSWORD CHANGE-->
		
		<div style="position:absolute;width:300px;padding:5px;right:15px;top:180px;background:lawngreen">
			<a href="javascript:changePasswordMenu()" align="center">Change password</a>
			<div id="pwdchange" name="pwdchange" class='password'style="display:none">
				<table>
				<tr>
					<td>Enter old password:</td><td><input type="password" id="oldpwd" name="oldpwd"></td>
				</tr>
				<tr>
					<td>Enter new password:</td><td><input type="password" id="newpwd" name="newpwd"></td>
				</tr>
				<tr>
					<td>Confirm password:</td><td><input type="password" id="confpwd" name="confpwd"></td>
				</tr>
				</table>
				<div align="center"><button class= 'btn'onclick="validatePassword()">Change Password</button></div>
				<div class="wrongpwd" id="old_wrong" name="old_wrong">Old password is incorrect</div>
				<div class="wrongpwd" id="new_wrong" name="new_wrong">New passwords should match and can't be empty</div>
			</div>
		</div>
		
		
		
		<!--INSERT-->
		
		
		<div id="insert"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> INSERT into GODOWN </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="insert"action="godown_action.php" method="post">
			<table>
				<tr><td>Unique ID :</td><td><input type="text" name="id" ></td></tr>
				<tr><td>Location* :</td><td><input type="text" id="location" name="location" required></td></tr>
				<tr><td>Manager ID* :</td><td><input type="text" id="manager" name="manager" required></td></tr>
				<tr><td>Capacity* :</td><td><input type="number" id="capacity" name="capacity" required></td></tr>
			</table>
			<input type="text" name="formtype" value="insert" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Insert Record</button></div><br></form>
			*required
		</div>
		
		
		<!--UPDATE-->
		
		<div id="update"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> UPDATE record of GODOWN </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="update"action="godown_action.php" method="post">
			<table>
				<tr><td>Unique ID* :</td><td><input type="text" name="id" required></td></tr>
				<tr><td>Location :</td><td><input type="text" name="location" ></td></tr>
				<tr><td>Manager :</td><td><input type="text" name="manager" ></td></tr>
				<tr><td>Capacity :</td><td><input type="text" name="capacity" ></td></tr>
			</table>
			<input type="text" name="formtype" value="update" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Update Record</button></div><br></form>
			*required
		</div>
	</body>
</html>