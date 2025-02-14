<?php
// Database connection parameters
$servername = "localhost"; // Change if necessary
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "WebTech"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $trainDetails = explode('|', $_POST['train']);
    $trainNumber = $trainDetails[0];
    $trainName = $trainDetails[1];
    $ticketPrice = $trainDetails[2];
    $fromLocation = $_POST['from'];
    $toLocation = $_POST['to'];
    $dateOfTravel = $_POST['date'];
    $class = $_POST['class'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO train_bookings (train_number, train_name, ticket_price, from_location, to_location, date_of_travel, class) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $trainNumber, $trainName, $ticketPrice, $fromLocation, $toLocation, $dateOfTravel, $class);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Booking recorded successfully!'); window.location.href='display.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>