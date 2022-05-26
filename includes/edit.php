<?php

    include_once("../includes/connection.php");

    $name=$username=$password=$email=$role=$image='';
    $errors = array('name'=>'', 'username'=>'', 'password'=>'','email'=>'', 'role'=>'', 'image'=>'' );

    $id = $_GET['editID'];
    
    $idQuery = "SELECT * FROM users WHERE user_id=$id";
    $idResult = mysqli_query($con, $idQuery);
    $idRow = mysqli_fetch_assoc($idResult);

    if(isset($_POST['edit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        if(!array_filter($errors))
        {
            $updateQuery = "UPDATE users SET name='$name', user_name='$username', password='$password', email='$email', role='$role' 
            WHERE user_id = $id";
            $updateResult = mysqli_query($con, $updateQuery);

            if($updateResult){
                header('location:../quality/users.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <link rel="stylesheet" href="../CSS/quality.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <div class="modal" style="display: flex">
        <div class="modal_inner">
            <div class="modal_top" style="height: 45px">
                <div class="modal_title">Edit</div>
            </div>
            <div class="modal_content">
                <form action="" method="POST" class="crud-form">
                    <div class="input-div">
                        <label>Name: </label>
                        <input type="text" name="name" placeholder="name" class="crud-form-input" value="<?php echo $idRow['name'] ?>"><br>
                    </div>
                    <div class="input-div">
                        <label>Username: </label>
                        <input type="text" name="username" placeholder="Username" class="crud-form-input" value="<?php echo $idRow['user_name'] ?>"><br>
                    </div>
                    <div class="input-div">
                        <label>Password: </label>
                        <input type="text" name="password" placeholder="Password" class="crud-form-input" value="<?php echo $idRow['password'] ?>"><br>
                    </div>
                    <div class="input-div">
                        <label>E-mail: </label>
                        <input type="text" name="email" placeholder="E-mail" class="crud-form-input" value="<?php echo $idRow['email'] ?>"><br>
                    </div>
                    <div class="input-div">
                        <label>Role: </label>
                        <select  class="crud-form-input" name="role">
                            <?php
                                if($idRow['role'] == 1){
                                    echo '<option value="1">Quality control</option>
                                    <option value="2">Customer service</option>';
                                }
                                else if($idRow['role'] == 2){
                                    echo '<option value="2">Customer service</option>
                                    <option value="1">Quality control</option>';
                                }
                            ?>
                        </select><br>
                    </div>
                    <div class="modal_bottom">
                        <button class="modal_button" type="submit" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>