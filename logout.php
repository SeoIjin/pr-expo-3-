<?php
session_start(); // Start the session
session_destroy(); // Destroy all session data
header("Location: homepage.php"); // Redirect to the homepage
exit();
?>
