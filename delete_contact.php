<?php
// delete_contact.php

// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the contact ID from the query string
$id = $_GET['id'];

// Delete the contact from the database
$query = "DELETE FROM contacts WHERE id = '$id'";
mysqli_query($conn, $query);

// Redirect the user to the contacts page
header("Location: contacts.php");
exit;
?>