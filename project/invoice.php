<?php
$page_title = 'Invoice';
include ('./includes/userHeader.html');

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

// Page header.
echo '<h1 id="mainhead">INVOICE</h1>';
echo'<form action="invoice.php" method="post">';
	echo'<p><input type="submit" name="submit" value="View my invoice" /></p>';
	echo'</form>';

// Check if the student is logged in
if (!isset($_COOKIE['student_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

$student_id = $_COOKIE['student_id'];

if (isset($_POST['submit'])) {
$query = "select concat(first_name, ' ', last_name) as name from students where student_id=$student_id";
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
$row = mysqli_fetch_array($result, MYSQLI_NUM);

if ($num == 1) {

	$name = $row[0];
	
	$query2 = "select subject_code, subject_name, subject_fee
			from subjects
			natural join registrations
			where student_id=$student_id";
	$result2 = @mysqli_query ($dbc,$query2);// Run the query.
	$num2 = @mysqli_num_rows($result2);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
	
	if ($num2 > 0) {
		echo'<p><br>Name: <b>'. $name . '</b></p>';
		echo'<p>Student id: <b>'. $student_id . '</b></p>';
		
		echo '<table border=1 cellspacing="0" cellpadding="5">
			<tr><td align="left"><b>Code</b></td><td align="left"><b>Subject</b></td><td align="left"><b>Fee (RM)</b></td></tr>';		
					
		echo'<h3>Details Summary:</h3>';
					
		while ($row2 = @mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			echo '</td><td align="left">' . $row2['subject_code'] . '</td><td align="left">' . $row2['subject_name'] . '</td><td align="left">' . $row2['subject_fee'] . '</td></tr>';
		}
						
		echo '</table>';
						
		@mysqli_free_result($result2); // Free up the resources.
		
		$query3 = "select sum(subject_fee) as total from subjects
					    		natural join registrations
					    		where student_id = $student_id";
							    
		$result3 = @mysqli_query ($dbc,$query3);// Run the query.
		$num3 = @mysqli_num_rows($result3);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
					
		while ($row3 = @mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			echo '<br>Total fees: <b>RM' . $row3['total'] . '</b>';
		}
	} else {
	        echo '<p class="error">You are not currently registered for any subjects.</p>';
	}
}
}
include ('./includes/footer.html'); // Include the HTML footer.
?>