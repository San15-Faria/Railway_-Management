<?php
// Database configuration
$host = "localhost";
$dbname = "WebTech";
$username = "root";
$password = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Check if the username or email already exists
$sql = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('An account with this username or email already exists. Please try another.');</script>";
    echo "<script>window.location.href='signup.html';</script>";
} else {
    // Insert new user
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: Could not register user.');</script>";
        echo "<script>window.location.href='signup.html';</script>";
    }
}

$stmt->close();
$conn->close();
?>
