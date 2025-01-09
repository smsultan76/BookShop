<header>
        <button class="sidebar-icon" onclick="toggleSidebar()">&#9776;</button>
        <a href="">
            <h1> Boi Bazar </h1>
        </a>
        <nav>
            <ul class="header-menu">
                <li><a href="">Home</a></li>
                <li><a href="info/service.php">Services</a></li>
                <li><a href="seller/seller.php">Become a Seller</a></li>
                <li><a href="info/about.php">About</a></li>
                <li><a href="user/myorder.php" > My Orders</a></li>
                <li><a href="user/cart.php" > Cart 🛒</a></li>
                <li>
                    <?php
                    if (!isset($_SESSION["UserName"])) {
                        echo '<button onclick="login(1)">Login</button>';
                    } else {
                        echo '<button onclick="login(2)">' . $_SESSION["UserName"] . '</button>';
                    }
                    ?>
                </li>
            </ul>
            <!-- 3-dot icon for header menu -->
        </nav>
        <button class="header-icon" onclick="toggleHeaderMenu()">&#x22EE;</button>
    </header>