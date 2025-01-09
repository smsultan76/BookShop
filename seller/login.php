<?php
session_start();
include("../connnect.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1> <a href="../index.php">Boi Bazar</a> </h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../info/contact.php">Contuct</a>
            <a href="../info/about.php">About</a>
            <button onclick="logsign(1)">Sign Up</button>
        </nav>
    </header>
    <img id="background" src="data/background.png" alt="">
    <h1 id="bodyh1">Become a Boi Bazar <br> Seller today!</h1>
    <h3 id="bodyh3">Create a Boi Bazar seller account now and reach <br>millions of customers!</h3>
    <div id="loginform">
        <form action="" method="post">
            <h2>Login</h2>
            <input class="ipbox" name="username" placeholder="Username"><br>
            <input class="ipbox" type="password" name="password" placeholder="Password"><br>
            <a href="">Forgot password?</a><br>
            <button name="login">Login</button><br>
            <pre>   Don't have account?   <a href="signup.php">Sign Up</a></pre>
        </form>
        <?php
        if (isset($_POST["login"])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM sellers WHERE Username='$username'";
                try {
                    if($row = mysqli_fetch_assoc(($conn->query($sql)))){
                    if (password_verify($password,$row['Password'])) {
                        session_start();
                        $_SESSION["seller"]= $username;
                        header("Location: login.php");
                        header("Location: seller.php");
                    }else{
                        echo "<script> 
                                alert('Username/Password error!');
                                </script>";
                    }}
                    mysqli_close($conn);
                } catch (mysqli_sql_exception) {
                    echo "Faild to Login";
                }
            }
        }
        ?>
    </div>

</body>
<script src="scripts.js"></script>


</html>