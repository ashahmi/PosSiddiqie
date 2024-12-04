<?php
$page_title = 'Add subject';
include ('./includes/adminHeader.html');

echo '<h1 id="mainhead">Add New Subject</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

if (isset($_POST['submitted'])) {
$name = $_POST['name'];
$code = $_POST['code'];
$fee = $_POST['fee'];

// add new subject

// check previous subject code
$query = "SELECT subject_id FROM subjects WHERE subject_code='$code'";
$result = @mysqli_query ($dbc,$query);

if (mysqli_num_rows($result) == 0) {

	$query = "INSERT INTO subjects (subject_code, subject_name, subject_fee) VALUES('$code', '$name', '$fee')";
	$result = @mysqli_query ($dbc,$query);
	
	if (mysqli_affected_rows($dbc) > 0) {
		echo '<h1 id="mainhead">Added!</h1>
		<p>New subject has been added. </p><p><br /></p>';
		
		include ('./includes/footer.html'); //try buang ni nanti
		exit();
	}
	else {
		echo '<h1 id="mainhead">System Error</h1>
		<p class="error">You could not add due to system error. We apologize for any inconvenience.</p>'; // Public message.
		echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
					
		include ('./includes/footer.html'); //try buang ni nanti
		exit(); //same
	}
}
else {
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The subject code has already been registered.</p>';
}
$result = @mysqli_query ($dbc,$query);// Run the query.
$num = @mysqli_num_rows($result);// OR die ('SQL Statement: ' . mysqli_error($dbc) );
}
?>
<form action="Add_new_subject.php" method="post">
	<p>Subject Name: <input type="text" name="name" required /></p>
	<p>Subject Code: <input type="text" name="code" required /></p>
	<p>Subject Fee: <input type="text" name="fee" required /></p>
	<p><input type="submit" name="submit" value="Add" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('./includes/footer.html');
?>	