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
        <!-- header bar that is going to appear at the top of the screen  onload="updateNav()" onresize="updateNav()"-->
        <div class="logo"><img src="images/logo.svg" alt="UCLan logo"></div>
        <div class="siteName">Student Shop</div>
        <!-- place the navigation links in a <nav> tag for accessibility purposes -->
        <nav class="desktopNav"> <!-- place the navigation links in a <nav> tag for accessibility purposes -->
            <ul class="navList">
                <li class="navItem"><a href="index.php">Home</a></li>
                <li class="navItem"><a href="products.html"> Products</a> </li>
                <li class="navItem"><a href="cart.html"> Cart</a> </li>
            </ul>
        </nav>
        <!-- for mobile navigation https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->

        <!-- First div is for burger menu icon-->
        <div class="mobileNav">
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <a href="javascript:void(0);" class="icon" onclick="revealMobileNav()">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Navigation links (hidden by default) -->
        </div>
        <!-- div of links for the page-->
        <div id="mobileNavList">
            <a href="index.php">Home</a>
            <a href="products.html"> Products</a>
            <a href="cart.html"> Cart</a>
        </div>
    </header>
    <!-- Content captured from Desing Requirements video -->
    <div class="side">
        <a href="#top">top</a>
    </div>
    <div class="main">
        <ul id="productBookmarks">
            <li>Products > </li>
            <li><a href="#hoodiesBookmark">Hoodies</a></li>
            <li><a href="#jumpersBookmark">Jumpers</a> </li>
            <li><a href="#tshirtsBookmark">T-Shirts</a> </li>
        </ul>
        <ul id="productList">
            <?php
                $connection = mysqli_connect("localhost", "atdenton", "SpBeSnKe30Uc", "atdenton");
                $types = mysqli_query($connection, "SELECT DISTINCT product_type FROM tbl_products");
                while ($type = mysqli_fetch_array($types, MYSQLI_ASSOC)) //loops through each type, essentially a for loop
                {
                    $rows = mysqli_query($connection, "SELECT * FROM tbl_products WHERE product_type=$type")
                    while ($row = mysqli_fetch_array($rows, MYSQLI_ASSOC))
                    {
                        echo "<li class='product'><div class ='productImage'><img src='".$row["product_image"]."' alt=".$row["product_title"]."></div><div class='productInfo'><h2>".$row["product_title"]."</h2><p>".$row["product_desc"]." <a href='item.html'>Read More.</a></p><p class='price'>".$row["product_price"]"</p><button type='button' class='buyButton')'>Buy</button></div></li>";
                    }
                }
                SELECT DISTINCT Country FROM Customers;
            ?>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footerSection">
            <h3>Links</h3>
            <!-- link to student's union website-->
            <a href="https://www.uclansu.co.uk/">Students' Union</a>
        </div>
        <div class="footerSection">
            <h3>Contact</h3>
            <p>Email : suinformation@uclan.ac.uk</p>
            <p>Phone: 01772 89 3000</p>
        </div>
        <div class="footerSection">
            <h3>Location</h3>
            <p>University of Central Lancashire Students' Union,<br>Fylde Road, Preston. PR1 7BY<br>Registered in
                England<br>Company Number: 07623917<br>Registered Charity Number: 1142616</p>
        </div>
    </div>
    <script>
        function addItemToCart(itemDetails) {
            let itemString = JSON.stringify(itemDetails)
            let nextIndex = localStorage.length;
            localStorage.setItem("item" + nextIndex, itemString)
            alert(itemDetails[0] + " added to cart!");
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