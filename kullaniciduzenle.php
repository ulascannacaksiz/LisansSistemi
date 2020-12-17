<style>
body {
overflow-x: hidden;
overflow-y: hidden;


}
.kguncelle{
	display: block;
  	width: 100%;
	margin-left: 40%;
	margin-top: 5%;
	}
</style>
<?php
include"x.php";
$id=$_GET['id'];
$sql=$db->query("SELECT * FROM kullanici where kullanici_id='$id'",PDO::FETCH_ASSOC);
foreach($sql as $r){
	$a=$r['isim'];
	$b=$r['soyisim'];
	$c=$r['eposta'];
	$d=$r['sifre'];
	$e=$r['uyelik_tarihi'];
	$f=$r['kullanici_tur'];
}
?>
<form action="" method="post">
<div class="kguncelle">
	<label>İsim</label>
	<input type="text" name="isim" class="form-control col-md-4" value="<?php echo $a;?>">
	<label>Soyisim</label>
	<input type="text" name="soyisim" class="form-control col-md-4" value="<?php echo $b;?>">	
	<label>Eposta</label>
	<input type="text" name="eposta" class="form-control col-md-4" value="<?php echo $c;?>">
	<label>Şifre</label>
	<input type="text" name="sifre" class="form-control col-md-4" value="">
	<label>Üyelik Tarihi</label>
	<input type="text" name="uyelik" class="form-control col-md-4" value="<?php echo $e;?>" disabled >
	<label>Kullanıcı Tür</label>
	<select name="ktur" class="form-control col-md-4">
		<option value="<?php echo $f;?>"><?php echo $f;?></option>
		<option value="admin">Admin</option>
		<option value="gelistirici">Geliştirici</option>
		<option value="uye">Üye</option>
	</select><br>
	<input type="submit" name="submit"  class="btn btn-success">
</form>
</div>
<?php
if(isset($_POST['submit'])){
	$isim=$_POST['isim'];
	$soyisim=$_POST['soyisim'];
	$eposta=$_POST['eposta'];
	$sifre=$_POST['sifre'];
	$ktur=$_POST['ktur'];
	$ulas = hash( 'sha256', $sifre );
$query=$db->prepare("update kullanici set  isim=?, soyisim=?, eposta=?,kullanici_tur=? where kullanici_id=?");

	$insert = $query->execute(array($isim,$soyisim,$eposta,$ktur,$id));
	if(!empty ($sifre)){
	$sq=$db->prepare("update kullanici set sifre=? where kullanici_id=?");
	$sfgn = $sq->execute(array($ulas,$id));
	}
			if ( $insert ) {
				$last_id = $db->lastInsertId();
				echo'<script>swal("Başarılı!", "Kullanıcı başarıyla Güncellendi!", "success") </script>';
				//$url="http://localhost/lisans/duzenle.php?id=$id";
				//header("location: $url");

			} else {
				echo'<script>swal("HATA!", "Bir Sorun Oluştu!", "error") </script>';
				

			}
}




?>