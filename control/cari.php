<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bukulapak";

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection){
        die("Connection Failed:".mysqli_connect_error());
    }
$key = $_GET['key'];
?>
<div class="container mt-4">
    <h4 class="text-dark text-center badge-light p-3 rounded" style="margin-top: 7rem;">Hasil Pencarian</h4>
    <div class="row m-4">
    <?php
    $tampildata = 100;
    $halamanaktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $awal = ($halamanaktif > 1 ) ? ($halamanaktif * $tampildata ) - $tampildata : 0 ;
    $jumlahdata = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM buku WHERE judul_buku LIKE '%$key%' OR kategori LIKE '%$key%'"));
    $jumlahhalaman = ceil($jumlahdata / $tampildata);
    $query = mysqli_query($connection, "SELECT * FROM buku WHERE judul_buku LIKE '%$key%' OR kategori LIKE '%$key%' LIMIT $awal, $tampildata");

        while ($data = $query->fetch_assoc()) { ?>
                <div class="offset-1 col-10">
                <a href="detail_buku.php?kd_buku=<?php echo $data['kd_buku']; ?>" style="text-decoration: none;">
                    <div class="row border-top p-3 mb-3">
                        <div class="col-0 col-md-2">
                            <img src="img/katalog/<?php echo $data['foto']; ?>" class="img-thumbnail d-none d-md-block">
                        </div>
                        <div class="col-6">
                            <h6 class="text-dark font-weight-bold">
                                <?php echo $data['judul_buku']; ?>
                            </h6>
                            <p class="text-muted small">
                                <?php echo $data['pengarang']; ?>
                            </p>
                            <p class="text-danger">Rp.
                                <?php echo $data['harga']; ?>
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
                <?php
                    }
            
                ?>
    </div>
    <div class="offset-5 col">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href='?halaman=<?php echo $halamanaktif-1; ?>'>&laquo;</a></li>
                <?php for ($i=1 ; $i <= $jumlahhalaman ; $i++){ ?>
                <li class="page-item">
                    <a class="page-link" href='?halaman=<?php echo $i ?>'>
                        <?php echo $i ?></a>
                </li>
                <?php } ?>
                <li class="page-item"><a class="page-link" href='?halaman=<?php echo $halamanaktif+1; ?>'>&raquo;</a></li>
            </ul>
            </div>
</div>