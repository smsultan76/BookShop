<?php
session_start();
require 'connnect.php';
// if (empty($_GET["Id"])) header("Location: index.php");
if (isset($_SESSION["UserName"])) {
    $username = $_SESSION["UserName"];
    $sql = 'SELECT * FROM `users` Where `UserName`="' . $username . '"';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $userid = $row["SL"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> -->
    </head>

<body>
    <?php require 'header.php'; ?>
    <main class="content">
        <h2>Product Details</h2>
        <div class="product-detail">
            <?php
            $gid = $_GET["Id"];
            $sql = "SELECT `books`.*, `images`.`img1` FROM `books` 
                    LEFT JOIN `images` ON `books`.`Id`=`images`.`Id`
                    WHERE `books`.`Id`=$gid";
            $result = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($result)) {
                $Id = $rows["Id"];
                if (!empty($rows['img1'])) {
                    echo '<a href="product.php?Id=' . $Id . '"><img src="data:image/jpeg;base64,' . base64_encode($rows["img1"]) . '" alt="Product 1"></a>';
                } else {
                    echo '<a href="product.php?Id=' . $Id . '"><img src="img/product2.jpg" alt="Product 1"></a>';
                }
                echo '<a href="product.php?Id=' . $Id . '"><h4>' . $rows["BName"] . '</h4></a> ';
                echo '<i>by </i> ' . $rows["WName"];
                echo '<p><i>' . $rows["Edition"] . '</i></p> ';
                echo '<p> ' . $rows["category"] . ' Book </p>';
                echo '<p>BDT : ' . $rows["price"] . ' TK</p>';
                $price = $rows["price"];
            }
            ?>
            <form action="" method="post">
                <input type="hidden" name="userId" value="<?php echo $userid; ?>">
                <input type="hidden" name="productId" value="<?php echo $gid; ?>">
                <button type="submit" name="AC" value="submit">Add to Cart</button>
                <?php
                if (isset($_POST["AC"])) {
                    if (isset($_SESSION["UserName"])) {
                        $userid = $_POST["userId"];
                        $productId = $_POST["productId"];
                        $sql = "SELECT * FROM `cart` WHERE `user_id`=? AND `product_id`=? ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $userid, $productId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $sql = "UPDATE `cart` SET `quantity` = quantity + 1 WHERE `user_id` =? AND `product_id`=? ";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ii", $userid, $productId);
                            $stmt->execute();
                            echo "<p> Product successfully added to the cart!</p>";
                        } else {
                            $sql = "INSERT INTO cart (`user_id`, `product_id`, `quantity`) VALUES (?, ?, 1)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ii", $userid, $productId);
                            if ($stmt->execute()) {
                                echo "<p> Product successfully added to the cart!</p>";
                            } else {
                                echo "Error: " . $conn->error;
                            }
                        }
                    } else {
                        echo "<p style='color: red;'>You must be Login to add product in your cart. <a href='user/login.php'> login here</a></p>";
                    }
                }
                ?>
            </form>
            <h3>Standard Delivery BDT: 100 TK</h3>
        </div>
        <div class="total">
            <h3>Total Amount: <?php echo $price + 100; ?> TK</h3>
            <form action="checkout/checkout.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $gid; ?>">
                <button type="submit" name="buynow">Buy Now</button>
            </form>
        </div>
    </main>
 <?php require 'footer.php' ?>
</body>
<script src="script.js"></script>

</html>