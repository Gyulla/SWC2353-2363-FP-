<?php
// Retrieve user inputs from the form
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$date = $_POST['date'];
$adultTickets = $_POST['adult-ticket'];
$childTickets = $_POST['child-ticket'];
$seniorTickets = $_POST['senior-ticket'];

// Define ticket prices
$adultPrice = 220;   // Price per adult ticket
$childPrice = 185;   // Price per child ticket
$seniorPrice = 185;  // Price per senior ticket

// Calculate total prices for each ticket type
$totalAdultPrice = $adultTickets * $adultPrice;
$totalChildPrice = $childTickets * $childPrice;
$totalSeniorPrice = $seniorTickets * $seniorPrice;

// Calculate the grand total
$grandTotal = $totalAdultPrice + $totalChildPrice + $totalSeniorPrice;

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticket_booking';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
$sql = "INSERT INTO bookings (name, phone, email, date, adult_tickets, child_tickets, senior_tickets, total_amount)
        VALUES ('$name', '$phone', '$email', '$date', $adultTickets, $childTickets, $seniorTickets, $grandTotal)";

if ($conn->query($sql) === TRUE) {
    // Generate and display receipt
    echo "<h2>Booking Receipt</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Phone: $phone</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Date: $date</p>";
    echo "<p>Adult Tickets: $adultTickets x RM$adultPrice = RM$totalAdultPrice</p>";
    echo "<p>Children Tickets: $childTickets x RM$childPrice = RM$totalChildPrice</p>";
    echo "<p>Senior Tickets: $seniorTickets x RM$seniorPrice = RM$totalSeniorPrice</p>";
    echo "<p>Grand Total: RM$grandTotal</p>";
    echo "<p>Booking information saved successfully!</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
