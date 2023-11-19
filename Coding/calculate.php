<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$date = $_POST['date'];
$adultTickets = $_POST['adult-ticket'];
$childTickets = $_POST['child-ticket'];
$seniorTickets = $_POST['senior-ticket'];

$adultPrice = 220;
$childPrice = 185;
$seniorPrice = 185;

$totalAdultPrice = $adultTickets * $adultPrice;
$totalChildPrice = $childTickets * $childPrice;
$totalSeniorPrice = $seniorTickets * $seniorPrice;

$grandTotal = $totalAdultPrice + $totalChildPrice + $totalSeniorPrice;

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticket_booking';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO bookings (name, phone, email, date, adult_tickets, child_tickets, senior_tickets, total_amount)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiiid", $name, $phone, $email, $date, $adultTickets, $childTickets, $seniorTickets, $grandTotal);

if ($stmt->execute()) {
    include 'receipt_design.php'; 
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
