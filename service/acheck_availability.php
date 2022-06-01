<?php
$conn= new mysqli("localhost","root","","egway");

if(!empty ($_POST["name"]))
{
	$query="SELECT * FROM users WHERE name='".$_Post["name"]."'OR user_name	='".$_Post["user_name"]."'OR user_id='".$_Post["user_id"]."'";
	$result= mysqli_query ($conn,$query);
	$user_count=mysqli_num_rows($result);
	if($user_count>0)
	{
		echo" <div class='name-taken'> Username taken try agian try another one. </div>";
	}
	else
	{
		echo "<div class='name-ok'> Username OK.</div>";
	}
}
?>
