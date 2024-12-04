<?php
$page_title = 'Admin Homepage';
include ('./includes/adminHeader.html');
?>
<form action="admin.php" method="post">
	<p><h2>Admin: </h2>
	<ul>
		<li>Add new subjects.</li>
		<br><li>Edit existing subjects.</li>
		<br><li>View all subjects:
			<ul>
				<li>Display all subjects</li>
				<li>Search a subject</li>
				<li>Delete a subject</li>
			</ul>
		</li>
		<br><li>Student Management:
			<ul>
				<li>View registered students</li>
				<li>View student subject registrations</li>
			</ul>
		</li>
	</ul></p>	
</form>
<?php
include ('./includes/footer.html');
?>