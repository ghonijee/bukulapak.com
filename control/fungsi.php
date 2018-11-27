<?php
require_once "connect.php";
if(!isset($_SESSION)){
    session_start();
}
function daftar($data){
    global $connection;

    $id=$data['id'];
    $user = mysqli_real_escape_string($connection, $data['Username']);
    $pass = password_hash($data['pass'],PASSWORD_DEFAULT);
    $namalkp = mysqli_real_escape_string($connection, $data['namalengkap']);
    $kelamin = mysqli_real_escape_string($connection, $data['kelamin']);
    $email = mysqli_real_escape_string($connection, $data['email']);
    $nohp = mysqli_real_escape_string($connection, $data['no_hp']);
    $pos = mysqli_real_escape_string($connection, $data['pos']);
    $alamat = mysqli_real_escape_string($connection, $data['alamat']);

    $cekuser = mysqli_query($connection, "SELECT username from customer where username='$user'");
    if (mysqli_fetch_assoc($cekuser)) {
        echo "<div class='alert alert-danger position-relative container' style='top: 100px;'>Username Sudah Terpakai</div>";
        return false;
    } else {
        $daftar= mysqli_query(
        $connection,
        "INSERT INTO customer 
        Value ('','$user','$pass','$namalkp','$kelamin','$email','$nohp','$pos','$alamat')"
        );
        return true;
    }
}

function login($data){
    global $connection;

    $username=$data['username'];
    $pass=$data['password'];

    $user = mysqli_query($connection, "SELECT * FROM customer WHERE username='$username'");
    if(mysqli_num_rows($user)===1){
        $rows=mysqli_fetch_assoc($user);
        if(password_verify($pass, $rows["password"])){
            $_SESSION['login']=$rows;   
        }else{
            return false;
        }
    }else {
        return false;
    }
    return true;
}

function keranjang($data){
    global $connection;
    $kd_buku=$data['kd_buku'];
    $id=$data['id'];
    $jumlah=$data['jumlah'];
    $harga=$data['harga'];
    $subtotal=$data['subtotal'];

    if ($id<>'0') {
        $cekcart = mysqli_query($connection, "SELECT * from cart where kd_buku='$kd_buku'");
        if (mysqli_num_rows($cekcart)>0) {
            $hasil=mysqli_fetch_assoc($cekcart);
            $jumlah=$data['jumlah'] + $hasil['jumlah'];
            $update= mysqli_query($connection, "UPDATE cart SET jumlah=$jumlah WHERE kd_buku='$kd_buku'");
        } else {
            $daftar= mysqli_query(
        $connection,
        "INSERT INTO cart 
        Value ('',' $id','$kd_buku','$jumlah','$harga','$subtotal')"
        );
        }
    }else{
        header("location: register.php");

    }
    // if (isset($_SESSION['keranjang'][$kd_buku])) {
    //     $_SESSION['keranjang'][$kd_buku]+=1;
    // } else {
    //     $_SESSION['keranjang'][$kd_buku]= 1;
    // }
    return true;
}

function pesanan($data){
    global $connection;
    $id=$data['id'];

    $cekcart = mysqli_query($connection, "SELECT * from cart where id=$id");
    $cekkd_order = mysqli_query($connection, "SELECT * from chekout ORDER BY kd_order DESC LIMIT 1");
    $hasil_co= mysqli_fetch_assoc($cekkd_order);
    $jumlah= mysqli_num_rows($cekcart);
    while ($pesananku = mysqli_fetch_assoc($cekcart)) {
        $insertpesanan=mysqli_query(
            $connection,
            "INSERT INTO pesanan (`kd_pesanan`, `kd_order`, `id`, `kd_buku`, `jumlah`, `harga`, `subtotal`) VALUE
            ('',
            $hasil_co[kd_order],
            $id,
            '$pesananku[kd_buku]',
            $pesananku[jumlah],
            $pesananku[harga],
            $pesananku[subtotal])"
            );
            //ambil stok awal
            $stok_awal = mysqli_fetch_assoc(mysqli_query($connection, "SELECT stok FROM buku WHERE kd_buku = '$pesananku[kd_buku]'"));
            $stok_buku = $stok_awal['stok'] - $pesananku['jumlah'];
            mysqli_query($connection, "UPDATE buku SET stok = '$stok_buku' WHERE kd_buku = '$pesananku[kd_buku]'");
    }
    return TRUE;
}

function checkout($data){
    global $connection;
    
    $tanggal=$data['tanggal'];
    $id=$data['id'];
    $total=$data['total'];
    $status=$data['status'];
    $noresi=$data['noresi'];

    $daftar= mysqli_query(
        $connection,
        "INSERT INTO chekout 
        Value ('',' $tanggal','$id','$total','$status','$noresi')"
        );
    return true;
}

function clearcart($data){
    global $connection;
    $id=$data['id'];
    $hapus=mysqli_query($connection, "DELETE FROM `cart` WHERE id=$id");
}

function konfirmasi($data){
    global $connection;
    $kd_order=$data['kd_order'];
    $id=$data['id'];
    $namagambar=upload($kd_order);
    if(!$namagambar){
        return FALSE;
    }

    mysqli_query($connection,"INSERT INTO konfirmasi VALUES ('$kd_order','$id','$namagambar')");

    return TRUE;
}

function upload($kd_order){
    $namagambar=$_FILES['konfirmasi']['name'];
    $ukuran = $_FILES['konfirmasi']['size'];
    $eror= $_FILES['konfirmasi']['error'];
    $tmp= $_FILES['konfirmasi']['tmp_name'];
    $ektensi=['jpg','png','jpeg'];
    $ektensigambar = explode('.',$namagambar);
    $ektensigambar = strtolower(end($ektensigambar));
    if($eror===4){
        echo "<div class='alert alert-danger position-relative container' style='top: 110px;'>Silahkan Pilih Gambarnya Dahulu!</div>";
        return FALSE;
    }
    if (!in_array($ektensigambar,$ektensi)){
        echo "<div class='alert alert-danger position-relative container' style='top: 110px;'>File yang anda Upload bukan Gambar!</div>";
        return FALSE;
    }
    //upload
    move_uploaded_file($tmp,'img/konfirmasi/'.$kd_order.'.'.$ektensigambar);
    return $kd_order.'.'.$ektensigambar;
}

function updatestatuscheckout($data){
    global $connection;
    $kd_order=$data['kd_order'];
    mysqli_query($connection,"UPDATE chekout SET status='Belum Dikonfirmasi' WHERE kd_order='$kd_order'");
}

function diterima($data){
    global $connection;
    $kd_order=$data['kd_order'];
    mysqli_query($connection,"UPDATE chekout SET status='Sudah Diterima' WHERE kd_order='$kd_order'");
}