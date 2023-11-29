<?php 
require_once('db.php');

function auth($id,$pass)
{
	$con=getConnection();
	$sql="select * from cd where Id='$id' and Pass='$pass'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		return true;
	}
	else
	{
		return false;
	}

}


 ?>