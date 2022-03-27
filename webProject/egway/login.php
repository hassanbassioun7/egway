<?php
session_start();

include("connection.php");
include("functions.php");

$user_name=$password='';
//errors array
$errors = array('user_name'=>'', 'password'=>'');


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];

    if(empty($user_name))
    {
        $errors['user_name'] = "please enter your username";
    }
    if(empty($password))
    {
        $errors['password'] = "please enter your password";
    }
    
    if(!array_filter($errors))
    {
        //read from database
        $query = "SELECT * FROM users WHERE user_name = '$user_name' limit 1";

        $result = mysqli_query($con, $query);
        
        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] == $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        $errors['password'] = "Wrong username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EGWay-Login</title>
        <link rel="stylesheet" href="../CSS/style.css">
        <!-- links for the font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body class="background">
        <div id="box">

            <form name="login-form" method="post">
                <div id="login">Login</div>

                <input id="textbox" type="text" name="user_name" placeholder="Username" value="<?php echo $user_name ?>"><br>
                <div class="red-text"><?php echo $errors['user_name']; ?></div><br>

                <input id="textbox" type="password" name="password" placeholder="Password" value="<?php echo $password ?>"><br>
                <div class="red-text"><?php echo $errors['password']; ?></div><br>

                <input id="button" type="submit" value="Login"><br><br>

               <p style="color: white">Create a <a href="signup.php">new account</a></p><br><br>

            </form>
        </div>
    </body>
</html>