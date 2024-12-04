<?php # Script 7.6 - view_users.php (2nd version after Script 7.4)
// This script retrieves all the records from the users table.

$page_title = 'View Students';
include ('./includes/adminHeader.html');

// Page header.
echo '<h1 id="mainhead">Registered Students</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;
		
// Make the query.
$query = "select student_id as id, first_name as fname, last_name as lname, email as email from students";		
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );

if ($num > 0) { // If it ran OK, display the records.

	echo "<p><center>There are currently $num registered students.</center></p>\n";

	// Table header.
	echo '<table border=1 align="center" cellspacing="0" cellpadding="5">
	<tr><td align="left"><b>Student id</b></td><td align="left"><b>First name</b></td><td align="left"><b>Last name</b></td><td align="left"><b>Email</b></td></tr>';
	
	// Fetch and print all the records.
	while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['id'] . '</td><td align="left">' . $row['fname'] . '</td><td align="left">' . $row['lname'] . '</td><td align="left">' . $row['email'] . '</td></tr>';
	}

	echo '</table>';
	
	@mysqli_free_result($result); // Free up the resources.	

} else { // If it did not run OK.
	echo '<p class="error">There are currently no registered users.</p>';
}

echo "<h3>Registered Subjects:</h3>\n";
echo'<form action="view_students_li.php" method="post">';

	$query1 = "select student_id as id from students order by student_id asc";
	$result1 = @mysqli_query ($dbc,$query1);
	$num1 = @mysqli_num_rows($result1);
	
	if ($num1 > 0) {
		echo"<p>Select Student's ID  :  ";
		
		echo '<select name="id">';
		while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		    echo '<option value="' . $row1["id"] . '">' . $row1["id"] . '</option>';
		}
		echo '</select>';
		
		echo'<input type="submit" name="submitStudent" value="View" /></p>';
		
	} else { // If it did not run OK.
		echo '<p class="error">There are currently no registered subjects.</p>';
	}
echo'</form>';	
	
if (isset($_POST['submitStudent'])) {
	
	$i = $_POST['id'];
	
	$query2 = "SELECT student_id as id, concat(first_name, ' ', last_name) as Sname, subject_name as name, subject_fee as fee
		FROM students
		NATURAL JOIN registrations
		NATURAL JOIN subjects
		WHERE student_id = '$i'";
	$result2 = @mysqli_query ($dbc,$query2);// Run the query.
	$num2 = @mysqli_num_rows($result2);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
	
	if ($num2 > 0) {
		
		//$row3 = @mysqli_fetch_array($result2, MYSQLI_ASSOC
		//echo "<p>ID: <b>$i</b></p>";
		echo '<table border=1 cellspacing="0" cellpadding="5">
		<tr><td align="left"><b>Student id</b></td><td align="left"><b>Name</b></td><td align="left"><b>Subject</b></td><td align="left"><b>Fees (RM)</b></td></tr>';		
		
		while ($row2 = @mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			echo '<tr><td align="left">' . $row2['id'] . '</td><td align="left">' . $row2['Sname'] . '</td><td align="left">' . $row2['name'] . '</td><td align="left">' . $row2['fee'] . '</td></tr>';
			//echo'<p>ID: ' . $row2['id'] . '</p>';
		}
		
		echo '</table>';
		//@mysqli_free_result($result2)
		
		$query3 = "select sum(subject_fee) as total from subjects
	   			natural join registrations
	    			where student_id = $i";
			    				    
		$result3 = @mysqli_query ($dbc,$query3);// Run the query.
		$num3 = @mysqli_num_rows($result3);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
		
		while ($row3 = @mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			echo '<br>Total fees: <b>RM' . $row3['total'] . '</b>';
		}
	}
	else {
		echo '<p class="error">This user is not currently registered for any subjects.</p>';
	}
		
		//@mysqli_free_result($result3); // Free up the resources.	
}

@mysqli_close($dbc); // Close the database connection.

include ('./includes/footer.html'); // Include the HTML footer.
?>