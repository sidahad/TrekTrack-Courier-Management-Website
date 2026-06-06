<?php
session_start();
include 'database.php'; // Database connection file
include 'auth.php'; // Authentication check file

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "Please log in to view your payments.";
    exit;
}

$user_id = $_SESSION['uid']; // Assuming the user ID is stored in the session

// Fetch payment records for the logged-in user
$sql = "SELECT user_id, order_id, card_type, card_holder_name, expiration_date, transaction_date FROM payments WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Your Payment Records (User ID: $user_id)</h2>";
    echo "<table border='1'>
            <tr>
                <th>User ID</th>
                <th>Order ID</th>
                <th>Card Type</th>
                <th>Card Holder Name</th>
                <th>Expiration Date</th>
                <th>Transaction Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['user_id'] . "</td>
                <td>" . $row['order_id'] . "</td>
                <td>" . $row['card_type'] . "</td>
                <td>" . $row['card_holder_name'] . "</td>
                <td>" . $row['expiration_date'] . "</td>
                <td>" . $row['transaction_date'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No payment records found.";
}

$stmt->close();
$conn->close();
?>

