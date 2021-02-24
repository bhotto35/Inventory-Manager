<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			if(!isset($_SESSION['emp_pwd']))
			{
				echo "<script> window.location.replace('main.php');</script>";
			}
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Database did not connect');
			}
			$pwd=$_SESSION['emp_pwd'];
			$query1="select * from employee;";
			if($is_query_run=mysqli_query($link,$query1))
			{
				echo '<table cellpadding="5px" id="employee" name="employee"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="8">EMPLOYEE</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Name</td>
						<td>Phone</td>
						<td>Email</td>
						<td>Salary</td>
						<td>Date joined</td>
						<td>Designation</td>
						<td></td>
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['name']."</td>";
					echo "<td>".$query_executed['phone']."</td>";
					echo "<td>".$query_executed['email']."</td>";
					echo "<td>".$query_executed['salary']."</td>";
					echo "<td>".$query_executed['datejoined']."</td>";
					echo "<td>".$query_executed['designation']."</td>";
					$str = "<td>
						<form action='employee_action.php' method='post'>
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
		<title> Employee Manager </title>
		<link rel="stylesheet" href="styles.css">
		<script>
			var search=0;
			var x=0;
			function emplogout()
			{
				window.location.replace('employee_logout.php');
			}
			function logout()
			{
				window.location.replace('logout.php');
			}
			function hideall()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('employeefound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('employee').style.visibility="hidden";
			}
			function view()
			{
				hideall();
				if(x==0)
				{document.getElementById('employee').style.visibility="visible";
				x=1;}
				else{
					x=0;
				}
			}
			function insform()
			{
				hideall();
				if(x==0)
				{
					document.getElementById('insert').style.visibility="visible";
					x=1;
				}
				else
				{
					x=0;
				}
			}
			function updform()
			{
				hideall();
				if(x==0)
				{
					document.getElementById('update').style.visibility="visible";
					x=1;
				}
				else
				{
					x=0;
				}
			}
			function changePasswordMenu()
			{
				hideall();
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
					form.action = "employee_changepwd.php";
					form.style.visibility='hidden';
					const pwd=document.getElementById('confpwd');
					form.appendChild(pwd);
					document.body.appendChild(form);
					form.submit();
				}
			}
			function srchform()
			{
				document.getElementById('employeefound').style.visibility='hidden';
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
				
				hideall();
				var flag=0;
				var div=document.getElementById("employeefound");
				div.innerHTML="";
				var rows=document.getElementById("employee").rows.length;
				var cols = document.getElementById("employee").rows[1].cells.length;
				var table=document.createElement("table");
				table.border="1";
				table.cellpadding="1";
				
				var index=parseInt(document.getElementById('category_').value);
				var keyword=(document.getElementById('keyword_').value).toLowerCase();
				var i=0;
				var j=0;
				var row0=document.createElement("tr");
				row0.style.fontWeight="bold";
				var headers=["ID", "Name","Phone","Email","Salary","Date joined","Designation"];
				
				for(j=0;j<cols-1;j++)
				{
					var cell=document.createElement("td");
					cell.innerHTML=headers[j];
					row0.appendChild(cell);
				}
				table.appendChild(row0);
				
				for(i=2;i<rows;i++)
				{
					var x_=(document.getElementById("employee").rows[i].cells.item(index).innerHTML).toLowerCase();
					if(x_.includes(keyword))
					{
						var row=document.createElement("tr");
						for(j=0;j<cols-1;j++)
						{
							var cell=document.createElement("td");
							cell.innerHTML=document.getElementById("employee").rows[i].cells.item(j).innerHTML;
							row.appendChild(cell);
							console.log(cell);
						}
						table.appendChild(row);
						flag=1;
					}
				}
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
			<h2 align="center">Employee Manager</h2>
			<hr>
			<div class = 'main-menubar'>
				<big style="text-shadow:0px">Log out of:</big>&nbsp&nbsp
				<button class="btn"onclick="emplogout()">Employee Manager</button>&nbsp&nbsp
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
						<td>Enter keyword:<br><small>[Enter date in the format yyyy-mm-dd]</small>
						</td><td> <input type='text' id='keyword_'></td>
					</tr>
					<tr><td>Choose category:</td><td> <select id='category_' type='number'>
						<option value='0'>ID</option>
						<option value='1'>Name</option>
						<option value='2'>Phone</option>
						<option value='3'>Email</option>
						<option value='4'>Salary</option>
						<option value='5'>Date Joined</option>
						<option value='6'>Designation</option>
					</select></td></tr>
					</table>
					<div style='text-align:center'><button type='button' class='btn'onclick='search_()'>Filter</button></div>
				</div>
			</div>
			<button class="btn1" onclick="updform()"><img src="update.ico">&nbsp UPDATE</button><br>
		</div>
		<div id="employeefound" style="position:absolute;background:white;left:200px;top:250px;padding:10px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden"> 
			
		</div>
		
		<!--PASSWORD CHANGE-->
		
		
		<div style="position:absolute;width:300px;padding:5px;right:15px;top:180px;background:lawngreen">
			<a href="javascript:changePasswordMenu()" align="center">Change password</a>
			<div id="pwdchange" name="pwdchange" class='password' style="display:none">
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
			<big> INSERT into EMPLOYEE </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="insert"action="employee_action.php" method="post">
			<table>
				<tr><td>Unique ID :</td><td><input type="text" name="id" ></td></tr>
				<tr><td>Name* :</td><td><input type="text" id="name" name="name" required></td></tr>
				<tr><td>Phone* :</td><td><input type="text" id="phone" name="phone" required></td></tr>
				<tr><td>Email* :</td><td><input type="text" id="email" name="email" required></td></tr>
				<tr><td>Address* :</td><td><input type="text" id="address" name="address" required></td></tr>
				<tr><td>Salary* :</td><td><input type="number" id="salary" name="salary" required></td></tr>
				<tr><td>Date joined* :</td><td><input type="date" id="date" name="date" placeholder="yyyy-mm-dd" required></td></tr>
				<tr><td>Designation* :</td><td><input type="text" id="designation" name="designation" required></td></tr>
			</table>
			<input type="text" name="formtype" value="insert" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Insert Record</button></div><br></form>
			*required
		</div>
		
		<!--UPDATE-->
		
		
		<div id="update"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> UPDATE record of EMPLOYEE </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="update"action="employee_action.php" method="post">
			<table>
				<tr><td>Unique ID* :</td><td><input type="text" name="id" required></td></tr>
				<tr><td>Name :</td><td><input type="text" name="name" ></td></tr>
				<tr><td>Phone :</td><td><input type="text" name="phone" ></td></tr>
				<tr><td>Email :</td><td><input type="text" name="email" ></td></tr>
				<tr><td>Address :</td><td><input type="text" name="address" ></td></tr>
				<tr><td>Salary :</td><td><input type="number" name="salary" ></td></tr>
				<tr><td>Date joined :</td><td><input type="date" name="date" placeholder="yyyy-mm-dd" ></td></tr>
				<tr><td>Designation :</td><td><input type="text" name="designation" ></td></tr>
			</table>
			<input type="text" name="formtype" value="update" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Update Record</button></div><br></form>
			*required
		</div>
	</body>
</html>