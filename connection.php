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