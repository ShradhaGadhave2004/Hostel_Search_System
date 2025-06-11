<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Specify your database password here
$database = "hostelhubfinder";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact_no'];
    $option = $_POST['type'];

    // Prepare the SQL statement to insert data based on the user type
    if ($option == 'hostel_owner') {
        $sql = "INSERT INTO hostel_owner (username, password, email, contact_no) VALUES ('$username', '$password', '$email', '$contact')";
    } elseif ($option == 'hostel_seeker') {
        $sql = "INSERT INTO hostel_seeker (username, password, email, contact_no) VALUES ('$username', '$password', '$email', '$contact')";
    }

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Account created successfully');</script>";
        echo "<script>window.location.href='login_page.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
