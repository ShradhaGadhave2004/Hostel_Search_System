<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email']) || !isset($_SESSION['owner_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.html");
    exit();
}

// Check if property ID is provided in the URL
if (isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

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

    // Prepare and execute SQL DELETE query
    $sql = "DELETE FROM property WHERE property_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind property ID parameter
        $stmt->bind_param('i', $propertyId);

        // Execute the statement
        if ($stmt->execute()) {
            // Property deleted successfully
            echo "<script>alert('Property deleted successfully.')</script>";
            header("Location: profileo_page.php");
            exit();
        } else {
            echo "Error deleting property: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Property ID not provided.";
}
?>
