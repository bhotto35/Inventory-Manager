<html>
	<head>
		<script src="../jquery-3.5.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
		
	</head>
	<body>
		<div id="tables" style='border:1px solid black;display:inline-block;padding:5px;'>
		<style>
			 table { page-break-inside:auto }
			tr{ page-break-inside:avoid; page-break-after:auto }
			thead { display:table-header-group;page-break-after:auto }
			th{width:40px}
			tfoot { display:table-footer-group }
		</style>
		<?php
			session_start();
			if(!isset($_SESSION['pwd']))
			{
				header('location: access.php');
			}
			if(empty($_POST))
			{
				echo "<script>
					alert('No table was selected');
					window.location.replace('main.php');
				</script>";
			}
			$link = mysqli_connect("localhost","root","","inventory");
			$query1 ="select * from outward;";
			$query2 = "select * from stock;";
			$query3 = "select * from inwards;";
			$query4 = "select * from bill;";
			$query5 = "select * from orders";
			$query6 = "select id, name, phone, email from customer;";
			$query7 = "select * from godown;";
			$query8 = "select * from employee;";
			if(isset($_POST['stock']))
			{
				$r2 = mysqli_query($link,$query2);
				echo "<h2>STOCK</h2><br><table id = 'stock'>
					<thead>
					<tr style='background:rgba(249,221,30,1)'>
					<th>ID</th>
					<th>Name</th>
					<th>C.P.</th>
					<th>S.P </th>
					<th>Units</th>
					<th>Threshold Units</th>
					<th>Godown ID</th>
					<th>Remarks</th>
					</tr></thead><tbody>
					
				";
				while($ra2=mysqli_fetch_assoc($r2))
				{
					echo "<tr>";
					echo "<td>".$ra2['id']."</td>";
					echo "<td>".$ra2['name']."</td>";
					echo "<td>".$ra2['cp_per_unit']."</td>";
					echo "<td>".$ra2['sp_per_unit']."</td>";
					echo "<td>".$ra2['units']."</td>";
					echo "<td>".$ra2['threshold']."</td>";
					echo "<td>".$ra2['godown_id']."</td>";
					echo "<td>".$ra2['remarks']."</td>";
					echo "</tr>";
				}
				echo '</tbody></table><br><br><br>';
			}
			if(isset($_POST['outwards']))
			{
				$r1 = mysqli_query($link,$query1);
				echo "<h2>OUTWARDS</h2><br><table id = 'outwards'><thead>
					<tr style='background:rgba(249,221,30,1)'>
					<th>ID</th>
					<th>Product ID</th>
					<th>Qty</th>
					<th>Bill</th>
					<th>Date</th></tr></thead><tbody>
					
				";
				while($ra1 = mysqli_fetch_assoc($r1))
				{
					echo "<tr>";
					echo "<td>".$ra1['id']."</td>";
					echo "<td>".$ra1['product_id']."</td>";
					echo "<td>".$ra1['quantity']."</td>";
					echo "<td>".$ra1['bill_id']."</td>";
					echo "<td>".$ra1['outward_date']."</td>";
					echo "</tr>";
				}
				echo "</tbody></table><br><br><br>";
			}
			
			
			if(isset($_POST['inwards']))
			{
				$is_query_run=mysqli_query($link,$query3);
				echo '<h2>INWARDS</h2><br>
					<table cellpadding="5px" id = "inwards">
						<thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>P_ID</th>
						<th>Invoice</th>
						<th>Product</th>
						<th>Supplier</th>
						<th>S_phone</th>
						<th>S_Email</th>
						<th>Date</th>
						<th>Qty</th>
						</tr></thead><tbody>
						';
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
				echo '</tbody></table><br><br><br>';
			}
			
			
			if(isset($_POST['bill']))
			{
				$is_query_run=mysqli_query($link,$query4);
				echo '<h2>BILL</h2><br>
					<table cellpadding="5px" id = "bill"><thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>Cust_ID</th>
						<th>Status</th>
						<th>Method</th>
						<th>Amount (Rs.)</th></tr></thead><tbody>
						
						';
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
				echo '</tbody></table><br><br><br>';
			}
			
			
			if(isset($_POST['orders']))
			{
				$is_query_run=mysqli_query($link,$query5);
				echo '<h2>ORDERS</h2><br>
					<table cellpadding="5px" id = "orders"><thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>Bill</th>
						<th>ProdID</th>
						<th>Qty</th>
						<th>Date</th>
						<th>Status</th></tr></thead><tbody>
						';
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
				echo '</tbody></table><br><br><br>';
			}
			
			
			if(isset($_POST['customer']))
			{
				$is_query_run=mysqli_query($link,$query6);
				echo '<h2>CUSTOMER</h2><br>
					<table cellpadding="5px" id = "customer"><thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Email</th></tr></thead><tbody>
						';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['name']."</td>";
					echo "<td>".$query_executed['phone']."</td>";
					echo "<td>".$query_executed['email']."</td>";
					echo "</tr>";
				}
				echo '</tbody></table><br><br><br>';
			}
			
			
			if(isset($_POST['godowns']))
			{
				$is_query_run=mysqli_query($link,$query7);
				echo '<h2>GODOWNS</h2><br>
					<table cellpadding="5px" id = "godowns"><thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>Location</th>
						<th>ManagerID</th>
						<th>Capacity</th>
						</tr></thead><tbody>
						';
				while($query_executed=mysqli_fetch_assoc($is_query_run))
				{
					echo "<tr>";
					echo "<td>".$query_executed['id']."</td>";
					echo "<td>".$query_executed['location']."</td>";
					echo "<td>".$query_executed['manager']."</td>";
					echo "<td>".$query_executed['capacity']."</td>";
					echo "</tr>";
				}
				echo '</tbody></table><br><br><br>';
			}
			
			
			if(isset($_POST['employee']))
			{
				$is_query_run=mysqli_query($link,$query8);
				echo '<h2>EMPLOYEE</h2><br>
					<table cellpadding="5px" id = "employee"><thead>
						<tr style="background:rgba(249,221,30,1)">
						<th>ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Salary</th>
						<th>Joined</th>
						<th>Designation</th></tr></thead><tbody>
						
						';
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
				echo '</tbody>></table><br><br><br>';
			}
		?>
		</div>
		<script>
		$(document).ready(function(){
			var d = new Date();
		var name = "<title>tables_"+d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()+"</title>";
		var div = document.getElementById("tables").innerHTML;
		var win = window.open('', '', 'height=700,width=700');
		win.document.write('<html><head>');
		win.document.write(name);   // <title> FOR PDF HEADER.
		win.document.write('<style>');
		win.document.write('</style>');
		win.document.write('</head>');
		win.document.write('<body>');
		win.document.write(div);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
		win.document.write('</body></html>');

		win.document.close(); 	// CLOSE THE CURRENT WINDOW.

		win.print();    // PRINT THE CONTENTS.
		win.close();
		window.location.replace('main.php');
		});
		</script>
	</body>
</html>