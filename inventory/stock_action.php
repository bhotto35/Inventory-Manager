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
				$query="delete from stock where id='$id';";
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('record was deleted');
						window.location.replace('stock.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('record could not be deleted');
						window.location.replace('stock.php');
					</script>";
				}
			}
			else if($_POST['formtype']=='insert')
			{	
				$id_tobemade=0;
				$id0='';
				$id=$_POST['id'];
				$query0="select max(id) from stock;";
				if ($is_query_run = mysqli_query($link,$query0)) 
				{ 
					while ($query_executed = mysqli_fetch_assoc ($is_query_run))
					{
						$id0=$query_executed['max(id)'];
						echo $id0."hm".$id." hm<br>";
						if($id0==$id||$id==null)
							$id_tobemade=1;	
					} 
				} 
				else
				{
					die('Error in query execution');
				}
				if($id_tobemade==1)
				{
					$id1=(int)$id0+1;
					//echo $id1."<br>";
					$id=(string)$id1;
					$zeroes=5-strlen($id);
					$zero='';
					$i=1;
					for($i=1;$i<=$zeroes;$i++)
						$zero=$zero.'0';
					$id=$zero.$id; 
				}
				$name=$_POST['name'];
				$cp_per_unit=$_POST['cp_per_unit'];
				$sp_per_unit=$_POST['sp_per_unit'];
				$units=0;
				$threshold = $_POST['threshold'];
				$godown_id=$_POST['godown_id'];
				$remarks=$_POST['remarks'];
				$query="insert into stock values('$id','$name',$cp_per_unit,$sp_per_unit,$units,$threshold,'$godown_id','$remarks');";
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was inserted');
						window.location.replace('stock.php');
					</script>";
				}
				else
				{
					$x= mysqli_error($link);
					/*echo "<script>
						alert('".$x."');
						window.location.replace('stock.php');
					</script>";*/
					echo $x;
					
				}
			}
			else if($_POST['formtype']=='update')
			{	
				$id=$_POST['id'];
				$name=$_POST['name'];
				$cp_per_unit=$_POST['cp_per_unit'];
				$sp_per_unit=$_POST['sp_per_unit'];
				$units=0;
				$threshold = $_POST['threshold'];
				$godown_id=$_POST['godown_id'];
				$remarks=$_POST['remarks'];
				$query0="select * from stock where id='$id';";
				if($is_query_run=mysqli_query($link,$query0))
				{
					while($query_executed=mysqli_fetch_assoc($is_query_run))
					{
						if($name==null)
							$name=$query_executed['name'];
						if($cp_per_unit==null)
							$cp_per_unit=$query_executed['cp_per_unit'];
						if($sp_per_unit==null)
							$sp_per_unit=$query_executed['sp_per_unit'];
						$units=$query_executed['units'];
						if($godown_id==null)
							$godown_id=$query_executed['godown_id'];
						if(empty($_POST['threshold']))
							$threshold=$query_executed['threshold'];
						if($remarks==null)
							$remarks=$query_executed['remarks'];
					}
				}
				//echo $name." ".$phone." ".$email." ".$address." ".$salary." ".$datejoined." ".$designation."<br>";
				$query="update stock set name='$name',
						cp_per_unit=$cp_per_unit,
						sp_per_unit=$sp_per_unit,
						units=$units,
						threshold = $threshold,
						godown_id='$godown_id',
						remarks='$remarks' where id='$id';";
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