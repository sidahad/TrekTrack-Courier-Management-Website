<?php
include 'auth.php';
include 'database.php';

$query = "SELECT * FROM courier_orders";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching courier orders: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .orders-container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            background-color: #f9f9f9;
        }
        .main-heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<?php include 'headers.php'; ?>

<div class="orders-container">
    <h2 class="main-heading">Courier Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Delivery Method</th>
                <th>Total Weight</th>
                <th>Total Price (USD)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['sname'] . "</td>";
                    echo "<td>" . $row['rname'] . "</td>";
                    echo "<td>" . $row['dmethod'] . "</td>";
                    echo "<td>" . $row['tweight'] . " KG</td>";
                    echo "<td>" . $row['totalprice'] . " USD</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footers.php'; ?>

</body>
</html>
