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
      <h4 class="text-dark roboto-font text-center bg-light p-3">Riwayat Pembelian</h4>
      <div class="row">
         <div class="col">
            <div class="row container-fluid">
               <?php
            $id=$_SESSION['login']['id'];
            $checkout=mysqli_query($connection,"SELECT * FROM chekout WHERE id=$id AND status='Sudah Diterima'");
            while ($hasil=$checkout->fetch_assoc()) {
                ?>
               <div class="col-10 offset-1 mt-3 border badge-light">
                  <div class="row mt-3 mb-2">
                     <div class="col">
                        <h6 class="font-weight-bold open-font">Kode Order</h6>
                        <h6>
                           <?php echo $hasil['kd_order']; ?>
                        </h6>
                     </div>
                     <div class="col">
                        <h6 class="font-weight-bold open-font">Tanggal</h6>
                        <h6>
                           <?php echo $hasil['tanggal'] ?>
                        </h6>
                     </div>
                     <div class="col">
                        <h6 class=" font-weight-bold">TOTAL</h6>
                        <h6 class="text-dark">Rp.
                           <?php echo number_format($hasil['total']); ?>
                        </h6>
                     </div>
                     <div class="col">
                        <!-- <button type="button" class="btn bg-1 text-light" data-toggle="modal" data-target="#modelId">
                           Detail
                        </button> -->
                        <a href="detail_riwayat.php?kd_order=<?php echo $hasil['kd_order']; ?>" id="detailbtn" class="btn bg-1 text-light"
                           data-toggle="modal" data-target="#detailriwayat">Detail</a>
                     </div>
               
                     <div class="modal fade" id="detailriwayat" role="dialog" tabindex="-1" aria-labelledby="riwayat" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                           <div class="modal-content">
                              <div class="modal-header bg-1">
                                 <h5 class="modal-title text-light">Riwayat Pesanan Anda</h5>
                                 <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body" id="bodydetail">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn bg-1 text-light" data-dismiss="modal">Close</button>
                                 <!-- <button type="button" class="btn bg-1 text-light">Save</button> -->
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
         </div>
      </div>
      <?php 
            if (mysqli_num_rows($checkout)==0) {
                ?>
                <div class="text-center col">
                     <h3 class="text-dark roboto-font text-center mb-4">Kosong!</h3>
                     <img src="img/assets/kerangang_kosong.png" alt="" style="height:200px; width: 240px;">
                </div>
            <?php
            } ?>
   </div>
   <div style="margin-top:8rem;">
      <?php require_once 'template/footbar.php'; ?>
      <script src="js/jquery-3.3.1.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.js"></script>
      <script language="javascript">
         $(document).ready(function(){
            $('a#detailbtn').click(function(){
               var url = $(this).attr('href');
               $.ajax({
                  url : url,
                  success:function(data){
                  $('#bodydetail').html(data);
                  // $('#detailriwayat').modal("show");
                  }
               });
            });
         
         });
      </script>
</body>

</html>