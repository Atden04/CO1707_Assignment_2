<!DOCTYPE html>
<html lang="en">

<!-- 
Author: Alexander Denton
ID : 21002180
Date: 14/01/2024
Assignment 1 index page
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
                <li><a href="cart.html">Cart</a></li>
                <li><a href="signup.html">Sign Up</a></li>
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
                <il><a href="cart.html">Cart</a></il>
                <li><a href="signup.html">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <!-- Content captured from Desing Requirements video -->
    <main>
        <section id="liveOffers">
            <h1>Offers</h1>
            <ul>
                <?php
                    $connection = mysqli_connect("localhost", "root", "", "union-shop");
                    $result = mysqli_query($connection, "SELECT * FROM tbl_offers");
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<li><h2>".$row["offer_title"]."</h2>".$row["offer_dec"]."</li>";
                    }
                ?>
            </ul>
        </section>
        <h1>Where opportunity creates success</h1>
        <p>Every student at The University of Central Lancashire is automatically a member of the Student's Union.
            We're here to make life better for students - inspiring you to succeed and achieve your goals.</p>
        <p>Everything you need to know about UCLan Student's Union. Your membership starts here.</p>
        <h2>Together</h2>
        <video class="media" height="400" src="videos/video.mp4" controls>Sorry, your browser does not
            support HTML5 and therefore cannot view this video</video>
        <h2>Join our global community</h2>
        <iframe class="media" height="400" src="https://youtube.com/embed/EI_lco-qdw8"
            title="This is #MyPreston - Youtube" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
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
        /* for showing the mobile navigation when using the hamburger icon*/
        function revealMobileNav() {
            var x = document.getElementById("mobileNavList");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        if (typeof (Storage) !== "undefined") {
            alert("Storage API is permitted");
        }
        else {
            alert("Storage API is not permitted");
        }


    </script>
</body>

</html>