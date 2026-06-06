<?php
session_start();
include 'auth.php'; // Authentication check
include 'database.php'; // Database connection

// Check if order_id is passed via query string or session
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} elseif (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
} else {
    echo "No order selected for payment.";
    exit;
}

if (isset($_POST["paybutton"])) {
    $cardType = $_POST['cardType'];
    $cardHolderName = $_POST['cardHolderName'];
    $cardNumber = $_POST['cardNumber'];
    $expDate = $_POST['expDate'];
    $cvv = $_POST['cvv'];
    $user_id = $_SESSION['uid']; // Fetch the user_id based on logged-in user session
    $transaction_date = date('Y-m-d H:i:s'); // Current timestamp

    // Insert the payment details into the database
    $stmt = $conn->prepare("INSERT INTO payments (user_id, order_id, card_type, card_number, card_holder_name, expiration_date, cvv, transaction_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssss", $user_id, $order_id, $cardType, $cardNumber, $cardHolderName, $expDate, $cvv, $transaction_date);

    if ($stmt->execute()) {
        echo "<script>alert('Payment Successful!'); window.location.href='index.php';</script>";
    } else {
        echo "Payment Failed: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>
    <link rel="stylesheet" href="paymentdetails.css">
</head>
<body>

<div class="container">
    <h2>Credit Card Payment</h2>
    
    <form method="POST">
        <div class="card-details">
            <label for="cardType">Card Type</label>
            <select name="cardType" id="cardType" required>
                <option value="visa">Visa</option>
                <option value="mastercard">MasterCard</option>
                <option value="amex">American Express</option>
            </select>

            <label for="cardHolderName">Card Holder Name</label>
            <input type="text" name="cardHolderName" id="cardHolderName" required>

            <label for="cardNumber">Card Number</label>
            <input type="text" name="cardNumber" id="cardNumber" maxlength="16" required>

            <label for="expDate">Expiration Date</label>
            <input type="month" name="expDate" id="expDate" required>

            <label for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv" maxlength="3" required>

            <!-- Hidden input to store the user_id and order_id -->
            <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

            <button type="submit" name="paybutton" class="pay-button">Make Payment</button>
        </div>
    </form>
</div>

</body>
</html>
