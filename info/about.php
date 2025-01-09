<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #5a67d8;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            margin-top: 20px;
        }
        .contact {
            font-size: 0.9em;
            color: #666;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #5a67d8;
            color: #fff;
        }
    </style>
</head>
<body>
<header>
        <button class="sidebar-icon" onclick="toggleSidebar()">&#9776;</button>

        <a href="../">
            <h1> Boi Bazar </h1>
        </a>
        <nav>
            <ul class="header-menu">
                <li><a href="../">Home</a></li>
                <li><a href="service.php">Services</a></li>
                <li><a href="../user/cart.php" style="font-size: 22px;"> Cart 🛒</a></li>
            </ul>
            <!-- 3-dot icon for header menu -->
        </nav>
    </header>
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to <strong>Boi Bazar</strong>! At Boi Bazar, we are passionate about connecting book lovers with their favorite reads. Whether you’re a book collector, an avid reader, or a first-time seller, our platform is designed to make buying and selling books online as easy and enjoyable as possible.</p>

        <div class="section">
            <h2 class="section-title">What We Offer:</h2>
            <ul>
                <li><strong>User Dashboard:</strong> Create an account to browse, add books to your cart, and make purchases.</li>
                <li><strong>Seller Dashboard:</strong> Register as a seller to add new books, upload images, and manage your inventory with ease.</li>
                <li><strong>Secure Platform:</strong> Built using the latest web technologies to ensure a seamless experience for all users.</li>
                <li><strong>Coming Soon:</strong> We're working hard to introduce new features, including order placement and a secure payment method, to make your experience even better.</li>
            </ul>
        </div>

        <div class="section">
            <h2 class="section-title">Our Mission:</h2>
            <p>We aim to provide a reliable platform where book lovers can find the books they need and sellers can reach their audience easily. Our goal is to build a community of readers and sellers, making the world of books more accessible to everyone.</p>
        </div>

        <div class="section contact">
            <h2 class="section-title">Contact Us:</h2>
            <p>Have questions or feedback? We’d love to hear from you! Reach out to us at <strong>sultan.1021@fec.edu.bd</strong> or follow us on social media.</p>
        </div>
    </div>
<?php include("../footer.php") ?>
</body>
</html>
