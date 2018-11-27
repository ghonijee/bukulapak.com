<?php 
$data=mysqli_query($connection, "Select * from konfirmasi INNER JOIN chekout using (kd_order) WHERE chekout.status != 'Sudah Dikirim  ' ");
$menunggukonfirmasi= mysqli_num_rows($data);
$totalorder =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_order) FROM chekout"));
$totalbuku =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_buku) FROM buku"));
$totaluser =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(id) FROM customer"));
// var_dump($totalorder['COUNT(kd_order)']);

?>

<div class="row">
    <div class="col-10 offset-1">
        <h3 class="text-dark p-3 border-bottom mt-2"><i class="fas fa-check-circle"></i> VERIFIKASI</h3>
        <table class="table table-bordered table-hover shadow text-center mt-3">
            <thead class="bg-primary text-light open-font font-weight-bold">
                <tr>
                    <td>Kode Order</td>
                    <td>ID Customer</td>
                    <td>Bukti Transfer</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="">
                <?php 
        while ($data2=mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td>
                        <?= $data2['kd_order']; ?>
                    </td>
                    <td>
                        <?= $data2['id']; ?>
                    </td>
                    <!-- <td><a class="btn badge-info" href="">Lihat Bukti</a></td> -->
                    <!-- <td><img class=" img-thumbnail"src="../img/konfirmasi/<?= $data2['bukti']; ?>""></td>  -->
                    <!-- <td><a class=" btn btn-info badge-info" href="edit_konfirmasi.php?kd_order=<?php echo $data2['kd_order']; ?>">Konfirmasi</a></td> -->
                    <td><a href="ajax/lihat_bukti.php?kd_order=<?php echo $data2['kd_order']; ?>" id="btnlihatbukti"
                            class=" btn btn-info badge-info" data-toggle="modal" data-target="#lihatbukti">Lihat Bukti</a></td>
                    <td><a href="ajax/edit_verifikasi.php?kd_order=<?php echo $data2['kd_order']; ?>" id="btnkonfirmasi"
                            class=" btn btn-info badge-info" data-toggle="modal" data-target="#konfirmasi">Konfirmasi</a></td>
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
<div class="modal fade" id="lihatbukti" role="dialog" tabindex="-1" aria-labelledby="lihatbukti" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light">Bukti Transfer</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="changebukti">
                <div class="modal-body" id="bodylihat">
                    <h1></h1>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" form="formkonfirmasi" class="btn bg-info text-light">Konfirmasi</button> -->
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
        $('a#btnlihatbukti').click(function () {
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function (data) {
                    $('#changebukti').html(data);
                    // $('#detailriwayat').modal("show");
                }
            });
        });

    });
</script>