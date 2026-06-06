<?php

include 'auth.php';
include 'database.php';

if(isset($_POST['order'])){

    $uid = $_SESSION['uid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql_total = "SELECT SUM(subtotal) AS total FROM cart WHERE uid = $uid";
    $result_total = mysqli_query($conn, $sql_total);
    $total = mysqli_fetch_assoc($result_total)['total'];

    $sql_order = "INSERT INTO `orders`(`uid`, `oname`, `ophone`, `oaddress`, `oemail`, `total`) VALUES ('$uid','$name','$phone','$address','$email','$total')";

    if(mysqli_query($conn, $sql_order)){
        
        $oid = mysqli_insert_id($conn);

        $sql_select_cart = "SELECT * FROM cart WHERE `uid` = $uid";

        $result_select_cart = mysqli_query($conn, $sql_select_cart);

        $row_count_cart = mysqli_num_rows($result_select_cart);

        if($row_count_cart){
            while($row = mysqli_fetch_assoc($result_select_cart)){
                $cart_id = $row['cart_id'];
                $pid = $row['pid'];
                $price = $row['price'];
                $qty = $row['qty'];
                $subtotal = $row['subtotal'];

                $sql_insert_items = "INSERT INTO `order_items`(`pid`, `oid`, `price`, `qty`, `subtotal`) VALUES ('$pid','$oid','$price','$qty','$subtotal')";

                if(mysqli_query($conn, $sql_insert_items)){
                    $sql_delete_cart = "DELETE FROM `cart` WHERE cart_id = $cart_id";

                    $result_delete_cart = mysqli_query($conn, $sql_delete_cart);

                    
                }
            }

            echo "<script>
                    alert('Order Successfull');
                </script>";

            header('location: index.php');
        }


    }



}


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 

    <form action="" method="POST">
    <label for="">
        Name: <input type="text" name="name">
    </label>
    <label for="">
        Phone: <input type="number" name="phone">
    </label>
    <label for="">
        Email: <input type="email" name="email">
    </label>
    <label for="">
        Address: <input type="text" name="address">
    </label>
        <input type="submit" name="order" value="FINISH ORDER">

    </form>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
  
<?php
    include 'headers.php'
    ?>
<div class="container">
        <h1 class="text-center mb-4 " style="padding-top: 5rem;">Checkout</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Personal info</div>
                    <div class="card-body">
                        <form action="" method="POST">     
                       <div class="form-group">
                            <label for="firstName">Username</label>
                            <input type="text" class="form-control" id="firstName" name="name" placeholder="Jacqueline">
                        </div>
                        
                        <div class="form-group">
                            <label for="mobileNumber">Mobile number</label>
                            <input type="tel" class="form-control" id="mobileNumber" name="phone" placeholder="9154857896">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address " name="address" placeholder="1421 Coburn Hollow Road Metamora, Near Center Point, IL 61548.">
                        </div>
                    </div>
                 

                </div>
            </div>
            <?php


$uid = $_SESSION['uid'];

$sql1 = "SELECT * FROM products, cart WHERE cart.pid = products.pid AND cart.uid = $uid";

$resilt = mysqli_query($conn,$sql1);

$row__count = mysqli_num_rows($resilt);
$rew=mysqli_fetch_assoc($resilt);
$totalprice = 50;
$pay = $totalprice + $rew['subtotal'] ;
?>
            <div class="col-md-6">
                <div class="card">
                    
                        <div class="form-group" style="margin-top: 15px;">
                             <label class="form-label" >Subtotal</label>
                           
                            <span class="float-right"><?php echo $rew ['subtotal'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Service Charge</label>
                            <span class="float-right"><?php echo $totalprice ?></span>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <label>Payable Now</label>
                            <span class="float-right"><b><?php echo $pay ?></b></span>
                        </div>
                        <button type="submit" class="btn btn-success btn-block" name="order" style="margin-top: 15px;">Place order</button>
                    </div>
                </div>
            </div>
        </div>
       
    </tr>  
    </form>    
</div>
</body>
</html>