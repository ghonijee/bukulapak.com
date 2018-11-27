<?php
include'control/connect.php';
include'control/fungsi.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: register.php');
}

// if(isset($_POST['keranjang'])){
//     $kd_buku=$_POST['kd_buku'];
// }else{
//     $kd_buku=0;
// }
// if (!isset($_SESSION['keranjang'][$kd_buku])) {
//     $_SESSION['keranjang'][$kd_buku]=0;
// }
if(isset($_POST['checkout'])){
    if(checkout($_POST)){
        if(pesanan($_POST)){
            clearcart($_POST);
            header("location: checkout.php");
        }else{
            var_dump($_POST);
            die;
        }
    }
}
if(isset($_POST['tambah'])){
    tambah($_POST);
}elseif(isset($_POST['kurang'])){
    kurang($_POST);
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

    </style>
</head>
<body>
<?php require_once 'template/navbar.php'; ?>
<div id="content">
   <div class="container" style="margin-top:7rem;">
      <h4 class="roboto-font text-left badge-light p-3 mb-4">Keranjang Anda</h4>
      <div class="row">
         <div class="col-8">
            <div class="row container-fluid">
               <?php
            $total=0;
            $id=$_SESSION['login']['id'];
            $pesanan=mysqli_query($connection,"SELECT * FROM cart WHERE id=$id");
            while ($hasil=mysqli_fetch_assoc($pesanan)) {
                $kode=$hasil['kd_buku'];
                $jumlah=$hasil['jumlah'];
                $result= mysqli_query($connection, "SELECT * FROM buku WHERE kd_buku='$kode'");
                $data = $result->fetch_assoc();
                $subharga=$jumlah * $data['harga']; ?>
               <div class="col-12">
                  <div class="row border-top p-3 mb-3">
                     <div class="col-0 col-md-2">
                        <a href="detail_buku.php?kd_buku=<?php echo $data['kd_buku']; ?>">
                           <img src="img/katalog/<?php echo $data['foto']; ?>" class="img-thumbnail d-none d-md-block">
                        </a>
                     </div>
                     <div class="col-6">
                        <p class="text-dark roboto-font">
                           <?php echo $data['judul_buku']; ?>
                        </p>
                        <p class="text-muted small">
                           <?php echo $data['pengarang']; ?>
                        </p>
                        <p class="text-danger roboto-font">Rp.
                           <?php echo $data['harga']; ?>
                        </p>
                     </div>
                     <div class="col-4 col-md-2 text-center">
                        <form action="" method="post">
                            <input type="text" name="jumlah" readonly id="jumlah" class="form-control text-center"
                                value="<?php echo $jumlah ?>">
                        </form>
                    </div>
                    <div class="col-2 d-none d-md-inline text-right">
                        <p class="text-dark roboto-font">Subtotal</p>
                        <p class="text-danger">Rp.
                            <?php echo $subharga; ?>
                        </p>
                        <!-- <a href="hapus_pesan.php?id=<?php echo $kode; ?>" class="text-danger font-weight-bold">Hapus</a> -->
                        <a href="#" class="text-danger roboto-font" data-toggle="modal" data-target="#hapus">Hapus</a>
                        <div class="modal fade" id="hapus" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded border-0">
                                    <div class="modal-header bg-1">
                                        <div class="modal-title">
                                            <h4 class="text-light roboto-font">Konfirmasi</h4>
                                        </div>
                                        <button type="button" class="close text-light" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Apakah anda yakin mau manghapus produk ini dari keranjang?..</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="hapus_pesan.php?id=<?php echo $kode; ?>" class="btn btn-danger text-light">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
               </div>
            <?php
          $total=$total+$subharga;   
         }
            ?>
            </div>
         </div>
         <div class="col-4">
         <?php 
            if (!$total==0) {
                ?>
            <!-- <div class="col-3 offset-1 w-75" style="position: absolute; top: 200px; right: 100px;"> -->
            <div class="row m-4">
                <div class="col">
                    <div class="row border badge-light p-3 rounded w-100 ">
                        <div class="col-12 text-center">
                            <p class="text-dark roboto-font">Total Pembayaran </p>
                            <p class="text-danger font-weight-bold roboto-font">Rp.
                                <?php echo $total; ?>
                            </p>
                        </div>
                        <div class="col-12 text-center">
                            <form action="" method="POST">
                                <input type="hidden" name="tanggal" value="<?php echo date(" d M Y"); ?>" >
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <input type="hidden" name="status" value="Belum Dibayar">
                                <input type="hidden" name="noresi" value="Belum Tersedia">
                                <button type="button" class="btn-block border-0 bg-1 text-light p-2 roboto-font shadow-sm" name="checkout" data-toggle="modal" data-target="#checkout">Checkout</button>
                                <div class="modal fade" id="checkout" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded border-0">
                                            <div class="modal-header bg-1">
                                                <div class="modal-title">
                                                    <h4 class="text-light">Konfirmasi</h4>
                                                </div>
                                                <button type="button" class="close text-light" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <span>Apakah anda yakin mau chekout belanjaan anda ?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn border-0 bg-1 text-light p-2 rounded" name="checkout">Checkout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <?php require_once 'template/buku_lain.php'; ?>
      </div>
      <?php
            }else{
                ?>
         </div>
         <div class="col-12">
            <div class="row justify-content-center">
               <div class="col-5 rounded text-center text-dark">
                  <h4>Maaf Keranjang Masih Kosong!</h4>
                  <img src="img/assets/kerangang_kosong.png" alt="" class="card-img-top mt-4" style="height:200px; width: 240px;">
                  <div class="mt-3">
                    <a href="home.php" class="mt-3 btn bg-1 pt-2 pb-2 pr-5 pl-5 btn-lg text-center text-light" style="text-decoration: none;">Belanja Yuk!</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
         <?php
            }
         ?>
   </div>

   <div style="margin-top:6rem;"></div>
   <?php require_once 'template/footbar.php'; ?>
   <!-- <script src="js/jquery-3.3.1.js"></script> -->
   <script src="js/popper.js"></script>
   <script src="js/bootstrap.js"></script>
   <script>
   </script>
</body>
</html>
?>