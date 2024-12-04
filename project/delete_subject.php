<?php
$page_title = 'Delete subject';
include ('./includes/adminHeader.html');

echo '<h1 id="mainhead">Subjects</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

$query = "select subject_id, subject_code, subject_name from subjects";		
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );

if ($num > 0) { // If it ran OK, display the records.

	// Table header.
	echo '<table border=1 align="center" cellspacing="0" cellpadding="5">
	<tr><td align="left"><b>ID</b></td><td align="left"><b>Code</b></td><td align="left"><b>Name</b></td></tr>';
	
	// Fetch and print all the records.
	while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '</td><td align="left">' . $row['subject_id'] . '</td><td align="left">' . $row['subject_code'] . '</td><td align="left">' . $row['subject_name'] . '</td></tr>';
	}

	echo '</table>';
	
	@mysqli_free_result($result); // Free up the resources.	

} else { // If it did not run OK.
	echo '<p class="error">There are currently no registered users.</p>';
}

if (isset($_POST['submitted'])) {
	$id = $_POST['id'];
	$code = $_POST['code'];
	
	$query2 = "delete from subjects where subject_id='$id' and subject_code='$code'";
	$result2 = @mysqli_query ($dbc,$query2);// Run the query.
	
	if (mysqli_affected_rows($dbc) > 0) {
		
		echo '<h1 id="mainhead">Deleted!</h1>
			<p>Subject has been deleted. </p><p><br /></p>';
							
		include ('./includes/footer.html');
		exit();
				
	}
	else {
		echo '<h1 id="mainhead">System Error</h1>
		<p class="error">You could not delete due to subject id and code is not matched or system error. We apologize for any inconvenience.</p>'; // Public message.
		echo '<p>' . mysqli_error($dbc); // Debugging message.
									
		include ('./includes/footer.html');
		exit();
	}
	
}
?>
<h2>Delete subject</h2>
<form action="delete_subject.php" method="post">
	<p>Select subject's id and code to <b>DELETE:</b></p>
	<p>Id: <input type="text" name="id" required /></p>
	<p>Code: <input type="text" name="code" required /></p>
	<p><input type="submit" name="submit" value="Delete" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>	
<?php
include ('./includes/footer.html');
?>