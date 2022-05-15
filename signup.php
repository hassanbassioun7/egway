<?php

    include_once("includes/connection.php");
    include_once("includes/functions.php");

    $name=$user_name=$password=$con_pass=$user_birth=$email=$gender=$image='';
    //an array for errors
    $errors = array('name'=>'', 'user_name'=>'', 'password'=>'', 'con_pass'=>'','email'=>'', 'user_birth'=>'', 'gender'=>'', 'image'=>'');

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $name=$_POST['name'];
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];
        $con_pass=$_POST['con_pass'];
        $email=$_POST['email'];
        $user_birth=$_POST['user_birth'];
        $imageName= $_FILES['image']['name'];
        $imageTmpName= $_FILES['image']['tmp_name'];
        $imageSize= $_FILES['image']['size'];
        $imageError= $_FILES['image']['error'];
        // $imageType= $_FILES['image']['type'];
        
        if (isset($_POST['gender']))
            $gender=$_POST['gender'];
        
        if(empty($name)) 
        {
            $errors['name'] = "please enter your name";
        }

        if(empty($user_name)) 
        {
            $errors['user_name'] = "please enter a username";
        }
        else if(is_numeric($user_name))
        {
            $errors['user_name'] = "the username can't be a numeric value";
        }
        $query = mysqli_query($con, "SELECT * FROM users WHERE user_name = '$user_name'");
        if(mysqli_num_rows($query) > 0)
        {
            $errors['user_name'] = "this username already exists!";
        }

        if(empty($password))
        {
            $errors['password'] = "please enter a password";
        }
        // else if(strlen($password)<6)
        // {
        //     $errors['password'] = "password must have atleast 6 characters"
        // }
        if(empty($con_pass) || $password!=$con_pass)
        {
            $errors['con_pass'] ="password did not match";
        }
        $query = mysqli_query($con, "SELECT * FROM users WHERE password = '$password'");
        if(mysqli_num_rows($query) > 0)
        {
            $errors['password'] = "this password is already taken, please choose another one";
        }

        if(empty($email))
        {
            $errors['email'] = "please enter your email";
        }
        //to check if email format is valid or not
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "this email is not valid";
        }
        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($query) > 0)
        {
            $errors['email'] = "this email is already signed up";
        }

        if(empty($user_birth))
        {
            $errors['user_birth'] = "please enter your birthday";
        }
        if(empty($gender))
        {
            $errors['gender'] = "please enter your gender";
        }

        if(empty($imageName)){
            $errors['image'] = "please select an image for your profile picture";
        }
        else{
            $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

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
        }

        if(!array_filter($errors))
        {
            //save to database
            $query = "INSERT INTO users (name, user_name, password, email, user_birth, gender, `image`) values ('$name','$user_name','$password','$email', '$user_birth','$gender', '$image')";

            mysqli_query($con, $query);            

            header("Location: login.php");
            die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EGWay-Signup</title>
        <link rel="stylesheet" href="CSS/authenticate.css">
        <!-- links for the font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body class="background">
        <div class="box">

            <form name="signup-form" method="post" enctype="multipart/form-data">
                <div class="signup">Signup</div>

                <!-- add (required="true") as an attribute for the input if you want to do frontend validation for the input fields (if empty) -->
                
                <input class="textbox" type="text" name="name" placeholder="Full Name" value="<?php echo $name ?>" ><br>
                <div class="red-text"><?php echo $errors['name']; ?></div><br>

                <input class="textbox" type="text" name="user_name" placeholder="Username" value="<?php echo $user_name ?>"><br>
                <div class="red-text"><?php echo $errors['user_name']; ?></div><br>

                <input class="textbox" type="password" name="password" placeholder="Password" value="<?php echo $password ?>"><br>
                <div class="red-text"><?php echo $errors['password']; ?></div><br>

                <input class="textbox" type="password" name="con_pass" placeholder="Confirm Password" value="<?php echo $con_pass ?>"><br>
                <div class="red-text"><?php echo $errors['con_pass']; ?></div><br>

                <input class="textbox" type="text" name="email" placeholder="E-mail" value="<?php echo $email ?>"><br>
                <div class="red-text"><?php echo $errors['email']; ?></div><br>

                <input class="textbox" type="date" name="user_birth" max="2004-01-01" value="<?php echo $user_birth ?>"><br>
                <div class="red-text"><?php echo $errors['user_birth']; ?></div><br>


                <label style="color: white" for="gender">Male</label>
                <input type="radio" name="gender" value="male" class="radiobutton" <?php if ($gender=='male') echo "checked"; ?> >

                <label style="color: white" for="gender">Female</label>
                <input type="radio" name="gender" value="female" class="radiobutton" <?php if ($gender=='female') echo "checked"; ?> >

                <div class="red-text"><?php echo $errors['gender']; ?></div><br>

                <div style="display: flex">
                    <label style="color: white; margin-right:10px;" for="image">Picture:</label>
                    <input type="file" name="image" id="image" class="form-image"><br>
                </div>
                <div class="red-text"><?php echo $errors['image']; ?></div><br>
                
                <div style="text-align: center"><input class="button" type="submit" value="Signup"></div><br>

                <p style="color: white; text-align: center;"> Already have an account? <a href="login.php">Login</a></p>

            </form>
        </div>
    </body>
</html>
