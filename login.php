<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Log in</button>
    </form>
</html>

<?php
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
