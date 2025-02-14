<!-- update.php -->
<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $train = $_POST['train'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $class = $_POST['class'];
    $price = $_POST['price'];

    // Update the booking
    $stmt = $pdo->prepare("UPDATE bookings SET train=?, from_location=?, to_location=?, date=?, class=?, price=? WHERE id=?");
    $stmt->execute([$train, $from, $to, $date, $class, $price, $id]);

    header('Location: payment-success.php'); // Redirect to confirmation page
    exit();
}

// Get the booking details from the database
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$id]);
$booking = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
</head>
<body>
    <h1>Update Booking</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
        <label for="train">Train:</label>
        <input type="text" name="train" value="<?php echo htmlspecialchars($booking['train']); ?>" required>
        <br>

        <label for="from">From:</label>
        <input type="text" name="from" value="<?php echo htmlspecialchars($booking['from_location']); ?>" required>
        <br>

        <label for="to">To:</label>
        <input type="text" name="to" value="<?php echo htmlspecialchars($booking['to_location']); ?>" required>
        <br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($booking['date']); ?>" required>
        <br>

        <label for="class">Class:</label>
        <input type="text" name="class" value="<?php echo htmlspecialchars($booking['class']); ?>" required>
        <br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($booking['price']); ?>" required>
        <br>

        <input type="submit" value="Update Booking">
    </form>
</body>
</html>
