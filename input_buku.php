<?php 
require 'control/connect.php';
require 'control/fungsi.php';


if(isset($_POST['input'])){
   global $connection;

   $kd_buku=$_POST["kd_buku"];
   //$foto=$_FILES['file']['name'];
    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
    $foto = $_FILES['file']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp,'img/katalog/'.$foto);
    } else {
        //header("location:/admin/?page=");
    }
   $judul_buku=$_POST["judul"];
   $pengarang=$_POST["pengarang"];
   $kategori=$_POST["kategori"];
   $stok=$_POST["stok"];
   $detail=$_POST["detail"];
   $harga=$_POST["harga"];

   mysqli_query($connection, "INSERT INTO buku VALUES ('$kd_buku','$foto','$judul_buku','$pengarang','$kategori',$stok,'$detail',$harga)");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Input</title>
</head>

<body>
   <div>
      <form action="" method="post" enctype="multipart/form-data">
         <label for="kode">Kode : <input type="text" name="kd_buku" id="kode"></label><br>
         <label for="foto">File :<input type="file" name="file" id="file"></label><br>
         <label for="judul">Judul :<input type="text" name="judul" id="judul" encr></label><br>
         <label for="pengarang">Pengarang :<input type="text" name="pengarang" id="pengarang"></label><br>
         <label for="kategori">kategori :<input type="text" name="kategori" id="kategori"></label><br>
         <label for="stok">stok :<input type="text" name="stok" id="stok"></label><br>
         <label for="detail">detail :<input type="text" height='100px' name="detail" id="detail"></label><br>
         <label for="harga">harga :<input type="text" name="harga" id="harga"></label><br>
         <button type="submit" name="input">Insert</button>

      </form>
   </div>
</body>

</html>