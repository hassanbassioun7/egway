<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EGWay - Home Page</title>
        <link rel="stylesheet" href="../CSS/intro.css">
        <!-- links for the font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        
        <div class="intro">
            <h1 class="logo-header">
                <span class="logo">EG</span><span class="logo">Way.</span>
            </h1>
        </div>

        <header>
            <h4 class="logo_nav">EGWay.</h4>
            <nav>
                <ul class="nav_links">
                    <li><a href="#">Services</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Profile</a></li>
                </ul>
            </nav>
            <a id="cta" class="cta" href="#"><button class="nav">Contact</button></a>
        </header>

        <script src="../JS/intro.js"></script>

        <div id="hello">
            Hello, <?php echo $user_data['name']; ?><br><br>
        </div>
        
        <a id="logout-link" href="logout.php">Logout</a>

    </body>
</html>