<?php
include_once("../includes/connection.php");

if(!empty ($_POST['username']))
{
    $username=$_POST['username'];
	$query="SELECT * FROM users WHERE user_name	= '$username'";
	$result= mysqli_query ($con, $query);
	$user_count=mysqli_num_rows($result);
	if($user_count>0)
	{
		echo "<div class='name-taken'> Username taken try agian try another one. </div>";
	}
	else
	{
		echo "<div class='name-ok'> Username OK.</div>";
	}
}
?>
