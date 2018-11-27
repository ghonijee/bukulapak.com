<?php 
// $data=mysqli_query($connection, "Select * from konfirmasi INNER JOIN chekout using (kd_order) WHERE chekout.status != 'Sudah Dikirim  ' ");
// $menunggukonfirmasi= mysqli_num_rows($data);
// $totalorder =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_order) FROM chekout"));
// $totalbuku =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_buku) FROM buku"));
// $totaluser =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(id) FROM customer"));
// var_dump($totalorder['COUNT(kd_order)']);

if(isset($_POST["cari"])){
    $cari=$_POST["tekscari"];
    $filter=$_POST["filter"];
        if ($filter=="Tanggal"){
        $data=mysqli_query($connection,"select * from chekout where tanggal like '%$cari'");
        }elseif($filter=="ID Customer"){
        $data=mysqli_query($connection,"select * from chekout where id like '%$cari'");    
        }elseif($filter=="Status"){
        $data=mysqli_query($connection,"select * from chekout where status like '%$cari'");    
        }    
}else{
    $data=mysqli_query($connection,"select * from chekout WHERE status!='Belum Dikonfirmasi'");
}
?>

<div class="row">
    <div class="col-10 offset-1">
            <h3 class="text-dark p-3 border-bottom mt-2"><i class="fas fa-hand-holding-usd"></i> TRANSAKSI</h3>

<table class="table table-striped table-bordered text-center mt-3">
    <thead class="thead-dark">
        <tr>
            <td>Kode Order</td>
            <td>Tanggal</td>
            <td>ID Customer</td>
            <td>Total</td>
            <td>Status</td>
            <td>No. Resi</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($data2=mysqli_fetch_array($data)) {
            ?>
        <tr>
            <td>
                <?= $data2['kd_order']; ?>
            </td>
            <td>
                <?= $data2['tanggal']; ?>
            </td>
            <td>
                <?= $data2['id']; ?>
            </td>
            <td>
                <?= $data2['total']; ?>
            </td>
            <td>
                <?= $data2['status']; ?>
            </td>
            <td>
                <?= $data2['noresi']; ?>
            </td>
            <td><a class="btn badge-info" href="proses/exportpdf.php?act=<?= $data2['kd_order']; ?>">Cetak</a></td>
        </tr>
        <?php
        } ?>
    </tbody>
</table>
    </div>
    </div>
<div class="modal fade" id="konfirmasi" role="dialog" tabindex="-1" aria-labelledby="riwayat" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light">Konfirmasi Pesanan</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="change">
                <div class="modal-body" id="bodykonfirmasi">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" form="formkonfirmasi" class="btn bg-info text-light">Konfirmasi</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script language="javascript">
    $(document).ready(function () {
        $('a#btnkonfirmasi').click(function () {
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function (data) {
                    $('#change').html(data);
                    // $('#detailriwayat').modal("show");
                }
            });
        });

    });
</script>