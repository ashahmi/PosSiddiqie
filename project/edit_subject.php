<?php
$page_title = 'Edit subject';
include ('./includes/adminHeader.html');

echo '<h1 id="mainhead">Edit a subject</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

if (isset($_POST['submitted'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$code = $_POST['code'];
	$fee = $_POST['fee'];
	
	// edit subject
	
	// check previous subject code
	$query = "SELECT subject_id FROM subjects WHERE subject_code='$code'";
	$result = @mysqli_query ($dbc,$query);
	if (mysqli_num_rows($result) == 0) {
		$query = "UPDATE subjects
			SET subject_code = '$code', subject_name = '$name', subject_fee='$fee' 
			WHERE subject_id = '$id'";
		$result = @mysqli_query ($dbc,$query);
			
		if (mysqli_affected_rows($dbc) > 0) {
			echo '<h1 id="mainhead">Edited!</h1>
			<p>Subject has been edited. </p><p><br /></p>';
						
			include ('./includes/footer.html');
			exit();
			
		}
		else {
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">You could not edit due to system error. We apologize for any inconvenience.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
								
			include ('./includes/footer.html');
			exit();
		}
	}
	else {
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The subject code has already been registered.</p>';
	}
}
?>
<form action="edit_subject.php" method="post">
	<p><b>Select subject id to edit:</b></p>
	<p>Id: <input type="text" name="id" required /></p>
	<p><b>Edit:</b></p>
	<p>Subject Name: <input type="text" name="name" required /></p>
	<p>Subject Code: <input type="text" name="code" required /></p>
	<p>Subject Fee: <input type="text" name="fee" required /></p>
	<p><input type="submit" name="submit" value="Edit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>	
<?php
include ('./includes/footer.html');
?>