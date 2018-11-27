<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bukulapak";

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection){
        die("Connection Failed:".mysqli_connect_error());
    }
?>
