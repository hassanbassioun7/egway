<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");

    access($con);

    $qualityquery = "SELECT * FROM users WHERE role =1";
    $qualityresult = mysqli_query($con, $qualityquery);

    $servicequery = "SELECT * FROM users WHERE role =2";
    $serviceresult = mysqli_query($con, $servicequery);

    $travellersquery = "SELECT * FROM users WHERE role =3";
    $travellersresult = mysqli_query($con, $travellersquery);

    $name=$username=$password=$email=$role=$image='';
    $errors = array('name'=>'', 'username'=>'', 'password'=>'','email'=>'', 'role'=>'', 'image'=>'' );

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $imageName= $_FILES['image']['name'];
        $imageTmpName= $_FILES['image']['tmp_name'];
        $imageSize= $_FILES['image']['size'];
        $imageError= $_FILES['image']['error'];
        // $imageType= $_FILES['image']['type'];

        $usernamequery = mysqli_query($con, "SELECT * FROM users WHERE user_name = '$username'");
        if(mysqli_num_rows($usernamequery) > 0)
        {
            $errors['username'] = "this username already exists!";
        }

        // to divide the file name and extension (ex: image.jpeg  -->  image & jpeg)
        $fileExt = explode('.', $imageName);
        // to make it lower case of the extension
        $fileActualExt = strtolower(end($fileExt));
        $allow = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allow)){
            if(!$imageError === 0){
                $errors['image'] = "there was an error uploading your image";
            }
            else if($imageSize > 500000){
                $errors['image'] = "the image you selected is too big";
            }
        }
        else{
            $errors['image'] = "this file format is not allowed, please select jpeg or png file";
        }

        if(!array_filter($errors))
        {
        
            $query = "INSERT into users (name, user_name, password, email, role, `image`) 
            VALUES ('$name','$username', '$password','$email', '$role', '$image')";
            mysqli_query($con, $query);
            
            // so that if the page was reloaded manually it won't post (send to database) again
            header("Refresh: 0.1");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/quality.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Quality Control - travellers</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Travellers</h2>
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
                <a href="travellers.php" class="nav__link active">
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
        <div class="table-box" style="width: 80%; margin: 0 auto;">
                <div class="card-header sticky">
                    <h3>Travellers</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th> Profile Picture</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>E-mail</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Registerd</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                            
                            if(mysqli_num_rows($travellersresult) > 0){
                                echo "<tbody>";
                                while($row = mysqli_fetch_assoc($travellersresult)){
                        ?>
                            <tr>
                                <td><?php echo $row["user_id"] ?></td>
                                <?php
                                echo '<td><a href="profile.php?viewID=' . $row['user_id'] .'"><img src="data:image;base64,' .base64_encode($row['image']).'" class="profile_picture"></a></td>';
                                ?>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["password"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["gender"] ?></td>
                                <td><?php echo $row["user_birth"] ?></td>
                                <td><?php echo $row["date"] ?></td>
                            </tr>
                        <?php
                                }
                            }
                            else{
                                echo "No Costumer Service registerd";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>