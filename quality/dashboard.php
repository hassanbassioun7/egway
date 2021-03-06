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
    <title>Quality Control - dashboard</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Dashboard</h2>
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
                <a href="dashboard.php" class="nav__link active">
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
                <a href="assessment.php" class="nav__link">
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
            <div class="cards">
                <a href="travellers.php" class="card-single">
                    <div>
                        <h1>
                            <?php
                                $travellersquery = "SELECT user_id from users WHERE role = 3 ";
                                $travellersresult = mysqli_query($con, $travellersquery);

                                $row = mysqli_num_rows($travellersresult);

                                echo $row ;
                            ?>
                        </h1>
                        <span>travellers</span>
                    </div>
                    <div>
                        <span class="material-icons">person</span>
                    </div>
                </a>
                <a href="flights.php" class="card-single">
                    <div>
                        <h1>0</h1>
                        <span>Flights</span>
                    </div>
                    <div>
                        <span class="material-icons">flight</span>
                    </div>
                </a>
                <a href="flights.php" class="card-single">
                    <div>
                        <h1>0</h1>
                        <span>Tickets</span>
                    </div>
                    <div>
                        <span class="material-icons">airplane_ticket</span>
                    </div>
                </a>
                <a href="quality_comments.php" class="card-single">
                    <div>
                        <h1>
                            <?php
                                $commentquery = "SELECT * FROM comments";
                                $commentresult = mysqli_query($con, $commentquery);
                                $commentrow = mysqli_num_rows($commentresult);
                                echo $commentrow;
                            ?>
                        </h1>
                        <span>Comments</span>
                    </div>
                    <div>
                        <span id class="material-icons">chat</span>
                    </div>
                </a>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Flights</h3>

                            <a href="#">See all <span style="font-size: 10px" class="material-icons">arrow_forward</span></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Flight Number</td>
                                            <td>Location</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>100</td>
                                            <td>Dubai</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>101</td>
                                            <td>Saudi Arabia</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>102</td>
                                            <td>Johannesburg</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>103</td>
                                            <td>Egypt</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>104</td>
                                            <td>Atlanta</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>105</td>
                                            <td>Chicago</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>106</td>
                                            <td>Denver</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>107</td>
                                            <td>Morocco</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>108</td>
                                            <td>Egypt</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>109</td>
                                            <td>Suadi Arabia</td>
                                            <td>
                                                <span class="status purple"></span>
                                                review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>110</td>
                                            <td>Egypt</td>
                                            <td>
                                                <span class="status pink"></span>
                                                in progress
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>111</td>
                                            <td>New York</td>
                                            <td>
                                                <span class="status orange"></span>
                                                pending
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3>New User</h3>
                            <a href="users.php">See all <span style="font-size: 10px" class="material-icons">arrow_forward</span></a>
                        </div>

                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>

                            <div class="customer">
                                <div class="info">
                                    <img src="../media/Pp.jpeg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Hassan H. Bassiouny</h4>
                                        <small>User</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="material-icons">account_circle</span>
                                    <span class="material-icons">chat</span>
                                    <span class="material-icons">call</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>