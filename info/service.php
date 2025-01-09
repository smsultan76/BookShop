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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #5a67d8;
            margin-bottom: 20px;
        }
        .service {
            display: flex;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .service-icon {
            font-size: 40px;
            margin-right: 15px;
            color: #5a67d8;
        }
        .service-content {
            flex: 1;
        }
        .service-content h2 {
            margin-top: 0;
            color: #333;
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
                <li><a href="about.php">About</a></li>
                <li><a href="../user/cart.php" style="font-size: 22px;"> Cart 🛒</a></li>
            </ul>
            <!-- 3-dot icon for header menu -->
        </nav>
    </header>
    <div class="container">
        <h1>Our Services</h1>
        <div class="service">
            <div class="service-icon">📚</div>
            <div class="service-content">
                <h2>Book Sales</h2>
                <p>We offer a wide selection of books from various genres. Find the perfect read for any occasion, from children's books to academic resources.</p>
            </div>
        </div>
        <div class="service">
            <div class="service-icon">🛒</div>
            <div class="service-content">
                <h2>Online Store Management</h2>
                <p>Sellers can easily manage their inventory, add new books, and update existing entries with our user-friendly seller dashboard.</p>
            </div>
        </div>
        <div class="service">
            <div class="service-icon">🔍</div>
            <div class="service-content">
                <h2>Search and Filter</h2>
                <p>Use our advanced search and filter options to quickly find books that match your preferences, making it easier to discover new favorites.</p>
            </div>
        </div>
        <div class="service">
            <div class="service-icon">💳</div>
            <div class="service-content">
                <h2>Upcoming: Secure Payments</h2>
                <p>We are working to introduce secure payment methods to streamline the purchasing process and ensure a safe transaction experience.</p>
            </div>
        </div>
    </div>
<?php include("../footer.php") ?>
</body>
</html>
