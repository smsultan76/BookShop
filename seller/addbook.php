<?php
require '../connnect.php';
session_start();
if(!isset($_SESSION["seller"])){
    header("Location: seller.php");
}else{
    $username = $_SESSION["seller"];
    $sql = 'SELECT * FROM sellers WHERE Username="'.$username.'"';
    $row= mysqli_fetch_assoc(mysqli_query($conn,$sql));
    $seller_id= $row["Sl"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="styles.css">    
</head>

<body>
    <header>
        <h1> <a href="../index.php">Boi Bazar</a> </h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/about.php">About</a>
            <button onclick="cencel()">Cencel</button>
        </nav>
    </header>
    <div class="container">
    <div id="edit">
        <h1> Enter your book info</h1>
        <form action="" method="post">
            <table id="edittable">
                <tr>
                    <th>Book Name</th>
                    <td>: <input  name="BName" required></td>
                </tr>
                <tr>
                    <th>Writer Name</th>
                    <td>: <input  name="WName" required></td>
                </tr>
                <tr>
                    <th>Edition</th>
                    <td>: <input  name="edition" required></td>
                </tr>
                <tr>
                    <th>Categorie</th>
                    <td>: <input  name="cate" required></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>: <input  name="dept" required></td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>: <input  name="quantity" required></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>: <input  name="price" required></td>
                </tr>
            </table>
            <button type="submit" name="addbook">Add Book</button>
            <?php
            if(isset($_POST['addbook'])) {
                $BName= $_POST["BName"];
                $WName= $_POST["WName"];
                $edition= $_POST["edition"];
                $cate= $_POST["cate"];
                $dept= $_POST["dept"];
                $quantity= $_POST["quantity"];
                $price= $_POST["price"];
                $sql = "INSERT INTO `books` (`BName`, `WName`, `Edition`, `quantity`, `price`,`category`, `department`,`saller_id`)  VALUES ('$BName', '$WName', '$edition', '$quantity', '$price','$cate','$dept','$seller_id')";
                $result= mysqli_query($conn,$sql);
                echo '<script> alert("Book Successfully Added."); 
                window.location.href="seller.php"; </script>';
            }
            ?>
        </form>
    </div>
    </div>
 <?php require '../footer.php'; ?>
</body>

<script src="scripts.js"></script>

</html>