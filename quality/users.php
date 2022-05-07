<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/quality.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Quality Control - users</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <!-- the icon which make the navbar collapse -->
            <div id="menu" class="menu-icon-container">
                <span class="material-icons">menu</span>
            </div>
            <h2>Users</h2>
        </div>
        <div class="search-wrapper">
            <span class="material-icons search-icon">search</span>
            <input type="search" placeholder="Search Users">
        </div>

        <div class="user-wrapper">
            <img src="../media/Pp.jpeg" width="30px" height="30px" alt="Profile Picture">
            <div>
                <h4>Hassan Bassiouny</h4>
                <small>Quality Control</small>
            </div>
        </div>
    </header>
    <div class="page-container">
        <nav class="nav">
            <!-- for making a collapsable navbar from its border -->
            <!-- <div class="nav__border"></div> -->
            <ul class="nav__list">
                <a href="dashboard.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">dashboard</span>
                    </div>
                    <span class="nav__label">Dashboard</span>
                </a>
                <a href="users.php" class="nav__link active">
                    <div class="nav__icon-container">
                        <span class="material-icons">account_circle</span>
                    </div>
                    <span class="nav__label">Users</span>
                </a>
                <a href="flights.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">flight</span>
                    </div>
                    <span class="nav__label">Flights</span>
                </a>
                <a href="assessment.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">assessment</span>
                    </div>
                    <span class="nav__label">Assessment</span>
                </a>
                <a href="profit.php" class="nav__link">
                    <div class="nav__icon-container">
                        <span class="material-icons">paid</span>
                    </div>
                    <span class="nav__label">Profit</span>
                </a>
            </ul>
        </nav>
        <div class="content">
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr class="sticky">
                            <th class="users-table">ID</th>
                            <th class="users-table">User Name</th>
                            <th class="users-table">Password</th>
                            <th class="users-table">Email</th>
                        </tr>
                    </thead>
                    <?php
                        include_once("../includes/connection.php");
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($con, $query);
                            
                        if(mysqli_num_rows($result) > 0){
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["password"] . "</td><td>" . $row["email"] . "</td></tr>";
                            }
                            echo "</tbody>";
                        }
                        else{
                            echo "No result";
                        }
                    ?>
                </table>
            </div>
                <div class="crud">
                    <form action="" method="POST" class="crud-form" enctype= "multipart/form-data">
                        <!-- <label class="crud-form-label">Name</label> -->
                        <input type="text" name="username" placeholder="Name" class="crud-form-input"><br>
                        <!-- <label class="crud-form-label">Password</label> -->
                        <input type="text" name="password" placeholder="Password" class="crud-form-input"><br>
                        <!-- <label class="crud-form-label">E-mail</label> -->
                        <input type="text" name="email" placeholder="E-mail" class="crud-form-input"><br>
                        <!-- <label class="crud-form-label">Role</label> -->
                        <label for="role">Choose Role:</label>
                        <select name="role">
                        <option value="user">User</option>
                        <option value="customer service">Customer service</option>
                        <option value="quality">Quality control</option>
                        
                        </select>
                        <input type="file" name="image" class="crud-form-input"><br>
                        <button class="form-button" type="submit" name="save">OK</button>
                    </form>
                </div>
                <?php
                    if(isset($_POST['save'])){
                        $name = $_POST['username'];
                        $password = $_POST['password'];
                        $email = $_POST['email'];
                        $role = $_POST['role'];
                        $file=$_FILES['image'];
                        
                        $errorCount = 0;
                        
                        if(empty($name))
                        {
                            echo "<br> please enter his/her name <br>";
                            $errorCount = $errorCount + 1;
                        }
                        if(empty($password))
                        {
                            echo "please enter his/her password";
                            $errorCount = $errorCount + 1;
                        }
                            if(empty($email))
                        {
                            echo "<br> please enter his/her email <br>";
                            $errorCount = $errorCount + 1;
                        }
                        if(empty($role))
                        {
                            echo "please enter his/her role";
                            $errorCount = $errorCount + 1;
                        }
                        if($errorCount == 0)
                        {
                            $query = "INSERT into users (user_name, password ,role) values ('$name','$password','$role')";
                            mysqli_query($con, $query);
                        }
                        else
                        {
                            echo "<br>" . "$errorCount";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="../JS/quality.js"></script>
</html>
