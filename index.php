<?php
session_start();

include_once("includes/connection.php");
include_once("includes/functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EGWay - Home Page</title>
        <link rel="stylesheet" href="CSS/home.css">
        <!-- links for the font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- welcome animation -->
        <div class="intro">
            <h1 class="logo-header">
                <span class="logo">EG</span><span class="logo">Way.</span>
            </h1>
        </div>

        <!-- navigation bar -->
        <nav>
            <!-- logo -->
            <a class="logo_nav" href="index.php">EGWay</a>

            <ul>
                <li><a href="#" class="rest_nav">Services</a></li>
                <li><a href="#" class="rest_nav">About</a></li>
                <li><a href="#" class="rest_nav">Profile</a></li>
                <!-- login list (user, customer service, quality control) -->
                <?php
                if(!isset($_SESSION['user_id'])){
                    echo "<li><a href=\"login.php\" class=\"login_nav\">Login</a></li>";
                } else {
                    echo "<li><a href=\"includes/logout.php\" class=\"login_nav\">Logout</a></li>";
                }
                ?>
                <!-- <ul>
                    <li><a href=\"#\">User</a></li>
                    <li><a href=\"#\">Customer Service</a></li>
                    <li><a href=\"#\">Quality Control</a></li>
                </ul> -->

                <!-- <a id="logout-link" href="includes/logout.php">Logout</a> -->
            </ul>
        </nav>

        <script src="JS/intro.js"></script>

        <div id="hello">
            <?php if (isset($user_data)) echo 'hello, ' . $user_data['name']; ?><br><br>
        </div>

    </body>
</html>