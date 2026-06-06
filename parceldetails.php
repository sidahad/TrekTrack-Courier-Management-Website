<?php
session_start();
include 'auth.php';
include 'database.php';

if(isset($_POST['ptcheckout'])) {
    $uid = $_SESSION['uid'];  // Assuming session contains user id
    $sname = $_POST['sname'];
    $semail = $_POST['semail'];
    $sphone = $_POST['sphone'];
    $scountry = $_POST['scountry'];
    $scity = $_POST['scity'];
    $saddress = $_POST['saddress'];

    $rname = $_POST['rname'];
    $remail = $_POST['remail'];
    $rphone = $_POST['rphone'];
    $rcountry = $_POST['rcountry'];
    $rcity = $_POST['rcity'];
    $raddress = $_POST['raddress'];

    $dmethod = $_POST['dmethod'];
    $tweight = $_POST['tweight'];
    $totalprice = $_POST['totalprice']; // This is passed via the hidden input field

    // Insert data into the courier_orders table
    $query = "INSERT INTO courier_orders (uid, sname, semail, sphone, scountry, scity, saddress, rname, remail, rphone, rcountry, rcity, raddress, dmethod, tweight, totalprice)
              VALUES ('$uid', '$sname', '$semail', '$sphone', '$scountry', '$scity', '$saddress', '$rname', '$remail', '$rphone', '$rcountry', '$rcity', '$raddress', '$dmethod', '$tweight', '$totalprice')";

    if (mysqli_query($conn, $query)) {
        // Get the last inserted order ID
        $order_id = mysqli_insert_id($conn);

        // Redirect to the payment page with the order_id as a GET parameter
        header("Location: paymentdetails.php?order_id=$order_id");
        exit(); // Ensure script stops executing after the redirect
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sender & Receiver Checkout</title>
    <style>
     
        .chec-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .mai-heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .ta {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .thea , .ther {
            padding: 15px;
            text-align: left;
        }
        .thea {
            background-color: #f4f4f4;
        }
        .ther {
            background-color: #f9f9f9;
        }
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .labeli {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .sele {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .btss {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btss:hover {
            background-color: #218838;
        }
        .total-price {
            font-weight: bold;
            font-size: 20px;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'headers.php'; ?>

<div class="chec-container">
    <h2 class="mai-heading">Sender & Receiver Checkout Details</h2>
    <form action="#" method="POST">
        <!-- Sender and Receiver details -->
        <table class="ta">
            <thead>
                <tr>
                    <th class="thea">Sender Details</th>
                    <th class="thea">Receiver Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ther">
                        <div class="form-section">
                            <label class="labeli" for="sname">Sender Name:</label>
                            <input type="text" id="sname" name="sname" required>

                            <label class="labeli" for="semail">Sender Email:</label>
                            <input type="email" id="semail" name="semail" required>

                            <label class="labeli" for="sphone">Sender Phone:</label>
                            <input type="text" id="sphone" name="sphone" required>

                            <label class="labeli" for="scountry">Sender Country:</label>
                            <input type="text" id="scountry" name="scountry" required>

                            <label class="labeli" for="scity">Sender City:</label>
                            <input type="text" id="scity" name="scity" required>

                            <label class="labeli" for="saddress">Sender Address:</label>
                            <input type="text" id="saddress" name="saddress" required>
                        </div>
                    </td>
                    <td class="ther">
                        <div class="form-section">
                            <label class="labeli" for="rname">Receiver Name:</label>
                            <input type="text" id="rname" name="rname" required>

                            <label class="labeli" for="remail">Receiver Email:</label>
                            <input type="email" id="remail" name="remail" required>

                            <label class="labeli" for="rphone">Receiver Phone:</label>
                            <input type="text" id="rphone" name="rphone" required>

                            <label class="labeli" for="rcountry">Receiver Country:</label>
                            <input type="text" id="rcountry" name="rcountry" required>

                            <label class="labeli" for="rcity">Receiver City:</label>
                            <input type="text" id="rcity" name="rcity" required>

                            <label class="labeli" for="raddress">Receiver Address:</label>
                            <input type="text" id="raddress" name="raddress" required>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Delivery method and weight -->
        <div>
            <label class="labeli" for="dmethod">Delivery Method:</label>
            <select class="sele" id="dmethod" name="dmethod" onchange="calculatePrice()" required>
                <option value="aeroplane" data-price="10000">Aeroplane</option>
                <option value="ship" data-price="5000">Ship</option>
                <option value="truck" data-price="1000">Truck</option>
            </select>
        </div>

        <div>
            <label class="labeli" for="tweight">Weight (KG):</label>
            <select class="sele" id="tweight" name="tweight" onchange="calculatePrice()" required>
                <option value="1">1 KG</option>
                <option value="2">2 KG</option>
                <option value="3">3 KG</option>
                <option value="4">4 KG</option>
                <option value="5">5 KG</option>
            </select>
        </div>

        <!-- Display the calculated price -->
        <div class="total-price">
            Total Price: <span id="price_display">10000</span> USD
        </div>

        <!-- Hidden input to store the total price -->
        <input type="hidden" id="totalprice" name="totalprice" value="10000">

        <button class="btss" type="submit" name="ptcheckout">Proceed to Payment</button>
    </form>
</div>

<script>
    function calculatePrice() {
        const deliveryMethod = document.getElementById('dmethod');
        const weight = document.getElementById('tweight').value;
        const pricePerKg = deliveryMethod.options[deliveryMethod.selectedIndex].dataset.price;

        const totalPrice = pricePerKg * weight;
        document.getElementById('price_display').textContent = totalPrice;

        // Update the hidden input with the calculated total price
        document.getElementById('totalprice').value = totalPrice;
    }

    // Calculate price on page load
    window.onload = calculatePrice;
</script>

<?php include 'footers.php'; ?>

</body>
</html>


