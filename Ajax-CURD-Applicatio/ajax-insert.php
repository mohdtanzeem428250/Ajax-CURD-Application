<?php
	include "Database-Connection.php";
	$f_name=$_POST["fname"];
	$l_name=$_POST["lname"];
	$c_city=$_POST["city"];
	$c_contact=$_POST["contact"];

	if(function_exists('date_default_timezone_set')) 
	{
    	date_default_timezone_set("Asia/Kolkata");
	}
	$time=date('h:i:a');
	$date=date('Y-m-d');

	$sql="INSERT INTO `student-data`(FirstName,LastName,Date,Time,Status,City,Contact) VALUES ('$f_name','$l_name','$date','$time','0','$c_city','$c_contact')";

	if(mysqli_query($connection,$sql))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
?>