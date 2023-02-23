<?php
// add_contact_handler.php

// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the input data from the form submission
$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Insert the new contact into the database
$query = "INSERT INTO contacts (user_id, name, email, phone) VALUES ('$user_id', '$name', '$email', '$phone')";
mysqli_query($conn, $query);

// Redirect the user to the contacts page
header("Location: contacts.php");
exit;
?>
