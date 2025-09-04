<?php

include "Database-Connection.php";
$limit_per_page=5;
$page="";
if(isset($_POST["page_no"]))
{
	$page=$_POST["page_no"];
}
else
{
	$page=1;
}

$offset=($page-1)*$limit_per_page;
$sql="SELECT * FROM `student-data` LIMIT {$offset},{$limit_per_page}";
$result=mysqli_query($connection,$sql) or die("Query Failed...");
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

	$sql_total="SELECT * FROM `student-data`";
	$records=mysqli_query($connection,$sql_total) or die("Query Failed...");
	$total_records=mysqli_num_rows($records);
	$total_pages=ceil($total_records/$limit_per_page);

	$output .= '<div id="pagination">';
	for($index=1; $index<=$total_pages; $index++)
	{
		if($index==$page)
		{
			$class_name="active";
		}
		else
		{
			$class_name="";
		}
		$output .="<a class='{$class_name}' id='{$index}' href=''>{$index}</a>";
	}
	$output .='</div>';
	echo $output;
}
else
{
	"<h1>Record Not Found...</h1>";
}
?>