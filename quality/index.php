<?php

    include_once("../includes/connection.php");
    include_once("../includes/functions.php");

    if($user_data = check_login($con)){
        if($user_data['role'] == 'user'){
            ?>
                <script>
                    alert("You don't have access to this page");
                    window.location.href='../index.php';
                </script>
            <?php
        }
        if($user_data['role'] == 'customer service'){
            ?>
                <script>
                    alert("You need to be quality control to access this page");
                    window.location.href='../service';
                </script>
            <?php
        }
    }
    else if(!isset($_SESSION['user_id'])){
        ?>
            <script>
                alert("You don't have access to this page");
                window.location.href='../index.php';
            </script>
        <?php
    }
?>
