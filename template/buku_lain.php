
<h4 class="text-dark w-100 text-center bg-light p-3 shadow-sm mt-5 roboto-font">Buku Lainnya</h4>

<div class="container mt-5">
   <div class="row">
      <?php
               $select_buku = mysqli_query($connection, "SELECT * FROM buku order by stok LIMIT 6");
              // if (mysqli_num_rows($select_buku)>0) {
                  while ($data = mysqli_fetch_array($select_buku)) {
      ?>
      <div class="col-12 col-sm-6 col-md-3 col-lg-2 text-center">
         <div class="card col p-2">
            <a href="detail_buku.php?kd_buku=<?php echo $data['kd_buku']; ?>" style="text-decoration: none;">
               <img src="img/katalog/<?php echo $data['foto']; ?>" class="card-img-top" style="width: 135px; height: 190px;">
               <p class="card-title mt-3 mb-0 text-truncate open-font">
                  <?php echo $data['judul_buku']; ?>
               </p>
               <p class="text-muted m-1 small">
                  <?php echo $data['kategori']; ?>
               </p>
               <p class="text-dark card-text">Rp.
                  <?php echo $data['harga']; ?>
               </p>
            </a>
         </div>
      </div>
      <?php
                   // }
                } ?>
   </div>
</div>
<hr class="w-100">