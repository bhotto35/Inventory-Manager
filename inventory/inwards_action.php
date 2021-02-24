<!DOCTYPE html>
<html>
	<body>
		<?php
			session_start();
			if(empty($_POST)|| !isset($_SESSION['user']))
				header('location: access.php');
			$link=mysqli_connect('localhost', 'root', '', 'inventory');
			if(!$link)
				die('Could not connect to database');
			if($_POST['formtype']=='delete')
			{	
				$id=$_POST['id'];
				$query="delete from inwards where id='$id';";
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('record was deleted');
						window.location.replace('inwards.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('record could not be deleted');
						window.location.replace('inwards.php');
					</script>";
				}
			}
			else if($_POST['formtype']=='insert')
			{	
				$product_id=$_POST['product_id'];
				$invoice=$_POST['invoice'];
				$product_name=$_POST['product_name'];
				$supp_name=$_POST['supp_name'];
				$supp_phone=$_POST['supp_phone'];
				$supp_email=$_POST['supp_email'];
				$supp_date=$_POST['supp_date'];
				$quantity=$_POST['quantity'];
				if($supp_date==null)
					$supp_date=date("Y-m-d");
				echo $supp_date;
				$query="insert into inwards(product_id,invoice,product_name,supp_name,supp_phone,supp_email,supp_date,quantity) 
						values('$product_id','$invoice','$product_name','$supp_name','$supp_phone','$supp_email','$supp_date',$quantity);";
				$query1="select units from stock where id='$product_id';";
				$x=mysqli_query($link,$query1);
				$y=mysqli_fetch_assoc($x);
				$units=$y['units']+$quantity;
				$query2="update stock set units=$units where id='$product_id';";
				if(mysqli_query($link,$query)&&mysqli_query($link,$query2))
				{
					echo "<script>
						alert('record was inserted');
						window.location.replace('inwards.php');
					</script>";
				}
				else
				{
					//$x= mysqli_error($link);
					echo "<script>
						alert('record could not be inserted');
						window.location.replace('inwards.php');
					</script>";	
				}
			}
			else if($_POST['formtype']=='update')
			{	
				$id=$_POST['id'];
				$product_id=$_POST['product_id'];
				$invoice=$_POST['invoice'];
				$product_name=$_POST['product_name'];
				$supp_name=$_POST['supp_name'];
				$supp_phone=$_POST['supp_phone'];
				$supp_email=$_POST['supp_email'];
				$query0="select * from inwards where id='$id';";
				if($is_query_run=mysqli_query($link,$query0))
				{
					while($query_executed=mysqli_fetch_assoc($is_query_run))
					{
						if(empty($_POST['product_id']))
							$product_id=$query_executed['product_id'];
						if(empty($_POST['invoice']))
							$invoice=$query_executed['invoice'];
						if(empty($_POST['product_name']))
							$product_name=$query_executed['product_name'];
						if(empty($_POST['supp_name']))
							$supp_name=$query_executed['supp_name'];
						if(empty($_POST['supp_phone']))
							$supp_phone=$query_executed['supp_phone'];
						if(empty($_POST['supp_email']))
							$supp_email=$query_executed['supp_email'];
					}
				}
				
				$query="update stock set product_id='$product_id',
						invoice='$invoice',
						product_name='$product_name',
						supp_name='$supp_name',
						supp_phone='$supp_phone',
						supp_email='$supp_email' where id='$id';";
						
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was updated');
						window.location.replace('stock.php');
					</script>";
				}
				else
				{
					//echo "Hm ".mysqli_error($link);
					echo "<script>
						alert('Record could not be updated');
						window.location.replace('stock.php');
					</script>";
					
				}
			}
			/*echo "<script>
				alert('ok');
				window.location.replace('employee.php');
			</script>";
			else
				echo "<script>
				alert('HMM');
				window.location.replace('employee.php');
			</script>";*/
			
		?>
	</body>
</html>