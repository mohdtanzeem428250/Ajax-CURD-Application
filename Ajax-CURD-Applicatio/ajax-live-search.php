<?php 

include "Database-Connection.php";
$search_val=$_POST["search"];
$sql="SELECT * FROM `student-data` WHERE FirstName LIKE '%{$search_val}%' OR LastName LIKE '%{$search_val}%' OR City LIKE '%{$search_val}%'" ;
	$result=mysqli_query($connection,$sql) or die("SQL Query Failed...");
	$output="";
	if(mysqli_num_rows($result)>0)
	{
		$output='<table border="1" width="100%" cellspacing="0" cellpadding="10px">
					<tr>
						<th>Id</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>City</th>
						<th>Contact</th>
						<th>Action</th>
					</tr>';
					while($rows=mysqli_fetch_assoc($result))
					{
						$output .= "<tr>
										<td>{$rows['Id']}</td>
										<td>{$rows['FirstName']}</td>
										<td>{$rows['LastName']}</td>
										<td>{$rows['City']}</td>
										<td>{$rows['Contact']}</td>
										<td>
											<button class='edit-btn' data-id='{$rows['Id']}'>Edit</button></a>
                        					<button class='delete-btn' data-id='{$rows['Id']}'>Delete</button></a>
										</td>
									</tr>";
					}
		$output .= '</table>';
		mysqli_close($connection);
		echo $output;
	}
	else
	{
		echo "<h1>Record Not Founds...</h1>";
	}

?>