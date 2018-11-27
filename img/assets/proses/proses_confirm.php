<?php
require_once("../../control/connect.php");

$kd_order=$_POST['kd_order'];
$status=$_POST['status'];
$resi=$_POST['noresi'];

// var_dump($status);
// die;
mysqli_query($connection, "UPDATE chekout SET status = '$status' , noresi = '$resi' WHERE kd_order = $kd_order" );
 //see the result
header("location:../index.php?page=verifikasi");
?>