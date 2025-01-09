<?php
session_start();
require '../connnect.php';
if (!isset($_SESSION['UserName'])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['UserName'];
$sql = 'SELECT `SL` FROM `users` WHERE `UserName`=' . '"' . $user_name . '"';
$row = mysqli_fetch_assoc($conn->query($sql));
$user_id = $row["SL"];
// Fetch orders for the logged-in user
$sql2 = "SELECT 
            o.order_id, 
            b.Id,
            b.BName, 
            o.quantity, 
            o.total_price, 
            o.payment_method, 
            o.status, 
            o.order_date 
        FROM orders o 
        JOIN books b ON o.product_id = b.Id
        WHERE o.user_id = ? 
        ORDER BY o.order_date DESC";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="styles.css">
    <title>My Orders</title>
    <style>
        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <a href="../index.php">
            <h1> Boi Bazar</h1>
        </a>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/contact.php">Contuct</a>
            <a href="../info/about.php">About</a>
            <a href="cart.php">Cart</a>
            <button onclick="profile()">Edit Profile</button>
        </nav>
    </header>
    <div class="container">
        <?php if ($result->num_rows > 0) : ?>
            <table >
                <caption>
                    <h1> My Orders</h1>
                </caption>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo '<a href="../product.php?Id=' . $row["Id"] . '">' . $row['BName']; ?> </a></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo number_format($row['total_price'], 2); ?> TK</td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td class="status-<?php echo strtolower($row['status']); ?>">
                                <?php echo $row['status']; ?>
                            </td>
                            <td><?php echo date("d M Y, h:i A", strtotime($row['order_date'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="empty-message">
                You have no orders yet.
            </div>
        <?php endif; ?>
    </div>
    <?php
    require '../footer.php';
    $stmt->close();
    $conn->close();
    ?>
</body>
<script src="script.js"></script>


</html>