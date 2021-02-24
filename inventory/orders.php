<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<title> Orders Manager </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	</head>
	<body >
		<?php
			session_start();
			if(!isset($_SESSION['orders_pwd']) || !isset($_SESSION['user']))
			{				
				echo "<script> window.location.replace('main.php');</script>";
				/*if(isset($_SESSION['pwd']))
					
				else
					echo "<script> window.location.replace('access.php');</script>";*/
			}
			$link=mysqli_connect('localhost','root','','inventory');
			if(!$link)
			{
				die('Database did not connect');
			}
			$pwd=$_SESSION['orders_pwd'];
			$query="SELECT orders.*, bill.customer_id, bill.amt FROM orders inner join bill on bill.id = orders.bill_id;";
			if($is_query_run=mysqli_query($link,$query))
			{
				echo '<table id="orders" name="orders"style ="display:none" align="center" >
						<thead>
						<tr >
							<td colspan = "8" >
								ORDERS
							</td>
						</tr>
						<tr>
						<td>ID</td>
						<td>Bill No.</td>
						<td>Product ID</td>
						<td>Quantity</td>
						<td>Date of Order</td>
						<td>Order Status</td>
						<td>Customer ID</td>
						<td>Total Order Amount (&#8377)</td>
						</tr>
						</thead>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr style='visibility:hidden'>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['bill_id']."</td>";
					echo "<td>".$query_executed['product_id']."</td>";
					echo "<td>".$query_executed['quantity']."</td>";
					echo "<td>".$query_executed['date_ordered']."</td>";
					echo "<td>".$query_executed['order_status']."</td>";
					echo "<td>".$query_executed['customer_id']."</td>";
					echo "<td>".$query_executed['amt']."</td>";
					echo "</tr>";
				}
				echo '</table>';
			}
			
			
			$query1="select * from outward;";
			if($is_query_run=mysqli_query($link,$query1))
			{
				echo '<table cellpadding="5px" id="outward" name="outward"class="tbl" align="center">
						<tr style="background:rgba(255,127,39,1)">
						<td style="color:white" align="center" colspan="8">OUTWARDS</td>
						</tr>
						<tr style="background:rgba(249,221,30,1)">
						<td>ID</td>
						<td>Product ID</td>
						<td>Quantity</td>
						<td>Bill No.</td>
						<td>Outward Date</td>
						<td></td>
						</tr>';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['product_id']."</td>";
					echo "<td>".$query_executed['quantity']."</td>";
					echo "<td>".$query_executed['bill_id']."</td>";
					echo "<td>".$query_executed['outward_date']."</td>";
					$str = "<td>
						<form action='orders_action.php' method='post'>
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
			<h2 align="center">Orders Manager</h2>
			<hr>
			<div class = "main-menubar">
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
				<button class="btn"onclick="ordrlogout()">Orders Manager</button>&nbsp&nbsp
				<button class="btn"onclick="logout()">Inventory</button>&nbsp&nbsp
				<big style="text-shadow:0px">Username:
					<?php echo $_SESSION['user']?>
				</big>
			</div>
		</header><br>
		<div class="menu" align="center">
			<div style="padding:5px">
			<button class="btn1" onclick="view()"><img src="eye-icon.ico" height="18" width='18'>&nbsp View ORDERS</button><br><br>
				<div id="viewmenu"style="background:white;position:absolute;border:1px solid yellow; display:none;padding:5px;box-shadow:0px 1px 3px 1px black">
					<table cellpadding="3">
						<tr>
							<td>
								Enter substring/keyword: <br>
								<small>[Enter date in the format yyyy-mm-dd]</small>
							</td>
							<td>
								<input type="text" id="key" name="key"><br><br>
								
							</td>
						</tr>
						<tr>
							<td>
								Choose category:
							</td>
							<td>
								<select id="under">
									<option value="bill">Bill Number has</option>
									<option value="beforedate">Before date</option>
									<option value="afterdate">After date</option>
									<option value="customer">Customer ID has</option>
									<option value="morethan">More Amount than (&#8377)</option>
									<option value="lessthan">Less Amount than (&#8377)</option>
								</select>
							</td>
						</tr>
					</table>
					<br><br>
					<button type="button" id="search" name="search"class="btn">Search</button>
				</div>
			</div>
			<button type = "button" class = "btn1" onclick = "makePDF()"><img src = "download.ico">&nbspGet PDF</button>
			<br><br>
			<button class="btn1" style="text-align:center"onclick="view0()">
				<img src="eye-icon.ico" height="18" width='18'>
				VIEW/DELETE <br>Outward
			</button><br><br>
			<button class="btn1" style="text-align:center"onclick="insform()">
				<img src="insert.ico">&nbsp INSERT Outward
			</button><br><br>
			<button class="btn1" style="text-align:center"onclick="updform()">
				<img src="update.ico">&nbsp UPDATE Outward
			</button>
		</div>
		
		<div id="ordersfound"style="position:absolute;background:white;padding:10px;left:200px;top:200px;
					border-radius:15px;box-shadow:2px 2px 3px darkblue;visibility:hidden"> 
			
		</div>
		
		<!--PASSWORD CHANGE-->
		
		<div style="position:absolute;width:300px;padding:5px;right:15px;top:200px;background:lawngreen">
			<a href="javascript:changePasswordMenu()" align="center">Change password</a>
			<div id="pwdchange" name="pwdchange" class='password' style="display:none">
				<table style='color:white'>
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
			<big> INSERT into OUTWARDS </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="insert"action="orders_action.php" method="post">
			Unique ID :<input type="number" name="id" ><br><br>
			Product ID* :<input type="text" id="product_id" name="product_id" required><br><br>
			Quantity* :<input type="number" id="quantity" name="quantity" required><br><br>
			Bill No.* :<input type="number" id="bill_id" name="bill_id" required><br><br>
			Outward Date* :<input type="date" id="outward_date" name="outward_date" required><br><br>
			<input type="text" name="formtype" value="insert" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Insert Record</button></div><br></form>
			*required
		</div>
		
		<!--UPDATE-->
		
		
		<div id="update"style="visibility:hidden;text-align:left;padding:5px;position: absolute;left:250px;top:200px;background:white;box-shadow:0px 0px 5px 3px yellow;">
			<big> UPDATE record of OUTWARDS </big><br>
			<hr style="border-top:1px solid lightgray;border-bottom:0px solid white">
			<form name="update"action="orders_action.php" method="post">
			Unique ID* :<input type="number" name="id" required><br><br>
			Product ID :<input type="text" id="product_id" name="product_id"><br><br>
			Quantity :<input type="number" id="quantity" name="quantity"><br><br>
			Bill No. :<input type="number" id="bill_id" name="bill_id"><br><br>
			Outward Date :<input type="date" id="outward_date" name="outward_date"><br><br>
			<input type="text" name="formtype" value="update" hidden>
			<div style="text-align:center"><button type="submit" class="btn">Update Record</button></div><br></form>
			*required
		</div>
		
		<script src="../jquery-3.5.1.js"></script>
		<script>
			var filtervals = {"bill":"Bill Number has",
							"beforedate":"Before date",
							"afterdate":"After date",
							"customer":"Customer ID has",
							"morethan":"More Amount than &#8377",
							"lessthan":"Less Amount than &#8377"};
			var x=0;
			function ordrlogout()
			{
				window.location.replace('orders_logout.php');
			}
			function logout()
			{
				window.location.replace('logout.php');
			}
			
			function view0()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('viewmenu').style.display="none";
				document.getElementById('ordersfound').style.visibility="hidden";
				document.getElementById('insert').style.visibility="hidden";
				document.getElementById('update').style.visibility="hidden";
				if(x==0)
				{document.getElementById('outward').style.visibility="visible";
				x=1;}
				else{
					document.getElementById('outward').style.visibility="hidden";
					x=0;
				}
			}
			
			function insform()
			{
				document.getElementById('pwdchange').style.display="none";
				document.getElementById('new_wrong').style.display="none";
				document.getElementById('old_wrong').style.display="none";
				document.getElementById('viewmenu').style.display="none";
				document.getElementById('ordersfound').style.visibility="hidden";
				document.getElementById('outward').style.visibility="hidden";
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
				document.getElementById('viewmenu').style.display="none";
				document.getElementById('ordersfound').style.visibility="hidden";
				document.getElementById('outward').style.visibility="hidden";
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
			
			function view()
			{
				if(x==0)
				{
					document.getElementById('viewmenu').style.display="block";
					document.getElementById('ordersfound').style.visibility="hidden";
					document.getElementById('pwdchange').style.display="none";
					document.getElementById('new_wrong').style.display="none";
					document.getElementById('old_wrong').style.display="none";
					document.getElementById('outward').style.visibility="hidden";
					document.getElementById('insert').style.visibility="hidden";
					document.getElementById('update').style.visibility="hidden";
					//document.getElementById('ordersfound').innerHTML="";
					x=1;
				}
				else
				{
					document.getElementById('viewmenu').style.display="none";
					x=0;
				}
			}
			function changePasswordMenu()
			{
				document.getElementById('ordersfound').style.visibility="hidden";
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
					document.getElementById('new_wrong').style.display="none";;
					document.getElementById('old_wrong').style.display="none";;
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
					form.action = "orders_changepwd.php";
					form.style.visibility='hidden';
					const pwd=document.getElementById('confpwd');
					form.appendChild(pwd);
					document.body.appendChild(form);
					form.submit();
				}
			}
			$('#search').click(function(){
				var found=0;
				document.getElementById('ordersfound').innerHTML="";
				document.getElementById('viewmenu').style.display="none";
				x=0;
				var table=document.createElement('table');
				table.cellPadding = "5";
				table.cellSpacing = "0";
				var x = $('#key').val();
				var i = $('#under').val();
				$('#orders tr').each(function(index, tr){
					var yes=0;
					if(index<=1) // the first two rows are always selected
						yes=1;
					else{
						$(this).children('td').each(function(idx,td){
							
							if(i=='bill'&& idx==1)
							{
								if(($(this).text()).includes(x))
								{
									yes=1;
									found+=1;
								}
							}							
							else if(i=='beforedate'&& idx==4)
							{
								if(x.localeCompare($(this).text())==1)
								{
									console.log(x,$(this).text());
									yes=1;
									found+=1;
								}
							}
							else if(i=='afterdate'&& idx==4)
							{
								if(x.localeCompare($(this).text())==-1)
								{
									yes=1;
									found+=1;
								}
							}
							else if(i=='customer'&& idx==6)
							{
								if(($(this).text()).includes(x))
								{
									yes=1;
									found+=1;
								}
							}
							else if(i=='morethan'&& idx==7)
							{
								if(!isNaN(parseFloat(x)))
								{
									var amt = parseFloat(x);
									if(parseFloat($(this).text())>x)
									{
										yes=1;
										found+=1;
									}
								}
							}
							else if(i=='lessthan'&& idx==7)
							{
								if(!isNaN(parseFloat(x)))
								{
									var amt = parseFloat(x);
									if(parseFloat($(this).text())<x)
									{
										yes=1;
										found+=1;
									}
								}
							}
						}
						)
					}
					if (yes==1)
					{
						var row=document.createElement('tr');
						$(this).children('td').each(function(idx,td){
							var cell=document.createElement('td');
							cell.innerHTML=$(this).text();
							cell.align="center";
							
							if(index==0)
							{
								cell.colSpan="8";
								cell.style.fontWeight = 'bold';
								cell.style.background = 'lightgray';
							}
							else if(index==1)
							{
								cell.style.background = 'darkgray';
								cell.style.color = 'white';
							}
							row.appendChild(cell);
						})
						table.appendChild(row);
					}
				}
				)
				console.log(found);
				if(found==0)
				{
					/*var row=document.createElement('tr');
					var cell=document.createElement('td');
					cell.colSpan="6";
					cell.innerHTML="No results";
					row.appendChild(cell);
					row.style.visibility='visible';
					$('#orders').append(row);*/
					var div= document.getElementById('ordersfound');
					div.innerHTML="no results";
					div.style.visibility="visible";
				}
				else
				{
					var div= document.getElementById('ordersfound');
					var count = found+" entries were found";
					var para = document.createElement("P");
					var t = document.createTextNode(count);
					para.appendChild(t);
					div.appendChild(para);
					div.appendChild(table);
					div.style.visibility="visible";
				}
			}
			);
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
			/*function makePDF()
			{
				var d = new Date();
				var name = "stats_"+d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()+".pdf";
				var pdf = new jsPDF('l', 'pt', 'a4');
				source = $('#ordersfound')[0];

				specialElementHandlers = {
					'#bypassme': function (element, renderer) {
						return true
					}
				};
				margins = {
					top: 50,
					bottom: 50,
					left: 40,
					width:5000,
				};
				pdf.fromHTML(
				source, 
				margins.left, 
				margins.top, { 
					'width': 5000, 
					'elementHandlers': specialElementHandlers,
					'pagesplit':true
				},

				function (dispose) {
					
					pdf.save(name);
				}, margins);
			}*/
			
			function makePDF()
			{
				if(document.getElementById('ordersfound').style.visibility!="hidden")
				{
					var div = document.getElementById("ordersfound").innerHTML;
					var filter = "Filter: "+filtervals[String(document.getElementById('under').value)];
					filter=filter+ " "+ String(document.getElementById('key').value);
					console.log(filter);
					var win = window.open('', '', 'height=700,width=700');
					win.document.write('<html><head>');
					win.document.write('<title>Orders</title>');   // <title> FOR PDF HEADER.
					win.document.write('</head>');
					win.document.write('<body>');
					win.document.write('<p>');
					win.document.write(filter);
					win.document.write('</p>');
					win.document.write(div);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
					win.document.write('</body></html>');

					win.document.close(); 	// CLOSE THE CURRENT WINDOW.

					win.print();    // PRINT THE CONTENTS.
					win.close();
				}
				else
				{
					alert("First create a view from 'View Contents'");
				}
			}
		</script>
	</body>
</html>