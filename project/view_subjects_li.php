<?php
$page_title = 'View Subjects';
include ('./includes/adminHeader.html');

// Page header.
echo '<h1 id="mainhead">Registered Subjects</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;
		
// Make the query.
$query = "select subject_code as code, subject_name as name from subjects";		
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );

if ($num > 0) { // If it ran OK, display the records.

	echo "<p><center>There are currently $num registered subjects.</p>\n";

	// Table header.
	echo '<table border=1 align="center" cellspacing="0" cellpadding="5">
	<tr><td align="left"><b>Code</b></td><td align="left"><b>Name</b></td></tr>';
	
	// Fetch and print all the records.
	while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '</td><td align="left">' . $row['code'] . '</td><td align="left">' . $row['name'] . '</td></tr>';
	}

	echo '</table>';
	
	@mysqli_free_result($result); // Free up the resources.	

} else { // If it did not run OK.
	echo '<p class="error">There are currently no registered users.</p>';
}

echo "</center><h3>Subject Details:</h3>\n";
echo'<form action="view_subjects_li.php" method="post">';

	$query1 = "select subject_name from subjects";
	$result1 = @mysqli_query ($dbc,$query1);
	$num1 = @mysqli_num_rows($result1);
	
	if ($num1 > 0) {
		echo"<p>Select Subject  :  ";
		
		echo '<select name="subject">';
		while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		    echo '<option value="' . $row1["subject_name"] . '">' . $row1["subject_name"] . '</option>';
		}
		echo '</select>';
		
		echo'<input type="submit" name="submitSubject" value="View" /></p>';
		
	} else { // If it did not run OK.
		echo '<p class="error">There are currently no subjects.</p>';
	}
echo'</form>';	
	
if (isset($_POST['submitSubject'])) {
	
	$s = $_POST['subject'];
	
	$query2 = " select subject_id, subject_code, subject_name, subject_fee
			from subjects
			where subject_name = '$s'";
	$result2 = @mysqli_query ($dbc,$query2);// Run the query.
	$num2 = @mysqli_num_rows($result2);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
	
	echo '<table border=1 cellspacing="0" cellpadding="5">
	<tr><td align="left"><b>Id</b></td><td align="left"><b>Code</b></td><td align="left"><b>Subject</b></td><td align="left"><b>Fee (RM)</b></td></tr>';		
	
		while ($row2 = @mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			echo '<tr><td align="left">' . $row2['subject_id'] . '</td><td align="left">' . $row2['subject_code'] . '</td><td align="left">' . $row2['subject_name'] . '</td><td align="left">' . $row2['subject_fee'] . '</td></tr>';
		}
		
		echo '</table>';
		
		@mysqli_free_result($result2); // Free up the resources.	
}	

@mysqli_close($dbc); // Close the database connection.

include ('./includes/footer.html'); // Include the HTML footer.
?>