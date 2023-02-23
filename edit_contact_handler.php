<?php
// edit_contact_handler.php

// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the inputdata from the form submission
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Update the contact in the database
$query = "UPDATE contacts SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
mysqli_query($conn, $query);

// Redirect the user to the contacts page
header("Location: contacts.php");
exit;
?>
