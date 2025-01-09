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
                <li><a href="islamic.php">Islamic</a></li>
                <li><a href="top.php">Top Selling</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="kids.php">Kids</a></li>
                <li><a href="old.php">Old Books</a></li>
            </ul>
        </nav>
    </aside>
    <main>
        <div class="content">
            <h2>New Books for you</h2>
            <div class="product-list">
                <?php
                $sql = "SELECT `books`.*, `images`.`img1` FROM `books` 
                    LEFT JOIN `images` ON `books`.`Id`=`images`.`Id`
                    ORDER BY `books`.`Date` DESC";
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