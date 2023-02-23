<?php
// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lastSeen";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 to support special characters
$conn->set_charset("utf8");
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