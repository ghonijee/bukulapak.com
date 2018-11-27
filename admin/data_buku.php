<?php 
$data="";
$no=1;
            $tampildata = 10;
            $halamanaktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $awal = ($halamanaktif > 1 ) ? ($halamanaktif * $tampildata ) - $tampildata : 0 ;
            $jumlahdata = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM buku"));
            $jumlahhalaman = ceil($jumlahdata / $tampildata);
            $data1 = mysqli_query($connection, "SELECT * FROM buku LIMIT $awal, $tampildata"); 
            // for ($i=1 ; $i <= $jumlahhalaman ; $i++){
            //     echo "<a href='?halaman=$i'>$i</a>";
            // }
            //if (mysqli_num_rows($query) > 0) {
            //  while ($data = mysqli_fetch_array($query)) {
if(isset($_POST["cari"])){
    $cari=$_POST["tekscari"];
    $filter=$_POST["filter"];
        if ($filter=="Judul Buku"){
        $data1=mysqli_query($connection, "select * from buku where judul_buku like '%$cari'");
        }elseif($filter=="Nama Pengarang"){
        $data1=mysqli_query($connection,"select * from buku where pengarang like '%$cari'");    
        }else{
        $data1=mysqli_query($connection,"select * from buku where kategori like '%$cari'");     
        }       
}else{
    $data1 = mysqli_query($connection, "SELECT * FROM buku LIMIT $awal, $tampildata"); 
}
?>
<div class="row">
    <div class="col-10 offset-1">
            <h3 class="text-dark p-3 border-bottom mt-2"><i class="fas fa-swatchbook"></i> DATA BUKU</h3>
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <?php
                while ($data = $data1->fetch_assoc()) { ?>
        
            <div class="row border-bottom p-3 mb-1">
                <div class="col-0 col-md-3">
                    <img src="../img/katalog/<?php echo $data['foto']; ?>" class="img-thumbnail d-none d-md-block" style="height: 75%;">
                </div>
                <div class="col-6">
                    <h6 class="text-dark font-weight-bold">
                        <?php echo $data['judul_buku']; ?>
                    </h6>
                    <p class="text-muted small">
                        <?php echo $data['pengarang']; ?>
                    </p>
                    <p class="text-danger">Rp.
                        <?php echo number_format($data['harga']); ?>
                    </p>
                </div>
                <div class="col-2">
                    <button class="btn badge-primary btn-block" onclick="edit('<?php echo $data['kd_buku']; ?>')">Edit</button>
                    <button class="btn badge-primary btn-block" onclick="hapus('<?php echo $data['kd_buku']; ?>')">Hapus</button>
                    
                </div>
            </div>
            <?php  } ?>
</div>
        </div>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col ml-3 mt-3 border p-3">
                <form action="" method="post" class="form-group">
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="filter" id="filter" value="Judul Buku" checked >Judul Buku
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="filter" id="filter" value="Nama Pengarang">Nama Pengarang
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="filter" id="filter" value="Kategori">Kategori
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-10">
                      <!-- <label for="key">Masukan Kata Kunci</label> -->
                      <input type="text" name="tekscari" id="key" class="form-control" placeholder="Masukan Kata Kunci" aria-describedby="helpId">
                      <small id="helpId" class="text-muted">Masukan Kata Kuncinya</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary col mb-1" name="cari" value="Cari">
                        <input type="submit" class="btn btn-primary col" name="semua" value="Tampilkan Semua" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="offset-3 col">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href='?page=tampil&halaman=<?php echo $halamanaktif-1; ?>'>&laquo;</a></li>
        <?php for ($i=1 ; $i <= $jumlahhalaman ; $i++){ ?>
        <li class="page-item">
            <a class="page-link" href='?page=tampil&halaman=<?php echo $i ?>'>
                <?php echo $i ?></a>
        </li>
        <?php } ?>
        <li class="page-item"><a class="page-link" href='?page=tampil&halaman=<?php echo $halamanaktif+1; ?>'>&raquo;</a></li>
    </ul>
</div>
</div>
</div>


<script type="text/javascript">
    function hapus(kd) {
        var jawab= confirm('Anda Yakin Menghapus '+kd + "?");
        if(jawab==true){
            document.location ="proses/proses_hapus.php?kd_buku="+kd;
            alert(kd);
        }
    }

    function edit(kd) {
        document.location="?page=edit_buku&kd_buku=" + kd;
    }

    function  tes(a) {
        alert("haaayyyyy" + a);
    }
</script>