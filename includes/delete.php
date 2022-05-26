<?php

include_once("connection.php");
if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];

    $query = "DELETE from users where user_id = $id";
    $result = mysqli_query($con, $query);
    if($result){
        header("Location: ../quality/users.php"); 
        die;
    }
    else{
        die(mysqli_error($con));
    }
}

?>