<?php 

function getConnection(){
	$servername="localhost";
	$username= "root";
	$password="";
	$dbname="abc";
	$conn= new mysqli($servername,$username,$password,$dbname);
	return $conn;
}

 ?>