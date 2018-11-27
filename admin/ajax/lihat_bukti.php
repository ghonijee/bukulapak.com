<?php 
require_once '../../control/connect.php';
require_once '../../control/fungsi.php';
$kd_order=$_GET['kd_order'];

?>

<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <?php       
            $result= mysqli_query($connection, "SELECT * FROM konfirmasi WHERE kd_order='$kd_order'");
            while ($data = $result->fetch_assoc()) {
             ?>
            <div class="col-12">
                
                <div class="row p-3 mb-3">
                    <div class="col">
                        <img src="http://localhost/bukulapak/img/konfirmasi/<?= $data['bukti']; ?>" class=" img-fluid">
                        <!-- <img src="http://localhost/bukulapak/img/konfirmasi/9.jpg" class=" img-thumbnail" style="heigt: 100px;"> -->
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>