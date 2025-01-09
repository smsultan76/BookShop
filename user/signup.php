<?php
session_start();
include("../connnect.php");
if(isset($_SESSION["UserName"])){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Sign Up</title>
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
            <button onclick="logsign(2)">Login</button>
        </nav>
    </header>
    <div id="loginform">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <input name="fname" placeholder="First Name" class="ipbox" required><br>
            <input name="lname" placeholder="Last Name" class="ipbox" required><br>
            <input class="ipbox" name="email" type="email" placeholder="Email" required><br>
            <input class="ipbox" name="username" placeholder="Username" required><br>
            <input class="ipbox" type="password" name="password" placeholder="Password" required><br>
            <button name="signup" type="submit">Sign Up</button><br><br>
            Already have account?   <a href="login.php">Login</a>
        </form>
        <?php
        if (isset($_POST["signup"])) {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql= "SELECT * FROM users WHERE UserName='$username' OR Email='$email'";
            if (mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
                echo "<script> 
                                alert('Username or Email already exist. Registration Unsuccessful.');
                                    </script>";
            }else{
                try{
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` ( `FName`, `LName`, `Email`, `UserName`, `Password`) VALUES ( '$fname', '$lname', '$email', '$username', '$password')";
                        $chk = mysqli_query($conn,$sql);
                        echo "<script> 
                                alert('Registration Successful. login Now.');
                                window.location.href = 'login.php';
                                
                                    </script>";
                }catch(mysqli_sql_exception){
                    echo "Registration Faild";
                }

            }
        }
        ?>
    </div>

</body>
<script src="script.js"></script>

</html>