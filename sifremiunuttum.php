<!doctype html>
<html>

	<head>
	<link rel="stylesheet" href="stil/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<meta charset="utf-8">
	<title>Anasayfa</title>
	</head>
<body>
<?php
include"ayar/baglan.php";
include"ayar/function.php";
	$gelen=$_GET['v'];

	?>

<form action="" method="post" id="myP" class="mt-5 ml-5">
	<div class="row d-flex justify-content-center">
<div class="card" style="width: 50rem;">
 <center> <img  src="http://localhost/lisans/stil/resim/d81ff5759e.png" width="200px" height="300px" alt="Card image cap"></center>
  <div class="text-center">
   <div class="card-body">
    <h5 class="card-title"><p>KOD:</p></h5>
    <p class="card-text"><p>Mailinize gönderilen kodu giriniz</p></p>
    <div class="form-group">
  <center>  <input type="text" class="form-control col-md-4 " id="kod" name="kod"></center>
	</div>
   <input type="submit" class="btn btn-primary" name="gonder" value="Gönder">
  </div>
</div>
</div>
</div>
</form>


</body>
</html>
<?php

if(isset($_POST['gonder'])){
	$kod=$_POST['kod'];
	$hash=hash('sha256',$kod);
	$hash= strtoupper($hash);
	if($gelen==$hash){
		///$sql = $db->query( "SELECT * From hash where gonderilen='$kod' ", PDO::FETCH_ASSOC);
	$sql = $db->prepare( "SELECT COUNT(*) From hash where gonderilen='$kod'" );
	$sql->execute();
	$say = $sql->fetchColumn();
//document.getElementById("myP").style.visibility = "hidden";
if($say>=1){
		echo '<script>

  document.getElementById("myP").remove();
</script>';
	echo'
	<form action="guncelle.php" method="post" class="mt-5 ml-5">
	<div class="row d-flex justify-content-center">
<div class="card" style="width: 50rem;">

  <div class="text-center">
   <div class="card-body">
    <h5 class="card-title"><p>Yeni Şifre Oluştur:</p></h5>
    <p class="card-text"><p>Lüften Yeni Şifrenizi giriniz</p></p>
    <div class="form-group">
  <center>  <input type="text" class="form-control col-md-4 " name="sifre"></center>
	</div>
  <input type="hidden" name="kod" value='.$kod.'><br>
   <input type="submit" class="btn btn-success" name="guncelle" value="Güncelle">
  </div>
</div>
</div>
</div>';

}
	}else{
		echo  '<script>swal("HATA!", "Lütfen Mailinize Gönderilen kodu girin!", "error")</script>';
	}
}

?>
