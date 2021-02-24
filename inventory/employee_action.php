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
				$query="delete from employee where id='$id';";
				if(mysqli_query($link, $query))
				{
					echo "<script>
						alert('record was deleted');
						window.location.replace('employee.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('record could not be deleted');
						window.location.replace('employee.php');
					</script>";
				}
			}
			if($_POST['formtype']=='insert')
			{	
				$id_tobemade=0;
				$id=$_POST['id'];
				$query0="select id from employee;";
				if ($is_query_run = mysqli_query($link,$query0)) 
				{ 
					while ($query_executed = mysqli_fetch_assoc ($is_query_run))
					{
						$id0=$query_executed['id'];
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
					$q = 'select max(id) from employee';
					$r = mysqli_query($link,$q);
					$ra = mysqli_fetch_assoc($r);
					$id0 = $ra['max(id)'];
					$id1=(int)$id0+1;
					$id=(string)$id1;
					$zeroes=5-strlen($id);
					$zero='';
					$i=1;
					for($i=1;$i<=$zeroes;$i++)
						$zero=$zero.'0';
					$id=$zero.$id; 
				}
				$name=$_POST['name'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$address=$_POST['address'];
				$salary=$_POST['salary'];
				$datejoined=$_POST['date'];
				$designation=$_POST['designation'];
				$query="insert into employee values('$id','$name','$phone','$email','$address',$salary,'$datejoined','$designation');";
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was inserted');
						window.location.replace('employee.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('New record could not be created');
						window.location.replace('employee.php');
					</script>";
					
				}
			}
			if($_POST['formtype']=='update')
			{	
				$id=$_POST['id'];
				$name=$_POST['name'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$address=$_POST['address'];
				$salary=$_POST['salary'];
				$datejoined=$_POST['date'];
				$designation=$_POST['designation'];
				$query0="select * from employee where id='$id';";
				if($is_query_run=mysqli_query($link,$query0))
				{
					while($query_executed=mysqli_fetch_assoc($is_query_run))
					{
						if(empty($_POST['name']))
							$name=$query_executed['name'];
						if(empty($_POST['phone']))
							$phone=$query_executed['phone'];
						if(empty($_POST['email']))
							$email=$query_executed['email'];
						if(empty($_POST['address']))
							$address=$query_executed['address'];
						if($salary==0||empty($_POST['salary']))
							$salary=$query_executed['salary'];
						if(empty($_POST['date']))
							$datejoined=$query_executed['datejoined'];
						if(empty($_POST['designation']))
							$designation=$query_executed['designation'];
					}
				}
				$query="update employee set name='$name',
						phone='$phone',
						email='$email',
						address='$address',
						salary=$salary,
						datejoined='$datejoined',
						designation='$designation' where id='$id';";
				echo $query;
				if(mysqli_query($link,$query))
				{
					echo "<script>
						alert('record was updated');
						window.location.replace('employee.php');
					</script>";
				}
				else
				{
					echo "<script>
						alert('Record could not be updated');
						window.location.replace('employee.php');
					</script>";
					
				}
			}
		?>
	</body>
</html>