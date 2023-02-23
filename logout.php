<?php
// Start the session and destroy the user's session
session_start();
session_destroy();
header("Location: login.php");
exit;
?>
