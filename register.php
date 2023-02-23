<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="contacts.php">Contacts</a></li>
    <li><a href="schedule.php">Schedule</a></li>
    <li><a href="statistics.php">Statistics</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>

    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
</body>
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

// Get the username and password from the registration form
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if the username is already taken
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  // Username is already taken, display an error message
  echo "Username is already taken.";
} else {
  // Username is available, insert the new user information into the database
  $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  mysqli_query($conn, $query);
  echo "Registration successful.";
}
?>