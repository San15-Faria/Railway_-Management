<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WebTech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM orders WHERE id=?");
$stmt->bind_param("i", $id);

$id = $_POST['id']; // ID of the order to delete
$stmt->execute();

$stmt->close();
$conn->close();

echo "Order deleted successfully!";
?>
