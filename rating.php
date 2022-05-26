<?php
    include_once("includes/connection.php");
    include_once("includes/functions.php");
    $user_data = check_login($con);
    $user_id = $user_data['user_id'];

    if(isset($_POST['submit'])){
        $rate = $_POST['star'];

        $selectquery = "SELECT * FROM ratings WHERE userID = '$user_id'";
        $result = mysqli_query($con, $selectquery);
        $row = mysqli_num_rows($result);
        if($row > 0){
            $upatetquery = "UPDATE ratings SET rating = '$rate' WHERE userID = '$user_id'";
            $exec = mysqli_query($con, $upatetquery);
        } else {
            $query = "INSERT INTO ratings (userID, rating) VALUES ('$user_id', '$rate')";
            $exec = mysqli_query($con, $query);
        }
    }

    $selectquery = "SELECT * FROM ratings WHERE userID = '$user_id'";
    $exec = mysqli_query($con, $selectquery);
    $row = mysqli_num_rows($exec);
    $result = mysqli_fetch_assoc($exec);

    $sum = mysqli_query($con, "SELECT SUM(rating) AS total FROM ratings");
    $sumResult = mysqli_fetch_assoc($sum);
    $total = $sumResult['total'];

    $selectAll = "SELECT * FROM ratings";
    $execAll = mysqli_query($con, $selectAll);
    $rows = mysqli_num_rows($execAll);

    if($rows > 0){
        $avg = $total / $rows;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/rating.css">
    <script src="https://kit.fontawesome.com/7e0079de7f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="rating_block">
        <form method="post">
            <div class="rating">
                <input type="radio" value="5" name="star" id="star5" <?php if($row > 0){if($result['rating'] == '5') echo 'checked';} ?> required><label for="star5"></label>
                <input type="radio" value="4" name="star" id="star4" <?php if($row > 0){if($result['rating'] == '4') echo 'checked';} ?> required><label for="star4"></label>
                <input type="radio" value="3" name="star" id="star3" <?php if($row > 0){if($result['rating'] == '3') echo 'checked';} ?> required><label for="star3"></label>
                <input type="radio" value="2" name="star" id="star2" <?php if($row > 0){if($result['rating'] == '2') echo 'checked';} ?> required><label for="star2"></label>
                <input type="radio" value="1" name="star" id="star1" <?php if($row > 0){if($result['rating'] == '1') echo 'checked';} ?> required><label for="star1"></label>
            </div>
            <button type="submit" class="submit" name="submit"> SUBMIT </button>
        </form>
        <span><?php echo 'Average: ' . round($avg,2) ?></span>
    </div>
</body>
</html>