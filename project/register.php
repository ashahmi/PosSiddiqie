<?php
$page_title = 'Register';
include ('./includes/indexHeader.html');

echo '<h1 id="mainhead">Register</h1>';

require_once ('mysqli.php'); // Connect to the db.
global $dbc;

if (isset($_POST['submitted'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	
	if ($_POST['password1'] != $_POST['password2']) {
		echo "<font color='red'>Your password did not match the confirmed password.</font>";
	} else {
	
		$p = $_POST['password1'];
		$query = "SELECT student_id FROM students WHERE email='$email'";
		$result = @mysqli_query ($dbc,$query);
		if (mysqli_num_rows($result) == 0) {
			$query = "INSERT INTO students (first_name, last_name, email, password) VALUES ('$fname', '$lname', '$email', SHA('$p'))";
			$result = @mysqli_query ($dbc,$query);
					
			if (mysqli_affected_rows($dbc) > 0) {
				echo '<h1 id="mainhead">Registered!</h1>
				<p>You have been registered. </p><p><br /></p>';
				
				$query1 = "SELECT student_id, first_name FROM students WHERE email='$email' AND password=SHA('$p')";		
				$result1 = @mysqli_query ($dbc,$query1); // Run the query.
				$row1 = mysqli_fetch_array ($result1, MYSQLI_NUM); // Return a record, if applicable.
				
				if ($row1) { // A record was pulled from the database.
									
					// Set the cookies & redirect.
					setcookie ('student_id', $row1[0]);
					setcookie ('first_name', $row1[1]);//joe
								
					//setcookie ('user_id', $row[0], time()+3600, '/', '', 0);
					//setcookie ('first_name', $row[1], time()+3600, '/', '', 0);
								
								
					// Redirect the user to the loggedin.php page.
					// Start defining the URL.
					$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
					// Check for a trailing slash.
					if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
						$url = substr ($url, 0, -1); // Chop off the slash.
					}
					// Add the page.
					$url .= '/loggedin.php';
								
					header("Location: $url");
				}
				include ('./includes/footer.html');
				exit();
					
			}
			else {
				echo '<h1 id="mainhead">System Error</h1>
				<p class="error">You could not register due to system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
									
				include ('./includes/footer.html');
				exit();
			}
		}
		else {
			echo '<h1 id="mainhead">Error!</h1>
			<p class="error">The email has already been registered.</p>';
		}
	}
}
?>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="fname" required value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" /></p>
	<p>Last Name: <input type="text" name="lname" required value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<p>Password: <input type="password" name="password1" size="10" maxlength="20" /></p>
	<p>Confirm Password: <input type="password" name="password2" size="10" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>	
<?php
include ('./includes/footer.html');
?>