<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email']) || !isset($_SESSION['owner_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.html");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostelhubfinder";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the owner ID from the session
$ownerId = $_SESSION['owner_id'];

// SQL query to fetch property details owned by the owner
$sql_property = "SELECT * FROM property WHERE owner_id = $ownerId";
$result = $conn->query($sql_property);
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
  <p><strong>Contact No.:</strong> <?php echo $_SESSION['contact_no']; ?></p>
  <a href="update_page.html" class="logout-btn">Edit Profile</a>
  <!-- Display property details if the logged-in user is an owner -->
  <?php if ($result->num_rows > 0) : ?>
    <h2><u>Owned Properties</u></h2>
    
      <?php while ($row = $result->fetch_assoc()) : ?>
        <strong>Property name:</strong><?php echo $row['property_name']; ?><br><br>
        <strong>Location:</strong><?php echo $row['location']; ?><br><br>
        <strong>Type:</strong><?php echo $row['p_type']; ?><br><br>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image_data']); ?>" alt="Property Image"><br><br>
        <a href="property_update.html" class="logout-btn">Update Property Data</a> 
        <a href="view_detailso.php?property_id=<?php echo $row['property_id']; ?>" class="logout-btn">View Details</a>
        <br><br>
        <a href="delete.php?property_id=<?php echo $row['property_id']; ?>" class="logout-btn">Delete Property</a>
        <hr>
      <?php endwhile; ?>
    
  <?php else : ?>
    <p>No properties owned.</p>
  <?php endif; ?>
  </div>
  <div class="profile-action">
  <a href="delete_owner.php" class="logout-btn">Delete Account</a>
    <a href="login_page.html" class="logout-btn">Logout</a>
  </div>
  <br>
  <center>
<div>
    <a href="home_pageo.php">Back to Home</a>
</div>
  </center>
</div>

</body>
</html>
