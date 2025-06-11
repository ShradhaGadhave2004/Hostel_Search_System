<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results</title>
<link rel="stylesheet" href="search.css"> <!-- Link to your CSS file -->
</head>
<body>
<img src="logo1.png" alt="Logo" class="logo">
<div class="container">
    <h2><u>Search Results</u></h2>
    <center><a href="filters.html">Add Filters</a></center>
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

    // Check if the search query is provided in the session variable
    if (isset($_SESSION['search_query'])) {
        // Retrieve the search query from the session variable
        $searchQuery = $_SESSION['search_query'];
        
        // Prepare the base SQL query
        $sql = "SELECT * FROM property WHERE property_name LIKE '%$searchQuery%' OR location LIKE '%$searchQuery%'";
        
        // Check if rent filter is applied
        if (isset($_GET['accommodation']) && !empty($_GET['accommodation'])) {
            $accommodationFilter = $_GET['accommodation'];
            // Assuming 'p_type' is a column in your 'property' table
            // Adjust the column name as per your actual database structure
            $sql .= " AND p_type = '" . $conn->real_escape_string($accommodationFilter) . "'";
        }
        
        // Check if mess availability filter is applied
if (isset($_GET['mess']) && !empty($_GET['mess'])) {
    $mess = $_GET['mess'];
    if ($mess === 'Yes') {
        $sql .= " AND mess = 'Yes'";
    } elseif ($mess === 'No') {
        $sql .= " AND mess = 'No'";
    }
}

// Check if parking availability filter is applied
if (isset($_GET['parking']) && !empty($_GET['parking'])) {
    $parking = $_GET['parking'];
    if ($parking === 'Yes') {
        $sql .= " AND parking = 'Yes'";
    } elseif ($parking === 'No') {
        $sql .= " AND parking = 'No'";
    }
}

// Check if security availability filter is applied
if (isset($_GET['security']) && !empty($_GET['security'])) {
    $security = $_GET['security'];
    if ($security === 'Yes') {
        $sql .= " AND security = 'Yes'";
    } elseif ($security === 'No') {
        $sql .= " AND security = 'No'";
    }
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
                    echo '<a href="view_details.php?property_id=' . $row['property_id'] . '">View Details</a>'; 
                    echo '</div>';
                }
            } else {
                echo '<p>No results found.</p>';
            }
            ?>
        </div>

    <?php
    } else {
        echo '<p>No search query found.</p>';
    }
    ?>
    <a href="home_page.php">Back to Home</a>
</div>
</body>
</html>
