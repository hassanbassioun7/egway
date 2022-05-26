<?php

include_once("connection.php");

if(isset($_GET['enableID'])){
    $id = $_GET['enableID'];

    $nameQuery = "SELECT * FROM users 
    JOIN accountStatus ON users.status=accountStatus.status_id 
    WHERE user_id = $id LIMIT 1";
    $nameResult = mysqli_query($con, $nameQuery);
    $nameRows = mysqli_fetch_assoc($nameResult);

    if(isset($_POST['enable'])){
        $comment = $_POST['enable_comment'];

        $query = "UPDATE users set status= 1 , status_comment='$comment' WHERE user_id=$id";
        $result = mysqli_query($con, $query);

        if($result){
            header("Location: ../quality/users.php"); 
            die;
        }
        else{
            die(mysqli_error($con));
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/quality.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>enabel</title>
</head>
<body>
    <div class="modal" style="display: flex">
        <div class="modal_inner">
            <div class="modal_top" style="height: 45px">
                <div class="modal_title">Enable</div>
            </div>
            <div class="modal_content">
                <form method="POST" class="crud-form">
                    <div style="text-align: center; font-weight: bold;"> <?php echo $nameRows['name']; ?></div><br>
                    <div class="input-div">
                        <textarea name="enable_comment" class="crud-form-input" placeholder="place your comment here" required></textarea>
                    </div>
                    <div class="modal_bottom">
                        <button class="modal_button" type="submit" name="enable">Enable</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>