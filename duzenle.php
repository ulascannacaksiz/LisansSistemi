<?php
ob_start();
include "x.php";
$id=$_GET['id'];
$sql=$db->query("SELECT kullanici.kullanici_id,program.program_id,lisans.hwid,lisans.lisans_anahtari,isim,soyisim,lisans.lisans_bitis,lisans.lisans_id,lisans.lisans_baslangic,lisans.lisans_durum,program_isim from kullanici  INNER JOIN lisans on lisans.kullanici_id =kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id where lisans_id='$id'", PDO::FETCH_ASSOC);
foreach($sql as $row){ 
		$isim=$row[ 'isim' ];  
		$durum = $row[ 'lisans_durum' ];
		$drm=$row[ 'lisans_durum' ];
		$soyi=$row[ 'soyisim' ]; 
		$pis=$row[ 'program_isim' ]; 
		$lib=$row[ 'lisans_baslangic' ];
		$lin=$row[ 'lisans_bitis' ];  
		$la=$row[ 'lisans_anahtari' ];  
		$kid=$row['kullanici_id'];
		$hwid=$row[ 'hwid' ];  
	$p_id=$row['program_id'];
}
		switch ( $durum ) {
			case 0:
				$durum = "Pasif";
				break;
			case 1:
				$durum = "Aktif";
				break;
			case 2:
				$durum = "Beklemede";
				break;
			case 3:
				$durum = "Süresi Doldu";
				break;
			case 4:
				$durum = "Demo";
				break;
		}
?>
<form action="" method="post">

<div class="form-row">
	<div class="form-group col-md-6">


	<label for="kullanici" class="col-sm-2 col-form-label">Kullanıcı</label>
	<select name="kullanici" id="kullanici" class="form-control">
		
		<?php 
		echo'<option value="'.$kid.'">'. $isim." ".$soyi.'</option>';
		listele();
		?>

	</select>	
	
	</div>
	<div class="form-group col-md-6">
	<label for="program" class="col-sm-2 col-form-label">Program</label>
	<select name="program" id="program" class="form-control">
		
		<?php 
		echo'<option value="'.$p_id.'">'. $pis.'</option>';
		program_listele()
		?>

	</select>
	</div>
	</div>
	
	
	<div class="form-group mt-2">
	<label for="lisans" class="col-sm-2 col-form-label">Lisans Anahtarı</label>
	
	<input type="text" class="form-control" id="lisans" name="lisans" value="<?php echo $la; ?>"><br>
	<label for="hwid" class="col-sm-2 col-form-label">Hwid Anahtarı</label>
	<input type="text" class="form-control" id="hwid" name="hwid" value="<?php echo $hwid; ?>">
	
	</div>
	  <div class="form-row">
    <div class="col">
    Başlangıç Tarihi
	<input type="date" class="form-control" name="baslangic" value="<?php echo $lib; ?>">
		  </div>
		 
		  <div class="col">
		  Bitiş Tarihi
	<input type="date" class="form-control" name="bitis" value="<?php echo $lin; ?>">
	</div>
		<div class="form-group col-md-12">
	<label for="durum" class="col-sm-2 col-form-label">Lisans Durum</label>
	<select name="durum" id="durum" class="form-control">
		<option value="<?php echo $drm;?>"><?php echo $durum?></option>
		<option value="0">Pasif</option>
		<option value="1">Aktif</option>
		<option value="2">Beklemede</option>
		<option value="3">Süresi Doldu</option>
		<option value="4">Demo</option>
	</select>	
	</div>
	<input type="hidden" name="id" value="<?php echo $id?>">
	<input type="submit" class="btn btn-info" name="submit" value="Lisans Bilgilerini Güncelle">
</form>
<?php
	if(isset($_POST['submit'])){
		$id=$_POST['id'];
	$kullanici_id=$_POST['kullanici'];
	$pid=$_POST['program'];
	$lia=$_POST['lisans'];
	$hwid=$_POST['hwid'];
	$lbt=$_POST['baslangic'];
	$lbitis=$_POST['bitis'];
	$ldurum=$_POST['durum'];
	lisans_guncelle($id,$kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum);

		ob_flush();
		}
			
	?>