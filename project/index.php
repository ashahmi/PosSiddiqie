<?php # Script 3.4 - index.php
$page_title = 'Home';
include ('./includes/indexHeader.html');
?>
<center><h1>Welcome to Our Tuition Management</h1>

<!-- Inserting the provided image and styling it -->
<img src="https://www.hashmicro.com/blog/wp-content/uploads/2023/03/tuition.png" alt="Tuition Management" style="max-width: 40%; height: auto;">
<br/><br/>
<!-- Inserting the button to link to login.php -->
<a href="login.php"><button>Login</button></a> <a href="register.php"><button>Register</button></a>

<?php
include ('./includes/footer.html');
?>