<html>
<body >
<div id='tables' style='background:white;padding:30px'>
<h1> Inventory Manager </h1><h3>Stats Tables</h3>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<?php
	if(empty($_POST))
		header('location: ../access.php');
	session_start();
	
	$link=mysqli_connect("localhost","root","","inventory");

	echo "Start date: ".$_POST['stdate']."<br>End date: ".$_POST['endate']."<br><br>";
	$query="select sum(bill.amt), bill.id, orders.date_ordered from bill inner join orders on orders.bill_id=bill.id group by orders.date_ordered;";
	$results=mysqli_query($link,$query);
	$total=0;
	$rows=0;
	$date_ordered = array();
	$sales = array();
	$products = array();
	$orders = array();
	echo "
		<table >
			<thead><tr>
				<th >Date</th>
				<th >Total sales (Rs.) </th>
			</tr></thead><tbody>
			";
	while($result_array=mysqli_fetch_assoc($results))
	{
		$str1=$result_array['date_ordered'];
		$str2=$result_array['sum(bill.amt)'];
		if(strcmp($_POST['stdate'],$str1)<=0 && strcmp($str1,$_POST['endate'])<=0)
		{
			array_push($date_ordered,$result_array['date_ordered']);
			array_push($sales,$result_array['sum(bill.amt)']);
			$total+=(float)$str2;
			$rows+=1;
			echo "<tr><td >".$str1."</td><td>".$str2."</td></tr>";
		}
	}
	echo "</tbody></table>";
	if($rows>0)
	{
		echo "<div ><big>Avg sales: Rs. ".number_format($total/$rows,2)."</big></div>";
		echo "<div ><big>Total sales: Rs. ".number_format($total,2)."</big></div>";
	}
	else
	{
		echo "<div >There was no sale in this period</div>";
	}
	echo "<br><br>";
	
	
	$query = "select STOCK.name,SUM(ORDERS.quantity),STOCK.sp_per_unit from ORDERS inner join STOCK on ORDERS.product_id=STOCK.id";
	$query = $query." where ORDERS.date_ordered<='".$_POST['endate']."' and ORDERS.date_ordered>='".$_POST['stdate'];
	$query = $query."' group by STOCK.id order by sum(ORDERS.quantity) DESC;";
	$results2 = mysqli_query($link,$query);
	echo "<table >
			<thead><tr>
				<th '>Product</th>
				<th >Units sold </th>
				<th >S.P. per unit (Rs.) </th>
			</tr></thead><tbody>";
	while($result_array = mysqli_fetch_assoc($results2))
	{
		$str1 = $result_array['name'];
		$str2 = $result_array['SUM(ORDERS.quantity)'];
		$str3 = $result_array['sp_per_unit'];
		array_push($products,$result_array['name']);
		array_push($orders,$result_array['SUM(ORDERS.quantity)']);
		echo "<tr><td >".$str1."</td><td>".$str2."</td>
				<td >".$str3."</td>
				</tr>";
		
	}
	echo "</tbody></table>";
