<?php
/*ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
ini_set('sendmail_from', 'hostelhubfinder@gmail.com');
ini_set('sendmail_path', '\"C:\\xampp1\\sendmail\\sendmail.exe\" -t');

ini_set('smtp_ssl', 'tls');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['property_id'])) {
    // Get the property ID from the form
    $propertyId = $_POST['property_id'];

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

    // SQL query to join property and owner tables to get owner's email
    $sql_owner = "SELECT hostel_owner.email FROM property JOIN hostel_owner ON property.owner_id = hostel_owner.owner_id WHERE property.property_id = $propertyId";
    $result_owner = $conn->query($sql_owner);

    if ($result_owner->num_rows > 0) {
        $row_owner = $result_owner->fetch_assoc();
        $ownerEmail = $row_owner['email'];

        // Send notification email to the owner
        $to = $ownerEmail;
        $subject = "Interest Notification for Property ID: $propertyId";
        $message = "Someone is interested in your property (Property ID: $propertyId).";
        $headers = "From: hostelhubfinder@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Notification email sent to the owner.";
        } else {
            echo "Error sending notification email.";
        }
    } else {
        echo "Owner email not found.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // SMTP server address
    $mail->SMTPAuth = true;
    $mail->Username = 'hostelhubfinder@gmail.com';  // Your email address
    $mail->Password = 'Sssm@2022';  // Your email password
    $mail->SMTPSecure = 'tls';  // Enable TLS encryption
    $mail->Port = 587;  // TCP port to connect to

    // Email content
    $mail->setFrom('hostelhubfinder@gmail.com', 'HostelHubFinder');  // Sender's email and name
    $mail->addAddress('recipient@example.com', 'Recipient Name');  // Recipient's email and name
    $mail->Subject = 'Subject of the email';
    $mail->Body = 'Message content goes here';

    // Send email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}nyxw retq vhjn lrme*/
session_start();
// Include PHPMailer autoload file
require 'C:\xampp1\htdocs\PHPMailer-master\src\Exception.php';
require 'C:\xampp1\htdocs\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp1\htdocs\PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['property_id'])) {
    // Get the property ID from the form
    $propertyId = $_POST['property_id'];

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

    // SQL query to join property and owner tables to get owner's email
    $sql_owner = "SELECT hostel_owner.email FROM property JOIN hostel_owner ON property.owner_id = hostel_owner.owner_id WHERE property.property_id = $propertyId";
    $result_owner = $conn->query($sql_owner);

    if ($result_owner->num_rows > 0) {
        $row_owner = $result_owner->fetch_assoc();
        $ownerEmail = $row_owner['email'];
        $ownerName = $row_owner['username'];
        $ownerContact = $row_owner['contact_no'];

        // Fetch property details
        $sql_property = "SELECT * FROM property WHERE property_id = $propertyId";
        $result_property = $conn->query($sql_property);

        if ($result_property->num_rows > 0) {
            $row_property = $result_property->fetch_assoc();
            $propertyName = $row_property['property_name'];
            $propertyLocation = $row_property['location'];

            $seekerName = $_SESSION['username'];
            $seekerEmail = $_SESSION['email'];
            $seekerContact=$_SESSION['contact_no'];

            // Create a new PHPMailer instance for owner
            $mailOwner = new PHPMailer(true);
            $mailSeeker = new PHPMailer(true);

            try {
               // SMTP configuration for owner
               $mailOwner->isSMTP();
               $mailOwner->Host = 'smtp.gmail.com';  // SMTP server address
               $mailOwner->SMTPAuth = true;
               $mailOwner->Username = 'hostelhubfinder@gmail.com';  // Your email address
               $mailOwner->Password = 'nyxw retq vhjn lrme';  // Your email password
               $mailOwner->SMTPSecure = 'ssl';  // Enable SSL encryption
               $mailOwner->Port = 465;  // TCP port to connect to

               // Email content for owner
               $mailOwner->setFrom('hostelhubfinder@gmail.com', 'Hostel Hub Finder');  // Sender's email and name
               $mailOwner->addAddress($ownerEmail);  // Owner's email
               $mailOwner->Subject = "Interest Notification from HostelHubFinder for your Property: $propertyName";
               $mailOwner->Body = "Someone is interested in your Property: $propertyName (Property ID: $propertyId)!!!. 

               $seekerName has shown interest in viewing your property. 
               Want to send details and information about your property? 
               Contact the seeker directly using contact number $seekerContact or email the details to the email $seekerEmail and get in contact with your seeker!!!
                                  
                                  
               Regards,
               Hostel Hub Finder.
               Email:hostelhubfinder@gmail.com";

               // Send email to owner
               $mailOwner->send();

               // SMTP configuration for seeker
               $mailSeeker->isSMTP();
               $mailSeeker->Host = 'smtp.gmail.com';  // SMTP server address
               $mailSeeker->SMTPAuth = true;
               $mailSeeker->Username = 'hostelhubfinder@gmail.com';  // Your email address
               $mailSeeker->Password = 'nyxw retq vhjn lrme';  // Your email password
               $mailSeeker->SMTPSecure = 'ssl';  // Enable SSL encryption
               $mailSeeker->Port = 465;  // TCP port to connect to

               // Email content for seeker
               $mailSeeker->setFrom('hostelhubfinder@gmail.com', 'Hostel Hub Finder');  // Sender's email and name
               $mailSeeker->addAddress($seekerEmail);  // Seeker's email (assuming you have stored the seeker's email in $seekerEmail)
               $mailSeeker->Subject = "Interest Confirmation from HostelHubFinder for Property: $propertyName";
               $mailSeeker->Body = "Thank you for showing interest in Property: $propertyName (Property ID: $propertyId). 
                                    
               Your request has been forwarded to the owner. Expect to hear from them soon regarding details and information.
               Or directly contact using contact details of the owner!
                                    
                OWNER DETAILS:
                Owner Name: $ownerName
                Owner Email: $ownerEmail
                Owner Contact: $ownerContact
                                    
                                    
                Regards,
                Hostel Hub Finder.
                Email:hostelhubfinder@gmail.com";

               // Send email to seeker
               $mailSeeker->send();

               echo "<script>alert('Notification emails sent to the owner and the seeker.');</script>";
               echo "<script>window.location.href='view_details.php?property_id=$propertyId';</script>";
               exit();
                
            } catch (Exception $e) {
                echo "Error sending notification email: {$mail->ErrorInfo}";
            }
        } else {
            echo "Property details not found.";
        }
    } else {
        echo "Owner email not found.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>

