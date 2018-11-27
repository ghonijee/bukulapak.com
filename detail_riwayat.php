<?php 
require_once 'control/connect.php';
require_once 'control/fungsi.php';
?>

<!-- <div class="modal fade" id="detailriwayat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"> -->
    <!-- <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Pesanan Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                    <?php
                    $id=$_SESSION['login']['id'];
                    $total=0;
                    $kd_order=$_GET['kd_order'];
                    $pesanan=mysqli_query($connection, "SELECT * FROM pesanan WHERE id=$id AND kd_order=$kd_order");
                    while ($hasil=$pesanan->fetch_assoc()) {
                        $kode=$hasil['kd_buku'];
                        $jumlah=$hasil['jumlah'];
                        $result= mysqli_query($connection, "SELECT * FROM buku WHERE kd_buku='$kode'");
                        while ($data = $result->fetch_assoc()) {
                            $subharga=$jumlah * $data['harga']; ?>
                    <div class="col-12">
                        <div class="row p-3 mb-3">
                            <div class="col-2">
                                <img src="img/katalog/<?php echo $data['foto']; ?>" class="img-thumbnail d-none d-md-block">
                            </div>
                            <div class="col-5">
                                <p class="text-dark font-weight-bold">
                                    <?php echo $data['judul_buku']; ?>
                                </p>
                                <p class="text-muted small">
                                    <?php echo $data['pengarang']; ?>
                                </p>
                                <p class="text-danger">Rp.
                                    <?php echo $data['harga']; ?>
                                </p>
                            </div>
                            <div class="col-1 col-md-2 text-center">
                                <form action="" method="post">
                                    <input type="text" name="jumlah" readonly id="jumlah" class="form-control text-center"
                                        value="<?php echo $jumlah ?>">
                                </form>
                            </div>
                            <div class="col-2 text-right">
                                <p class="text-danger font-weight-bold">Subtotal</p>
                                <p class="text-danger">Rp.
                                    <?php echo $subharga; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $total=$total+$subharga;
                        }
                    }
                    ?>
                    <div class="col-11 bg-light p-2 text-right">
                        <h6 class="p-2 mb-1 font-weight-bold">Total</h6>
                        <h6 class="p-2 rounded bg-light text-dark">Rp. <?= number_format($total);  ?></h6>
                    </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div> -->
        </div>
    </div>
<!-- </div> -->