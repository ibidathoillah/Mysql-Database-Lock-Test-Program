<?php
session_start();

if(isset($_SESSION['host']) && isset($_SESSION['uname']) && isset($_SESSION['psw']))
{


	$databaseHost = $_SESSION['host'];
	$databaseName = 'test';
	$databaseUsername = $_SESSION['uname'];
	$databasePassword = $_SESSION['psw'];
	$sleep = 2;
	error_reporting(0);
	
	$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die("<script>alert('Cannot connect database');window.location.href='logout.php'</script>");



	$locking = mysqli_query($mysqli, "SHOW OPEN TABLES  WHERE In_use > 0");
	$lock = mysqli_fetch_array($locking);
	$isLocked = $lock["In_use"];

	


?>

<html>
<head>	
	<title>Homepage</title>
	<style type="text/css">
		input[type=text] ,select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #23a9e1;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit],button,input[type=reset]  {
    width: 100%;
    background-color: #23a9e1;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
hr{

	background-color: #23a9e1;
	padding: 1px;
	border:none;

}

input[type=submit]:hover {
    background-color: #2196F3;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #23a9e1;
    color: white;
}
.container{
	margin: auto;
	margin-top: 10px;
	width: 80%;
	padding: 10px;

	
}
a button{
	
	    width: 100px;
}
.logo {
  animation: bounceIn 0.6s;
  transform: rotate(0deg) scale(1) translateZ(0);
  transition: all 0.4s cubic-bezier(.8,1.8,.75,.75);
  cursor: pointer;
}

.logo:hover {
   transform: scale(1.1);
}

.failed{
	  animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}

@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }
  
  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}

@keyframes bounceIn {
  0% {
    opacity: 1;
    transform: scale(.3);
  } 

  50% {
    opacity: 1;
    transform: scale(1.05);
  } 

  70% {
    opacity: 1;
    transform: scale(.9);
  }

  100% {
    opacity: 1;
    transform: scale(1);
  }
}
	</style>


</head>

<body class="container">
	<a href="index.php"><img class="logo" src="logo.png" style="width: 400px;"></a>
	<br>
	<?php
	echo "Locked Status :".$isLocked." ";
	echo "You are login as ".$databaseUsername." with host ".$databaseHost;
	?>
	<a href="logout.php" style="float: right;"><button>Log Out</button></a>

	<hr>
	<?php

		if(!isset($_GET['id']))
		{



	?>

	<form action="" method="post" name="form1">
		<table width="100%" border="0" >
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" required></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" required></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" required></td>
			</tr>
			<tr> 
				<td><input type="reset" name="reset" value="Reset"></td>
				<td><input type="submit" name="Submit" value="Add"></td>
				
			</tr>
		</table>
	</form>

	<?php
	}
	else
	{
		//fetching data in descending order (lastest entry first)
		//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
		//getting id from url
		$id = $_GET['id'];

		//selecting data associated with this particular id
		$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

		while($res = mysqli_fetch_array($result))
		{
			$name = $res['name'];
			$age = $res['age'];
			$email = $res['email'];
		}



	?>

	<form name="form1" method="post" action="">
		<table width="100%" border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>" required></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" value="<?php echo $age;?>" required></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>" required></td>
			</tr>
			<tr>
				<td><input type="reset" name="reset" value="Reset"></td>
				<td style="display: none"><input type="hidden"  name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
				
			</tr>
		</table>
	</form>
	<?php




		if(isset($_POST['update']))
		{	



			$id = mysqli_real_escape_string($mysqli, $_POST['id']);
			
			$name = mysqli_real_escape_string($mysqli, $_POST['name']);
			$age = mysqli_real_escape_string($mysqli, $_POST['age']);
			$email = mysqli_real_escape_string($mysqli, $_POST['email']);	
			
			// checking empty fields
			if(empty($name) || empty($age) || empty($email)) {	
					
				if(empty($name)) {
					echo "<font color='red'>Name field is empty.</font><br/>";
				}
				
				if(empty($age)) {
					echo "<font color='red'>Age field is empty.</font><br/>";
				}
				
				if(empty($email)) {
					echo "<font color='red'>Email field is empty.</font><br/>";
				}		
			} else {	
				if($isLocked==1)
				{
					echo "<div style='color:red' class='failed'>CAN'T UPDATE TABLE IS LOCKED</div><br>";
				}
				else
				{
					$result = mysqli_query($mysqli,"LOCK TABLES users write") or die('Query failed: ' . mysql_error());
				//updating the table
				$result = mysqli_query($mysqli, "UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id");
				
				//redirectig to the display page. In our case, it is index.php
				
				sleep($sleep);

				// Will not get here, but we should unlock.
				$query = 'UNLOCK TABLES';
				$result = mysqli_query($mysqli,$query) or die('Query failed: ' . mysql_error());

				header("Location: index.php");

				}
			}
		}

	}
	?>

	<br/>

	<table width='80%' id="customers">

	<tr bgcolor='#CCCCCC'>
		<th>Name</th>
		<th>Age</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
	<?php 
	
	

	if(isset($_POST['Submit'])) {	


	


	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		if($isLocked==1)
		{
			echo "<div style='color:red' class='failed'>CAN'T UPDATE TABLE IS LOCKED</div><br>";
		}
		else
		{
			// if all the fields are filled (not empty) 
			$result = mysqli_query($mysqli,"LOCK TABLES users write") or die('Query failed: ' . mysql_error());

			// At this point, the "sample" table is locked.
			// Do somethings here, wait a bit
			//insert data to database	

			$result = mysqli_query($mysqli, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");
			
			//display success message
			echo "<div style='color:green'>Data added successfully.</div><br>";
			sleep($sleep);

			// Will not get here, but we should unlock.
			$query = 'UNLOCK TABLES';
			$result = mysqli_query($mysqli,$query) or die('Query failed: ' . mysql_error());
			
		}
	}
}

$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead

	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['email']."</td>";	
		echo "<td><a href=\"index.php?id=$res[id]\"><button>Edit</button></a> <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button>Delete</button></a></td>";		
	}
	?>
	</table>
</body>
</html>
<?php
}
else
{

	header("Location: login.php");

}
