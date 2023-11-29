<?php 
require_once('../Models/alldb.php');
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$pass=$_REQUEST['pass'];

	if(empty($id))
	{
		echo "empty";
	}
	else
	{
		$status=auth($id,$pass);
		if($status){
			header('location:../Views/dashboard.php');
		}
		else
		{
			header('location:../Views/login.php');
		}
	}

}

 ?>