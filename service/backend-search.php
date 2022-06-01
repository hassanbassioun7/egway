<?php
$con = mysqli_connect("localhost", "root", "", "egway");
 
$sql = "Select users.user_id, users.name, users.user_name, users.email, users.gender, users.user_birth, users.date, users.role from users" ;
// Escape user inputs for security
$term =  $_POST['term'];
  echo"<table border=1 width=100%>
            <tr><th>user_id</th><th>name</th><th>user_name</th><th>email</th><th>gender</th><th>user_birth</th><th>date</th><th>role</th></tr>";
if(!empty($term)){
    // Attempt select query execution
    $sql = $sql." WHERE name LIKE '%" . $term . "%' or user_id LIKE '%" . $term . "%' or user_name LIKE '%" . $term . "%' or email LIKE '%" . $term . "%' or gender LIKE '%" . $term . "%' or user_birth LIKE '%" . $term . "%' or date LIKE '%" . $term . "%' or role LIKE '%" . $term . "%' ";
}
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<tr><td>" . $row['user_id'] . "</td><td>". $row['name'] ."</td><td>".$row["user_name"]."</td><td>".$row["email"]."</td><td>".$row["gender"]."</td><td>".$row["user_birth"]."</td><td>".$row["date"]."</td><td>".$row["role"]."</td></tr>";
            }
            
        } else{
            echo "<tr><td colspan=4>No matches found</td></tr>";
        }
    } else{
        echo "<tr><td colspan=4>ERROR: Could not able to execute $sql. " . mysqli_error($con)."</td></tr>";
    }

 echo"</table>";
// close connection
mysqli_close($con);
?>