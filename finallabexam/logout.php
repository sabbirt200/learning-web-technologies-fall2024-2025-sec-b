<?php
session_start();  // Start the session

// Destroy all session variables and the session itself
session_unset();  // Remove all session variables
session_destroy();  // Destroy the session

// Redirect the user to the login page
header("Location: index.php");  // Redirect to login page
exit;
?>
