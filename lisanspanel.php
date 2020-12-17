<?php include "x.php";


?>
<form action="" method="post">

<div class="form-row">
	<div class="form-group col-md-6">


	<label for="kullanici" class="col-sm-2 col-form-label">Kullanıcı</label>
	<select name="kullanici" id="kullanici" class="form-control">
		<option>Seçiniz</option>
		<?php 
		listele();
		?>

	</select>	
	
	</div>
	<div class="form-group col-md-6">
	<label for="program" class="col-sm-2 col-form-label">Program</label>
	<select name="program" id="program" class="form-control">
		<option>Seçiniz</option>
		<?php 
		program_listele()
		?>

	</select>
	</div>
	</div>
	
	
	<div class="form-group mt-2">
	<label for="lisans" class="col-sm-2 col-form-label">Lisans Anahtarı</label>
	
	<input type="text" class="form-control" id="lisans" name="lisans" value="<?php lisans_uret(24);?>"><br>
	<label for="hwid" class="col-sm-2 col-form-label">Hwid Anahtarı</label>
	<input type="text" class="form-control" id="hwid" name="hwid">
	
	</div>
	  <div class="form-row">
    <div class="col">
    Başlangıç Tarihi
	<input type="date" class="form-control" name="baslangic">
		  </div>
		 
		  <div class="col">
		  Bitiş Tarihi
	<input type="date" class="form-control" name="bitis">
	</div>
		<div class="form-group col-md-12">
	<label for="durum" class="col-sm-2 col-form-label">Lisans Durum</label>
	<select name="durum" id="durum" class="form-control">
		<option value="0">Seçiniz</option>
		<option value="0">Pasif</option>
		<option value="1">Aktif</option>
		<option value="2">Beklemede</option>
		<option value="3">Süresi Doldu</option>
		<option value="4">Demo</option>
	</select>	
	</div>
	
	<input type="submit" class="btn btn-info" name="submit">
</form>
<?php
	if(isset($_POST['submit'])){
	$kullanici_id=$_POST['kullanici'];
	$pid=$_POST['program'];
	$lia=$_POST['lisans'];
	$hwid=$_POST['hwid'];
	$lbt=$_POST['baslangic'];
	$lbitis=$_POST['bitis'];
	$ldurum=$_POST['durum'];
	lisans_olustur($kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum);
		}
	?>