<?php
	include "Database-Connection.php";
	$student_id=$_POST["s_Id"];
	$sql="SELECT * FROM `student-data` WHERE id={$student_id}";
	$result=mysqli_query($connection,$sql) or die("SQL Query Failed...");
	$output="";
	if(mysqli_num_rows($result)>0)
	{
					while($rows=mysqli_fetch_assoc($result))
					{
						$output .= "<tr>
                    					<td style='font-size: 20px;'>Enter The First Name</td>
                    					<td style='font-size: 20px;'><input style='height: 25px;' value='{$rows['FirstName']}' type='text' id='edit-firstname' placeholder='Enter The First Name' /></td>
                    					<td style='font-size: 20px;'><input style='height: 25px;' type='hidden' value='{$rows['Id']}' type='text' id='edit-id' placeholder='Enter The First Name' /></td>
                				   </tr>
                				   <tr>
                    					<td style='font-size: 20px;'>Enter The Last Name</td>
                    					<td style='font-size: 20px;'><input style='height: 25px;' value='{$rows['LastName']}' type='text' id='edit-lastname' placeholder='Enter The Second Name' /></td>
                				   </tr>
                				   <tr>
                    					<td style='font-size: 20px;'>Enter The City</td>
                    					<td style='font-size: 20px;'><input style='height: 25px;' value='{$rows['City']}' type='text' id='edit-city' placeholder='Enter The City' /></td>
                				   </tr>
                				   <tr>
                    					<td style='font-size: 20px;'>Enter The Contact</td>
                    					<td style='font-size: 20px;'><input style='height: 25px;' value='{$rows['Contact']}' type='text' id='edit-contact' placeholder='Enter The Contact' /></td>
                				   </tr>
                				   <tr>
                    			   		<td style='font-size: 20px;'><input class='delete-btn1' type='reset' id='edit-reset1' value='Reset' /></td>
                    			   		<td style='font-size: 20px;'><input class='edit-btn' type='submit' id='edit-submit' value='Save' /></td>
                				   </tr>";
					}
		mysqli_close($connection);
		echo $output;
	}
	else
	{
		echo "<h1>Record Not Founds...</h1>";
	}
 ?>