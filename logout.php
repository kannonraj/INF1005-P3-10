<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login or homepage
header("Location: login.php");
exit;
?>
