<!DOCTYPE html>
<html lang="en">

<!-- 
Author: Alexander Denton
ID : 21002180
Date: 14/01/2024
Assignment 1 item page
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
                <li><a href="products.php"> Products</a> </li>
                <li><a href="cart.html"> Cart</a> </li>
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
            <!-- div of links for the page-->
            <ul id="mobileNavList">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php"> Products</a></li>
                <li><a href="cart.html"> Cart</a></li>
            </ul>
        </nav>
     </header>
    <!-- Content captured from Desing Requirements video -->
    <main>
        <ul id="itemList">
            <?php
                $productID = $_GET["pid"];
                $connection = mysqli_connect("localhost", "root", "", "union-shop");
                $products = mysqli_query($connection, "SELECT * FROM tbl_products WHERE product_id=".$productID);
                while ($product = mysqli_fetch_array($products, MYSQLI_ASSOC))
                {
                    echo "<li class='item'><section class ='itemImage'><img src='".$product["product_image"]."' alt=".$product["product_title"]."></section><section class='itemInfo'><h2>".$product["product_title"]."</h2><p>".$product["product_desc"]."</p><p class='price'>".$product["product_price"]."</p><button type='button' class='buyButton')'>Buy</button></section></li>";
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
        var itemDetails;
        function initialisePage() {
            let itemString = sessionStorage.getItem('itemDetails');
            itemDetails = JSON.parse(itemString);
            console.log(itemDetails);
            var ul = document.getElementById("itemList");
            console.log(ul);

            ul.innerHTML = "<li class='item'><div class ='itemImage'><img src='" + itemDetails[4] + "' alt=" + itemDetails[0] + "></div><div class='itemInfo'><h2>" + itemDetails[0] + " - " + itemDetails[1] + "</h2><p>" + itemDetails[2] + "</p><p class='price'>" + itemDetails[3] + "</p><button type='button' class='buyButton' onclick='addItemToCart(itemDetails)'>Buy</button></div></li>";
            console.log(ul);
        }

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