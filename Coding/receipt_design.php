<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <link rel="stylesheet" href="styleReceipt.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section class="receipt">
        <h2>Booking Receipt</h2>
        <div class="receipt-info">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Date:</strong> <?php echo $date; ?></p>
            <p><strong>Adult Tickets:</strong> <?php echo $adultTickets; ?> x RM<?php echo $adultPrice; ?></p>
            <p><strong>Child Tickets:</strong> <?php echo $childTickets; ?> x RM<?php echo $childPrice; ?></p>
            <p><strong>Senior Tickets:</strong> <?php echo $seniorTickets; ?> x RM<?php echo $seniorPrice; ?></p>
        </div>
    
        <div class="total-amount">
            <p><strong>Total Amount:</strong> <span>RM<?php echo $grandTotal; ?></span></p>
        </div>
    </section>
</body>
</html>
