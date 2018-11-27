<?php
   require_once ("../control/connect.php");
   if (isset($_POST['submit'])) {
        $data = $_POST['filter'];
        if (isset($_POST['submit'])) {
            $data = $_POST['filter'];
            if ($data === "Jan") {
                header("Location: proses/explapor.php?data=Jan");
            } elseif ($data === "Feb") {
                header("Location: proses/explapor.php?data=Feb");
            } elseif ($data === "Mar") {
                header("Location: proses/explapor.php?data=Mar");
            } elseif ($data === "Apr") {
                header("Location: proses/explapor.php?data=Apr");
            } elseif ($data === "Mei") {
                header("Location: proses/explapor.php?data=Mei");
            } elseif ($data === "Jun") {
                header("Location: proses/explapor.php?data=Jun");
            } elseif ($data === "Jul") {
                header("Location: proses/explapor.php?data=Jul");
            } elseif ($data === "Agt") {
                header("Location: proses/explapor.php?data=Agt");
            } elseif ($data === "Sep") {
                header("Location: proses/explapor.php?data=Sep");
            } elseif ($data === "Oct") {
                header("Location: proses/explapor.php?data=Oct");
            } elseif ($data === "Nov") {
                header("Location: proses/explapor.php?data=Nov");
            } elseif ($data === "Des") {
                header("Location: proses/explapor.php?data=Des");
            } else {
                header("Location: proses/explapor.php?data= ");
            }
        }
    }
?>
<div class="row">
    <div class="col-10 offset-1">
            <h3 class="text-dark p-3 border-bottom mt-2"><i class="fas fa-chart-area"></i> CETAK LAPORAN BULANAN</h3>

<form action="" method="post"> 
    <div class="form-group mt-4 col-6">
        <label for="">Pilih Bulan</label>
        <select name="filter" class="form-control">
            <option value="Jan">Januari</option>
            <option value="Feb">Februari</option>
            <option value="Mar">Maret</option>
            <option value="Apr">April</option>
            <option value="Mei">Mei</option>
            <option value="Jun">Juni</option>
            <option value="Jul">Juli</option>
            <option value="Agt">Agustus</option>
            <option value="Sep">September</option>
            <option value="Oct">Oktober</option>
            <option value="Nov">November</option>
            <option value="Des">Desember</option>                                
        </select>
    </div>
    <div class="form-group col-6">
        <input class="btn btn-info" type="submit" value="Cetak Laporan" name="submit"/>
    </div>
</form>
</div>
</div>