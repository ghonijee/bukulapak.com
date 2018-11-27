<?php 
// require_once '../../control/connect.php';

$jan =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Jan%'"));
$feb =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Feb%'"));
$mar =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Mar%'"));
$apr =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Apr%'"));
$mei =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Mei%'"));
$jun =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Jun%'"));
$jul =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Jul%'"));
$agt =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Agt%'"));
$sep =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Sep%'"));
$oct =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Oct%'"));
$nov =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Nov%'"));
$des =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(tanggal) FROM chekout where tanggal LIKE '%Des%'"));


?>