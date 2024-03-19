<?php
    session_start();
?>
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
                <li><a href="cart.php">Cart</a></li>
                <?php
                    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
                        echo "<li><a href='logout.php'>Log Out</a></li>";
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
                        echo "<li><a href='logout.php'>Log Out</a></li>";
                    } else {
                        echo "<li><a href='signup.php'>Sign Up</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
    <!-- Content captured from Desing Requirements video -->
    <main>
        <?php
            if (isset($_GET["noAccount"])) {
                $noAccount = $_GET["noAccount"];
                if ($noAccount)
                {
                    //is user is redirecteed to this page for no account, notify them
                    echo "<script>alert('The Account you\'ve tried to log in with doesn\'t exist. Please Sign up');</script>";
                }
            }

            // This is the signup.php page, are you sure you want to tell the user to "sign up" when they're already on the page
            // is this meant to be on the logged in page instead?

            $fullName = $email = $password = $confirmPassword = $address = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") { 

                $fullName = processInput($_POST["fullName"]);

                $email = processInput($_POST["email"]);

                $password = processInput($_POST["password"]);
                $confirmPassword = processInput($_POST["confirmPassword"]);

                $address = processInput($_POST["address"]);

                if ($password == $confirmPassword)
                {
                    $connection = require_once 'conn.php';

                    $rowsExistingEmail = mysqli_query($connection, "SELECT * FROM `tbl_users` WHERE user_email LIKE '$email'");
                    $countRows = mysqli_num_rows($rowsExistingEmail);
                    if ($countRows == 0) {   //if no rows then account with provided email doesn't exist
                        //get num rows for next id and add data to databse.
                        $rowsInTable = mysqli_query($connection, "SELECT * FROM tbl_users;");
                        $id = mysqli_num_rows($rowsInTable)+1;
                        mysqli_query($connection, "INSERT INTO `tbl_users`(`user_id`, `user_full_name`, `user_address`, `user_email`, `user_pass`, `user_timestamp`) VALUES ('$id','$fullName','$address','$email','$password',NOW())");
                        echo "<script>alert('You\`re account has now been registered. You can now log in via the cart. ');</script>";
                    } else {
                        echo "<script>alert('An account already exists with the email provided. Please log in via the cart.');</script>";
                    }
                    

                    
                }
            }

            function processInput($data) {

            $data = trim($data);

            $data = stripslashes($data);

            $data = htmlspecialchars($data);

            return $data;

            }

        ?>

        <p>Sign Up</p>
        <p>In order to purchase from the Student's Union shop, you need to create an account with all fields below required. If you have any difficulties with the from places contact the <a>webmaster</a></p>
        <form id="signup" method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p><label>Full Name:</label>
            <input type="text" name="fullName" placeholder="Full Name" required></p>
            <!-- https://www.w3schools.com/tags/att_input_pattern.asp -->
            <p><label>Email Address:</label>
            <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" ></p>

            <p><label>Password:
            <p>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
            </label>
            <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
            <input id="passwordInput" type="password" name="password" placeholder="Password" required onfocus="createPasswordRequirementsPrompt()" oninput="updatePasswordRequirementsPrompt()" onblur="hidePasswordRequirementsPrompt()"></p>
            <section id="passwordRequirementPrompt">
            </section>
            <p><label>Confirm Password:</label>
            <input id="confirmPasswordInput" type="password" name="confirmPassword" placeholder="Repeat Password" required onfocus="createConfirmPasswordPrompt()" oninput="updateConfirmPasswordPrompt()" onblur="hideConfirmPasswordPrompt()"></p>
            <section id="passwordConfirmPrompt">
            </section>
            <p><label>Address:</label>
            <input type="text" name="address" placeholder="Address" required></p>
            <input type="submit" value="Submit">
        </form>
        
        <?php

            if ($password != $confirmPassword) {
                echo "<p>You're passwords don't match, try again.</p>";
            }

            echo "<h2>Your Input:</h2>";

            echo $fullName;

            echo "<br>";

            echo $email;

            echo "<br>";

            echo $password;

            echo "<br>";

            echo $address;

            echo "<br>";

        ?>
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

        /* for checking password when being entered */
        function createPasswordRequirementsPrompt() {
            let passwordRequirementPrompt = document.getElementById("passwordRequirementPrompt");
            passwordRequirementPrompt.innerHTML += "<p id='passwordLengthPrompt'></p>";
            passwordRequirementPrompt.innerHTML += "<p id='passwordUppercasePrompt'></p>";
            passwordRequirementPrompt.innerHTML += "<p id='passwordLowercasePrompt'></p>";
            passwordRequirementPrompt.innerHTML += "<p id='passwordNumberPrompt'></p>";
        }

        function updatePasswordRequirementsPrompt() {
            let passwordInput = document.getElementById("passwordInput");
            let password = passwordInput.value;
            let passwordLengthPrompt = document.getElementById("passwordLengthPrompt");
            if (password.length >= 8)
            {
                passwordLengthPrompt.innerHTML = "The password is long enough";
            }
            else {
                passwordLengthPrompt.innerHTML = "Password should be a minimum of 8 characters long";
            }

            let passwordUppercasePrompt = document.getElementById("passwordUppercasePrompt");
            let capitalsInPassword = password.match(/[A-Z]/g)
            if (capitalsInPassword != null)  {
                passwordUppercasePrompt.innerHTML = "Password contains a capital letter";
            }  else {
                passwordUppercasePrompt.innerHTML = "Password needs to contain a capital letter";
            }

            let passwordLowercasePrompt = document.getElementById("passwordLowercasePrompt");
            let lowercaseInPassword = password.match(/[a-z]/g)
            if (lowercaseInPassword != null)  {
                passwordLowercasePrompt.innerHTML = "Password contains a lowercase letter";
            }  else {
                passwordLowercasePrompt.innerHTML = "Password needs to contain a lowercase letter";
            }

            let passwordNumberPrompt = document.getElementById("passwordNumberPrompt");
            let numbersInPassword = password.match(/[0-9]/g)
            if (numbersInPassword != null)  {
                passwordNumberPrompt.innerHTML = "Password contains a number letter";
            }  else {
                passwordNumberPrompt.innerHTML = "Password needs to contain a number letter";
            }
        }

        function hidePasswordRequirementsPrompt() {
            let passwordRequirementPrompt = document.getElementById("passwordRequirementPrompt");
            passwordRequirementPrompt.innerHTML = "";
        }

        function createConfirmPasswordPrompt() {
            let passwordConfirmPrompt = document.getElementById("passwordConfirmPrompt");
            passwordConfirmPrompt.innerHTML = "<p id='confirmPrompt'></p>";
        } 
        
        function updateConfirmPasswordPrompt() {
            let password = document.getElementById("passwordInput").value;
            let confirmedPassword = document.getElementById("confirmPasswordInput").value;
            let confirmPrompt = document.getElementById("confirmPrompt");
            if (password == confirmedPassword) {
                confirmPrompt.innerHTML = "The Passwords Match";
            } else {
                confirmPrompt.innerHTML = "The Passwords do not Match";
            }
        } 
        
        function hideConfirmPasswordPrompt() {
            let passwordConfirmPrompt = document.getElementById("passwordConfirmPrompt");
            passwordConfirmPrompt.innerHTML = "";
        }

        function checkPasswordsMatch(password, confirmPassword) {
            let main = document.getElementsByTagName("main")[0];
            if (password == confirmPassword)
            {
                main.innerHTML += "<p>The Passwords Match<p>";
            }
            else
            {
                main.innerHTML += "<p>The Passwords do not Match<p>";
            }
            
        }
    </script>
</body>

</html>