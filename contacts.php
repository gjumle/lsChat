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
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the user's contacts from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM contacts WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
  <div class="navbar-container">
    <a href="#" class="logo">lastSeen</a>
    <ul class="navbar-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="contacts.php">Contacts</a></li>
      <li><a href="schedule.php">Schedule</a></li>
      <li><a href="stats.php">Statistics</a></li>
    </ul>
    <div class="navbar-right">
      <a href="logout.php">Logout</a>
    </div>
    <button class="navbar-toggle">
      <span class="navbar-toggle-icon"></span>
    </button>
  </div>
  <div class="navbar-mobile-menu">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="contacs.php">Contacts</a></li>
      <li><a href="schedule.php">Schedule</a></li>
      <li><a href="stats.php">Statistics</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
<!-- Display the user's contacts -->
<h1>Contacts</h1>
<ul>
  <?php foreach ($contacts as $contact) { ?>
    <li>
      <?php echo $contact['name']; ?> 
      <a href="edit_contact.php?id=<?php echo $contact['id']; ?>">Edit</a>
      <a href="delete_contact.php?id=<?php echo $contact['id']; ?>">Delete</a>
    </li>
  <?php } ?>
</ul>
</body>
</html>
