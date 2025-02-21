<?php
session_destroy(); // Destroy all session data
header("Location: index.php"); // Redirect to login/home page
exit();
?>
