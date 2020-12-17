<?php
session_start();
include'ayar/baglan.php';
 ?>
<!doctype html>
<style>
body {
overflow-x: hidden;
overflow-y: hidden;
	height: 500px;
	background-image: url(stil/resim/bg.jpg);
}
.girisyap{
	display: block;
  	width: 50%;
	margin-left: 40%;
	margin-top: 20%;
	}
</style>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<link rel="stylesheet" href="stil/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<form action="" method="post">
<div class="girisyap">
	 <div class="form-group row">
    <label for="staticEmail" class="col-md-1 col-form-label">Email</label>
    <div class="col-md-4">
	<input type="email" name="mail" id="staticEmail" class="form-control">
	</div>
	</div>

	<div class="form-group row ">
	<label for="sifre" class="col-md-1 col-form-label">Şifre</label>
	<div class="col-md-4">
	<input type="password" name="password" id="sifre" class="form-control">
	</div></div>


	<input type="submit" name="submit" value="Giriş yap" class="btn btn-info col-md-2"><br>
	<a href="http://localhost/lisans/sifre.php">ŞİFREMİ UNUTTUM</a>
	</div>
</form>
<?php
if(isset($_POST['submit'])){
$ep=$_POST['mail'];
$si=$_POST['password'];
$ulas= hash('sha256',$si);
$query = $db->query( "Select *from kullanici where eposta='$ep' and sifre='$ulas' ", PDO::FETCH_ASSOC );

$sayi = $query->rowCount();
if ( $sayi > 0 ) {
	foreach ( $query as $row ) {
		$uye_adi = $row[ 'isim' ] . $row[ 'soyisim' ];
		$kullnici_tur = $row[ 'kullanici_tur' ];
		$id = $row[ 'kullanici_id' ];
	}
	$_SESSION[ 'girisyap' ] = $eposta;
	$_SESSION[ "login_oldum" ] = true;
	$_SESSION[ "uye_id" ] = $id;
	$_SESSION[ "uye_sifre" ] = $sifre;
	$_SESSION[ "kullanici_tur" ] = $row[ "kullanici_tur" ];
	$_SESSION[ "uye_adi" ] = $row[ "isim" ] . " " . $row[ "soyisim" ];
	header("location:index.php");
}else {
	echo "Hatalı Kullanıcı adı yada şifre girdiniz";
}

}
?>


</body>
</html>
