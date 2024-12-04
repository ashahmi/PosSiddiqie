<?php
$page_title = 'Subjects';
include ('./includes/userHeader.html');

// Page header.
echo '<h1 id="mainhead">Subjects</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

// Check if the student is logged in
if (!isset($_COOKIE['student_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

$student_id = $_COOKIE['student_id'];
	
// Make the query.
$query = "SELECT s.subject_code, s.subject_name, s.subject_fee
		FROM subjects s
		LEFT JOIN registrations r ON s.subject_id = r.subject_id
	    	AND r.student_id = '$student_id'
		WHERE r.subject_id IS NULL";
//"select subject_code, subject_name, subject_fee from subjects";		
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );

if ($num > 0) { // If it ran OK, display the records.

	echo "<p><center>There are currently $num available subjects for you.</p></center>\n";

	// Table header.
	echo '<table border=1 align="center" cellspacing="0" cellpadding="5">
	<tr><td align="left"><b>Code</b></td><td align="left"><b>Subject</b></td><td align="left"><b>Fee</b></td></tr>';
	
	// Fetch and print all the records.
	while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '</td><td align="left">' . $row['subject_code'] . '</td><td align="left">' . $row['subject_name'] . '</td><td align="left">' . $row['subject_fee'] . '</td></tr>';
	}

	echo '</table>';
	
	@mysqli_free_result($result); // Free up the resources.	

} else { // If it did not run OK.
	echo '<p class="error">There are currently no registered users.</p>';
}

echo'<form action="user_subjects.php" method="post">';
echo'<br><h3>Register a subject:</h3>';

	$query1 = "SELECT s.subject_name, s.subject_id
		FROM subjects s
		LEFT JOIN registrations r ON s.subject_id = r.subject_id
	    	AND r.student_id = '$student_id'
		WHERE r.subject_id IS NULL";
	$result1 = @mysqli_query ($dbc,$query1);
	$num1 = @mysqli_num_rows($result1);
	
	if ($num1 > 0) {
		echo"<p>Select Subject : ";
		
		echo '<select name="subject">';
		while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		    echo '<option value="' . $row1["subject_name"] . '">' . $row1["subject_name"] . '</option>';
		}
		echo '</select>';
		
		echo'<input type="submit" name="submitSubject" value="Register" /></p>';
		
	} else { // If it did not run OK.
		echo '<p class="error">There are currently no subjects.</p>';
	}
echo'</form>';

if (isset($_POST['submitSubject'])) {
	$s = $_POST['subject'];
	
	$query3 = "select subject_id from subjects where subject_name ='$s'";		
	$result3 = @mysqli_query ($dbc,$query3);// Run the query.
	$num3 = @mysqli_num_rows($result3);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
	$row3 = mysqli_fetch_array($result3, MYSQLI_NUM);
	$subject_id = $row3[0];
	
	if ($num1) {
		$query4 = "insert into registrations (student_id, subject_id) values ($student_id, $subject_id)";
		$result4 = @mysqli_query ($dbc,$query4);// Run the query.
		
		if ($result4) { // If it ran OK.
			//echo'<br><p>Hello '. $row2[1] . '</p>';
			echo'<p>You have been registered to take '. $s . '</p>';
				
			echo '<h1 id="mainhead">Thank you!</h1>
			<p>Your registration have been submitted.</p>';	
			
			echo'<a href="user_subjects.php"><button>Register another subject</button></a> <a href="invoice.php"><button>View invoice</button></a>';
		
		} else { // If it did not run OK.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">You cannot register the subject due to a system error. We apologize for any inconvenience.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
			include ('./includes/footer.html'); 
			exit();
		}
	}
		
}
			
@mysqli_close($dbc); // Close the database connection.

include ('./includes/footer.html'); // Include the HTML footer.
?>