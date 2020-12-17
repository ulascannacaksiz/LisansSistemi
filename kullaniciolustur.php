<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>
<body>
<?php
	include "ayar/baglan.php";
	if(isset($_POST['submit'])){
	$isim=$_POST['isim'];
	$soyisim=$_POST['soyisim'];
	$eposta=$_POST['eposta'];
	$sifre=$_POST['sifre'];
	$ulas = hash( 'sha256', $sifre );
	$tarih=date("Y-m-d H:i:s");
	$query=$db->prepare("insert into kullanici set isim=?,soyisim=?,eposta=?,sifre=?,uyelik_tarihi=?");
	$insert = $query->execute(array($isim,$soyisim,$eposta,$ulas,$tarih));
		print_r($insert);
	if ( $insert ) {
				$last_id = $db->lastInsertId();
				print "Kullanıcı başarıyla kayıt edildi";
				$url="index.php";
				    
					header("Refresh:3; url=$url");

			} else {
				echo( "hata" );
				
					$url="/index.php";
				    //header( "Refresh: 3; url=$url" );
			}
	}
	
	
	?>



</body>
</html>