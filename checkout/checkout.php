<?php
session_start();
require '../connnect.php';

// Check if the user is logged in
if (!isset($_SESSION['UserName'])) {
    header("Location: ../user/login.php"); // Redirect to login page if not logged in
    exit();
}

// if(isset($_SESSION["order_id"])){
//     header("Location: payment_processing.php");
// }
if (isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
} else {
    // header("Location: ../index.php");
}
// Get the logged-in user ID
$user_name = $_SESSION['UserName'];
$sql = 'SELECT `SL` FROM `users` WHERE `UserName`=' . '"' . $user_name . '"';
$row = mysqli_fetch_assoc($conn->query($sql));
$user_id = $row["SL"];

// Check if the user has added an address
$sql_address = "SELECT * FROM address WHERE `SL` = ?";
$stmt = $conn->prepare($sql_address);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($rowadd = $result->fetch_assoc()) {
    $address_id = $rowadd['SL'];
} else {
    header("Location: ../user/profile.php");
    exit();
}
if (isset($_POST["proceed"])) {
    $user_id = $_POST["uid"];
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quanty"];
    $unitprice = $_POST["unitprice"];
    $delivery_fee = $_POST["delivery"];
    $tprice = $_POST["tprice"];
    // $address_id= $_POST["address_id"];
    $proceed_sql = "INSERT INTO `orders` (`user_id`, `product_id`, `quantity`, `unit_price`, `delivery_fee`,
     `total_price`, `payment_method`, `shipping_address`, `billing_address`) 
    VALUES ('$user_id', '$product_id', '$quantity', '$unitprice', '$delivery_fee', '$tprice', 'pending', '$address_id', '$address_id')";

    if (mysqli_query($conn, $proceed_sql)) {
        $order_id = mysqli_insert_id($conn);
        $_SESSION["order_id"] = $order_id;
        $conn->close();
        header("Location: payment_processing.php");
    } else {
        echo ' <h1 style="color: red;">An error occers.</h1>';
    }
}

// If address exists, proceed to payment or checkout section
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>

<body>
    <header>
        <a href="../">
            <h1> Boi Bazar </h1>
        </a>
        <nav>
            <a href="../index.php">Home</a>
            <!-- <a href="">Contact</a> -->
            <a href="../user/cart.php">Cart</a>
            <!-- <a href="">About</a> -->
        </nav>
    </header>
    <div class="checkout_container">
        <h2 id="checkout_h2">Checkout and Payment</h2>
        <div id="product">
            <?php
            echo '<div id="image">';
            $sql = "SELECT `books`.*, `images`.`img1` FROM `books` 
                LEFT JOIN `images` ON `books`.`Id`=`images`.`Id`
                WHERE `books`.`Id`=$product_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo '<img src="data:image/jpg;base64,' . base64_encode($row["img1"]) . '"alt="Product 1">';
            echo "</div>";
            echo '<div id="data">';
            echo '<h3>' . $row["BName"] . '</h3>';
            echo '<div id="price" data-info="' . $row["price"] . '">Price: ' . $row["price"] . ' BDT</div> <br>';
            echo '<div id="quantity">
        Quantity: <button onclick="quantity(1)"> ▬</button>
        <input id="quan" value="1" disabled>
        <button onclick="quantity(2)">✙</button>
    </div> <br>';
            echo 'Standard Delivery fee: 100 TK';
            echo "</div>";

            ?>

        </div>
        <h2 id="checkout_h2">Your Address</h2>
        <div id="product">
            <p>Your information</p> <hr>
            <p><b>Your Phone:</b> <?= $rowadd["Phone"] ?></p><hr>
            <p><b>Your Address:</b> <?= $rowadd["Division"].', '.$rowadd["District"].', '.$rowadd["Upazila"].', '.$rowadd["Post Office"].', '.$rowadd["Area"].', '.$rowadd["Landmark(Optional)"].'. '?></p>
        </div>
        <div id="payment">
            <form action="<?php htmlspecialchars(($_SERVER["PHP_SELF"])) ?>" method="POST">

                <input type="hidden" value="<?php echo $user_id ?>" name="uid">
                <input type="hidden" value="<?php echo $product_id ?>" name="product_id">
                <input type="hidden" id="quanty" name="quanty">
                <input type="hidden" id="unitPrice" name="unitprice">
                <input type="hidden" value="100" name="delivery">
                <!-- <input type="hiddn" value="<?php echo $address_id; ?>" name="address_id"> -->
                Total Amount: <input type="" name="tprice" id="tprice" readonly> Tk<br>
                <button type="submit" name="proceed">Proceed to Payment</button>
            </form>
            <?php

            ?>

        </div>

    </div>






    <?php require '../footer.php'; ?>
</body>
<script src="script.js">
    // document.getElementById("tprice").value = price;
</script>

</html>