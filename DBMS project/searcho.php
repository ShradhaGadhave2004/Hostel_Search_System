<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results</title>
<link rel="stylesheet" href="search.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="container">
<img src="logo1.png" alt="Logo" class="logo">
    <h2><u>Search Results</u></h2>
    <center><a href="filterso.html">Add Filters</a></center>
    <?php
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
    
    session_start(); // Start the session

    // Check if the search query is provided in the URL (via $_GET)
    if (isset($_GET['search'])) {
        // Store the search query in a session variable
        $_SESSION['search_query'] = $_GET['search'];
    }
    $searchQuery = $_SESSION['search_query'];
    
    // Prepare the base SQL query
    $sql = "SELECT * FROM property WHERE property_name LIKE '%$searchQuery%' OR location LIKE '%$searchQuery%'";
    
    // Check if accommodation type filter is applied
if (isset($_GET['accommodation']) && !empty($_GET['accommodation'])) {
    $accommodationFilter = $_GET['accommodation'];
    // Assuming 'p_type' is a column in your 'property' table
    // Adjust the column name as per your actual database structure
    $sql .= " AND p_type = '" . $conn->real_escape_string($accommodationFilter) . "'";
}

if (isset($_GET['rent']) && !empty($_GET['rent'])) {
    $rentFilter = $_GET['rent'];
    if ($rentFilter == 'Lowest_to_Highest') {
        $sql .= " ORDER BY CAST(SUBSTRING_INDEX(rent_range, 'Rs.', -1) AS UNSIGNED) ASC";
    } else if ($rentFilter == 'Highest_to_Lowest') {
        $sql .= " ORDER BY CAST(SUBSTRING_INDEX(rent_range, 'Rs.', -1) AS UNSIGNED) DESC";
    }
}      
    // Execute the SQL query
    $result = $conn->query($sql);
    
    ?>

    <div class="results-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="result-item">';
                echo '<h3>' . $row['property_name'] . '</h3>';
                echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                echo '<p><strong>Type:</strong> ' . $row['p_type'] . '</p>';
                echo '<p><strong>Rent range:</strong> ' . $row['rent_range'] . '</p>';
                echo '<a href="view_detailso.php?property_id=' . $row['property_id'] . '">View Details</a>'; 
                echo '</div>';
            }
        } else {
            echo '<p>No results found.</p>';
        }
        ?>
    </div>

    <a href="home_pageo.php">Back to Home</a>
</div>
</body>
</html>
