<?php 
require_once '../../control/connect.php';
require_once '../../control/fungsi.php';
$kd_order=$_GET['kd_order'];

?>

<div class="modal-body">
    <form action="proses/proses_confirm.php" method="post" class="form-group" id="formkonfirmasi">
        <label for="">Kode Order</label>
        <input type="text" class="form-control" name="kd_order" value="<?= $kd_order; ?>" readonly>
        <label for="">Status</label>
        <label for=""></label>
        <select class="custom-select" name="status" id="">
            <option selected>Select one</option>
            <option value="Sudah Dikonfirmasi">Sudah Dikonfirmasi</option>
            <option value="Sudah Dikirim">Sudah Dikirim</option>
        </select>
        <label for="">Nomer Resi</label>
        <input type="text" class="form-control" name="noresi" value="">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="formkonfirmasi" name="konfirmasi" class="btn bg-info text-light">Konfirmasi</button>
</div>