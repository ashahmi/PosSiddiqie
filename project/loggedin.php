<?php
// If no cookie is present, redirect the user.
if (!isset($_COOKIE['student_id'])) {

	// Start defining the URL.
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Check for a trailing slash.
	if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
		$url = substr($url, 0, -1); // Chop off the slash.
	}
	$url .= '/subjects.php'; // Add the page.
	header("Location: $url");
	exit(); // Quit the script.
}

// Set the page title
$page_title = 'Logged In!';

// Include the appropriate header based on the user type.
if ($_COOKIE['student_id'] == 7) {
	include('./includes/adminHeader.html');
} else {
	include('./includes/userHeader.html');
}

// Print a customized message.
echo "<h1>Logged In!</h1>
<p>You are now logged in, <b>{$_COOKIE['first_name']}</b>! ID: <b>{$_COOKIE['student_id']}</b>.</p>
<p><br /><br /></p>";

include('./includes/footer.html');
?>
