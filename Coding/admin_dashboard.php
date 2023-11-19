<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.html');
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticket_booking';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $deleteBookingID = $_GET['delete'];

    $deleteSql = "DELETE FROM bookings WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $deleteBookingID);
    $deleteStmt->execute();

    header('Location: admin_dashboard.php');
    exit();
}

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .dashboard-container {
            max-width: 900px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-btn {
            background-color: #ff0000;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['admin_id']; ?> | <a href="admin_login.html">Logout</a></p>

    <h3>Users' Bookings</h3>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date</th>
            <th>Adult Tickets</th>
            <th>Child Tickets</th>
            <th>Senior Tickets</th>
            <th>Total Amount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['adult_tickets'] . "</td>";
                echo "<td>" . $row['child_tickets'] . "</td>";
                echo "<td>" . $row['senior_tickets'] . "</td>";
                echo "<td>" . $row['total_amount'] . "</td>";
                echo "<td><button class='delete-btn' onclick='deleteBooking(" . $row['id'] . ")'>Delete</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No bookings available</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    function deleteBooking(bookingID) {
        var confirmDelete = confirm("Are you sure you want to delete this booking?");
        if (confirmDelete) {
            window.location.href = 'admin_dashboard.php?delete=' + bookingID;
        }
    }
</script>

</body>
</html>
