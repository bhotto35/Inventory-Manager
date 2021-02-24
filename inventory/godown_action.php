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
				$query="delete from godown where id='$id';";
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('record was deleted');
						window.location.replace('godown.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('record could not be deleted');
						window.location.replace('godown.php');
					</script>";
				}
			}
			if($_POST['formtype']=='insert')
			{	
				$id_tobemade=0;
				$id0='';
				$id=$_POST['id'];
				$query0="select id from godown;";
				if ($is_query_run = mysqli_query($link,$query0)) 
				{ 
					while ($query_executed = mysqli_fetch_assoc ($is_query_run))
					{
						$id0=$query_executed['id'];
						//echo $id0."hm".$id." hm<br>";
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
					$id=(string)$id1;
					$zeroes=5-strlen($id);
					$zero='';
					$i=1;
					for($i=1;$i<=$zeroes;$i++)
						$zero=$zero.'0';
					$id=$zero.$id; 
				}
				$location=$_POST['location'];
				$manager=$_POST['manager'];
				$capacity=$_POST['capacity'];
				$query="insert into godown values('$id','$location','$manager',$capacity);";
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was inserted');
						window.location.replace('godown.php');
					</script>";
				}
				else
				{
					//echo "Hm ".mysqli_error($link);
					echo "<script>
						alert('New record could not be created');
						window.location.replace('godown.php');
					</script>";
					
				}
			}
			if($_POST['formtype']=='update')
			{	
				$id=$_POST['id'];
				$location=$_POST['location'];
				$manager=$_POST['manager'];
				$capacity=$_POST['capacity'];
				$query0="select * from godown where id='$id';";
				if($is_query_run=mysqli_query($link,$query0))
				{
					while($query_executed=mysqli_fetch_assoc($is_query_run))
					{
						if(empty($_POST['location']))
							$location=$query_executed['location'];
						if(empty($_POST['manager']))
							$manager=$query_executed['manager'];
						if(empty($_POST['capacity']))
							$capacity=$query_executed['capacity'];
					}
				}
				//echo $name." ".$phone." ".$email." ".$address." ".$salary." ".$datejoined." ".$designation."<br>";
				$query="update employee set location='$location',
						manager='$manager',
						capacity=$capacity where id='$id';";
				echo $query;
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was updated');
						window.location.replace('godown.php');
					</script>";
				}
				else
				{
					//echo "Hm ".mysqli_error($link);
					echo "<script>
						alert('Record could not be updated');
						window.location.replace('godown.php');
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