<?php
session_start();

include_once("../includes/connection.php");
include_once("../includes/functions.php");

 $user_data = check_login($con);

?>

<!DOCTYPE html>
<html>

    <head>
        <title>EGWay - Home Page</title>
        <link rel="stylesheet" href="../CSS/home2.css">
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

        <!-- navigation bar-->
      

       
        <div class="banner">
                 <a class="logoo" href="index.php">EGWay</a>
            <div class="navbar">                
                <ul>
                    <li><a href="#" class="rest_nav">Services</a></li>
                    <li><a href="#" class="rest_nav">About us</a></li>
                    <li><a href="#" class="rest_nav">Profile</a></li>
                    <!-- login list (user, customer service, quality control) -->
                    <?php
                    if(!isset($_SESSION['user_id'])){
                        echo "<li><a href=\"../login.php\" class=\"login_nav\">Login</a></li>";
                    } else {
                        ?>
                        <!-- echo "<li><a href=\"../includes/logout.php\" class=\"login_nav\">Logout</a></li>"; -->
                       <li class="profile"><ul class="profilelist"> <div class="username">
                           <li>logout</li>
                           <li>profile</li>
                     <?php 
                    if(isset($user_data))
                    {
                        echo '<a href="../includes/logout.php"><img src="data:image;base64,' .base64_encode($user_data['image_user']).'" class="profile_picture"></a>';
                        echo $user_data['name'];
                        
                    }
                     ?>
                     
                </div></ul></li>
                    
                <?php

                    }      
                    ?> 
              

                </ul>
                
                   
            </div>

            <div class="content">
                        <h1>Discover the world with us</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa quaerat dignissimos 
                            <br>esse labore rem ex numquam deleniti quod, sequi suscipit fugit minus soluta provident? Iure rerum iusto nemo repellendus a?</p>
             </div>

            
        </div>
        <script src="../JS/intro.js"></script>

        <!-- <div id="hello">
            <?php if (isset($user_data)) echo 'hello, ' . $user_data['name']; ?><br><br>
        </div>  -->











 
    </body>
</html>

