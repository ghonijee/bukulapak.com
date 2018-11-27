<?php 
$data=mysqli_query($connection, "Select * from konfirmasi INNER JOIN chekout using (kd_order) WHERE chekout.status != 'Sudah Dikirim  ' ");
$menunggukonfirmasi= mysqli_num_rows($data);
$totalorder =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_order) FROM chekout"));
$totalbuku =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kd_buku) FROM buku"));
$userlaki2 =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kelamin) FROM customer where kelamin='Laki-laki'"));
$userperem =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kelamin) FROM customer where kelamin='Perempuan'"));
$kat_Pend =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kategori) FROM buku where kategori LIKE '%Pendidikan%'"));
$kat_Agama =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kategori) FROM buku where kategori LIKE '%Religi%'"));
$kat_Hobby =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kategori) FROM buku where kategori LIKE '%Hobby%'"));
$kat_Umum =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kategori) FROM buku where kategori LIKE '%Umum%'"));
$kat_Komp =mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(kategori) FROM buku where kategori LIKE '%Komputer%'"));
$total=0;
$totaluang =mysqli_query($connection, "SELECT total FROM chekout");
while ($uang=mysqli_fetch_assoc($totaluang)) {
    $total = $total + $uang['total'];
}
$jual=0;
$totaljual =mysqli_query($connection, "SELECT jumlah FROM pesanan");
while ($jualbuku=mysqli_fetch_assoc($totaljual)) {
    $jual = $jual + $jualbuku['jumlah'];
}

require_once 'proses/penjualan.php';
// var_dump($totalorder['COUNT(kd_order)']);
?>
<div>
<!-- <h3 class="text-dark text-center p-3 mt-2">ADMINISTRATO</h3> -->

    <div class="row">
        <div class="col-10 offset-1">
            <h3 class="text-dark p-3 border-bottom mt-2"><i class="fas fa-home"></i> DASHBOARD</h3>
        <div class="row mt-3">
        <div class="col-4 mb-3">
            <div class="card text-light">
                <div class="card-header bg-primary">
                    <h6 class="font-weight-bold">Uang Masuk</h6>
                </div>
                <div class="card-body text-right bg-primary text-light">
                    <h5 class=" font-weight-bold">
                        Rp. <?= number_format($total); ?> /Tahun
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-4 mb-3">
            <div class="card text-light">
                <div class="card-header bg-secondary">
                    <h6 class="font-weight-bold"><i class="fas fa-book-open"></i> Buku Terjual</h6>
                </div>
                <div class="card-body bg-secondary text-right text-light">
                    <h5 class="font-weight-bold">
                        <?= $jual; ?>&nbspBuku
                    </h5>
                    
                </div>
            </div>
        </div>
        <div class="col-4 mb-3">
            <div class="card text-light">
                <div class="card-header bg-info">
                    <h6 class="font-weight-bold">Total Buku</h6>
                </div>
                <div class="card-body text-light bg-info text-right">
                    <h5 class="font-weight-bold">
                        <?= $totalbuku['COUNT(kd_buku)']; ?>&nbspBuku
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-8 bg-white mb-3">
            <canvas id="jual" height='250' width='400'></canvas>
        </div>
        <div class="col-4">
            <div class="row">   
                <div class="col-12 mb-3">
                    <div class="card text-light">
                        <div class="card-header bg-3">
                            <h6 class="font-weight-bold">Total Pesanan</h6>
                        </div>
                        <div class="card-body text-light bg-3 text-right">
                            <h5 class="font-weight-bold">
                            <?= $totalorder['COUNT(kd_order)']; ?> Pesanan
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card  text-light">
                        <div class="card-header bg-4">
                            <h6 class="font-weight-bold">Menunggu Konfirmasi</h6>
                        </div>
                        <div class="card-body bg-4 text-light text-right">
                            <h5 class="font-weight-bold ">
                                <?= $menunggukonfirmasi; ?> Pesanan
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 bg-white mb-3">
            <canvas id="buku" height='300' width='400'></canvas>
        </div>
        <div class="col-6 bg-white mb-3">
            <!-- <canvas id="myChart" class=""></canvas> -->
            <canvas id="myChart" width="500" heigt="500"></canvas>
        </div>
    <!-- </div>
    <div class="row mt-3"> -->
    <!-- </div> -->
    <!-- <div class="row">
        <div class="col-6">
            <canvas id="myChart"></canvas>
        </div>
    </div> -->
</div>
</div>
</div>
<!-- <div class="col-12">
    <canvas id="myChart"></canvas>
</div> -->
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var buku = document.getElementById("buku").getContext('2d');
var jual = document.getElementById("jual").getContext('2d');
// animation.animateScale = true;
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Laki-Laki','Perempuan'],
        datasets:[{
            label:'Customer',
            data: [
                <?php echo $userlaki2['COUNT(kelamin)']; ?>,
                <?php echo $userperem['COUNT(kelamin)']; ?>
            ],
            backgroundColor:['rgba(117, 149, 118, 1)','rgba(106, 117, 236, 1)']
        }]
    },
    options:{
        title:{
            display: true,
            text: 'Total Customer',
            fontSize: 16
        },
        layout:{
            padding:{
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        cutoutPercentage : 40
    }
});
var myChart = new Chart(buku, {
    type: 'bar',
    data: {
        labels: ['Pendidikan','Religi','Hobby','Umum','Komputer'],
        datasets:[{
            label:'Kategori Buku',
            data: [
                <?php echo $kat_Pend['COUNT(kategori)']; ?>,
                <?php echo $kat_Agama['COUNT(kategori)']; ?>,
                <?php echo $kat_Hobby['COUNT(kategori)']; ?>,
                <?php echo $kat_Umum['COUNT(kategori)']; ?>,
                <?php echo $kat_Komp['COUNT(kategori)']; ?>
            ],
            backgroundColor:[
                'rgba(106, 117, 236, 1)',
                'rgba(45, 200, 187, 1)',
                'rgba(117, 149, 118, 1)',
                'rgba(136, 117, 149, 1)',
                'rgba(200, 76, 45, 1)'
            ]
        }]
    },
    options:{
        title:{
            display: true,
            text: 'Total Buku Berdasarkan Kategori'
            
        },
        layout:{
            padding:{
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }
});
var myChart = new Chart(jual, {
    type: 'line',
    data: {
        labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
        datasets:[{
            label:'Penjualan',
            fill: false,
            borderColor: 'rgba(106, 117, 236, 1)',
            lineTension:0,
            pointBackgroundColor: 'blue',
            pointBorderWidth: 2,
            data: [
                <?php echo $jan['COUNT(tanggal)']; ?>,
                <?php echo $feb['COUNT(tanggal)']; ?>,
                <?php echo $mar['COUNT(tanggal)']; ?>,
                <?php echo $apr['COUNT(tanggal)']; ?>,
                <?php echo $mei['COUNT(tanggal)']; ?>,
                <?php echo $jun['COUNT(tanggal)']; ?>,
                <?php echo $jul['COUNT(tanggal)']; ?>,
                <?php echo $agt['COUNT(tanggal)']; ?>,
                <?php echo $sep['COUNT(tanggal)']; ?>,
                <?php echo $oct['COUNT(tanggal)']; ?>,
                <?php echo $nov['COUNT(tanggal)']; ?>,
                <?php echo $des['COUNT(tanggal)']; ?>
            ],
            backgroundColor: ''
            
        }]
    },
    options:{
        title:{
            display: true,
            text: 'Total Penjualan Per-Bulan',
            fontSize: 15
            
        },
        layout:{
            padding:{
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }
});
    
</script>