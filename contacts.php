<?php
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
</head>
<body>
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
