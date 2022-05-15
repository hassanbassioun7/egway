<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");
    include_once("index.php");

    $selectquery = "SELECT * FROM users";
    $selectresult = mysqli_query($con, $selectquery);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/quality.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Quality Control - flights</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Flights</h2>
        </div>
        <div class="search-wrapper">
            <span class="material-icons search-icon">search</span>
            <input type="search" placeholder="Search Users">
        </div>

        <div class="user-wrapper">
            <?php
                $user_data = check_login($con);
                if(isset($user_data))
                {
                    echo '<img src="data:image;base64,' .base64_encode($user_data['image']).'" class="profile_picture">';
                }
            ?>
            <div>
                <h4>
                    <?php 
                        if (isset($user_data))
                        {
                            echo $user_data['name'];
                        }
                    ?>
                </h4>
                <small>
                    <?php
                        if(isset($user_data))
                        {
                            echo $user_data['role'];
                        }
                    ?>
                </small>
            </div>
        </div>
    </header>
    <div class="page-container">
        <nav class="nav">
            <!-- for making a collapsable navbar from its border -->
            <!-- <div class="nav__border"></div> -->
            <ul class="nav__list">
                <a href="dashboard.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">dashboard</span>
                    </div>
                    <span class="nav__label">Dashboard</span>
                </a>
                <a href="users.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">account_circle</span>
                    </div>
                    <span class="nav__label">Users</span>
                </a>
                <a href="flights.php" class="nav__link active">
                    <div class="nav__icon-container">
                        <span class="material-icons">flight</span>
                    </div>
                    <span class="nav__label">Flights</span>
                </a>
                <a href="assessment.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">assessment</span>
                    </div>
                    <span class="nav__label">Assessment</span>
                </a>
                <a href="profit.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">paid</span>
                    </div>
                    <span class="nav__label">Profit</span>
                </a>
                <a href="../includes/logout.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">logout</span>
                    </div>
                    <span class="nav__label">Logout</span>
                </a>
            </ul>
        </nav>
        <div class="content">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quaerat quidem eius sit hic incidunt accusamus minima deleniti, repellendus accusantium est dolor vero esse neque consequuntur qui, exercitationem ut nostrum.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quaerat quidem eius sit hic incidunt accusamus minima deleniti, repellendus accusantium est dolor vero esse neque consequuntur qui, exercitationem ut nostrum.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quaerat quidem eius sit hic incidunt accusamus minima deleniti, repellendus accusantium est dolor vero esse neque consequuntur qui, exercitationem ut nostrum.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quaerat quidem eius sit hic incidunt accusamus minima deleniti, repellendus accusantium est dolor vero esse neque consequuntur qui, exercitationem ut nostrum.
            </p>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>
