<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- 
Author: Alexander Denton
ID : 21002180
Date: 14/01/2024
Assignment 1 products page
-->

<head>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- link to the stylesheet -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="initialisePage()">
    <header>
        <!-- header bar that is going to appear at the top of the screen  -->
        <div class="logo"><img src="images/logo.svg" alt="UCLan logo"></div>
        <div class="siteName">Student Shop</div>
        <!-- place the navigation links in a <nav> tag for accessibility purposes -->
        <nav id="desktopNav"> <!-- place the navigation links in a <nav> tag for accessibility purposes -->
            <ul id="desktopNavList">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
        <!-- for mobile navigation https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->

        <!-- First div is for burger menu icon-->
        <nav id="mobileNav">
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <a href="javascript:void(0);" class="icon" onclick="revealMobileNav()">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Navigation links (hidden by default) -->
            <ul id="mobileNavList">
                <il><a href="index.php">Home</a></il>
                <il><a href="products.php">Products</a></il>
                <il><a href="cart.php">Cart</a></il>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <!-- Content captured from Desing Requirements video -->
    <aside id="productTopLink">
        <a href="#top">top</a>
    </aside>
    <main>
        <ul id="productBookmarks">
            <li>Products > </li>
            <li><a href="#hoodiesBookmark">Hoodies</a></li>
            <li><a href="#jumpersBookmark">Jumpers</a> </li>
            <li><a href="#tshirtsBookmark">T-Shirts</a> </li>
        </ul>
        <ul id="productList">
            <?php
                $connection = require_once 'conn.php';
                $rows = mysqli_query($connection, "SELECT * FROM tbl_products");
                while ($row = mysqli_fetch_array($rows, MYSQLI_ASSOC))
                {
                    echo "<li class='product'>";
                    echo "<section class ='productImage'><img src='".$row["product_image"]."' alt=".$row["product_title"]."></section>";
                    echo "<section class='productInfo'>";
                    echo "<h2>".$row["product_title"]."</h2>";
                    echo "<p>".$row["product_desc"]." <a href='item.php?pid=".$row["product_id"]."'>Read More.</a></p>";
                    echo "<p class='price'>".$row["product_price"]."</p>";
                    echo "<button type='button' class='buyButton' onclick='addItemToCart(".$row["product_id"].")' >Buy</button></section>";
                    echo "</li>";
                }
            ?>
        </ul>
    </main>

    <!-- Footer -->
    <footer>
        <section class="footerSection">
            <h3>Links</h3>
            <!-- link to student's union website-->
            <a href="https://www.uclansu.co.uk/">Students' Union</a>
        </section>
        <section class="footerSection">
            <h3>Contact</h3>
            <p>Email : suinformation@uclan.ac.uk</p>
            <p>Phone: 01772 89 3000</p>
        </section>
        <section class="footerSection">
            <h3>Location</h3>
            <p>University of Central Lancashire Students' Union,<br>Fylde Road, Preston. PR1 7BY<br>Registered in
                England<br>Company Number: 07623917<br>Registered Charity Number: 1142616</p>
        </section>
    </footer>
    <script>
        function addItemToCart(itemId) {

            $.ajax({
                type: 'POST',
                url: "addProductToCookies.php",
                data: {
                    id: "itemId"
                },
                success: function (e) {
                    alert(e);
                }
            });
        }

        /* for showing the mobile navigation when using the hamburger icon*/
        function revealMobileNav() {
            var x = document.getElementById("mobileNavList");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
</body>

</html>