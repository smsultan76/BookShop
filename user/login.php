<?php
session_start();
include("../connnect.php");
if (isset($_SESSION["UserName"])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1> Boi Bazar</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/contact.php">Contuct</a>
            <a href="../info/about.php">About</a>
            <a href="cart.php?li=true">Cart</a>
            <button onclick="logsign(1)">Sign Up</button>
        </nav>
    </header>
    <div id="loginform">
        <form action="" method="post">
            <h2>Login</h2>
            <input class="ipbox" name="username" placeholder="Username"><br>
            <input class="ipbox" type="password" name="password" placeholder="Password"><br>
            <div class="forcheck">
                <div>
                    <input type="checkbox"><label for=""> Save my password </label> 
                </div>
                <div> <a href=""> Forgot password?</a></div>
            </div>
            <button name="login">Login</button><br><br>
            Don't have account?   <a href="signup.php">Sign Up</a>
        </form>
        <?php
        if (isset($_POST["login"])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM users WHERE UserName='$username'";
                try {
                    if ($row = mysqli_fetch_assoc(($conn->query($sql)))) {
                        if (password_verify($password, $row['Password'])) {
                            session_start();
                            $_SESSION["UserName"] = $username;
                            header("Location: login.php");
                            header("Location: ../index.php");
                        } else {
                            echo "<script> 
                                alert('Username/Password error!');
                                </script>";
                        }
                    }
                    mysqli_close($conn);
                } catch (mysqli_sql_exception) {
                    echo "Faild to Login";
                }
            }
        }
        ?>
    </div>

</body>
<script src="script.js"></script>


</html>