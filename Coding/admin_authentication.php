<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticket_booking';

$adminID = $_POST['admin_id'];
$adminPassword = $_POST['admin_password'];

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admins WHERE admin_id = ? AND admin_password = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $adminID, $adminPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_id'] = $adminID;

        header('Location: admin_dashboard.php');
        exit();
    } else {
        header('Location: admin_login.html');
        exit();
    }

    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
