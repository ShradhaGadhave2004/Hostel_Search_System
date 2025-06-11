<?php
/*session_start(); // Start the session

// Check if the seeker is logged in
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
    if (isset($_GET['property_id'])) {
        $propertyId = $_GET['property_id'];

    // Sanitize input data to prevent SQL injection
    $content=$_POST['content'];
    $seekerId = $_SESSION['seeker_id']; // Get the seeker's ID from the session
    
    // Prepare and execute the SQL query to insert property details and image data
    $sql = "INSERT INTO reviews (content, property_id, seeker_id) VALUES ('$content', '$propertyId', '$seeker_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Review posted successfully.');</script>";
        echo "<script>window.location.href='view_details.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
        $conn->close();
    }else{
        echo '<p>Property ID not provided.</p>';
    }
}*/
session_start(); // Start the session

// Check if the seeker is logged in
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

    if (isset($_GET['property_id'])) {
        $propertyId = (int) $_GET['property_id'];

        // Sanitize user input (improved)
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING); // Escape special characters

        $seekerId = $_SESSION['seeker_id']; // Get the seeker's ID from the session

        // Prepare SQL statement with placeholders
        $sql = "INSERT INTO reviews (content, property_id, seeker_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind sanitized values to placeholders
        $stmt->bind_param('sss', $content, $propertyId, $seekerId);

        if ($stmt->execute()) {
            echo "<script>alert('Review posted successfully.');</script>";
            echo "<script>window.location.href='view_details.php?property_id=$propertyId';</script>";
            exit();
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

        $stmt->close(); // Close the prepared statement
    } else {
        echo '<p>Property ID not provided.</p>';
    }

    $conn->close();
}
?>