?>
	</div>
	<div id="graph" width='60%'style='display:inline-block;background:white;padding-left:10px;padding:right:30px'>
		<h1>Inventory Manager</h1><h3>Graphs</h3>
		<?php
			echo "Start date: ".$_POST['stdate']."<br>End date: ".$_POST['endate']."<br><br>";
		?>
		<canvas id="salesByDate" height="500" width='600'style="border:1px solid #000000;background:white">
		</canvas><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<canvas id="salesByProduct" height="500" width='600' style="border:1px solid #000000;background:white">
		</canvas>
	</div>
	
	<script>
		
		//https://code.tutsplus.com/tutorials/how-to-draw-bar-charts-using-javascript-and-html5-canvas--cms-28561
		
		var date_ordered = <?php echo json_encode($date_ordered);?>;
		var sales = <?php echo json_encode($sales);?>;
		
		var width = sales.length*15+50;
		//document.getElementById('salesByDate').style.width = width;
		
		var c = document.getElementById("salesByDate");
		var ctx = c.getContext("2d");
		ctx.lineWidth = 0;
		ctx.strokeStyle= 'black';
		ctx.moveTo(15, 490);
		ctx.lineTo(15, 15);
		ctx.stroke();
		ctx.moveTo(15, 490);
		ctx.lineTo(585, 490);
		ctx.stroke();
		ctx.font = '15px Arial';
		ctx.fillText('Sales',0,12);
		ctx.fillText('Dates',200,500);
		
		
		
		
		//var date_ordered = ['2020-1-18','2020-2-18','2020-3-18','2020-4-18','2020-5-18','2020-6-18'];
		//var sales = [2000000,3000000,4000000,950000,700000,999999];
		var i;
		if(sales.length>0)
		{
			var maxval = 0;
			for(i=0;i<sales.length;i++)
			{
				if(parseInt(sales[i])>maxval)
					maxval=parseInt(sales[i]);
			}
			
			var cnst=1;
			if(maxval>480 && maxval<1000)
				cnst = 3;
			else if(maxval<5000)
				cnst = 6;
			else if(maxval<10000)
				cnst=25;
			else if(maxval<25000)
				cnst=50;
			else if(maxval<50000)
				cnst=115;
			else if(maxval<1000000)
				cnst=2300;
			else
				cnst = 9800;
			
			for(i=0;i<sales.length;i++)
			{
				var height = parseInt(sales[i])/cnst;
				ctx.rect(20+i*15,500-(height+10), 10, height);
				ctx.fillStyle = "#8ED6FF";
				ctx.fill();
				ctx.lineWidth = 1;
				ctx.strokeStyle = "black";
				ctx.stroke();
			}
			ctx.save();
			ctx.translate(0,500);
			ctx.rotate(-0.5*Math.PI);
			
			var x=3;
			while(x>0)
			{
				for(i=0;i<date_ordered.length;i++)
				{
					var height = parseInt(sales[i])/cnst;
					ctx.font = '12px Cambria';
					ctx.fillStyle = "black";
					ctx.fillText(date_ordered[i],height+12,30+i*15);
				}
				x-=1;
			}
			ctx.restore();
			x=3;
			while(x>0)
			{
				i=490;
				while(i>10)
				{
					ctx.moveTo(12,i);
					ctx.lineTo(17,i);
					ctx.stroke();
					if((490-i)%50==0)
					{
						ctx.font = '10px Arial';
						ctx.fillStyle = "black";
						ctx.fillText(490-i,0,i);
					}
					i=i-10;
				}
				x-=1;
			}
			ctx.font = '15px Cambria';
			ctx.fillStyle = "black";
			var scale = ("Y axis scale: × ₹").concat((10*cnst).toString(10));
			ctx.fillText(scale,width-20,10);
			ctx.save();
		}
		else{
			ctx.font = '15px Cambria';
			ctx.fillStyle = "black";
			var scale = "No data";
			ctx.fillText(scale,100,100);
			ctx.save();
		}
		
		var products = <?php echo json_encode($products);?>;
		var orders = <?php echo json_encode($orders);?>;
		width = orders.length*15+50;
		//document.getElementById('salesByProduct').style.width = width;
		var c2 = document.getElementById("salesByProduct");
		var ctx2 = c2.getContext("2d");
		ctx2.lineWidth = 0;
		ctx2.strokeStyle= 'black';
		ctx2.moveTo(15, 490);
		ctx2.lineTo(15, 15);
		ctx2.stroke();
		ctx2.moveTo(15, 490);
		ctx2.lineTo(585, 490);
		ctx2.stroke();
		ctx2.font = '15px Arial';
		ctx2.fillText('Orders',0,12);
		ctx2.fillText('Product-Name',200,500);
		
		if(orders.length>0)
		{
			var maxval = 0;
			for(i=0;i<orders.length;i++)
			{
				if(parseInt(orders[i])>maxval)
					maxval=parseInt(orders[i]);
			}
			
			var cnst2 = 1;
			if(maxval<=10)
				cnst2=40;
			else if(maxval<=40)
				cnst2=10;
			else if(maxval<=100)
				cnst2=4;
			else if(maxval<=200)
				cnst2=2;
			
			for(i=0;i<orders.length;i++)
			{
				var height = parseInt(orders[i])*cnst2;
				ctx2.rect(20+i*15,500-(height+10), 10, height);
				ctx2.fillStyle = "pink";
				ctx2.fill();
				ctx2.lineWidth = 1;
				ctx2.strokeStyle = "black";
				ctx2.stroke();
			}
			ctx2.save();
			ctx2.translate(0,500);
			ctx2.rotate(-0.5*Math.PI);
			x=3;
			while(x>0)
			{
				for(i=0;i<products.length;i++)
				{
					var height = parseInt(orders[i])*cnst2;
					ctx2.font = '12px Cambria';
					ctx2.fillStyle = "black";
					ctx2.fillText(products[i],height+12,30+i*15);
				}
				x-=1;
			}
			
			ctx2.restore();
			
			x=3;
			while(x>0){
				i=490;
				var count=0;
				while(i>10)
				{
					ctx2.moveTo(12,i);
					ctx2.lineTo(17,i);
					ctx2.stroke();
					ctx2.font = '10px Arial';
					ctx2.fillStyle = "black";
					ctx2.fillText(count,0,i);
					count+=1;
					i=i-cnst2;
				}
				x-=1;
			}
			ctx2.font = '15px Cambria';
			ctx2.fillStyle = "black";
			var scale = "Y axis: 1 division => 1 unit";
			ctx2.fillText(scale,width-20,10);
			ctx2.save();
		}
		else{
			ctx2.font = '15px Cambria';
			ctx2.fillStyle = "black";
			var scale = "No data";
			ctx2.fillText(scale,100,100);
			ctx2.save();
		}
		
		
		$(document).ready(function(){
			var d = new Date();
			var name2 = "graph_"+d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()+".pdf";
			var options = {pagesplit: true};
			var pdf2 = new jsPDF('p', 'pt', 'a4');
			pdf2.addHTML($("#graph"), 10,20,options, function() {
				pdf2.save(name2);
			});
			
			var name = "<title>stats_"+d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()+"</title>";
			var div1 = document.getElementById("tables").innerHTML;
			var win = window.open('', '', 'height=700,width=700');
			win.document.write('<html><head>');
			win.document.write(name);   // <title> FOR PDF HEADER.
			win.document.write('</head>');
			win.document.write('<body>');
			win.document.write(div1);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
			win.document.write('</body></html>');

			win.document.close(); 	// CLOSE THE CURRENT WINDOW.

			win.print();    // PRINT THE CONTENTS.
			win.close();	
			setTimeout(() => {  window.location.replace('../main.php'); }, 100);
			
		});
	</script>
</body>
</html>