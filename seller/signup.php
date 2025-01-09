<?php
include("../connnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Sign Up</title>
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
            <button onclick="logsign(2)">Login</button>
        </nav>
    </header>
    <img id="background" src="data/back.jpg" alt="">
    <h1 id="bodyh1">Become a Boi Bazar <br> Seller today!</h1>
    <h3 id="bodyh3">Create a Boi Bazar seller account now and reach <br>millions of customers!</h3>
    <div id="loginform">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <input name="name" placeholder="Full Name" class="ipbox" required><br>
            <input class="ipbox" name="email" type="email" placeholder="Email" required><br>
            <input class="ipbox" name="username" placeholder="Username" required><br>
            <input name="booktype" placeholder="books type	" class="ipbox" required><br>
            <input class="ipbox" type="password" name="password" placeholder="Password" required><br>
            <button name="signup" type="submit">Sign Up</button><br>
            <pre>   Already have account?   <a href="login.php">Login</a></pre>
        </form>
        <?php
        if (isset($_POST["signup"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $booktype = $_POST["booktype"];
            $password = $_POST["password"];
            $sql= "SELECT * FROM sellers WHERE UserName='$username' OR Email='$email'";
            if (mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
                echo "<script> 
                                alert('Username or Email already exist. Registration Unsuccessful.');
                                    </script>";
            }else{
                try{
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `sellers` ( `Name`, `Email`, `Username`, `Books type`, `Password`) VALUES ( '$name', '$email', '$username', '$booktype', '$password')";
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
<script src="scripts.js"></script>

</html>