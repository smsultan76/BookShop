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
                <li><a href="top.php">Top Selling</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="old.php">Old Books</a></li>
            </ul>
        </nav>
    </aside>
    <main>
        <div class="content">
            <h2>Kids Books are here</h2>
            <div class="product-list">
                <?php
                $sql = "SELECT `books`.*, `images`.`img1` FROM `books` 
                    LEFT JOIN `images` ON `books`.`Id`=`images`.`Id`
                    WHERE BName LIKE '%baby%' OR
    BName LIKE '%kid%' OR BName LIKE '%child%' OR BName LIKE '%toddler%' OR BName LIKE '%infant%' OR BName LIKE '%preschool%' OR
    BName LIKE '%tots%' OR BName LIKE '%junior%' OR BName LIKE '%youth%' OR BName LIKE '%play%' OR BName LIKE '%young%' OR
    BName LIKE '%storybook%' OR BName LIKE '%adventure%' OR BName LIKE '%fairy%' OR BName LIKE '%magical%' OR BName LIKE '%educational%' OR
    BName LIKE '%learning%' OR BName LIKE '%explorer%' OR BName LIKE '%friends%' OR BName LIKE '%imagination%' OR BName LIKE '%dream%' OR
    
    -- Filtering based on the `category` column for baby or kids-related categories
    category LIKE '%baby%' OR
    category LIKE '%kids%' OR
    category LIKE '%children%' OR
    category LIKE '%toddler%' OR
    category LIKE '%preschool%' OR
    category LIKE '%infant%' OR
    category LIKE '%youth%' OR
    category LIKE '%junior%' OR
    category LIKE '%young%' OR
    category LIKE '%family%' OR
    category LIKE '%play%' OR
    category LIKE '%learning%' OR
    category LIKE '%school%' OR
    category LIKE '%story%' OR
    category LIKE '%storybook%' OR
    category LIKE '%adventure%' OR
    category LIKE '%fiction%' OR
    category LIKE '%fantasy%' OR
    category LIKE '%imagination%' OR
    category LIKE '%activities%' OR
    category LIKE '%crafts%' OR
    
    -- Filtering based on the `department` column for baby or kids-related departments
    department LIKE '%baby%' OR
    department LIKE '%kids%' OR
    department LIKE '%children%' OR
    department LIKE '%infant%' OR
    department LIKE '%preschool%' OR
    department LIKE '%toddler%' OR
    department LIKE '%young%' OR
    department LIKE '%junior%' OR
    department LIKE '%youth%' OR
    department LIKE '%family%' OR
    department LIKE '%play%' OR
    department LIKE '%learning%' OR
    department LIKE '%education%' OR
    department LIKE '%story%' OR
    department LIKE '%fiction%' OR
    department LIKE '%storybook%' OR
    department LIKE '%adventure%' OR
    department LIKE '%imagination%' OR
    department LIKE '%exploration%' OR
    department LIKE '%creative%' OR
    department LIKE '%crafts%'";
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