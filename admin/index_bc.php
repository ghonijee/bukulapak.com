<?php 
require_once("../control/connect.php");
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('location:login.php');
} else {
    $username=$_SESSION['username'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-">
    <title>BUKULAPAK</title>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/script.js"></script>
    <style>
    </style>
</head>

<body>
    <div class="container-fluid bg-light content-main">
        <div class="row">
            <!-- sidebar -->
            <div class="side-bar col-2 bg-info shadow">
                <div class="text-light navbar-brand font-weight-bold"><a href="?page=dashborad" class="text-light" style="text-decoration: none;">BUKULAPAK</a></div>
                <ul class="navbar-nav">
                    <li class="nav-item mt-3 nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=dashboard"><i class="fas fa-home"></i>&nbsp&nbsp&nbsp&nbspHome</a>
                    </li>
                    <li class="nav-item mt-3 nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=verifikasi"><i class="fas fa-check-circle"></i>&nbsp&nbsp&nbsp&nbspVerifikasi</a>
                    </li>
                    <li class="nav-item mt-3 nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=input"><i class="fas fa-keyboard"></i>&nbsp&nbsp&nbsp&nbspInput Buku</a>
                    </li>
                    <li class="nav-item mt-3  nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=tampil"><i class="fas fa-swatchbook"></i>&nbsp&nbsp&nbsp&nbspData Buku</a>
                    </li>
                    <li class="nav-item mt-3 nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=transaksi"><i class="fas fa-hand-holding-usd"></i>&nbsp&nbsp&nbsp&nbspTransaksi</a>
                    </li>
                    <li class="nav-item mt-3 nav-font border-bottom shadow">
                        <a class="nav-link text-light p-2" href="?page=laporan"><i class="fas fa-chart-area"></i>&nbsp&nbsp&nbsp&nbspLaporan</a>
                    </li>
                </ul>
            </div>
            <!-- content -->
            <div class="col-10 offset-2 badge-info p-3 shadow">
                <nav class="nav justify-content-end">
                    <a class="nav-link text-light nav-font" href="#">Pergi ke Toko?</a>
                    <a class="nav-link text-light nav-font btn btn-outline-light mr-3" href="#">Hei, <?= $username;  ?></a>
                    <a class="nav-link text-light nav-font btn btn-outline-light" href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>

                </nav>
            </div>
            <div class="offset-2 col-10">
            <?php
                isset($_GET["page"])? $page=$_GET["page"]:$page="";
                if ($page=="input") {
                    require_once "input_buku.php";
                } elseif ($page=="tampil") {
                    require_once "data_buku.php";
                } elseif ($page=="dashboard") {
                    require_once "dashboard.php";
                } elseif ($page=="transaksi") {
                    require_once "transaksi.php";
                } elseif ($page=="beranda") {
                    require_once "beranda.php";
                } elseif ($page=="verifikasi") {
                    require_once "verifikasi.php";
                } elseif ($page=="laporan") {
                    require_once "laporan.php";
                } elseif ($page=="edit_buku") {
                    require_once "proses/edit_buku.php";
                } else {
                    echo "Halaman tidak ditemukan";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
    </script>
</body>

</html>