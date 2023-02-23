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
<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Log in</button>
</form>
</html>

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
// Get the username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username and password match the records in the database
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
  if (password_verify($password, $user['password'])) {
    // Username and password are correct, start a session for the user
    session_start();
    $_SESSION['user_id'] = $user['id'];
    header("Location: contacts.php");
    exit;
  } else {
    // Password is incorrect, display an error message
    echo "Incorrect password.";
  }
} else {
  // Username is not found, display an error message
  echo "Username not found.";
}
?>
