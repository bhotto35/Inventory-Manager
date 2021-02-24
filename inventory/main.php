<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<?php
			session_start();
			if(!isset($_SESSION['pwd']))
			{
				header('location: access.php');
			}
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Database did not connect');
			}
			
			$q1 = "select admin_pwd from password";
			$r = mysqli_query($link,$q1);
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['emp_pwd'] = $ra['admin_pwd'];
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['godw_pwd'] = $ra['admin_pwd'];
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['inw_pwd'] = $ra['admin_pwd'];
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['pwd'] = $ra['admin_pwd'];
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['orders_pwd'] = $ra['admin_pwd'];
			$ra = mysqli_fetch_assoc($r);
			$_SESSION['stoc_pwd'] = $ra['admin_pwd'];
			
			$_SESSION['user'] = 'Admin';
			
			
			$query1="select * from employee;";
			$query2="select * from godown;";
			$query3="select * from stock;";
			$query4="select * from inwards;";
			$query5="select id, name, phone, email from customer;";
			$query6="select * from outward;";
			$query7="select * from orders;";
			$query8="select * from bill;";
			$pwd=$_SESSION['pwd'];
			if($is_query_run=mysqli_query($link,$query1))
			{
				echo '<table cellpadding="5px" id="employee" name="employee"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="7">EMPLOYEE</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Name</td>
						<td>Phone</td>
						<td>Email</td>
						<td>Salary</td>
						<td>Date joined</td>
						<td>Designation</td></tr>';
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
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query2))
			{
				echo '<table cellpadding="5px" id="godown" name="godown" class="tbl" align="center" >
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="4">GODOWN</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Location</td>
						<td>Manager ID</td>
						<td>Capacity</td>
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['location']."</td>";
					echo "<td>".$query_executed['manager']."</td>";
					echo "<td>".$query_executed['capacity']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query3))
			{
				echo '<table cellpadding="5px"  id="stock" name="stock" class="tbl" align="center" >
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="8">STOCK</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Name</td>
						<td>C.P. per unit (&#8377)</td>
						<td>S.P per unit (&#8377)</td>
						<td>Units present</td>
						<td>Threshold Units</td>
						<td>Godown ID</td>
						<td>Remarks</td>
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['name']."</td>";
					echo "<td>".$query_executed['cp_per_unit']."</td>";
					echo "<td>".$query_executed['sp_per_unit']."</td>";
					echo "<td>".$query_executed['units']."</td>";
					echo "<td>".$query_executed['threshold']."</td>";
					echo "<td>".$query_executed['godown_id']."</td>";
					echo "<td>".$query_executed['remarks']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query4))
			{
				echo '<table cellpadding="5px" id="inwards" name="inwards" class="tbl" align="center" >
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="10">INWARDS</td>
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
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['product_id']."</td>";
					echo "<td>".$query_executed['invoice']."</td>";
					echo "<td>".$query_executed['product_name']."</td>";
					echo "<td>".$query_executed['supp_name']."</td>";
					echo "<td>".$query_executed['supp_phone']."</td>";
					echo "<td>".$query_executed['supp_email']."</td>";
					echo "<td>".$query_executed['supp_date']."</td>";
					echo "<td>".$query_executed['quantity']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			
			if($is_query_run=mysqli_query($link,$query5))
			{
				echo '<table cellpadding="5px" id="customer" name="customer"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="7">CUSTOMER</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Name</td>
						<td>Phone</td>
						<td>Email</td></tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['name']."</td>";
					echo "<td>".$query_executed['phone']."</td>";
					echo "<td>".$query_executed['email']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query6))
			{
				echo '<table cellpadding="5px" id="outward" name="outward" class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="7">OUTWARDS</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Product ID</td>
						<td>Quantity</td>
						<td>Bill No.</td>
						<td>Outward Date</td></tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['product_id']."</td>";
					echo "<td>".$query_executed['quantity']."</td>";
					echo "<td>".$query_executed['bill_id']."</td>";
					echo "<td>".$query_executed['outward_date']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query7))
			{
				echo '<table cellpadding="5px" id="orders" name="orders"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="7">ORDERS</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Bill No.</td>
						<td>Product ID</td>
						<td>Quantity</td>
						<td>Date of Order</td>
						<td>Order Status</td></tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['bill_id']."</td>";
					echo "<td>".$query_executed['product_id']."</td>";
					echo "<td>".$query_executed['quantity']."</td>";
					echo "<td>".$query_executed['date_ordered']."</td>";
					echo "<td>".$query_executed['order_status']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			if($is_query_run=mysqli_query($link,$query8))
			{
				echo '<table cellpadding="5px" id="bill" name="bill"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="7">BILLS</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Customer ID</td>
						<td>Payment Status</td>
						<td>Payment Method</td>
						<td>Total Amt (&#8377)</td></tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['customer_id']."</td>";
					echo "<td>".$query_executed['pay_status']."</td>";
					if($query_executed['method']=='cod')
						echo "<td>cash on delivery</td>";
					else
						echo "<td>".$query_executed['method']."</td>";
					echo "<td>".$query_executed['amt']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
		?>
		<script src="../jquery-3.5.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
		<script>
			var x=0;
			var statview=0;
			var tableview = 0;
			function logout()
			{
				window.location.replace("logout.php");
			}
			
			function employee()
			{
				hideall();
				document.getElementById('employee').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function godown()
			{
				hideall();
				document.getElementById('godown').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function stock()
			{
				hideall();
				document.getElementById('stock').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function inwards()
			{
				hideall();
				document.getElementById('inwards').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function order()
			{
				hideall();
				document.getElementById('orders').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function outward()
			{
				hideall();
				document.getElementById('outward').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function customer()
			{
				hideall();
				document.getElementById('customer').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function bill()
			{
				hideall();
				document.getElementById('bill').style.visibility="visible";
				tableview = 1;
				document.getElementById('hideall').style.display='inline';
			}
			
			function hideall()
			{
				document.getElementById('bill').style.visibility="hidden";
				document.getElementById('customer').style.visibility="hidden";
				document.getElementById('inwards').style.visibility="hidden";
				document.getElementById('employee').style.visibility="hidden";
				document.getElementById('godown').style.visibility="hidden";
				document.getElementById('stock').style.visibility="hidden";
				document.getElementById('outward').style.visibility="hidden";
				document.getElementById('orders').style.visibility="hidden";
				document.getElementById('statmenu').style.display='none';
				document.getElementById('stats').style.visibility='hidden';
				document.getElementById('getpdf').style.display='none';
				document.getElementById('hideall').style.display='none';
			}
			
			function changePasswordMenu()
			{
				document.getElementById('oldpwd').value='';
				document.getElementById('newpwd').value='';
				document.getElementById('confpwd').value='';
				if(x==0)
				{
					document.getElementById('pwdchange').style.display="block";
					hideall();
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
					form.action = "password_change.php";
					form.style.visibility='hidden';
					const pwd=document.getElementById('confpwd');
					form.appendChild(pwd);
					document.body.appendChild(form);
					form.submit();
				}
			}
			
			function loadmenu()
			{
				document.getElementById('menu').style.display='block';
			}
			
			function disablemenu()
			{
				document.getElementById('menu').style.display='none';
			}
			
			function loadStatMenu()
			{
				document.getElementById('hideall').style.display='none';
				if(statview==0)
				{
					document.getElementById('employee').style.visibility="hidden";
					document.getElementById('godown').style.visibility="hidden";
					document.getElementById('stock').style.visibility="hidden";
					document.getElementById('inwards').style.visibility="hidden";
					document.getElementById('customer').style.visibility="hidden";
					document.getElementById('outward').style.visibility="hidden";
					document.getElementById('orders').style.visibility="hidden";
					document.getElementById('bill').style.visibility="hidden";
					
					document.getElementById('statmenu').style.display='block';
					document.getElementById('stats').style.visibility='hidden';
					statview=1;
				}
				else
				{
					document.getElementById('statmenu').style.display='none';
					document.getElementById('stats').innerHTML='';
					document.getElementById('getpdf').style.display='none';
					statview=0;
				}
			}
			

			function notify(){
				document.getElementById('statmenu').style.display='none';
				document.getElementById('stats').innerHTML='';
				document.getElementById('getpdf').style.display='none';
				hideall();
				if(document.getElementById('notif').style.display=='none')
				{
					statview=0;
					$.ajax({
						url : "list_notific.php",
						type : 'post',
						data: {},
						success: function(data) {
						 $('#notif').html(data);
						 $('#notif').css("display","inline-block");
						 console.log(data);
						 statview=0;
						},
						error: function() {
						 $('#notif').text('An error occurred');
						}
					});
				}
				else{
					$('#notif').css("display","none");
				}
			}
			
			function loadstats(){
				document.getElementById('statmenu').style.display='none';
				$.ajax({
					url : "statistics/avg_sales.php",
					type : 'post',
					data: {"stdate":$('#stdate').val(),"endate":$('#endate').val()},
					success: function(data) {
					 $('#stats').html(data);
					 $('#stats').css("visibility","visible");
					 $('#getpdf').css("display","inline-block");
					 console.log(data);
					 statview=0;
					},
					error: function() {
					 $('#stats').text('An error occurred');
					}
				});
			}
			
			
			$(document).ready(function(){
				$('#pdfbtn').click(function() {
						var d = new Date();
						alert("2 PDFs shall be downloaded:  one for the graphs, another for the tables");
						const form=document.createElement('form');
						form.method='post';
						form.action='statistics/stat_pdf.php';
						const stdate = document.createElement('input');
						stdate.type = 'hidden';
						stdate.name = 'stdate';
						stdate.value = $('#stdate').val();
						form.appendChild(stdate);
						const endate = document.createElement('input');
						endate.type = 'hidden';
						endate.name = 'endate';
						endate.value = $('#endate').val();
						form.appendChild(endate);
						document.body.appendChild(form);
						form.submit();
						
				});
			});
			$(document).ready(function(){
				$('#tablespdf').click(function(){
					if(document.getElementById('select-tables').style.display=='none')
						document.getElementById('select-tables').style.display = 'block';
					else
						document.getElementById('select-tables').style.display = 'none';
				});
			});
		</script>
	</head>
	<title> Inventory Manager </title>
	<body >
	
		<!--===HEADING SECTION===-->
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
			<h2 align="center">Admin page</h2>
			<hr>
			
			<!--===MENUBAR===-->
			
			<div class='main-menubar'>
				<div style="display:inline-block;padding:2px;background:darkgray;border-radius:6px" onmouseenter="loadmenu()" onmouseleave="disablemenu()">
					<big class = "entity-manipulate-label">Manipulate entity</big>
					<div id="menu" onmouseenter="loadmenu()" onmouseleave="disablemenu()"class = "entity-container">
						<div class = "entity" onclick = "window.location.replace('employee.php')">EMPLOYEE</div>
						<div class = "entity" onclick = "window.location.replace('godown.php')">GODOWN</div>
						<div class = "entity" onclick = "window.location.replace('stock.php')">STOCK</div>
						<div class = "entity" onclick = "window.location.replace('inwards.php')">INWARDS</div>
						<div class = "entity" onclick = "window.location.replace('orders.php')">ORDERS</div>
		
					</div>
				</div>&nbsp &nbsp
				
				<!--===NOTIFICATION===-->
				<div style="display:inline-block;">
					<button type = "button" class = "iconbtn" onclick="notify()">
						<img src='bell.ico' width='15' height='15'>
					</button><br>
					<div id="notif" style="background:white;box-shadow:0px 1px 3px 1px black;padding:5px; border:1px solid gray;display:none;position:absolute">
					</div>
				</div>
				<!--==CHANGE PASSWORD===-->
				<div style="text-shadow:none;padding:3px;display:inline-block;">
					<button type = "button" class="btn" onclick="changePasswordMenu()">Change password</button>
					<div id="pwdchange" name="pwdchange" class='password'style="position:absolute;display:none">
						<table>
							<tr>
								<td>Enter old password:</td><td> <input type="password" id="oldpwd" name="oldpwd"></td>
							</tr>
							<tr>
								<td>Enter new password:</td><td> <input type="password" id="newpwd" name="newpwd"></td>
							</tr>
							<tr>
								<td>Confirm password:</td> <td><input type="password" id="confpwd" name="confpwd"></td>
							</tr>
						</table>
						<div align="center"><button class='btn2'onclick="validatePassword()">Change Password</button></div>
						<div class="wrongpwd" id="old_wrong" name="old_wrong">Old password is incorrect</div>
						<div class="wrongpwd" id="new_wrong" name="new_wrong">New passwords should match and can't be empty</div>
					</div>
				</div>
				
				<button class="btn"onclick="logout()">Log out</button>&nbsp
				
				<!--==STATISTICS==-->
				<div style="display:inline-block">
					<button type="button" class='btn'id="statbtn" onclick="loadStatMenu()">Statistics</button>
					<div id="statmenu" style="border:1px solid yellow;text-shadow:none;text-align:left;background:rgba(64,79,81,1);display:none;position:absolute;padding:5px;">
						<b>Date Range</b><br>
							<table>
								<tr>
									<td>Enter start date </td><td><input type="date" name="stdate" id="stdate"></td>
								</tr>
								<tr>
									<td>Enter end date  </td><td><input type="date" name="endate" id="endate"></td>
								</tr>
							</table>
							<div style='text-align:center'><button type="button" class='btn'id="avgsal"onclick="loadstats()">Submit</button></div>
					</div>
				</div>&nbsp
				
				<!--==SELECT TABLES FOR PDF==-->
				<div style = "display:inline-block">
					<button type="button" id="tablespdf" class='btn'>
						Select Tables for PDF
					</button>
					<div id = 'select-tables'
						style = "background:white;text-align:left;position: absolute;font-family: 'Cambria';padding:8px;display:none">
						<form action="alltables.php" method = "post">
							<input type = "checkbox" name = "stock" value = "stock">
								STOCK<hr>
							<input type = "checkbox" name = "outwards" value = "outwards">
								OUTWARDS<hr>
							<input type = "checkbox" name = "inwards" value = "inwards">
								INWARDS<hr>
							<input type = "checkbox" name = "bill" value = "bill">
								BILL<hr>
							<input type = "checkbox" name = "orders" value = "orders">
								ORDERS<hr>
							<input type = "checkbox" name = "customer" value = "customer">
								CUSTOMER<hr>
							<input type = "checkbox" name = "godowns" value = "godowns">
								GODOWNS<hr>
							<input type = "checkbox" name = "employee" value = "employee">
								EMPLOYEE<br><br>
							<div style = "text-align:center">
							<button type = 'submit' class = "btn2" >
								Get PDF
							</button>
							</div>
						</form>
					</div>
				</div>
				&nbsp
				
				<div id='getpdf'style="display:none"><button type="button" id="pdfbtn" class='btn'>Get PDF of Stats</button></div>
				&nbsp
				<div id='hideall'style="display:none"><button type="button" class='btn' onclick = "hideall()">Hide Table</button></div>
				<div id="editor"></div>
			</div>
		</header>
		<!--==DIV TO LOAD STATS INTO==-->
		<div id="stats" style="position:absolute;overflow-y:scroll;height:75%;
					background:white;left:250px;top:220px;padding:10px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden">
			
		</div>
		
		<br>
		<!--===TABLES MENU==-->
		<div class="menu0" align="center" >
			<font style = "font-family:'Cambria';">TABLES</font>
			<hr>
			<button class="btn1" onclick="employee()">EMPLOYEE</button><br><br>
			<button class="btn1" onclick="godown()">GODOWN</button><br><br>
			<button class="btn1" onclick="stock()">STOCK</button><br><br>
			<button class="btn1" onclick="inwards()">INWARDS</button><br><br>
			<button class="btn1" onclick="order()">ORDERS</button><br><br>
			<button class="btn1" onclick="bill()">BILLS</button><br><br>
			<button class="btn1" onclick="outward()">OUTWARDS</button><br><br>
			<button class="btn1" onclick="customer()">CUSTOMER</button><br>
		</div>
		
	</body>
</html>