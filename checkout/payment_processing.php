<?php
session_start();
require '../connnect.php';
if (!isset($_SESSION['UserName']) && !isset($_SESSION["order_id"])) {
    header("Location: ../user/login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST["Place_order"])){
    if(empty($_POST["payment_method"])){
        $error = "Please select a payment method.";
    }else{
        if(isset($_SESSION["order_id"])){
        $order_id = $_SESSION["order_id"];
        }else{
            exit;
        }
        $payment_method = $_POST["payment_method"];
        $payment_status = ($payment_method == "COD")? "COD" : "Paid";
        $sql = 'UPDATE `orders` SET `status` = ?, `payment_method` = ? 
                    WHERE `orders`.`order_id` = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$payment_status,$payment_method, $order_id);
        if ($stmt->execute()) {
            $conn->close();
            $stmt->close();
            unset($_SESSION["order_id"]);
            $succes=10;
        }else{
            $error= $stmt->error;
        }
        // $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Pprocessing</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="../">
            <h1> Boi Bazar </h1>
        </a>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../user/cart.php">Cart</a>
        </nav>
    </header>
    <div class="container">
        <div class="orderplace">
            <h1>Select Payment Option</h1>
            <form action="" method="POST">
                <input type="hidden" name="order_id" value="<?= $order_id;?>"> <!-- Replace with dynamic order_id -->
                <div class="radio-group">
                    <input type="radio" id="visa" name="payment_method" value="Visa">
                    <label for="visa">
                        <span class="icon">💳</span> Visa Card
                    </label>
                    <input type="radio" id="mastercard" name="payment_method" value="MasterCard">
                    <label for="mastercard">
                        <span class="icon">💳</span> MasterCard
                    </label>
                    <input type="radio" id="bank_transfer" name="payment_method" value="Bank Transfer">
                    <label for="bank_transfer">
                        <span class="icon">🏦</span> Bank Transfer
                    </label>
                    <input type="radio" id="cod" name="payment_method" value="COD">
                    <label for="cod">
                        <span class="icon">🚚</span> Cash on Delivery (COD)
                    </label>
                </div>
                <?php if(isset($error)){
                echo ' <b style="color: red;">'.$error.'</b>';
                }
                ?>
                <button name="Place_order">Place Order</button>
            </form>
            <?php
            if (isset($succes)){
                echo '<h1 style="color: green;"> Your order placed successfully.</h1>';
                echo '<p style="font-size:20px;"> Go to <a href="../user/myorder.php" style="text-decoration:none; color:blue;">My Orders</a>.</P';
            }
            ?>
        </div>

    </div>
    </div>

    <?php require '../footer.php'; ?>
</body>

</html>