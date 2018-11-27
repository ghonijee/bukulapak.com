<?php 
// require_once '../../control/connect.php';
$kode = $_GET['kd_buku']; //get the no which will updated
$query = "SELECT * FROM buku WHERE kd_buku = '$kode'"; //get the data that will be updated
$hasil = mysqli_query($connection ,$query);
$data  = mysqli_fetch_array($hasil);

?>

<h3 class="text-light badge-primary text-center p-3 border mt-2">EDIT BUKU</h3>
<div class="col mt-5">
    <form action="proses/proses_edit.php" method="POST" enctype="multipart/form-data" class="form-group">
        <div class="row">
            <div class="form-group col-4">
                <label for="kd_buku">Kode Buku</label>
                <input type="text" class="form-control" name="kd_buku" id="kd_buku" aria-describedby="helpId"
                    readonly value="<?= $data['kd_buku'] ?>" placeholder="Kode Buku">
                <small id="helpId" class="form-text text-muted">Masukan kode buku, contoh : KB01</small>
            </div>
            <div class="form-group col-8">
                <label for="judul">Judul Buku</label>
                <input type="text" class="form-control" name="judul" id="judul" aria-describedby="helpId" placeholder="Judul Buku" value="<?php echo $data['judul_buku']; ?>">
            </div>
            <div class="form-group col-4">
                <label for="pengarang">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" id="pengarang" aria-describedby="helpId"
                   value="<?php echo $data['pengarang']; ?>" placeholder="Pengarang Buku">
            </div>
            <div class="form-group col-4">
                <label for="kategori">Kategori</label>
                <select class="form-control" name="kategori" id="kategori" value="<?php echo $data['kategori']; ?>">
                    <option>Pendidikan</option>
                    <option>Novel</option>
                    <option>Umum</option>
                    <option>Komputer</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" name="stok" id="stok" aria-describedby="helpId" placeholder="Jumlah Buku" value="<?php echo $data['stok']; ?>">
            </div>
            <div class="form-group col-8">
                <label for="detail">Detai Buku</label>
                <textarea class="form-control" name="detail" id="detail" rows="4"><?php echo $data['detail']; ?></textarea>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" aria-describedby="helpId"
                            placeholder="Harga Buku" value="<?php echo $data['harga']; ?>">
                    </div>
                    <!-- <div class="form-group col-12">
                        <label for="">Foto Buku</label>
                        <input type="file" class="form-control-file" name="file" id="file" placeholder="Foto Buku"
                            aria-describedby="fileHelpId">
                        <small id="fileHelpId" class="form-text text-muted">Pilih Foto Cover Buku</small>
                    </div> -->
                </div>
            </div>
        </div>
        <input type="submit" value="Tambahkan" class="btn badge-primary">
		<input type="reset" name="Hapus" class="btn badge-secondary">
    </form>
</div>
