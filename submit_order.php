<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WebTech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO orders (username, phone, meal, order_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $phone, $meal, $order_date);

$username = $_POST['username'];
$phone = $_POST['phone'];
$meal = $_POST['meal'];
$order_date = $_POST['date'];
$stmt->execute();

$stmt->close();
$conn->close();

echo "Order placed successfully!";
?>
