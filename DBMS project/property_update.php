<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['owner_id'])) {
    header("Location: login_page.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file or configure the connection here
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

    // Retrieve form data
    $ownerId = $_SESSION['owner_id'];
    $updates = []; // Array to store the updates dynamically

    if (!empty($_POST['new-name'])) {
        $updates[] = "property_name = '" . $_POST['new-name'] . "'";
    }
    if (!empty($_POST['new-location'])) {
        $updates[] = "location = '" . $_POST['new-location'] . "'";
    }
    if (!empty($_POST['new-p_type'])) {
        $updates[] = "p_type = '" . $_POST['new-p_type'] . "'";
    }
    if (!empty($_POST['new-rent_range'])) {
        $updates[] = "`rent-range` = '" . $_POST['new-rent_range'] . "'"; 
    }
    if (!empty($_POST['new-accommodation'])) {
        $updates[] = "accommodation_types = '" . $_POST['new-accommodation'] . "'";
    }
    if (!empty($_POST['new-available'])) {
        $updates[] = "available = '" . $_POST['new-available'] . "'";
    }
    if (!empty($_POST['new-gender'])) {
        $updates[] = "gender = '" . $_POST['new-gender'] . "'";
    }
    if (!empty($_POST['new-mess'])) {
        $updates[] = "mess = '" . $_POST['new-mess'] . "'";
    }
    if (!empty($_POST['new-security'])) {
        $updates[] = "security = '" . $_POST['new-security'] . "'";
    }
    if (!empty($_POST['new-parking'])) {
        $updates[] = "parking = '" . $_POST['new-parking'] . "'";
    }
    if (!empty($_POST['new-speciality'])) {
        $updates[] = "speciality = '" . $_POST['new-speciality'] . "'";
    }
    
    // Construct the SQL UPDATE query
    $sql = "UPDATE property SET " . implode(", ", $updates) . " WHERE owner_id = $ownerId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Property details updated successfully.')</script>";
        header("Location: profileo_page.php");
        exit();
    } else {
        echo "Error updating property details: " . $conn->error;
    }

    $conn->close();
}
?>
