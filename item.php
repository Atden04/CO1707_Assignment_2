<?php
    session_start();
    $connection = require_once 'conn.php';
?>
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
                <?php
                    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
                        echo "<li><a href='logoutScript.php?returnPage=item.php&pid=".$_GET["pid"]."'>Log Out</a></li>";
                    } else {
                        echo "<li><a href='signup.php'>Sign Up</a></li>";
                    }
                ?>
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
                <?php
                    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
                        echo "<li><a href='logoutScript.php?returnPage=item.php&pid=".$_GET["pid"]."'>Log Out</a></li>";
                    } else {
                        echo "<li><a href='signup.php'>Sign Up</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
    <!-- Content captured from Desing Requirements video -->
    <main>
        <section id="itemDisplay">
            <ul id="itemList">
                <?php
                    $productID = $_GET["pid"];
                    $products = mysqli_query($connection, "SELECT * FROM tbl_products WHERE product_id=".$productID);
                    while ($product = mysqli_fetch_array($products, MYSQLI_ASSOC))
                    {
                        echo "<li class='item'>";
                        echo "<section class ='itemImage'><img src='".$product["product_image"]."' alt=".$product["product_title"]."></section>";
                        echo "<section class='itemInfo'>";
                        echo "<h2>".$product["product_title"]."</h2>";
                        echo "<p>".$product["product_desc"]."</p>";
                        echo "<p class='price'>".$product["product_price"]."</p>";
                        echo "<form id='productFilter' action='addProductToCartScript.php?pid=".$product["product_id"]."&returnPage=item.php&pName=".$product["product_title"]."' method='POST'><input type='submit' value='Buy'></form>";
                        echo "</section>";
                        echo "</li>";
                    }
                ?>           
            </ul>
        </section>
        <section id="itemReviews">
            <?php
                $productID = $_GET["pid"];
                $reviews = mysqli_query($connection, "SELECT * FROM tbl_reviews WHERE product_id=".$productID);
                $numReviews = mysqli_num_rows($reviews);
                if ($numReviews > 0) {
                    $totalRating = 0;
                    while ($review = mysqli_fetch_array($reviews, MYSQLI_ASSOC)) {
                        $totalRating += $review["review_rating"];
                    }
                    $averageRating = round($totalRating/$numReviews, 1);
                    echo "<h1>Average Rating: ".$averageRating."</h1>";

                    // need to requery after fetching the array
                    $reviews = mysqli_query($connection, "SELECT * FROM tbl_reviews WHERE product_id=".$productID);
                    while ($review = mysqli_fetch_array($reviews, MYSQLI_ASSOC)) {
                        echo "<section id='reviewContainer'>";
                        echo "<h2>".$review["review_title"]."</h2>";
                        echo "<p>".$review["review_desc"]."</p>";
                        echo "<h3>Rating : </h3>";
                        $itemRating = "";
                        $class = "";
                        switch ($review["review_rating"]) {
                            case 1:
                                $itemRating = "Terrible";
                                $class = "terribleRating";
                                break;
                            case 2:
                                $itemRating = "Bad";
                                $class = "badRating";
                                break;
                            case 3:
                                $itemRating = "Meh";
                                $class = "mehRating";
                                break;
                            case 4:
                                $itemRating = "Good";
                                $class = "goodRating";
                                break;
                            case 5:
                                $itemRating = "Excellent";
                                $class = "excellentRating";
                                break;
                            default:
                              // intentionally left blank
                          }
                        echo "<section id='itemRating'>";
                        echo "<h4 class='".$class."'>".$itemRating."</h4>";
                        echo "</section></section>";
                    }
                }
            ?>
            <section id="addReview">
                <?php
                    if (isset($_SESSION["loggedIn"]) && isset($_SESSION["userName"]))
                    {
                        if ($_SESSION["loggedIn"])
                        {
                            echo "<h3>Add a Review</h3>";
                            echo "<form id='addItemReivewForm' action='addReviewScript.php?pid=".$_GET['pid']."' method='POST'>";
                            echo "<p><label>Title </label></p>";
                            echo "<input type='text' name='title' placeholder='Title' required>";
                            echo "<p><label>Comment </label></p>";
                            echo "<p><textarea type='text' name='comment' placeholder='Enter Comment here' required></textarea></p>";

                            echo "<select id='reviewRating' name='rating' required>";
                            echo "<option disabled selected value>Select a Rating</option>";
                            echo "<option value='5'>Excellent</option>";
                            echo "<option value='4'>Good</option>";
                            echo "<option value='3'>Meh</option>";
                            echo "<option value='2'>Bad</option>";
                            echo "<option value='1'>Terrible</option>";
                            echo "</select>";
                            echo "<p><input type='submit' value='Add Review'></p>";
                            echo "</form>";
                        }
                    }
                ?>
            </section>
        </section>
       
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
    <?php
        if (!isset($_SESSION["alertedOfCookies"])) {
            echo "<script>alert('Cookies are used on this Site.');</script>";
            $_SESSION["alertedOfCookies"] = true;
        }
        else if (!$_SESSION["alertedOfCookies"]) {
            echo "<script>alert('Cookies are used on this Site.');</script>";
            $_SESSION["alertedOfCookies"] = true;
        }
    ?>
    <script>
        function addItemToCart(itemId, itemTitle, itemDesc, itemImage, itemPrice) {
            let itemDetails = [itemId, itemTitle, itemDesc, itemImage, itemPrice];
            let itemString = JSON.stringify(itemDetails);
            let nextIndex = localStorage.length;
            localStorage.setItem("item" + nextIndex, itemString);
            alert(itemTitle + " added to cart!");
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