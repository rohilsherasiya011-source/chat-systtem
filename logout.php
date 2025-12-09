<?php
session_start();     // Session start → required to destroy it
session_unset();     // Clear all session variables
session_destroy();   // Destroy session completely

// Redirect back to login page
header("Location: index.php");
exit;
?>
