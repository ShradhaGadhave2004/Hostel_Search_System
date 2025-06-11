<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link rel="stylesheet" href="profile_page.css"> 
</head>
<body>
<img src="logo1.png" alt="Logo" class="logo">
<div class="container">
  <div class="profile-header">
  <h1><u>User Profile</u></h1>
  <br>
  <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
  <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
  <p><strong>Contact No.: <strong><?php echo $_SESSION['contact_no']; ?></p>
  </div>
  <div class="profile-action">
    <a href="update_page.html" class="logout-btn">Edit Profile</a>
    <a href="delete_seeker.php" class="logout-btn">Delete Account</a><br><br>
    <a href="login_page.html" class="logout-btn">Logout</a>
  </div>
  <br>
  <center>
  <div>
    <a href="home_page.php">Back to Home</a>
</div>
</center>

</body>
</html>
