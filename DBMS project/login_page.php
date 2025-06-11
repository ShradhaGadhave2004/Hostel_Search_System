<?php
session_start(); // Start the session

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

    // Retrieve username and password from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the user exists and retrieve user data
    /*$sql = "SELECT * FROM hostel_seeker WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);*/
    $sql_owner = "SELECT * FROM hostel_owner WHERE username='$username' AND password='$password'";
    $result_owner = $conn->query($sql_owner);

    // SQL query to check login credentials in hostel_seeker table
    $sql_seeker = "SELECT * FROM hostel_seeker WHERE username='$username' AND password='$password'";
    $result_seeker = $conn->query($sql_seeker);

    if ($result_owner->num_rows > 0) {
        // User authenticated as hostel owner, redirect to owner's home page
        $row = $result_owner->fetch_assoc();
        echo "<script>alert('Logged in as hostel owner');</script>";
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['contact_no'] = $row['contact_no'];
        $_SESSION['owner_id']=$row['owner_id'];
        
        echo "<script>window.location.href='home_pageo.php';</script>";
        exit();
    } elseif ($result_seeker->num_rows > 0) {
        // User authenticated as hostel seeker, redirect to seeker's home page
        $row = $result_seeker->fetch_assoc();
        echo "<script>alert('Logged in as hostel seeker');</script>";
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['contact_no'] = $row['contact_no'];
        $_SESSION['seeker_id']=$row['seeker_id'];
        echo "<script>window.location.href='home_page.php';</script>";
        exit();
    } else {
        // Authentication failed, redirect back to login page with an error message
        echo "<script>alert('Invalid username or password');</script>";
        echo "<script>window.location.href='login_page.html';</script>";
        exit();
    }

    $conn->close();
}
?>



  



