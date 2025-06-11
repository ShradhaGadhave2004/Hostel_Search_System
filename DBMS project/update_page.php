<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these with your actual database credentials
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

    // Retrieve new email and password from the form
    $newEmail = $_POST['new-email'];
    $newPassword = $_POST['new-password'];
    $newContact = $_POST['new-contact_no'];

    // Update the user's data in the database
    $username = $_SESSION['username']; // Get the username from the session
    $sql = "UPDATE hostel_seeker SET email='$newEmail', password='$newPassword', contact_no='$newContact' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        // Update successful, redirect to the profile page
        $_SESSION['email'] = $newEmail; // Update the email in the session
        $_SESSION['contact_no'] = $newContact;
        header("Location: profile_page.php");
        exit();
    } else {
        // Error updating data, redirect back to the profile page with a message
        header("Location: profile_page.php?error=1");
        exit();
    }

    $conn->close();
}
?>
