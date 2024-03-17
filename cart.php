<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- 
Author: Alexander Denton
ID : 21002180
Date: 14/01/2024
Assignment 1 cart page
-->

<head>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- link to the stylesheet -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
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
    <main>
        <section id="cart">
            <h2>Shopping Cart</h2>
            <p>The items you've added to your shopping cart are:</p>
            <table>
                <tr>
                    <th style="width:10%">Item</th>
                    <th style="width:15%"></th>
                    <th style="width:33%">Product</th>
                    <th style="width:15%">Price</th>
                    <th style="width:5%"></th>
                </tr>

                <?php
                    if(isset($_COOKIE["cartProductIds"])) {
                        $productIds = $_COOKIE["cartProductIds"];
                        foreach ($productIds as $id) {
                            $connection = mysqli_connect("localhost", "root", "", "union-shop");
                            $products = mysqli_query($connection, "SELECT * FROM tbl_products WHERE product_id=".$id);
                            while ($product = mysqli_fetch_array($products, MYSQLI_ASSOC))
                            {
                                echo "<tr>";
                                echo "<th>0</th>";
                                echo "<th><img class='cartImage' src='".$product["product_image"]."' alt=".$product["product_title"]."></th>";
                                echo "<th>".$product["product_title"]."</th>";
                                echo "<th>".$product["product_price"]."</th>";
                                echo "<th><button type='button' class='removeButton' onclick=''>Remove</button></th>";
                            }
                        }
                    }
                ?>
            </table>
        </section>
        <aside id="emptyBasketDiv">
            <button type='button' onclick='emptyBasket()'>Empty Basket</button>
        </aside>
        <form id="login" action="login.php" method="post">
            <p>In order to check out you must log in</p>
            <p><label>Email Address:</label>
            <input type="text" name="email" required></p>
            <p><label>Password:</label>
            <input type="text" name="password" required></p>
            
            <input type="submit" value="Log Me In">
        </form>
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
         function initialisePage() {
            //local storage with an array called items with product IDs

            //send http get request contains all the product id's in the url
            //server takes them in and searched for those product ids and returns to the browser.

         }

        function removeItem(itemIndex)
        {
            var itemName = JSON.parse(localStorage.getItem('item' + itemIndex))[0];
            // now we've got the index of the item to remove, we need to move all the items down the array and then remove the last empty item.
            // this is becuase the id's are generated by length so if we don't decremend the id's when adding to the cart the last item will get overwritten by mistake
            for (i = itemIndex; i < localStorage.length;i++)
            {
                if (i != localStorage.length-1) //if not last item in localStorage
                {
                    let localItem = localStorage.getItem('item' + (i+1));   //get next item and store it in current id
                    localStorage.setItem("item" + i, localItem);
                }
                else{
                    localStorage.removeItem("item"+i);
                }
            }
            
            alert(itemName + " removed from cart.");
            location.reload();
        }

        function emptyBasket() {
            localStorage.clear();
            alert("Your cart has been emptied.");
            location.reload();
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