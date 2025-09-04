<?php

include "Database-Connection.php";
$id=$_POST['std_Id'];
$first=$_POST['firstName'];
$last=$_POST['lastName'];
$city=$_POST['c_city'];
$contact=$_POST['c_contact'];
$sql="UPDATE `student-data` SET FirstName='{$first}', LastName='{$last}', City='{$city}', Contact='{$contact}' WHERE Id='{$id}'";
if(mysqli_query($connection,$sql))
{
	echo 1;
}
else
{
	echo 0;
}

?>