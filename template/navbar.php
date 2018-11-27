<nav class="navbar navbar-expand navbar-dark bg-1 fixed-top p-1 p-md-2 p-lg-4">
    <div class="container-fluid">
        <!-- <a href="home.php" class="navbar-brand col-9 col-sm-3 col-md-2 col-xl-1 nav-fill">BUKULAPAK</a> -->
        <a href="home.php" class=" navbar-brand nav-fill text-light col-9 col-sm-3 col-md-2 col-auto font-weight-bold" style="text-decoration: none; font-size: 19px;"><i class="fas fa-book-open"></i> BUKULAPAK</a>
        <form action="" class="text-center form-inline  col-lg-5 col-xl d-none d-lg-inline-block">
            <input type="search" class="form-control w-100 col-11 mr-0 border-0" placeholder="Cari dengan Judul Buku / Pengarang Buku"
                name="cari" id="cari">
        </form>
        <?php    
        if(isset($_SESSION['login'])): ?>
        <?php $user = $_SESSION['login']['username']; ?>
        <div class="navbar-nav col-3 col-sm-4 col-md-3 col-xl-3 justify-content-start">
            <a class='nav-item roboto-font nav-link d-none text-light d-sm-inline'><i class="fas fa-user fa-lg"></i>&nbsp
                Hi,
                <?php echo $user; ?>
            </a>
            <a href="keranjang.php" class="nav-item nav-link roboto-font text-light d-sm-inline"><i class="fas fa-cart-plus fa-lg"></i>
                Keranjang</a>
            <a class="nav-item nav-link d-none text-light d-sm-inline" data-toggle="collapse" href="#menuNav"
                data-toggle="collapse">
                <i class="fas fa-bars fa-lg" aria-hidden="true"></i>
            </a>
            <?php else :?>
            <!-- ketika belum login -->
            <div class="navbar-nav col-3 offset-1 col-sm-4 col-md-3 col-xl-2">
                <a href="#logincollap" class="nav-item nav-link roboto-font d-none text-light d-sm-inline" data-toggle="collapse">LOGIN</a>
                <a href="register.php" class="nav-item nav-link roboto-font d-none text-light d-sm-inline">REGISTER</a>
                <?php endif ?>
            </div>
            <div class="collapse" id="menuNav">
                <div class="card card-body mt-1" style="position: fixed; top:9%; right: 7%;">
                    <a href="checkout.php" class="nav-item nav-link roboto-font d-none text-dark d-sm-inline"><i class="fas fa-shopping-bag fa-lg"></i>
                        &nbspPesanan</a>
                    <a href="riwayat.php" class="nav-item nav-link roboto-font d-none text-dark d-sm-inline"><i class="fas fa-history fa-lg"></i>
                        &nbspRiwayat</a>
                    <a href="control/logout.php" class="nav-item nav-link roboto-font d-none text-dark d-sm-inline"><i class="fas fa-sign-out-alt fa-lg"></i>
                        &nbspLogout</a>
                </div>
            </div>
            <div class="collapse" id="logincollap">
                <div class="card card-body mt-1" style="position: fixed; top:9%; right: 6%;">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name='username' placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name='password' placeholder="Password">
                        </div>
                        <button type="submit" name='login' class="btn bg-1 text-light roboto-font bg-1 border-0 pr-4 pl-4 pt-2 pb-2">Login</button>
                        <a href="register.php" class="text-primary">Daftar disini!</a>
                    </form>
                </div>
            </div>
        </div>
</nav>