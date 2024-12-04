<?php 
$page_title = 'Retrieving Query Results';
include ('./includes/header.html');

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

$query = "select subject_name, subject_fee from subjects;";

// Run the query and handle the results.
if ($result = @mysqli_query($dbc, $query)) {

	if (mysqli_num_rows($result) > 0) { // Some records returned.
	
		// Print each record in a loop.
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) { // NUM (untuk no. index je) and AS (nama column je)
			echo "<h3>$row[0] - $row[1]</h3><br />";
		}
	
	} else { // No records returned.
		echo '<p>There are currently no records in the table.</p>';
	}

} else { // Query didn't run properly.
	echo '<p><font color="red">MySQL Error: ' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</font></p>';// Debugging message.
}

// Free the result and close the connection.
mysqli_free_result($result);
mysqli_close($dbc);
?>
