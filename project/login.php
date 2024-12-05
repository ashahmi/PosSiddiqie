<?php
require_once ('mysqli.php'); // Connect to the db.
global $dbc;

if (isset($_POST['submitted'])) {
	
	$e = $_POST['email'];
	$p = $_POST['password'];
	
	$query = "SELECT student_id, first_name FROM students WHERE email='$e' AND password=SHA('$p')";		
	$result = @mysqli_query ($dbc,$query); // Run the query.
	$row = mysqli_fetch_array ($result, MYSQLI_NUM); // Return a record, if applicable.
	
	if ($row) { // A record was pulled from the database.
		
					
		// Set the cookies & redirect.
		setcookie ('student_id', $row[0]);
		setcookie ('first_name', $row[1]);//joe
				
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
				
		//echo'<br><a href="http://localhost/ip/cookies/loggedin.php">Logged in</a>';
		exit(); // Quit the script.
					
	} else { // No record matched the query.
		echo '<h1>Error!</h1>
			<p class="error"><br />';
			echo 'The email address and password entered do not match those on file.</p>';
		//$errors[] = mysqli_error($dbc)  . '<br /><br />Query: ' . $query; // Debugging message.
	}
}

mysqli_close($dbc);

$page_title = 'Login';
include ('./includes/indexHeader.html');

if (!empty($errors)) { // Print any error messages.
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	echo '</p><p>Please try again.</p>';
}
?>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="40" required /> </p>
	<p>Password: <input type="password" name="password" size="20" maxlength="20" required /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('./includes/footer.html');
?>		