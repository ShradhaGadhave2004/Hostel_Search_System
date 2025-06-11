<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Property Details</title>
<link rel="stylesheet" href="view_details.css">
</head>
<body>

<img src="logo1.png" alt="Logo" class="logo">
<div class="container">
    <center><h2>Property Details</h2></center>
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
    
    // Check if property ID is provided in the URL
    if (isset($_GET['property_id'])) {
        $propertyId = $_GET['property_id'];
        // SQL query to get property details by ID
        $sql = "SELECT * FROM property WHERE property_id = $propertyId";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Display property details
            $row = $result->fetch_assoc();
            echo '<center>';
            echo '<div class="property-details">';
            echo '<h3><u>' . $row['property_name'] . '</u></h3>';
            echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
            echo '<p><strong>Type:</strong> ' . $row['p_type'] . '</p>';
            echo '<p><strong>Rent Range:</strong> ' . $row['rent_range'] . '</p>';
            echo '<p><strong>Rooms Available:</strong> ' . $row['available'] . '</p>';
            echo '<p><strong>Mess Available:</strong> ' . $row['mess'] . '</p>';
            echo '<p><strong>Security Available:</strong> ' . $row['security'] . '</p>';
            echo '<p><strong>Parking Available:</strong> ' . $row['parking'] . '</p>';
            echo '<p><strong>Speciality:</strong> ' . $row['speciality'] . '</p>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Property Image">';
            echo '</div>';
            echo '<form action="send_interest.php" method="post" class="form-group">';
            echo '<input type="hidden" name="property_id" value="' . $propertyId . '">';
            echo '<p><strong>Note:</strong>Clicking on "I am Interested" will send the owner a mail with your email and contact number. Also you will receive a mail with the details of the owner.</p>';
            echo '<input type="submit" value="I am interested">';
            echo '</form>';
            echo '</center>';
        } else {
            echo '<p>No property found with the provided ID.</p>';
        }
        
        $conn->close();
    } else {
        echo '<p>Property ID not provided.</p>';
    }
    ?>
    <center><a href="home_page.php">Back to Home</a></center>
</div>
<center>
  <div>
  <form action="write_review.php?property_id=<?php echo $propertyId; ?>" method="post">
            <div class="form-group">
                <label for="p_name"><u>Write a Review:</u></label>
                <textarea id="content" name="content" placeholder="Write your review here..."></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" name="submit">
            </div>
 </div>
</center>
<center>
<div class="reviews-section">
    <h3>******Reviews******</h3>
    <?php
    // Reconnect to the database to fetch reviews
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch reviews for the current property ID
    $sql_reviews = "SELECT * FROM reviews WHERE property_id = $propertyId";
    $result_reviews = $conn->query($sql_reviews);

    if ($result_reviews->num_rows > 0) {
        while ($row_review = $result_reviews->fetch_assoc()) {
            echo '<div class="review-item">';
            // Fetch seeker name based on seeker ID
            $seekerId = $row_review['seeker_id'];
            $sql_seeker = "SELECT username FROM hostel_seeker WHERE seeker_id = $seekerId";
            $result_seeker = $conn->query($sql_seeker);
            $row_seeker = $result_seeker->fetch_assoc();
            echo '<p><strong>By:</strong> ' . $row_seeker['username'] . '</p>';
            echo '<p><strong>Date:</strong> ' . $row_review['posted_on'] . '</p>';
            echo '<p>' . $row_review['content'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews available.</p>';
    }
    $conn->close();
    ?>
</div>
</center>
</body>
</html>