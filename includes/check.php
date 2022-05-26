<?php

    include_once("connection.php");

    if(!empty($_POST["name"])){
        if (!preg_match ('/^[a-zA-Z\s]+$/', $_POST["name"]) ) { 
            echo "<span class=\"error-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align:middle;\">
            error_outline
            </span>Only alphabets are allowed</span>";
        }
    }

    if(!empty($_POST["username"])){
        
        $usernameQuery = "SELECT * FROM users WHERE user_name = '".$_POST['username']."'";
        $usernameResult = mysqli_query($con, $usernameQuery);
        $user_name = mysqli_num_rows($usernameResult);

        if(strlen($_POST["username"]) > 5)
        {
            if($user_name > 0)
            {
                echo "<span class=\"error-text\">
                <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
                error_outline
                </span>this username already exists</span>";
            }
            else{
                echo "<span class=\"confirm-text\">
                <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
                error_outline
                </span>this username is valid</span>";
            }
        }
        else{
            echo "<span class=\"error-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
            error_outline
            </span>username should be atleast 6 characters</span>";
        }
    }

    if(!empty($_POST["password"])){

        $passwordQuery = "SELECT * FROM users WHERE password = '".$_POST['password']."'";
        $passwordResult = mysqli_query($con, $passwordQuery);
        $password = mysqli_num_rows($passwordResult);

        if(strlen($_POST["password"]) < 6){
            echo "<span class=\"error-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
            error_outline
            </span> password should be atleast 6 characters </span>";
        }
        else if($password > 0){
            echo "<span class=\"error-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
            error_outline
            </span>this password already exists</span>";
        }
        else{
            echo "<span class=\"confirm-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
            check_circle_outline
            </span>this password is valid</span>";
        }
    }

    if(!empty($_POST["email"])){
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            echo "<span class=\"error-text\">
            <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
            error_outline
            </span>this email is not valid</span>";
        }
        else{
            $emailQuery = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
            $emailResult = mysqli_query($con, $emailQuery);
            $emailRows = mysqli_num_rows($emailResult);
            if($emailRows > 0)
            {
                echo "<span class=\"error-text\">
                <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
                error_outline
                </span>this email already exists</span>";
            }
            else{
                echo "<span class=\"confirm-text\">
                <span class=\"material-icons\" style=\"font-size: 18px; vertical-align: middle;\">
                check_circle_outline
                </span>this email is valid</span>";
            }
        }
    }
?>

