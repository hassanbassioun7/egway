<?php
session_start();

    include("connection.php");
    include("functions.php");


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];


        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save to database
            $user_id = random_num(5);
            $query = "insert into users (user_id, user_name, password) values ('$user_id','$user_name','$password')";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        }
        else
        {
            echo "Please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EGWay-Signup</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="background">
        <div id="box">

            <form name="signup-form" method="post">
                <div id="login">Signup</div>
                
                <input id="textbox" type="text" name="name" placeholder="Full Name"><br><br>
                <input id="textbox" type="text" name="user_name" placeholder="Username"><br><br>
                <input id="textbox" type="password" name="password" placeholder="Password"><br><br>
                <input id="textbox" type="password" name="con_pass" placeholder="Confirm Password"><br><br>

                <input id="button" type="submit" value="Signup"><br><br>

                <p id ="sl"> Already have an account? <a href="login.php">Login</a></p><br><br>

            </form>
        </div>
    </body>
</html>