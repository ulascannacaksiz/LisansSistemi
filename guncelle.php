<?php
include "x.php";
if(isset($_POST['guncelle'])){
	$sifre=$_POST['sifre'];
	$kod=$_POST['kod'];
$sql = $db->query( "SELECT * From hash where gonderilen='$kod' ", PDO::FETCH_ASSOC);
	foreach($sql as $row){
		$mail=$row['eposta'];
	}
	$ulas = hash( 'sha256', $sifre );
	$sg=("Update kullanici set sifre='$ulas' where eposta='$mail'");
	
	$db->exec($sg);
	
	if($sg){
		$sil=("Delete from hash where eposta='$mail'");
		$db->exec($sil);
		echo '<script>swal("Başarılı!", "Şifreniz Güncellendi!", "success")</script>';
		//header("location:index.php");
		
	}else{
		echo'<script>swal("HATA!", "Şifreniz Güncellenemedi!", "error")</script>';
	}
}



?>