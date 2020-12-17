<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>
<body>

<?php
	
	include "ayar/baglan.php";
	$kullanici_id=$_POST['kullanici'];
	$pid=$_POST['program'];
	$lia=$_POST['lisans'];
	$hwid=$_POST['hwid'];
	$lbt=$_POST['baslangic'];
	$lbitis=$_POST['bitis'];
	$ldurum=$_POST['durum'];
	
	
	$query=$db->prepare("insert into lisans set kullanici_id=?,program_id=?,lisans_anahtari=?,hwid=?,lisans_baslangic=?,lisans_bitis=?,lisans_durum=?");
	$insert = $query->execute(array($kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum));
		if ( $insert ) {
				$last_id = $db->lastInsertId();
				print "Kullanıcı başarıyla kayıt edildi";
				$url="index.php";
				    
					header("Refresh:3; url=$url");

			} else {
				echo( "hata" );
					$url="/index.php";
				    header( "Refresh: 3; url=$url" );
			}
	
	
	
	?>

</body>
</html>