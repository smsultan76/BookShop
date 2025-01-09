<?php
include("../connnect.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boi Bazar</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <?php require 'header.php'; ?>
    <aside id="sidebar">
        <h2>Categories</h2>
        <nav>
            <ul class="sidebar-menu">
                <li><a href="new.php">New Books</a></li>
                <li><a href="islamic.php">Islamic</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="kids.php">Kids</a></li>
                <li><a href="old.php">Old Books</a></li>
            </ul>
        </nav>
    </aside>
    <main>
        <div class="content">
            <h2>Top Selling Books for you</h2>
            <div class="product-list">
                <?php
                $sql = "SELECT b.*, images.img1, sold_count, cart_count
            FROM books b
            LEFT JOIN images ON b.Id = images.Id
            LEFT JOIN (SELECT product_id, COUNT(*) AS sold_count
                        FROM sold
                        GROUP BY product_id)
            s ON b.Id = s.product_id
            LEFT JOIN (SELECT product_id, COUNT(*) AS cart_count
                        FROM cart
                        GROUP BY product_id)
            c ON b.Id= c.product_id
            ORDER BY 
            sold_count DESC,
            cart_count DESC";
                $result = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    $Id = $rows["Id"];
                    if (!empty($rows['img1'])) {
                        echo '<a href="../product.php?Id=' . $Id . '"><img src="data:image/jpeg;base64,' . base64_encode($rows["img1"]) . '" alt="Product 1"></a>';
                    } else {
                        echo '<a href="../product.php?Id=' . $Id . '"><img src="../img/product2.jpg" alt="Product 1"></a>';
                    }
                    echo '<a href="../product.php?Id=' . $Id . '"><h4 >' . $rows["BName"] . '</h4></a>';
                    echo '<p>BDT : ' . $rows["price"] . ' TK</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>
    <?php require '../footer.php'; ?>
</body>

<script src="script.js"></script>

</html>