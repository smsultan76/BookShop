<?php
include("../connnect.php");
session_start();
if (isset($_SESSION["seller"])) {
    $username = $_SESSION["seller"];
    $sql = 'SELECT * FROM sellers WHERE Username="' . $username . '"';
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $seller_id = $row["Sl"];
} else {
    header("Location: seller.php");
    exit;
}
$sql2 = 'SELECT o.order_id,
		o.user_id,
      	o.product_id,
        b.BName,
        o.quantity,
        o.total_price,
        o.status,
        o.order_date,
        CONCAT(u.FName," ",u.LName) as `User Name`,
        CONCAT(a.Division,", ",a.District,", ",a.Upazila,", ",a.Area,", ",a.`Landmark(Optional)`) as locate,
        a.Phone
    FROM orders o
    JOIN address a ON o.user_id = a.SL
    JOIN users u ON o.user_id =u.SL
    JOIN books b ON o.product_id = b.Id
    JOIN sellers s on b.saller_id = s.Sl
    WHERE s.Sl=?';
$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$stmt = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <title>Your Sales</title>
</head>

<body>
    <header>
        <h1> <a href="../index.php">Boi Bazar</a> </h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/about.php">About</a>
            <button onclick="cencel()"> Back </button>
        </nav>
    </header>
    <div class="container">
        <table>
            <caption>
                <h1> You got this order</h1>
            </caption>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <!-- <th>Payment Method</th> -->
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Users Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result = $stmt->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $result['order_id']; ?></td>
                        <td><?php echo '<a href="../product.php?Id=' . $result["product_id"] . '">' . $result['BName']; ?> </a></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td><?php echo number_format($result['total_price'], 2); ?> TK</td>
                        <td class="status-<?php echo strtolower($result['status']); ?>">
                            <?php echo $result['status']; ?>
                        </td>
                        <td><?php echo date("d M Y, h:i A", strtotime($result['order_date'])); ?></td>
                        <td><?php echo '<a href="#user_' . $result["user_id"] . '">' . $result["user_id"]; ?></td>
                        
                    </tr>
                    <div id="user_<?= $result['user_id']; ?>" class="model">
                            <div>
                                <p>User Name : <?= $result["User Name"];?></p>
                                <p>Phone : <?= $result["Phone"] ?></p>
                                <p>Location : <?= $result["locate"] ?></p>
                                <a href="" style="position: absolute; top: 10px; right:10px; color: #fe0606; font-size: 30px; text-decoration: none;"> &times;</a>
                            </div>
                        </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php require '../footer.php'; ?>
</body>
<script src="scripts.js"></script>

</html>