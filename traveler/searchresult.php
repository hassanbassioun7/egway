<?php 
 include_once("../includes/connection.php");
 include_once("../includes/functions.php");

 $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../CSS/searchresult.css">
<link rel="stylesheet" href="../CSS/home.css">

<title>Result</title>
<!-- <style>
    .profile_picture{
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: inline ;
    margin-right: 10px;
}
</style> -->
</head>
<body>



<div class="navcontainer">
        <div class="navbar">  
                <div>
                     <a class="logoo" href="../index.php">EGWay</a> 
                </div>  

                <ul>
                    <li><a href="#" class="rest_nav">Services</a></li>
                    <li><a href="#" class="rest_nav">About us</a></li>
                    <li>
                        
                        <div>
                            <?php 
                                if(!isset($_SESSION['user_id'])){
                                    echo "<li><a href=\"../login.php\" class=\"login_nav\">Login</a></li>";
                                } else {
                                        echo '<img src="data:image;base64,' .base64_encode($user_data['image']).'" class="profile_picture">';
                                        echo '<span class="username">'. $user_data['name'].'</span>' ;
                            ?>
                                <ul>
                                    <li>
                                        <a href="">profile</a>
                                    </li>

                                    <li>
                                        <a href="../includes/logout.php">logout</a>
                                    </li>
                                </ul>
                        </div>
                            <?php
                                    }
                            ?>  
                     </li>
                 </ul>

 </div>


<?php

$from='';
 
    if(isset($_POST["searchbtn"]))
    {
        $from=$_POST['from'];
        $to=$_POST['destination'];
        $query="SELECT * from flights
        join locations on flights.start=locations.location_id
        join destinations on flights.destination=destinations.destination_id
        where Lname='$from' AND Dname='$to'  ";

         $result=mysqli_query($con,$query);
        
    } 
?>
 <div class="table-box" style="width: 80%; margin: 0 auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Plane ID</th>
                        <th>From</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>
                            <tr style="text-align: center">
                                <td><?php echo $row["flight_id"] ?></td>
                                <td><?php echo $row["planeID"] ?></td>
                                <td><?php echo $row["Lname"] ?></td>
                                <td><?php echo $row["Dname"] ?></td>
                                <td><?php echo $row["date"] ?></td>
                                <td><?php echo $row["time"] ?></td>
                                <td><?php echo $row["status"] ?></td>
                                <td><button class="bookbtn">BOOK</button></td>
                            </tr>
                    <?php
                    }
                        ?>
                    
                </tbody>
            </table>
    </div>

</body>
</html>