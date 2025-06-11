<?php
session_start(); // Start the session

// Check if the owner is logged in
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

    // Sanitize input data to prevent SQL injection
    $propertyName = mysqli_real_escape_string($conn, $_POST['p_name']);
    $propertyLocation = mysqli_real_escape_string($conn, $_POST['p_location']);
    $propertyType = mysqli_real_escape_string($conn, $_POST['p_type']);
    $propertyRent = $_POST['rent_range'];
    $propertyAccommodation = $_POST['accommodation']; 
    $propertyAvailable = $_POST['available'];
    $propertyGender = $_POST['gender'];
    $propertyMess = $_POST['mess'];
    $propertySecurity = $_POST['security'];
    $propertyParking = $_POST['parking'];
    $propertySpeciality = $_POST['speciality'];
    $ownerId = $_SESSION['owner_id']; // Get the owner's ID from the session

    // Prepare and execute the SQL query to insert property details and image data
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);

        // Prepare and execute the SQL query to insert property details and image data
        $stmt = $conn->prepare("INSERT INTO property (property_name, p_type, location, gender, rent_range, accommodation_types, available, mess, security, parking, speciality, image_data, owner_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssi", $propertyName, $propertyType, $propertyLocation, $propertyGender, $propertyRent, $propertyAccommodation, $propertyAvailable, $propertyMess, $propertySecurity, $propertyParking, $propertySpeciality, $imageData, $ownerId);
        $stmt->execute();

        // Check if the property was successfully inserted
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Property added successfully.')</script>";
            header("Location: profileo_page.php");
            exit();
        } else {
            echo "Error adding property.";
        }

        $stmt->close();
    } else {
        echo "Error uploading image.";
    }

    $conn->close();
}
?>