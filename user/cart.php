<?php
include("../connnect.php");
session_start();
if (!isset($_SESSION["UserName"])) {
    header("Location: login.php");
}
//get user id from Username( Session).
$user_name = $_SESSION['UserName'];
$sql = 'SELECT `SL` FROM `users` WHERE `UserName`=' . '"' . $user_name . '"';
$row = mysqli_fetch_assoc($conn->query($sql));
$user_id = $row["SL"];
// Check if the user has added an address
$sql_address = "SELECT * FROM address WHERE SL = ?";
$stmt = $conn->prepare($sql_address);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: ../user/profile.php");
    exit();
}

if (isset($_POST['user_id']) && isset($_POST['product_id'])) {
    $user_id = intval($_POST["user_id"]);
    $book_id = intval($_POST['product_id']);
    $sql_delete = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql_delete);
$stmt->bind_param("ii", $user_id, $book_id);

if ($stmt->execute()) {
echo "Item deleted successfully"; // Response for successful deletion
} else {
echo "Error deleting item"; // Response for error
}
exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="styles.css">
    </head>

<body>
    <header>
        <a href="../index.php"><h1> Boi Bazar</h1></a>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/contact.php">Contuct</a>
            <a href="../info/about.php">About</a>
            <a href="myorder.php">My Orders</a>
            <button onclick="profile()">Edit Profile</button>
        </nav>
    </header>
    <main class="content">
        <h2>Shopping Cart</h2>
        <hr>
        <div class="cart">
            <?php
            $total = 0;
            $sql = "SELECT images.img1, cart.user_id, cart.product_id, books.BName, books.price, cart.quantity FROM cart 
                    JOIN images ON cart.product_id=images.Id
                    JOIN books ON cart.product_id=books.Id
                    WHERE user_id=$user_id";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                while ($rows = mysqli_fetch_assoc($result)) {
                    $product_id = $rows["product_id"];
                    echo '<div class="cart-item" id="item_'.$product_id.'">';
    
                    echo '<div class="image">';
                    if (!empty($rows['img1'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($rows["img1"]) . '" alt="Product 1">';
                    } else {
                        echo '<a href="product.php?Id=' . $Id . '"><img src="img/product2.jpg" alt="Product 1"></a>';
                    }
                    echo '</div>';
                    echo '<div class="data">';
                    echo '<h4>' . $rows["BName"] . '</h4>';
                    echo '<p>BDT : ' . $rows["price"] . ' TK</p>';
                    echo '<p>Quantity : ' . $rows["quantity"] . '</p>';
                    echo '<p>Standard Delivery fee: 100 Tk</p>';
                    echo '<button onclick="delit(' . $user_id . ',' . $product_id . ')">Remove</button>';
                    echo '</div>';
                    echo '</div>';
                    $total += $rows["price"]*$rows["quantity"]+100;
                }
            }else{
                print '<h2 style="color:red">Your cart is empty.</h2>';
            }
            ?>
        </div>
        <?php
        
        ?>
        <div class="total">
            <h3>Total: <?php  echo $total." Tk"; ?></h3>
            <button>Checkout</button>
        </div>
    </main>
    <?php require '../footer.php'; ?>
</body>
<script src="script.js"></script>
</html>