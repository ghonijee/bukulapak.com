<?php
require_once '../../control/connect.php';

$kd=$_GET[kd_buku];
mysqli_query($connection, "delete from buku where kd_buku='$kd'");
header("location: ../index.php?page=tampil");
?>