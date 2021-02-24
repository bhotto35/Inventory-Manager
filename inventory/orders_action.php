<!DOCTYPE html>
<html>
	<body>
		<?php
			if(empty($_POST))
				header('location: access.php');
			session_start();
			$link=mysqli_connect('localhost', 'root', '', 'inventory');
			if(!$link)
				die('Could not connect to database');
			if($_POST['formtype']=='delete')
			{	
				$id=$_POST['id'];
				$query="delete from outward where id='$id';";
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('record was deleted');
						window.location.replace('orders.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('record could not be deleted');
						window.location.replace('orders.php');
					</script>";
				}
			}
			if($_POST['formtype']=='insert')
			{	
				$id0='';
				$id=$_POST['id'];
				$query0="select max(id) from outward;";
				$r = mysqli_query($link,$query0);
				$ra = mysqli_fetch_assoc($r);
				$max_id = $ra['max(id)'];
				if(!isset($_POST['id']))
				{
					if($max_id!=0)
					{
						$id0 = $ra['max(id)']+1;
					}
					else
						$id0 = 100;
				}
				else{
					$q = "select count(id) from outward where id = ".$id.";";
					$r = mysqli_query($link,$q);
					$ra = mysqli_fetch_assoc($r);
					if($ra['count(id)']>=1)
					{
						if($max_id!=0)
						{
							$id0 = $max_id+1;
						}
						else
							$id0 = 100;
					}
					else
						$id0 = $id;
				}
				
				$product_id=$_POST['product_id'];
				$quantity=$_POST['quantity'];
				$bill_id=$_POST['bill_id'];
				$outward_date=$_POST['outward_date'];
				$query="insert into outward values($id0,'$product_id',$quantity,$bill_id,'outward_date');";
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was inserted');
						window.location.replace('orders.php');
					</script>";
				}
				else
				{
					//echo "Hm ".mysqli_error($link);
					echo "<script>
						alert('New record could not be created');
						window.location.replace('orders.php');
					</script>";
					
				}
			}
			if($_POST['formtype']=='update')
			{	
				$id=$_POST['id'];
				$product_id=$_POST['product_id'];
				$quantity=$_POST['quantity'];
				$bill_id=$_POST['bill_id'];
				$outward_date=$_POST['outward_date'];
				$query0="select * from outward where id=$id;";
				$r = mysqli_query($link,$query0);
				$ra = mysqli_fetch_assoc($r);
				
				if(empty($_POST['product_id']))
					$product_id=$ra['product_id'];
				if(empty($_POST['quantity']))
					$quantity=$ra['quantity'];
				if(empty($_POST['bill_id']))
					$bill_id=$ra['bill_id'];
				if(empty($_POST['outward_date']))
					$outward_date=$ra['outward_date'];
				
				//echo $name." ".$phone." ".$email." ".$address." ".$salary." ".$datejoined." ".$designation."<br>";
				$query="update outward set product_id='$product_id',
						quantity=$quantity,
						bill_id=$bill_id,
						outward_date='$outward_date'
						where id='$id';";
				echo $query;
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was updated');
						window.location.replace('outward.php');
					</script>";
				}
				else
				{
					//echo "Hm ".mysqli_error($link);
					echo "<script>
						alert('Record could not be updated');
						window.location.replace('outward.php');
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