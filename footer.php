    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .footer {
            background-color: #333;
            color: #fff;
            margin-top: 50px;
            padding: 0;
            text-align: center;
            font-family: Arial, sans-serif;

        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 0 20px;
        }

        .footer-container>div {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }

        .footer h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer ul {
            list-style: none;
            display: flex;
            justify-content: space-evenly;
            gap: 13px;
            padding: 0;
        }

        .footer .footer-left a {
            color: #fff;
            text-decoration: none;
            transition: 0.5s;
        }

        .footer .footer-left a:hover {
            color: lightblue;
        }

        .footer .footer-center ul li a {
            font-size: 16px;
            color: #ffffff;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }

        .footer .footer-center ul li a:hover {
            color: #ccc;
            padding-top: 8px;
        }


        .footer .footer-right .social-icons a {
            display: inline-block;
            color: #fff;
            text-align: center;
            line-height: 40px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            transition: all 0.5s;
        }

        .footer .footer-right .social-icons a:hover {
            color: #222;
            background-color: #ffffff;
            width: 50px;
            line-height: 50px;
        }

        .footer-bottom {
            background-color: #222;
            padding: 10px 0;
            margin-top: 10px;
            font-size: 12px;
        }

        .footer-bottom p {
            margin: 0;
        }
    </style>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <h3>About Us</h3>
                <p>Project, a online Book Shop. Name Boi Bazar.<br>
                    <b>Design By</b><a target="_blank" href="http://fb.com/smsultan76"> Sultanum Mobin</a>
                </p>
            </div>
            <div class="footer-center">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home </a></li>
                    <li><a href="/BookShop/info/about.php">About</a></li>
                    <li><a href="/BookShop/info/service.php">Services</a></li>
                    <li><a href="/BookShop/info/contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="https://facebook.com/smsultan76" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/+8801723332972" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://github.com/smsultan76" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://linkedin.com/in/smsultan76" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Boi Bazar. All rights reserved.</p>
        </div>
    </footer>