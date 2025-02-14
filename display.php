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

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM train_bookings WHERE id = $id";
    $conn->query($delete_sql);
}

// Fetch booking details
$sql = "SELECT id, train_number, train_name, ticket_price, from_location, to_location, date_of_travel, class, created_at FROM train_bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Bill</title>
        <link rel='stylesheet' href='bill.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(to bottom, white, #800080);
                margin: 20px;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
            }
            h1 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .action-buttons a {
                margin: 0 5px;
                text-decoration: none;
                color: #007bff;
            }
              .action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px; /* Space between buttons */
}

.action-buttons a {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s, transform 0.2s;
}

.action-buttons a:hover {
    background-color: #0056b3;
    transform: scale(1.05); /* Slightly enlarge the button on hover */
}

.action-buttons a:active {
    transform: scale(0.95); /* Slightly shrink the button when clicked */
}

.proceed-button {
    display: block;
    margin: 20px auto;
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.2s;
}

.proceed-button:hover {
    background-color: #218838;
    transform: scale(1.05);
}

.proceed-button:active {
    transform: scale(0.95);
}
  
        </style>
    </head>
    <body>
        <h1>Booking Bill</h1>
        <table>
            <thead>
                <tr>
                    <th>Train Number</th>
                    <th>Train Name</th>
                    <th>Ticket Price</th>
                    <th>From Location</th>
                    <th>To Location</th>
                    <th>Date of Travel</th>
                    <th>Class</th>
                    <th>Booking Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['train_number']}</td>
                <td>{$row['train_name']}</td>
                <td>Rs. {$row['ticket_price']}</td>
                <td>{$row['from_location']}</td>
                <td>{$row['to_location']}</td>
                <td>{$row['date_of_travel']}</td>
                <td>{$row['class']}</td>
                <td>{$row['created_at']}</td>
                <td class='action-buttons'>
                    <a href='book.html?id={$row['id']}'>Add</a>
                    <a href='display.php?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this booking?\");'>Delete</a>
                </td>
              </tr>";
    }

    echo "      </tbody>
                </table>
                 <a href='meal.html' class='proceed-button'>Book Your Meal</a>
                 
                 <a href='pay.html' class='proceed-button'>Proceed To Pay</a>
                 <a href='book.html' class='proceed-button'>Back To Book Tickets</a>


            </body>
        </html>";
} else {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>No Bookings Found</title>
    </head>
    <body>
        <h1>No Bookings Found</h1>
        <p>No booking records are available at this time.</p>
        <a href='book.html'>Back to Booking</a>
    </body>
    </html>";
}

// Close the connection
$conn->close();
?>
