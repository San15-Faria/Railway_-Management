<?php
// Database connection parameters
$servername = "localhost"; // Update if necessary
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "WebTech"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$phone = $_POST['phone'];
$meal = $_POST['meal'];

// Determine meal name and cost based on the selected option
switch ($meal) {
    case '10':
        $meal_name = 'Tea';
        $cost = 10.00;
        break;
    case '50':
        $meal_name = 'Samosa';
        $cost = 50.00;
        break;
    case '70':
        $meal_name = 'Idli sambhar';
        $cost = 70.00;
        break;
    case '80':
        $meal_name = 'Rice Roti';
        $cost = 80.00;
        break;
    case '100':
        $meal_name = 'Vegetarian Thali';
        $cost = 100.00;
        break;
    case '150':
        $meal_name = 'Non-Vegetarian Thali';
        $cost = 150.00;
        break;
    default:
        die("Invalid meal selection.");
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO orders (username, phone, meal_name, cost) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $username, $phone, $meal_name, $cost);

// Execute the statement
if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
