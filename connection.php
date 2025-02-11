<?php
//error_reporting(0);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "responsiveform";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if($conn)
    {
        //echo "Connected to database";
    }
    else
    {
        echo "Not connected to database".mysqli_connect_error();
    }
?>