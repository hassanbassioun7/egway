<?php
    include_once("../includes/connection.php");

    if(isset($_GET['viewID'])){
        $id = $_GET['viewID'];
    
        $idQuery = "SELECT * FROM users 
        JOIN roles ON users.role = roles.role_id
        JOIN accountStatus ON users.status=accountStatus.status_id
        WHERE user_id = '$id' limit 1";
        $idResult = mysqli_query($con, $idQuery);
        $idRows = mysqli_fetch_assoc($idResult);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../CSS/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="left">
            <?php echo '<img src="data:image;base64,' .base64_encode($idRows['image']).'" alt="user" width="200">'?>
            <h4><?php echo $idRows['name'] ?></h4>
            <p><?php echo $idRows['role_name'] ?></p>
        </div>
        <div class="right">

            <div class="info">
                <h3>information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>email</h4>
                        <p><?php echo $idRows['email'] ?></p>
                    </div>
                    <div class="data">
                        <h4>phone</h4>
                        <p>01115992774</p>
                    </div>
                </div>
            </div>

            <div class="flights">
                <h3>flights</h3>
                <div class="flights_data">
                    <div class="data">
                        <h4>recent</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="data">
                        <h4>most viewed</h4>
                        <p>dolor sit amet.</p>
                    </div>
                </div>
            </div>

            <div class="social_media">
                <ul>
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>