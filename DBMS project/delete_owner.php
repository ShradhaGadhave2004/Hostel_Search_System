<?php
session_start(); // Start the session

// Check if the owner is logged in
if (!isset($_SESSION['owner_id'])) {
    // Redirect to the login page or any other page as needed
    header("Location: login.php");
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

// Get the logged-in owner's ID
$owner_id = $_SESSION['owner_id'];

// Delete properties associated with the owner
$sql_delete_properties = "DELETE FROM property WHERE owner_id = $owner_id";

if ($conn->query($sql_delete_properties) === TRUE) {
    // Properties deleted successfully
} else {
    // Error in deleting properties
    echo "Error deleting properties: " . $conn->error;
    exit();
}

// Delete the owner's account
$sql_delete_owner = "DELETE FROM owner WHERE owner_id = $owner_id";

if ($conn->query($sql_delete_owner) === TRUE) {
    // Account deleted successfully
    // Destroy the session and redirect to a confirmation page or any other page
    session_destroy();
    header("Location: signup_page.html");
    exit();
} else {
    // Error in deleting the account
    echo "Error deleting account: " . $conn->error;
}

$conn->close(); // Close the database connection
?>
