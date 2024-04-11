<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the signin.php page
header('Location: signin.php');
exit();
?>