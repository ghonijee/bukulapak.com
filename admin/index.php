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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/Chart.bundle.min.js"></script>
    <style>
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- <div class="container-fluid bg-light content-main"> -->
        <!-- <div class="row"> -->
        <!-- sidebar -->
        <div class="bg-2 shadow position-fixed" id="sidebar-wrapper">
            <!-- <div class="text-light navbar-brand ml-2 mr-0 mt-3 font-weight-bold">
                <a href="?page=dashboard" class="text-light" style="text-decoration: none;"><i class="fas fa-book-open"></i> BUKULAPAK</a>
            </div> -->
            <ul class="nav flex-column">
                <li class="nav-item mt-4 nav-font border-bottom  ">
                    <a class="nav-link text-light p-2" href="?page=dashboard"><i class="fas fa-home fa-lg"></i>&nbsp&nbsp&nbspHome</a>
                </li>
                <li class="nav-item mt-3 nav-font border-bottom">
                    <a class="nav-link text-light p-2" href="?page=verifikasi"><i class="fas fa-check-circle  fa-lg"></i>&nbsp&nbsp&nbspVerifikasi</a>
                </li>
                <li class="nav-item mt-3 nav-font border-bottom ">
                    <a class="nav-link text-light p-2" href="?page=input"><i class="fas fa-keyboard  fa-lg"></i>&nbsp&nbsp&nbspInput
                        Buku</a>
                </li>
                <li class="nav-item mt-3 nav-font border-bottom ">
                    <a class="nav-link text-light p-2" href="?page=tampil"><i class="fas fa-swatchbook fa-lg"></i>&nbsp&nbsp&nbspData
                        Buku</a>
                </li>
                <li class="nav-item mt-3 nav-font border-bottom ">
                    <a class="nav-link text-light p-2" href="?page=transaksi"><i class="fas fa-hand-holding-usd  fa-lg"></i>&nbsp&nbsp&nbspTransaksi</a>
                </li>
                <li class="nav-item mt-3 nav-font border-bottom ">
                    <a class="nav-link text-light p-2" href="?page=laporan"><i class="fas fa-chart-area  fa-lg"></i>&nbsp&nbsp&nbspLaporan</a>
                </li>
            </ul>
        </div>
        <!-- content -->
        <!-- <div class="col badge-info p-3 shadow"> -->
            <nav class="nav bg-2 shadow p-3 fixed-top" id="navbar-top">
            
                <i class="fa fa-arrow-circle-right text-light fa-2x col-auto" href="#menu-toggle" id="menu-toggle"></i>
                <a href="?page=dashboard" class="text-light font-weight-bold text-center col" style="text-decoration: none; font-size: 26px;"><i class="fas fa-book-open"></i> BUKULAPAK</a>
                <!-- <h2 class="nav-link text-light nav-font text-center font-weight-bold"></h2> -->
                <a class="nav-link text-light nav-font col-auto btn btn-outline-light mr-3" href="#">Hei,
                    <?= $username;  ?></a>
                <a class="nav-link text-light nav-font col-auto btn btn-outline-light" href="logout.php"><i class="fas fa-sign-out"></i>Logout</a>
            </nav>
        <!-- </div> -->

        <!-- <div id="page-content-wrapper"> -->
            <div class="container-fluid" style="margin-top: 4.6em;">
                <div class="row">
                    <div class="col">
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
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
        window.onload = function(){
            var button = document.getElementById('menu-toggle');
            button.click();
            // $("#menu-toggle").addClass('putar');
            // button.
        }
        $("#menu-toggle").click(function(e) {
            // $("#menu-toggle").addClass('putar');
            e.preventDefault();
            
            if($("#wrapper").toggleClass("toggled").hasClass('toggled')){
                $("#menu-toggle").addClass('putar');
            }else{
                $("#menu-toggle").removeClass('putar'); 
                // $("#menu-toggle").addClass('putarBack'); 
            }
            // if($("#wrapper").toggleClass("toggled", function () {
            //     if($(this).is('true')){
            //         alert('hahaha');
            //         $("#menu-toggle").addClass('putar');
            //     }else{
            //         $("#menu-toggle").removeClass('putar');
            //     }
            // }));
            // $("#menu-toggle").removeClass('putar');
        });
    </script>
</body>

</html>