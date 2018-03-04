<?php

if(isset($_POST['host']) && isset($_POST['uname']) && isset($_POST['psw']))
{
	session_start();
	
	$_SESSION['host'] = $_POST['host'];
	$_SESSION['uname'] = $_POST['uname'];
	$_SESSION['psw'] = $_POST['psw'];
	header("Location: index.php");
}
else
{
	header("Location: login.php");
}


?>