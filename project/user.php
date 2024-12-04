<?php
$page_title = 'User Homepage';
include ('./includes/userHeader.html');
?>
<form action="user.php" method="post">
	<p><h2>User:</h2>
	<ul>
		<li>Registration:
			<ul>
				<li>Create new student account.</li>	
			</ul>
		</li>
		<br><li>Subject Selection and Fee Calculation:
			<ul>
				<li>View available subjects</li>
				<li>Select subjects</li>
				<li>View selected subjects and total fee</li>
			</ul>
		</li> 
	</ul></p>	
</form>
<?php
include ('./includes/footer.html');
?>