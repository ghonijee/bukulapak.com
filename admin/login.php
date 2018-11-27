<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../control/connect.php";
if(isset($_POST['username'])){
    header('location:index.php');}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>LOGIN</title>
    <style>
     nav{
            margin: auto;
            text-align: center;
            width: 100%;
            font-family: asap condensed;
            font-size: 20px;
        }
        nav ul {
            background:pink;
            list-style: none;
            position: relative;
            display: inline-table;
            width: 100%;
            padding: 0px 0px 0px 0px;
        }
        nav ul li {
            float: left;
            padding: 10px;
        }
        nav ul li:hover {
            background: white;
            color: pink;
        }
        
.butt{
    background-color: #EAEAEA;
    font-size: 12px;
    color: black;
}
a{
    color: black;
    text-decoration-line: none;
}
.iniinput {
	font-family: FS Joey;
    width: 500px;
	height: 50px;
    text-align: center;
    border: none;
    border-radius: 5px;
    background-color: #B3D9D9;
    font-family: arial;
    
}

.button {
	width: 243px;
	height: 40px;
    background:#004040;
    margin-left:130px ;
    font-size: larger;
    color: white;
    font-family: arial;
}

body {
	font-family: FS Joey;
    background-image: url(1.jpg);
    background-size: cover;
}

table {
	margin-top: 20px;
    margin-bottom: 20px;
    border-collapse: collapse;
	
}
div{
    background-color: #004040;
    width: 300px;
}
 fieldset{
    margin: 120px 400px 175px 175px;
    background-color: #DCEDED;
    width: 400px;
    border: 10px white solid;
    border-radius: 40px;
    font-family: arial;
    opacity: 0.9;
 }
 legend{
    background:#004040;
    border: 10px white solid;
    color: white;
    width: 200px;
    text-align: center;
    margin-left: 140px;
    border-radius: 10px;
    font-family: arial;
}
    </style>
</head>

<body>
<fieldset>
    <legend align="left"><h3>LOGIN BUKULAPAK.COM</h3></legend>
    	<form action="proseslogin.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2">
                <tr>
					<td align="center"><input class="iniinput" type="text" name="username"  placeholder="Masukkan Username" /></td>
				</tr>
				<tr>
					<td align="center"><input class="iniinput" type="password" name="password" placeholder="Masukkan Password" /></td>
				</tr>
				<tr>
					<td><input type="submit" class="button" value="Login" /></td>
				</tr>
			</table>
            </form>
   </fieldset>
    </form>
</body>
</html>