<?php
    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "coffeedb";

    $db_conn = mysqli_connect($hostname, $user, $password, $database);
    if(mysqli_connect_errno()){
        echo "Failed to connect to database.";
    }
?>