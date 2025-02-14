<?php
// Database connection
$servername = "localhost"; // Change this to your server details
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "WebTech"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$trainData = explode("|", $_POST['train']);
$trainNumber = $trainData[0];
$trainName = $trainData[1];
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];
$class = $_POST['class'];

// Get timing and cost
$sql = "SELECT timing, ticket_price FROM bookings WHERE train_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $train_number);
$stmt->execute();
$stmt->bind_result($timing, $ticket_price);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
<div class="bg-img">
    <h1>Booking Confirmation</h1>
    <table>
        <thead>
            <tr>
                <th>Train Number</th>
                <th>Train Name</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Timing</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($trainNumber); ?></td>
                <td><?php echo htmlspecialchars($trainName); ?></td>
                <td><?php echo htmlspecialchars($from); ?></td>
                <td><?php echo htmlspecialchars($to); ?></td>
                <td><?php echo htmlspecialchars($timing); ?></td>
                <td>Rs.<?php echo htmlspecialchars($ticket_price); ?></td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
