<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
</body>
</html>

<?php
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