<?php
include "control/connect.php";
include 'control/fungsi.php';
if (!isset($_SESSION)) {
    session_start();
}
$select_buku = mysqli_query($connection, "SELECT * FROM buku");
$kd_buku=$_GET['kd_buku'];
$detail_buku = mysqli_query($connection, "SELECT * FROM buku WHERE kd_buku='$kd_buku'");
if (isset($_POST['login'])) {
    login($_POST);
}
if(isset($_POST['keranjang'])){
    if(isset($_SESSION['login'])) {
        if (keranjang($_POST)) {
            //pesanan($_POST);
            header("location: keranjang.php");
        }
    }else{
        header("location: register.php");
    }
    
}

if(isset($_POST['checkout'])){
    if (isset($_SESSION['login'])){
        if (checkout($_POST)) {
            if (pesanan($_POST)) {
                clearcart($_POST);
                header("location: checkout.php");
            } else {
                var_dump($_POST);
                die;
            }
        }
    }else{
        header("location: register.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-">
    <title>BUKULAPAK</title>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
    <style>
     #detail img:hover{
        transform: scale(1.5);
        transition-property: transform;
        transition-duration: .5s;
    }
    </style>
</head>

<body>
    <?php require_once 'template/navbar.php'; ?>
    <?php
        $detail = mysqli_fetch_array($detail_buku);
        // var_dump($detail['kd_buku']);
        $jumlah=1;
    ?>
    <div id="content">
    <div class="container" style="margin-top:10rem;">
        <hr class="w-100">
        <div class="row mb-5" id="detail">
            <div class="col-2 offset-1 border mr-4 p-2 rounded">
                <div class="border-secondary mr-1 text-center">
                    <img src="img/katalog/<?php echo $detail['foto']; ?>" class="img-fluid" style="width: 200px;">
                </div>
            </div>
            <div class="col-5">
                <h2 class="roboto-font">
                    <?php echo $detail['judul_buku']; ?>
                </h2>
                <h5 class="d-inline open-font">
                    <?php echo $detail['pengarang']; ?>
                </h5>
                <h5 class="d-inline ml-3 open-font">
                    <?php echo $detail['kategori']; ?>
                </h5>
                <div class="col-6 p-1 rounded mt-2">
                    <h4 class="text-dark mt-3">Stok Buku</h4>
                    <h4 class="text-danger">
                        <?php echo $detail['stok']; ?>
                    </h4>
                    <?php 
                     $subtotal=$jumlah*$detail['harga'];
                    ?>
                
                <form id="add" action="" method="post">
                    <input type="hidden" name="kd_buku" value="<?php echo $kd_buku; ?>">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['login']['id']; ?>">
                    <!-- <input type="hidden" name="jumlah" value="<?php //echo $jumlah; ?>"> -->
                    <input type="hidden" name="harga" value="<?php echo $detail['harga']; ?>">
                    <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                    <h4 class="text-dark mt-3">Jumlah</h4>
                    <input type="number" class="p-2 form-control col-4 d-inline" name='jumlah' value=1>
                    <!-- <button type="submit" name="keranjang" class="btn-info btn-block border-0 btn font-weight-bold pt-3 pb-3">Tambah Ke Keranjang</button> -->
                </form>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col">
                        <button type="submit" form="add" name="keranjang" class="bg-1 text-light btn-block shadow-sm border-0 roboto-font pt-3 pb-3">Tambah Ke Keranjang</button>
                        <!-- <button type="submit" name="beli" class="btn-info btn-block border-0 btn font-weight-bold pt-3 pb-3">Beli -->
                            <!-- Sekarang</button> -->
                            <form action="" method="POST">
                                <input type="hidden" name="tanggal" value="<?php echo date(" d M Y"); ?>" >
                                <input type="hidden" name="id" value="<?php echo $_SESSION['login']['id']; ?>">
                                <input type="hidden" name="total" value="<?php echo $subtotal; ?>">
                                <input type="hidden" name="status" value="Belum Dibayar">
                                <input type="hidden" name="noresi" value="Belum Tersedia">
                                <button type="button" class="bg-1 text-light btn-block shadow-sm border-0 roboto-font pt-3 pb-3 mt-2" name="checkout" data-toggle="modal" data-target="#checkout">Beli Sekarang</button>
                                <div class="modal fade" id="checkout" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded border-0">
                                            <div class="modal-header bg-1">
                                                <div class="modal-title">
                                                    <h5 class="text-light">Konfirmasi</h5>
                                                </div>
                                                <button type="button" class="close text-light" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <span>Apakah anda yakin mau langsung membeli buku ini?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-light" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn border-0 bg-1 p-2 rounded text-light" name="checkout">Beli Sekarang!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-5">
            <div class="col">
                <!-- <hr class="w-100"> -->
                <h4 class="text-dark text-center bg-light p-3 shadow-sm roboto-font">Detail Buku</h4>
                <hr class="w-75">
                <p class="text-justify col-8 offset-2 mt-4 open-font">
                    <?php echo $detail['detail']; ?>
                </p>
            </div>
        </div>
        <?php require_once 'template/buku_lain.php'; ?>
    </div>
    </div>
    <?php require_once 'template/footbar.php'; ?>
    <!-- <script src="js/jquery-3.3.1.js"></script> -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/script.js"></script> -->
    <script>
        //javascript
    </script>
</body>

</html>