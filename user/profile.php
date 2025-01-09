<?php
session_start();
include("../connnect.php");
if (!isset($_SESSION["UserName"])) {
    header("Location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Information</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1><a href="../index.php">Boi Bazar</a> </h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/about.php">About</a>
            <a href="myorder.php">My Orders</a>
            <a href="cart.php">Cart</a>
            <button onclick="logout()">LogOut</button>
        </nav>
    </header>


    <!-- Profile Information -->


    <div id="info">
        <div id="pinfo" class="pinfo">
            <h2>Your personal information</h2>
            <?php
            $username = $_SESSION["UserName"];
            $sql = 'SELECT * FROM `users` Where `UserName`="' . $username . '"';
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $user_id = $row["SL"];
            echo '<table id="table">
                <tr>
                    <th>First Name</th>
                    <td>' . $row["FName"] . '</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>' . $row["LName"] . '</td>
                </tr>
                <tr>
                    <th>UserName</th>
                    <td>' . $row["UserName"] . '</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>' . $row["Email"] . '</td>
                </tr>
            </table>';
            ?>
            <button onclick="editpro(1)">Edit Profile</button>
        </div>


        <!-- Edit profile information -->


        <div id="pedit" class="pinfo">
            <h2>Edit your profile info</h2>
            <form action="" method="post">
                <table id="table2">
                    <tr>
                        <td>First Name</td>
                        <td>: <input name="fname" value="<?php echo $row["FName"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>: <input name="lname" value="<?php echo $row["LName"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td>: <input name="username" value="<?php echo $row["UserName"]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <input name="email" value="<?php echo $row["Email"]; ?>" ></td>
                    </tr>
                </table>
                <button type="submit" name="user_data">Update</button>
                <?php

                // Update User information
                if (isset($_POST["user_data"])) {
                    $username = $_SESSION["UserName"];
                    $ufname = $_POST["fname"];
                    $ulname = $_POST["lname"];
                    $uusername = $_POST["username"];
                    $uemail = $_POST["email"];
                    $sql2 = 'UPDATE `users` SET `FName` = "' . $ufname . '", `LName` = "' . $ulname . '", `Email` = "' . $uemail . '", `UserName` = "' . $uusername . '" WHERE `users`.`UserName` ="' . $username . '"';
                    try {
                        mysqli_query($conn, $sql2);
                    } catch (Exception $err) {
                        echo $err->getMessage();
                    }
                }
                ?>
            </form>
        </div>



        <!-- User Address Show -->


        <div id="ainfo" class="pinfo">
            <?php
            $username = $_SESSION["UserName"];
            $sql = 'SELECT `SL` FROM `users` Where `UserName`="' . $username . '"';
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $SL = $row["SL"];
            $sql = 'SELECT * From `address` WHERE SL="' . $SL . '"';
            $result = $conn->query($sql);
            if (mysqli_num_rows($result)) {
            echo '<h2>Your Address information</h2>';
                $row = $result->fetch_assoc();
                echo '<table id="table">
                <tr>
                    <th>Division</th>
                    <td>' . $row["Division"] . '</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>' . $row["Phone"] . '</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>' . $row["District"] . '</td>
                </tr>
                <tr>
                    <th>Upazila</th>
                    <td>' . $row["Upazila"] . '</td>
                </tr>
                <tr>
                    <th>Post Office</th>
                    <td>' . $row["Post Office"] . '</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>' . $row["Area"] . '</td>
                </tr>
                <tr>
                    <th>Landmark(Optional)</th>
                    <td>' . $row["Landmark(Optional)"] . '</td>
                </tr>
            </table>';
                echo '<button onclick="editpro(2)">Edit Address</button>';
            } else {
                echo '<h2>Enter Your Address</h2>';
                echo '<form action="" method="post">';
                echo '<table id="table">
                <tr>
                    <th>Division</th>
                    <td><input type="text" name="Division" ></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="text" name="Phone" ></td>
                </tr>
                <tr>
                    <th>District</th>
                    <td><input type="text" name="District" ></td>
                </tr>
                <tr>
                    <th>Upazila</th>
                    <td><input type="text" name="Upazila" ></td>
                </tr>
                <tr>
                    <th>Post Office</th>
                    <td><input type="text" name="po" ></td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td><input type="text" name="Area" ></td>
                </tr>
                <tr>
                    <th>Landmark(Optional)</th>
                    <td><input type="text" name="Land" ></td>
                </tr>
            </table>';
                echo '<button onclick="" type="submit" name="add">ADD Address</button>';
                echo '</form>';
                if (isset($_POST["add"])) {
                    $Division = $_POST["Division"];
                    $Phone = $_POST["Phone"];
                    $District = $_POST["District"];
                    $Upazila = $_POST["Upazila"];
                    $po = $_POST["po"];
                    $Area = $_POST["Area"];
                    $Land = $_POST["Land"];
                    $sql4 = 'INSERT INTO `address` (`SL`, `Division`, `District`, `Upazila`, `Post Office`, `Area`, `Landmark(Optional)`, `Phone`) 
                    VALUES ("' . $user_id . '","' . $Division . '","' . $District . '","' . $Upazila . '","' . $po . '","' . $Area . '","' . $Land . '","' . $Phone . '")';
                    $conn->query($sql4);
                }
            }

            ?>
        </div>



        <!-- Edit address section  -->


        <div id="aedit" class="pinfo">
            <h2>Edit your profile info</h2>
            <form action="" method="post">
                <table id="table2">
                    <tr>
                        <td>Division</td>
                        <td>: <input name="Division" value="<?php echo $row["Division"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>: <input name="Phone" value="<?php echo $row["Phone"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td>: <input name="District" value="<?php echo $row["District"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Upazila</td>
                        <td>: <input name="Upazila" value="<?php echo $row["Upazila"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Post Office</td>
                        <td>: <input name="po" value="<?php echo $row["Post Office"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td>: <input name="Area" value="<?php echo $row["Area"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Landmark(Optional)</td>
                        <td>: <input name="Land" value="<?php echo $row["Landmark(Optional)"]; ?>"></td>
                    </tr>
                </table>
                <button type="submit" name="user_address">Update</button>
                <?php
                // Update User Address
                if (isset($_POST["user_address"])) {
                    $uDivision = $_POST["Division"];
                    $uPhone = $_POST["Phone"];
                    $uDistrict = $_POST["District"];
                    $uUpazila = $_POST["Upazila"];
                    $upo = $_POST["po"];
                    $uArea = $_POST["Area"];
                    $uLand = $_POST["Land"];
                    $sql3 = 'UPDATE `address` SET `Division` = "' . $uDivision . '",
                                    `District` = "' . $uDistrict . '", `Upazila` = "' . $uUpazila . '",
                                    `Post Office` = "' . $upo . '", `Area` = "' . $uArea . '"
                                    , `Landmark(Optional)` = "' . $uLand . '"
                                    , `Phone` = "' . $uPhone . '"
                                     WHERE `address`.`SL` =' . $user_id;
                    try {
                        mysqli_query($conn, $sql3);
                    } catch (Exception $err) {
                        echo $err->getMessage();
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <?php require '../footer.php'; ?>
</body>
<script src="script.js"></script>
</html>