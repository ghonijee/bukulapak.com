<?php
require "control/connect.php";
session_start();
$kd_buku=$_GET['id'];
$hapus=mysqli_query($connection, "DELETE FROM `cart` WHERE kd_buku='$kd_buku'");
// $hapus=mysqli_query($connection, "DELETE FROM `pesanan` WHERE kd_buku='$kd_buku'");
header('location: keranjang.php');
?>