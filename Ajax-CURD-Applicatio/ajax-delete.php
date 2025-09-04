<?php
	include("Database-Connection.php");
	$studentId=$_POST["id"];
	$sql="DELETE FROM `student-data` WHERE Id={$studentId}";
	if(mysqli_query($connection,$sql))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
?>