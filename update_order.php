<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WebTech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE orders SET username=?, phone=?, meal=?, order_date=? WHERE id=?");
$stmt->bind_param("ssssi", $username, $phone, $meal, $order_date, $id);

$username = $_POST['username'];
$phone = $_POST['phone'];
$meal = $_POST['meal'];
$order_date = $_POST['date'];
$id = $_POST['id'];
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: table.html");
exit;
?>
