<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HostelHubFinder</title>
<link rel="stylesheet" href="home_pageo.css">
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <div class="container">
        <img src="logo1.png" alt="Logo" class="logo">
        <a href="home_page.php">Home</a>
        <a href="about_us.html">About Us</a>
        <a href="contact_us.html">Contact Us</a>
        <a href="profile_page.php" class="top-right">View Your Profile</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to HostelHubFinder</h1>
        <p><strong>Find the perfect hostel for your stay!</strong></p>
    </div>
</section>

<!-- Features Section -->
<center>
<section class="features">
    <div class="container">
    <h1><u>Search here!!</u></h1><br>
                <h3>Search your dream stay just by searching the name and choosing the facilities!</h3>
    <form action="search.php" method="GET">
    <label for="search">Search:</label>
    <input type="text" name="search" placeholder="Search by Name or Location" required><br><br>
    <label for="rent">Rent:</label>
    <select name="rent" id="rent">
        <option value="">Any</option>
        <option value="Lowest_to_Highest">Lowest_to_Highest</option>
        <option value="Highest_to_Lowest">Highest_to_Lowest</option>
    </select>
<br><br>
    <label for="accommodation">Accommodation Type:</label>
    <select name="accommodation" id="accommodation">
        <option value="">Any</option>
        <option value="Hostel">Hostel</option>
        <option value="PG">PG</option>
        <option value="Flat">Flat</option>
    </select>
<br><br>
    <!--<input type="submit" name="submit" value="Search">  Added name attribute to submit button -->
    <input type="submit" value="Search" name="submit">
    </form>
    </div>
</section>
</center>

<center>
    <h1>Our Top Hostels, PG and Flats</h1>
</center>
<!-- Featured Properties Section -->
<section class="featured-properties">
    <div class="container1">
        <div class="property">
            <img src="saheli1.jpeg" alt="Property 1">
            <br><br>
            <h3>Saheli Hostel</h3>
            <p>Near Cummins College</p>
            <p>Karvenagar, Pune</p>
            <br>
            <p>"Liked and Viewed</p>
            <p>by most of the students."</p>
        </div>
        <div class="property">
            <img src="gayatri.jpeg" alt="Property 2">
            <h3>Gayatri Apartments</h3>
            <p>Near Kothrud Stand</p>
            <p>Kothrud, Pune</p>
            <br>
            <p>"Convenient and Good</p>
            <p>Locality for staying."</p>
        </div>
        <div class="property">
            <img src="download2.jpeg" alt="Property 3">
            <h3>Sahyadri PG</h3>
            <p>Near Kothrud Stand</p>
            <p>Kothrud, Pune</p>
            <br>
            <p>"Convenient and Good</p>
            <p>Locality for staying."</p>
        </div>
    </div>
</section>

<center>
    <h1>Meet Team HostelHubFinder!!</h1>
</center>
<!-- Team Section -->
<section class="team">
    <div class="container1">
        <div class="team-member">
            <img src="team1.jpg" alt="Team Member 1">
            <h3>Shradha Gadhave</h3>
            <p>System Head</p>
        </div>
        <div class="team-member">
            <img src="team2.jpg" alt="Team Member 2">
            <h3>Disha Chavan</h3>
            <p>Data Management Head</p>
        </div>
        <div class="team-member">
            <img src="team3.jpg" alt="Team Member 3">
            <h3>Shambhavi Bhosale</h3>
            <p>Customer Support Head</p>

        </div>
    </div>
</section>

<!-- Footer Section -->
<footer>
    <div class="container">
        <div class="social-icons">
            <a href="#">LinkedIn</a>
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">Twitter</a>
        </div>
        <p>&copy; 2024 HostelHubFinder</p>
    </div>
</footer>

</body>
</html>
