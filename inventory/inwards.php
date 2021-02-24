<!DOCTYPE html>
<html>
	<head>
		<?php
			session_start();
			if(!isset($_SESSION['inw_pwd']))
			{
				echo "<script> window.location.replace('main.php');</script>";
			}
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Database did not connect');
			}
			$pwd=$_SESSION['inw_pwd'];
			$query1="select * from inwards;";
			if($r=mysqli_query($link,$query1))
			{
				echo '<table cellpadding="5px" id="inwards" name="inwards" class="tbl" align="center" >
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="11">INWARDS</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Product ID</td>
						<td>Invoice number</td>
						<td>Product name</td>
						<td>Supplier name</td>
						<td>Supplier phone</td>
						<td>Supplier email</td>
						<td>Supply date</td>
						<td>Quantity</td>
						<td></td>
						</tr>';
				while($ra=mysqli_fetch_assoc($r))
				{
					echo "<tr >";
					echo "<td>".$ra['id']."</td>";
					echo "<td>".$ra['product_id']."</td>";
					echo "<td>".$ra['invoice']."</td>";
					echo "<td>".$ra['product_name']."</td>";
					echo "<td>".$ra['supp_name']."</td>";
					echo "<td>".$ra['supp_phone']."</td>";
					echo "<td>".$ra['supp_email']."</td>";
					echo "<td>".$ra['supp_date']."</td>";
					echo "<td>".$ra['quantity']."</td>";
					$str = "<td>
						<form action='inwards_action.php' method='post'>
						<input type='text' name='id' value='".$ra['id']."' hidden>
						<input type='text' name='formtype' value='delete' hidden>
						<button type='submit' class='btn'>Delete</button></form></td>
					";
					echo $str;
					echo "</tr>";
				}
				echo '</table>';
			}
			$query='select * from stock;';
			if($r=mysqli_query($link,$query))
			{
				echo '<table id="stock" hidden>';
				while($ra=mysqli_fetch_assoc($r))
				{
					echo "<tr>";
					echo "<td>".$ra['id']."</td>";
					echo "<td>".$ra['name']."</td>";
					echo "<td>".$ra['cp_per_unit']."</td>";
					echo "<td>".$ra['sp_per_unit']."</td>";
					echo "<td>".$ra['units']."</td>";
					echo "<td>".$ra['threshold']."</td>";
					echo "<td>".$ra['godown_id']."</td>";
					echo "<td>".$ra['remarks']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
		?>
		<title> Inwards Manager </title>
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			var search=0;
			var x=0;
			function inwdlogout()
			{
				window.location.replace('inwards_logout.php');
			}
			function logout()
			{
				window.location.replace('logout.php');
			}
			function view()
			{
				document.getElementById('stockfound').style.visibility='hidden';
				document.getElementById('inwardfound').style.visibility='hidden'
				document.getElementById('pwdchange').display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('inwardfound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('stockfound').style.visibility="hidden";
				if(x==0)
				{document.getElementById('inwards').style.visibility="visible";
				x=1;}
				else{
					document.getElementById('inwards').style.visibility="hidden";
					x=0;
				}
			}
			
			/*function delform()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('inwards').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('stockfound').style.visibility="hidden";
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
				document.getElementById('stockfound').style.visibility='hidden';
				document.getElementById('inwardfound').style.visibility='hidden'
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('inwards').style.visibility="hidden";
				document.getElementById('inwardfound').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('stockfound').style.visibility="hidden";
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
				document.getElementById('stockfound').style.visibility='hidden';
				document.getElementById('inwardfound').style.visibility='hidden'
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('inwards').style.visibility="hidden";
				document.getElementById('inwardfound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('stockfound').style.visibility="hidden";
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
				//document.getElementById('delete').style.visibility="hidden";
				document.getElementById('inwards').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('stockfound').style.visibility="hidden";
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
					form.action = "inwards_changepwd.php";
					form.style.visibility='hidden';
					const pwd=document.getElementById('confpwd');
					form.appendChild(pwd);
					document.body.appendChild(form);
					form.submit();
				}
			}
			function stocfoundnull()
			{
				document.getElementById('stockfound').style.visibility='hidden';
			}
			function searchStoc()
			{
				
				var flag=0;
				var div=document.getElementById("stockfound");
				div.innerHTML="";
				var rows=document.getElementById("stock").rows.length;
				var cols = document.getElementById("stock").rows[0].cells.length;
				var table=document.createElement("table");
				table.border="1";
				table.cellpadding="1";
				
				var index=parseInt(document.getElementById('filter').value);
				var keyword=document.getElementById('find').value;
				var i=0;
				var j=0;
				var row0=document.createElement("tr");
				row0.style.fontWeight="bold";
				var headers=["ID", "Name", "C.P. per unit","S.P. per unit","Units","Godown_ID","Remarks"];
				
				for(j=0;j<cols;j++)
				{
					var cell=document.createElement("td");
					cell.innerHTML=headers[j];
					row0.appendChild(cell);
				}
				table.appendChild(row0);
				
				//var row=document.createElement("tr");
				for(i=0;i<rows;i++)
				{
					var x=document.getElementById("stock").rows[i].cells.item(index).innerHTML;
					if(x.includes(keyword))
					{
						var row=document.createElement("tr");
						for(j=0;j<cols;j++)
						{
							var cell=document.createElement("td");
							cell.innerHTML=document.getElementById("stock").rows[i].cells.item(j).innerHTML;
							row.appendChild(cell);
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
			}
			function srchform()
			{
				//console.log(search);
				//document.getElementById('search').style.display='block';
				document.getElementById('inwardfound').style.visibility='hidden';
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
				var div=document.getElementById("inwardfound");
				div.innerHTML="";
				var rows=document.getElementById("inwards").rows.length;
				var cols = document.getElementById("inwards").rows[1].cells.length;
				var table=document.createElement("table");
				table.border="1";
				table.cellpadding="1";
				
				var index=parseInt(document.getElementById('category_').value);
				var keyword=(document.getElementById('keyword_').value).toLowerCase();
				var i=0;
				var j=0;
				var row0=document.createElement("tr");
				row0.style.fontWeight="bold";
				var headers=["ID", "Product ID","Invoice Number","Product Name","Supplier","Supplier Phone","Supplier Email","Date Delivered",'Quanitity'];
				
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
					var x_=(document.getElementById("inwards").rows[i].cells.item(index).innerHTML).toLowerCase();
					if(x_.includes(keyword))
					{
						var row=document.createElement("tr");
						for(j=0;j<cols-1;j++)
						{
							var cell=document.createElement("td");
							cell.innerHTML=document.getElementById("inwards").rows[i].cells.item(j).innerHTML;
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
			function notify()
			{
				if(document.getElementById('notif').style.display=='none')
					document.getElementById('notif').style.display='inline-block';
				else
					document.getElementById('notif').style.display='none';
			}
			
			$(document).ready(function(){
				$('#notify').click(function(){
						$.ajax({
						url : "notify.php",
						type : 'post',
						data: {"content":$('#content').val(),"action":"insert"},
						success: function(data) {
							var result = data;
							if(result=="1")
								alert('Notification created');
							else
								alert('Notification could not be created');
							document.getElementById('notif').style.display='none';
						},
						error: function() {
						 console.log('something went wrong');
						}
					});
				});
			});
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
			<h2 align="center">Inwards Manager</h2>
			<hr>
			<div class = 'main-menubar'>
				<div style="display:inline-block;">
					<button type = "button" class = "btn" onclick="notify()">
						<img src='bell.ico' width='15' height='15'>
						Create notification
					</button><br>
					<div id="notif" style="background:white;box-shadow:0px 1px 3px 1px black;padding:5px; border:1px solid gray;display:none;position:absolute">
						Enter the content of your notification
						<br>
						<textarea id = "content" name="content" >
						</textarea>
						<br>
						<button type='button' class='btn2' id = 'notify'>
							Notify
						</button>
					</div>
				</div>
				<big style="text-shadow:0px">Log out of:</big>&nbsp&nbsp
				<button class="btn"onclick="inwdlogout()">Inwards Manager</button>&nbsp&nbsp
				<button class="btn"onclick="logout()">Inventory</button>&nbsp&nbsp
				<big style="text-shadow:0px">Username:
					<?php echo $_SESSION['user']?>
				</big>
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
						<option value='0'>Inward ID</option>
						<option value='1'>Product ID</option>
						<option value='2'>Invoice Number</option>
						<option value='3'>Product Name</option>
						<option value='4'>Supplier Name</option>
						<option value='5'>Supplier Phone</option>
						<option value='6'>Supplier Email</option>
						<option value='7'>Supply Date</option>
					</select></td></tr>
					</table>
					<div style='text-align:center'><button type='button' class='btn'onclick='search_()'>Filter</button></div>
				</div>
			</div>
			<button class="btn1" onclick="updform()"><img src="update.ico">&nbsp UPDATE</button><br>
		</div>
		
		<div id="stockfound" style="position:absolute;background:white;left:250px;top:200px;padding:10px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden"> 
			
		</div>
		<div id="inwardfound" style="position:absolute;background:white;left:200px;top:250px;padding:10px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden"> 
			
		</div>
		
		<!--PASSWORD CHANGE-->
		
		
		<div style="position:absolute;height:23px;right:15px;top:180px">
			<div style="background:lawngreen;padding:5px;border:1px solid white">
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
			<div style="background:lawngreen;border:1px solid white">
				<details style="background:white;padding:5px">
					<summary style="background:lightgray;padding:3px" onclick="stocfoundnull()">Search Stock Items</summary><br>
					Enter keyword : &nbsp <input type="text" id="find" name="find">&nbsp &nbsp <br><br>
					Under : &nbsp <select id="filter">
						<option value="0">ID</option>
						<option value="1">Name</option>
						<option value="5">Godown ID </option>
					</select>
					<button class="btn"type="button" onclick="searchStoc()">Find Match</button></details>
			</div>
		</div>
		<!--DELETE-->
		
		
		<!--<div id="delete"style="visibility:hidden;text-align:center;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> DELETE from INWARDS </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			Enter unique ID of record to be deleted:<br><br><form name="delete"action="inwards_action.php" method="post">
			<input type="text" id="id0" name="id" required><br><br>
			<input type="text" name="formtype" value="delete" hidden>
			<button type="submit" class="btn">Delete Record</button></form>
		</div>-->
		
		
		<!--INSERT-->
		
		
		<div id="insert"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> INSERT into INWARDS </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="insert"action="inwards_action.php" method="post">
			<table cellspacing="10">
			<tr><td>Product ID* :</td><td><input type="text" name="product_id" required></td></tr>
			<tr><td>Invoice Number* :</td><td><input type="text" name="invoice" required></td></tr>
			<tr><td>Product Name* :</td><td><input type="text" name="product_name" required></td></tr>
			<tr><td>Supplier Name* :</td><td><input type="text" name="supp_name" required></td></tr>
			<tr><td>Supplier Phone* :</td><td><input type="text" name="supp_phone" required></td></tr>
			<tr><td>Supplier Email* :</td><td><input type="text" name="supp_email"required></textarea></td></tr>
			<tr><td>Supply Date :</td><td><input type="date" name="supp_date" ></td></tr>
			<tr><td>Quantity* :</td><td><input type="number" name="quantity" required></td></tr>
			</table>
			<input type="text" name="formtype" value="insert" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Insert Record</button></div><br></form>
			*required
		</div>
		
		
		<!--UPDATE-->
		
		<div id="update"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> UPDATE record of INWARDS </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="update"action="inwards_action.php" method="post">
			<table cellspacing="10">
			<tr><td>Unique ID* :</td><td><input type="text" name="id" required></td></tr>
			<tr><td>Product ID :</td><td><input type="text" name="product_id" ></td></tr>
			<tr><td>Invoice Number :</td><td><input type="text" name="invoice" ></td></tr>
			<tr><td>Product Name :</td><td><input type="number" name="product_name" ></td></tr>
			<tr><td>Supplier Name :</td><td><input type="text" name="supp_name" ></td></tr>
			<tr><td>Supplier Phone :</td><td><input type="text" name="supp_phone" ></td></tr>
			<tr><td>Supplier Email :</td><td><input type="text" name="supp_email"></textarea></td></tr>
			</table>
			<input type="text" name="formtype" value="update" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Update Record</button></div><br></form>
			*required<br>
			[Supply Date and Quantity of Inward cannot be updated directly]
		</div>
	</body>
</html>