<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $notes = $_POST['notes'];

  // Validate the form data (you can add your own validation rules here)
  if (empty($name)) {
    $errors[] = 'Name is required';
  }

  // If there are no validation errors, insert the contact into the database
  if (empty($errors)) {
    $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone, notes) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $email, $phone, $notes]);

    // Redirect to the contacts list page
    header('Location: contacts.php');
    exit;
  }
}

// Display the form and any validation errors
?>

<h1>Add Contact</h1>

<?php if (!empty($errors)) { ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($errors as $error) { ?>
        <li><?php echo $error; ?></li>
      <?php } ?>
    </ul>
  </div>
<?php } ?>

<form method="POST">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
  </div>
  <div class="form-group">
    <label for="notes">Notes</label>
    <textarea name="notes" class="form-control" id="notes"><?php echo isset($_POST['notes']) ? $_POST['notes'] : ''; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
  <a href="contacts.php" class="btn btn-link">Cancel</a>
</form>
