<?php
include("../connnect.php");
session_start();
if (!isset($_SESSION["seller"])) {
    header("Location: seller.php");
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
            <h1>Edit your Book Information</h1>
            <?php
            $Id = $_GET["Id"];
            $sql = 'SELECT * FROM images Where Id="' . $Id . '"';
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table id="edittable">
                    <caption>
                        <h3 style="color:red">Image must be under 50KB</h3>
                    </caption>

                    <tr>
                        <td>Image 1</td>
                        <td>: <input name="image1" type="file" value="upload image max size 50KB"></td>
                    </tr>
                </table>
                <button type="submit" name="update">Update</button>
            </form>
            <?php
            if (isset($_POST["update"])) {
                // $Id = $_POST["Id"];
                if (isset($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
                    $image = $_FILES['image1']['tmp_name'];
                    $imgsize = $_FILES['image1']['size'];

                    if ($imgsize < 53000) {
                        $imagedata = addslashes(file_get_contents($image));
                        if ($row["Id"]) {
                            $sql = "UPDATE `images` SET `img1` = '$imagedata' WHERE `images`.`Id` = '$Id'";
                        } else {
                            $sql = "INSERT INTO `images` (`Id`,`img1`) VALUES ('$Id','$imagedata')";
                        }
                        if ($conn->query($sql) === TRUE) {
                            echo '<script> alert("Update Successful."); 
                        window.location.href="seller.php"; </script>';
                        } else {
                            echo "error to uploading images" . $conn->error;
                        }
                    } else {
                        echo 'image size must be less then 50KB';
                    }
                } else {
                    echo 'Please select Image.';
                }
            }
            ?>
        </div>
    </div>
    <?php require '../footer.php'; ?>
</body>
<script src="scripts.js"></script>

</html>