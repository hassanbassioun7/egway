<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");
    include_once("index.php");

    $qualityquery = "SELECT * FROM users WHERE role =\"quality control\"";
    $qualityresult = mysqli_query($con, $qualityquery);

    $servicequery = "SELECT * FROM users WHERE role =\"customer service\"";
    $serviceresult = mysqli_query($con, $servicequery);

    $travellersquery = "SELECT * FROM users WHERE role =\"user\"";
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
    <title>Quality Control - users</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Users</h2>
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
            <ul class="nav__list">
                <a href="dashboard.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">dashboard</span>
                    </div>
                    <span class="nav__label">Dashboard</span>
                </a>
                <a href="users.php" class="nav__link active">
                    <div class="nav__icon-container">
                        <span class="material-icons">account_circle</span>
                    </div>
                    <span class="nav__label">Users</span>
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
            <div class="errors">
                <?php
                    if(!$errors['name']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['name'] . "</div>";
                    }
                    if(!$errors['username']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['username'] . "</div>";
                    }
                    if(!$errors['password']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['password'] . "</div>";
                    }
                    if(!$errors['email']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['email'] . "</div>";
                    }
                    if(!$errors['role']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['role'] . "</div>";
                    }
                    if(!$errors['image']=='')
                    {
                        echo "<div class=\"red-text\">" . $errors['image'] . "</div>";
                    }
                ?>
            </div>
            <div class="user_tables">
                <div class="table-box">
                    <div class="card-header">
                        <h3>Costumer Service</h3>
                    </div>
                    <table class="table">
                        <thead style="box-shadow: 0 3px 5px rgba(0,0,0,0.2);>
                            <tr class="sticky">
                                <th> Profile Picture</th>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                                if(mysqli_num_rows($serviceresult) > 0){
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_assoc($serviceresult)){
                            ?>
                            <tr>
                                <?php
                                echo '<td><img src="data:image;base64,' .base64_encode($row['image']).'" class="profile_picture"></td>';
                                ?>
                                <td><?php echo $row["user_id"] ?></td>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["password"] ?></td>
                                <td>
                                    <button class="edit"><a href="../includes/edit.php?editID=<?php echo $row['user_id'] ?>">edit</a></button>
                                </td>
                                <td>
                                    <button class="delete"><a href="../includes/delete.php?deleteID=<?php echo $row['user_id'] ?>">delete</a></button>
                                </td>
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
                <div class="table-box">
                    <div class="card-header">
                        <h3>Quality Control</h3>
                    </div>
                    <table class="table">
                        <thead style="box-shadow: 0 3px 5px rgba(0,0,0,0.2);">
                            <tr class="sticky">
                                <th> Profile Picture</th>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                                if(mysqli_num_rows($qualityresult) > 0){
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_assoc($qualityresult)){
                            ?>
                            <tr>
                                <?php echo '<td><img src="data:image;base64,' .base64_encode($row['image']).'" class="profile_picture"></td>'; ?>
                                <td><?php echo $row["user_id"] ?></td>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["password"] ?></td>
                                <td>
                                    <button class="edit"><a href="../includes/edit.php?editID=<?php echo $row['user_id'] ?>">edit</a></button>
                                </td>
                                <td>
                                    <button class="delete"><a href="../includes/delete.php?deleteID=<?php echo $row['user_id'] ?>">delete</a></button>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                else{
                                    echo "No Quality Control registerd";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
                        
            <div class="add_user">
                <button class="modal_button" onclick="openModal()">click to add</button>
            </div>

            <div class="modal">
                <div class="modal_inner">
                    <div class="modal_top">
                        <div class="modal_title">Registration</div>
                        <button class="modal_close"  onclick="closeModal()">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal_content">
                        <form action="" method="POST" class="crud-form" enctype="multipart/form-data">
                            <div class="input-div">
                                <label>Name: </label>
                                <input type="text" name="name" placeholder="name" class="crud-form-input" required><br>
                            </div>
                            <div class="input-div">
                                <label>Username: </label>
                                <input type="text" name="username" placeholder="Username" class="crud-form-input" required><br>
                            </div>
                            <div class="input-div">
                                <label>Password: </label>
                                <input type="text" name="password" placeholder="Password" class="crud-form-input" required><br>
                            </div>
                            <div class="input-div">
                                <label>E-mail: </label>
                                <input type="text" name="email" placeholder="E-mail" class="crud-form-input" required><br>
                            </div>
                            <div class="input-div">
                                <label>Profile Picture: </label>
                                <input type="file" name="image" id="image" class="form-image" required><br>
                            </div>
                            <div class="input-div">
                                <label>Role: </label>
                                <select  class="crud-form-input" name="role" required>
                                    <option value="">(Please choose a role)</option>
                                    <option value="user">User</option>
                                    <option value="customer service">Customer service</option>
                                    <option value="quality control">Quality control</option>
                                </select><br>
                            </div>
                            <div class="modal_bottom">
                                <button class="modal_button" type="submit" name="save">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>
