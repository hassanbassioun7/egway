<?php
    include_once("includes/connection.php");

    $name=$username=$password=$conPass=$user_birth=$gender=$image=$email='';

    $errors = array(
    'name'=> false,
    'username'=> false,
    'password'=> false,
    'conPass'=> false,
    'email'=> false,
    'user_birth'=> false,
    'gender'=> false,
    'image'=> false);

    if(isset($_POST["signup"]))
    {
        $name=$_POST['name'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $conPass=$_POST['conPass'];
        $email=$_POST['email'];
        $user_birth=$_POST['user_birth'];
        $gender = $_POST['gender'];
        $imageName= $_FILES['image']['name'];
        $imageTmpName= $_FILES['image']['tmp_name'];
        $imageSize= $_FILES['image']['size'];
        $imageError= $_FILES['image']['error'];
        // $imageType= $_FILES['image']['type'];
        
        if (!preg_match ('/^[a-zA-Z\s]+$/', $name )){ 
            $errors['name'] = true;
        }

        $usernameQuery = "SELECT * FROM users WHERE user_name = '$username'";
        $usernameResult = mysqli_query($con, $usernameQuery);
        $user_rows = mysqli_num_rows($usernameResult);
        if($user_rows > 0)
        {
            $errors['username'] = true;
        }
        if(strlen($username) < 5){
            $errors['username'] = true;
        }

        $passwordQuery = "SELECT * FROM users WHERE password = '$password'";
        $passwordResult = mysqli_query($con, $passwordQuery);
        $passwordRow = mysqli_num_rows($passwordResult);
        if($passwordRow > 0 || strlen($password) < 5){
            $errors['password'] = true;
            if($conPass == $password){
                $errors['conPass'] = true;
            }
        }

        if($conPass != $password){
            $errors['conPass'] = true;
        }

        if(empty($email))
        {
            $errors['email'] = true;
        }
        
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = true;
        }
        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($query) > 0)
        {
            $errors['email'] = true;
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
            $query = "INSERT INTO users (name, user_name, password, email, user_birth, gender, `image`) 
            values ('$name','$username','$password','$email', '$user_birth','$gender', '$image')";

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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- link for the ajax -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    </head>
    <body class="background">
        <div class="box">
            <form name="signup-form" method="post" enctype="multipart/form-data">
                <div class="signup">Signup</div>

                <input type="text" name="name" id="name" class="textbox" placeholder="Full Name" onkeyup="Name()" 
                value="<?php if($errors['name'] != true) echo $name ?>" required><br>
                <span id="nameMsg"></span><br>

                <input class="textbox" type="text" name="username" id="username" placeholder="Username" onkeyup="userName()" 
                value="<?php if($errors['username'] != true) echo $username ?>" required><br>
                <span id="usernameMsg"></span><br>

                <input class="textbox" type="password" name="password" id="password" placeholder="Password" onkeyup="Password()" 
                value="<?php if($errors['password'] != true) echo $password ?>" required><br>
                <span id="passMsg"></span><br>

                <input class="textbox" type="password" name="conPass" placeholder="Confirm Password"  
                value="<?php if($errors['conPass'] == false) echo $conPass ?>" required><br><br>

                <input class="textbox" type="text" name="email" id="email" placeholder="Email" onkeyup="Mail()" 
                value="<?php if($errors['email'] != true) echo $email ?>" required><br>
                <span id="mailMsg"></span><br>

                <input class="textbox" type="date" name="user_birth" max="2004-01-01"
                value="<?php echo $user_birth ?>" required><br>
                <span></span><br>


                <label style="color: white" for="gender">Male</label>
                <input type="radio" name="gender" value="male" class="radiobutton" <?php if($gender == 'male') echo 'checked' ?>>

                <label style="color: white" for="gender">Female</label>
                <input type="radio" name="gender" value="female" class="radiobutton" <?php if($gender == 'female') echo 'checked' ?> required><br><br>

                <div style="display: flex">
                    <label style="color: white; margin-right:10px;" for="image">Picture:</label>
                    <input type="file" name="image" id="image" class="form-image" required><br>
                </div>
                <span><?php if($errors['image'] != false) echo '<span class="error-text">
                <span class="material-icons" style="font-size: 18px; vertical-align: middle;"> error_outline </span>' . $errors['image'] . '</span>' ?></span><br>
                
                <div style="text-align: center"><input class="button" type="submit" name="signup" value="Signup"></div>
            </form>
            <p style="color: white; text-align: center;"> Already have an account? <a href="login.php">Login</a></p>
        </div>
    </body>

    <script>
        
        function Name()
        {
            jQuery.ajax(
            {
                url:"includes/check.php",
                data:'name=' + $("#name").val(),
                type: "POST",
                success: function(data)
                {
                    $("#nameMsg").html(data);
                }
            });
        }

        function userName()
        {
            jQuery.ajax(
            {
                url:"includes/check.php",
                data:'username=' + $("#username").val(),
                type: "POST",
                success: function(data)
                {
                    $("#usernameMsg").html(data);
                }
            });
        }

        function Password()
        {
            jQuery.ajax(
            {
                url:"includes/check.php",
                data:'password=' + $("#password").val(),
                type: "POST",
                success: function(data)
                {
                    $("#passMsg").html(data);
                }
            });
        }

        function conPass()
        {
            jQuery.ajax(
            {
                url:"includes/check.php",
                data:'conPass=' + $("#conPass").val(),
                type: "POST",
                success: function(data)
                {
                    $("#conpassMsg").html(data);
                }
            });
        }

        function Mail()
        {
            jQuery.ajax(
            {
                url:"includes/check.php",
                data:'email=' +$("#email").val(),
                type: "POST",
                success: function(data)
                {
                    $("#mailMsg").html(data);
                }
            });
        }
    </script>
</html>
