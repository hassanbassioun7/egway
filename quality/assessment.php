<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");

    access($con);

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
    <title>Quality Control - assessment</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Assessment</h2>
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
                            echo $user_data['role_name'];
                        }
                    ?>
                </small>
            </div>
        </div>
    </header>
    <div class="page-container">
        <nav class="nav">
            <ul class="nav__list">
                <a href="dashboard.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">dashboard</span>
                    </div>
                    <span class="nav__label">Dashboard</span>
                </a>
                <a href="users.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">manage_accounts</span>
                    </div>
                    <span class="nav__label">Costumer Service</span>
                </a>
                <a href="travellers.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">account_circle</span>
                    </div>
                    <span class="nav__label">Travellers</span>
                </a>
                <a href="quality_comments.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">chat</span>
                    </div>
                    <span class="nav__label">Comments</span>
                </a>
                <a href="flights.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">flight</span>
                    </div>
                    <span class="nav__label">Flights</span>
                </a>
                <a href="assessment.php" class="nav__link active">
                    <div class="nav__icon-container">
                        <span class="material-icons">assessment</span>
                    </div>
                    <span class="nav__label">Assessment</span>
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
            <div class="prev-comments">
                <?php
                    $query = "SELECT users.image, users.name, users.email, ratings.rating
                    FROM users INNER JOIN ratings ON users.user_id=ratings.userID;";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <div class="single-item" style="display: flex; margin: 0 0 35px 0">
                                    <div class="comment-header" style="display: flex;">
                                        <?php echo '<img src="data:image;base64,' .base64_encode($row['image']).'" class="profile_picture" style="margin-right: 1rem">'?>
                                        <div class="info-row">
                                            <h4><?php echo $row['name'] ?></h4>
                                            <a href="mailto:purecodingofficial@gmail.com"><?php echo $row['email'] ?></a>
                                        </div>
                                        <div>
                                            <p>
                                                <?php echo $row['rating'] ?>
                                                <span class="material-icons" style="color: gold">star</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>