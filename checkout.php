<?php
include'control/connect.php';
include'control/fungsi.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header('location: register.php');
}
if(!isset($kd_buku)){
    $kd_buku=0;
}
if(isset($_POST['konfirmasi'])){
    if(konfirmasi($_POST)){
        updatestatuscheckout($_POST);
    }
}
if(isset($_POST['terima'])){
   diterima($_POST);
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
      <h4 class="text-dark roboto-font text-left bg-light p-3">Pesananku</h4>
      <div class="row">
         <div class="col-8">
            <div class="row container-fluid">
               <?php
            $id=$_SESSION['login']['id'];
            $checkout=mysqli_query($connection,"SELECT * FROM chekout WHERE id=$id AND status!='Sudah Diterima'");
            while ($hasil=$checkout->fetch_assoc()) {
                ?>
               <div class="col-12 mt-3 border-top badge-light">
                  <div class="row mt-3 mb-2">
                     <div class="col-4">
                        <h6 class="font-weight-bold">Kode Order</h6>
                        <h6>
                           <?php echo $hasil['kd_order']; ?>
                        </h6>
                        <h6 class="font-weight-bold">Tanggal</h6>
                        <h6>
                           <?php echo $hasil['tanggal'] ?>
                        </h6>
                        <h6 class="font-weight-bold">ID User</h6>
                        <h6>
                           <?php echo $hasil['id']; ?>
                        </h6>
                     </div>
                     <div class="col-4">
                        <h6 class=" font-weight-bold">No. Resi</h6>
                        <h6>
                           <?php echo $hasil['noresi']; ?>
                        </h6>
                        <h6 class=" font-weight-bold">TOTAL</h6>
                        <h6 class="text-dark">Rp.
                           <?php echo number_format($hasil['total']); ?>
                        </h6>
                        <h6 class=" font-weight-bold">Status</h6>
                        <h6>
                           <?php echo $hasil['status'] ?>
                        </h6>
                     </div>
                     <div class="col-4">
                        <?php
                           $cekkode = mysqli_query($connection, "SELECT * FROM konfirmasi WHERE kd_order=$hasil[kd_order]");
                           $cekhasil=mysqli_fetch_assoc($cekkode);
                           if ($cekhasil['kd_order']!==$hasil['kd_order']) {
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="kd_order" value="<?php echo $hasil['kd_order']; ?>">
                           <input type="hidden" name="id" value="<?php echo $hasil['id']; ?>">
                           <p class="custom-file-label ml-3 mr-3">Upload...</p><input type="file" class="custom-file-input mb-2 bg-1"
                              name="konfirmasi">
                           <button class="btn bg-1 w-100 mb-5 border-0 pt-2 pb-2 text-light" name="konfirmasi" type="submit">Konfirmasi</button>
                           <a href="detail_pesanan.php?kd_order=<?php echo $hasil['kd_order']; ?>" class="text-center btn-block pb-2 rounded"
                              onclick="detail()">Detail</a>
                        </form>
                        <?php
                        } else {
                        ?>
                        <a href="detail_pesanan.php?kd_order=<?php echo $hasil['kd_order']; ?>" class="text-center btn btn-light text-primary btn-block border- pb-2 rounded"
                           onclick="detail()">Detail</a>
                        <a href="detail_pesanan.php?kd_order=<?php echo $hasil['kd_order']; ?>" class="text-center btn btn-light text-primary btn-block pb-2 rounded"
                           name="diterima" data-toggle="modal" data-target="#diterima">Sudah Terima Barang?</a>
                           <div class="modal fade" id="diterima" tabindex="-1">
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
                                                <span>Apakah barang anda sudah diterima ?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                <form action="" method="post">
                                                   <input type="hidden" name="kd_order" value="<?php echo $hasil['kd_order']; ?>">
                                                   <button type="submit" class="btn border-0 bg-1 text-light pr-3 pl-3 rounded" name="terima">YA</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                        } ?>
                     </div>
                  </div>
               </div>
               <?php
            }
            ?>
            </div>
         </div>
         <div class="col-4">
            <div class="row container-fluid">
               <div class="col-12">
               <?php 
                  $checkout1=mysqli_query($connection, "SELECT * FROM chekout WHERE id=$id AND status!='Sudah Diterima'");
                  if (mysqli_num_rows($checkout1)!==0) {
                ?>
                  <div class="card mt-3">
                  <p class="roboto-font text-light card-header text-center bg-1">Langkah Pembayaran</p>
                  <ul class="list-group">
                     <li class=" list-group-item card-text open-font">Lakukan pembayaran melalui Transfer atau Kirim ke rekening Berikut: <br>
                     <span class="text-danger open-font">BNI SYARI'AH</span><br>
                     <span class="text-danger open-font">Nama: bukulapak.com</span><br>
                     <span class="text-danger open-font">No: 0988363739393</span>
                     </li>
                  <li class=" list-group-item card-text open-font">Kirimkan Bukti Transfer / Kirim Melalui fungsi konfirmasi</li>
                  <li class=" list-group-item card-text open-font">Silahkan Tunggu Konfirmasi Dari admin untuk status dan No. Resi</li>
                  </ul>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
                  <?php
                  }else{ ?>
      </div>
      </div>
      </div>
      </div>
      
         <div class="col-12">
            <div class="row justify-content-center">
               <div class="col-5 rounded text-center text-light open-font p-3">
                  <h4 class="text-dark ">Maaf Anda Tidak Memiliki Pesanan!</h4>
                  <img src="img/assets/kerangang_kosong.png" alt="" class="card-img-top mt-4 mb-3" style="height:200px; width: 240px;">
                  <div class="mt-3">
                     <a href="home.php" class="mt-5 bg-1 pt-2 pb-2 pr-5 pl-5 btn-lg text-center text-light" style="text-decoration: none;">Belanja Yuk!</a>
                  </div>
               </div>
            </div>
         </div>
         <?php
            }
         ?>
   </div>

    <div style="margin-top:6rem;">
        <?php require_once 'template/footbar.php'; ?>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
            function detail() {
                document.location = "detail_pesanan.php?kd_order=<?php echo $hasil['kd_order']; ?>";
            }
        </script>
</body>

</html>