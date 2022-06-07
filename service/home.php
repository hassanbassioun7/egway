<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");
    
?>

<!DOCTYPE html>
<head>
    <!-- <style>
        .topnav{
            background-color:grey;
            overflow:hidden;
            color:white;
            font-size:20px;
            padding: 14px 16px;
        }
        .topnav a{
            float:left;
            display:block;
            color:white;
            text-align: center;
            padding: 0px 16px;
            text-decoration:none;
            font-size: 17px;
        }
        .topnav a:hover{
            background-color:green;
            color:white;
        }
    </style> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/service.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>customer - home</title>
</head>
<body>
    <div class="topnav">
        <?php
        if(!empty($_SESSION['ID'])) 
        {
            echo "Welcome ".$_SESSION['Name'];
            echo"<a href='Home.php'>Home</a>";
            echo"<a href='Add1.php'>Add</a>";
            echo"<a href='Delete.php'>'Delete</a>";
            echo"<a href='Update2.php'>edit</a>";
            echo"<a href='Search.php'>Search</a>";
        }
        else
        {
            echo"<a href='Home.php'>Home</a>";
            echo"<a href='Add1.php'>Add</a>";
            echo"<a href='Delete.php'>Delete</a>";
            echo"<a href='Update2.php'>edit</a>";
            echo"<a href='Search.php'>Search</a>";
        }
        ?>
    </div>
    <br><br>
</body>