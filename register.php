<?php
include "control/connect.php";
include "control/fungsi.php";
if (!isset($_SESSION)) {
    session_start();
}
$reg="";
if (isset($_POST['register'])) {
    if (daftar($_POST)) {
        $reg='sukses';
    } else {
        $reg='gagal';
    }
}
if (isset($_POST['login'])) {
    if(login($_POST)){
        // header("location: keranjang.php");
        // echo "<script>
        // window.history.go(-2);
        // <script>";
        ?>
        <script type="text/javascript">
        window.history.go(-2);
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-">
    <title>BUKULAPAK</title>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <?php require_once 'template/navbar.php'; ?>
    <div id="content">
    <div class="container border-left border-right">
        <div class="container" style="margin-top:7rem;">
        </div>
        <?php if($reg=='sukses'){
            echo "<div class='alert alert-success position-relative'>Registrasi Sukses! Silahkan 
            <a href='#logincollap' class='nav-item nav-link font-weight-bold d-none text-light d-sm-inline' data-toggle='collapse'> Login Disini!</a>
            </div>";
        } else if ($reg=='gagal'){
            echo "<div class='alert alert-danger position-relative'>Registrasi Gagal! Silahkan Cobalagi.</div>";
        }
        ?>
            <div class="row">
                <div class="col-4 offset-1">
                    <h4 class="text-drak text-center roboto-font font-weight-bold mb-4 badge-light p-2 rounded">Login Disini!</h2>
                </div>
                <div class="col-5 offset-1">
                    <h4 class="text-drak text-center roboto-font font-weight-bold mb-4 badge-light p-2 rounded">Daftar Disini!</h2>
                </div>
            </div>
            <div class="row">
            <div class="col-4 offset-1 border-right rounded p-4 mb-5">
                <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name='username' placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name='password' class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" name='login' class="btn bg-1 text-light border-0 pr-4 pl-4 pt-2 pb-2">Login</button>
                    </form>
            </div>
                <div class="col-5 offset-1 border-left rounded p-4 mb-5">
                    <form method="POST" action="" onsubmit="return validasi()" name="register">
                        <div class="form-group">
                            <input type="hidden" value="" name="id">
                            <label for="Username">Username</label>
                            <input type="text" id="Username" name="Username" class="form-control" placeholder="Username">
                            <div class="text-danger" id="name_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" id="Password" name="pass" class="form-control" placeholder="Password">
                            <div class="text-danger" id="pass_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="namalengkap">Nama Lengkap</label>
                            <input type="text" id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap">
                            <div class="text-danger" id="namalkp_invalid"></div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="kelamin" id="KelaminL" class="custom-control-input" value="Laki-laki">
                                <label for="KelaminL" class="custom-control-label">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="kelamin" id="KelaminP" class="custom-control-input" value="Perempuan">
                                <label for="KelaminP" class="custom-control-label">Perempuan</label>
                            </div>
                            <div class="text-danger" id="kelamin_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <div class="text-danger" id="email_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomer HP</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomer Handphone">
                            <div class="text-danger" id="nohp_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                            <div class="text-danger" id="alamat_invalid"></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Kode Pos</label>
                            <input type="text" name="pos" class="form-control" placeholder="Kode Pos">
                            <div class="text-danger" id="alamat_invalid"></div>
                        </div>
                        <button type="submit" name="register" class="btn bg-1 text-light border-0 pr-4 pl-4 pt-2 pb-2">Daftar</button>
                        <button type="reset" class="btn bg-1 text-light border-0 pr-4 pl-4 pt-2 pb-2">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'template/footbar.php'; ?>

    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
        var Username = document.forms["register"]["Username"];
        var password = document.forms["register"]["Password"];
        var namalengkap = document.forms["register"]["namalengkap"];
        var kelamin = document.forms["register"]["kelamin"];
        var email = document.forms["register"]["email"];
        var nohp = document.forms["register"]["no_hp"];
        var alamat = document.forms["register"]["alamat"];

        //display
        var name_invalid = document.getElementById("name_invalid");
        var pass_invalid = document.getElementById("pass_invalid");
        var namalkp_invalid = document.getElementById("namalkp_invalid");
        var kelamin_invalid = document.getElementById("kelamin_invalid");
        var email_invalid = document.getElementById("email_invalid");
        var nohp_invalid = document.getElementById("nohp_invalid");
        var alamat_invalid = document.getElementById("alamat_invalid");

        //listen
        Username.addEventListener('blur', namavalid, true);
        password.addEventListener('blur', passvalid, true);
        namalengkap.addEventListener('blur', namalengkapvalid, true);
        kelamin.addEventListener('blur', kelaminvalid, true);
        email.addEventListener('blur', emailvalid, true);
        nohp.addEventListener('blur', nohpvalid, true);
        alamat.addEventListener('blur', alamatvalid, true);

        function validasi(){
            //username
            if(Username.value==""){
                name_invalid.textContent = "Masukan Username!";
                Username.focus();
                return false;
            }
            //password
            if(password.value==""){
                pass_invalid.textContent = "Masukan Password!";
                password.focus();
                return false;
            }else if(password.value.length < 8 ){
                pass_invalid.textContent = "Masukan Password Minimal 8 Karakter!";
                password.focus();
                return false;
            }
            //nama lengkap
            if(namalengkap.value==""){
                namalkp_invalid.textContent = "Masukan Nama Lengkap Anda!";
                namalengkap.focus();
                return false;
            }

            //kelamin
            if(kelamin.value==""){
                kelamin_invalid.textContent = "Masukan Jenis Kelamin Anda!";
                kelamin.focus();
                return false;
            }
            //email
            if(email.value==""){
                email_invalid.textContent = "Masukan Alamat Email Anda!";
                email.focus();
                return false;
            }
            //no HP
            if(nohp.value==""){
                nohp_invalid.textContent = "Masukan Nomer Handphone Anda!";
                nohp.focus();
                return false;
            }
            //alamat
            if(alamat.value==""){
                alamat_invalid.textContent = "Masukan Alamat Anda!";
                alamat.focus();
                return false;
            }

        }

        function namavalid(){
            if(!Username.value==""){
                name_invalid.textContent = "";
                return true;
            }
        }
        function passvalid(){
            if(!password.value==""){
                pass_invalid.textContent = "";
                return true;
            }
        }
        function namalengkapvalid(){
            if(!namalengkap.value==""){
                namalkp_invalid.textContent = "";
                return true;
            }
        }
        function kelaminvalid(){
            if(!kelamin.value==""){
                kelamin_invalid.textContent = "";
                return true;
            }
        }
        function emailvalid(){
            if(!email.value==""){
                email_invalid.textContent = "";
                return true;
            }
        }
        function nohpvalid(){
            if(!nohp.value==""){
                nohp_invalid.textContent = "";
                return true;
            }
        }
        function alamatvalid(){
            if(!alamat.value==""){
                alamat_invalid.textContent = "";
                return true;
            }
        }
    </script>
</body>

</html>