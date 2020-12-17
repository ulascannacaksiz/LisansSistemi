<?php
include 'baglan.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require("ayar/PHPMailer/src/Exception.php");
require("ayar/PHPMailer/src/PHPMailer.php");
require("ayar/PHPMailer/src/SMTP.php");


$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //ssl
$mail->Port = 587; //25 , 465 , 587
$mail->Host = "smtp.gmail.com";
$mail->Username = "";
$mail->Password = "()";
$mail->setFrom("");
$mail->SetLanguage("tr", "PHPMailer/language");
$mail->CharSet  ="utf-8";



function lisans_uret( $uzunluk ) {
	//$dizi= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	$dizi = array( "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" );
	for ( $i = 0; $i <= $uzunluk; $i++ ) {
		if ( $i % 5 == 0 && $i > 0 ) {
			echo "-";
		}
		echo $dizi[ rand( 0, 35 ) ];
	}
}
// GEREKSİZ KULLANILMADI !!!!
/*function hash_uret( $uzunluk ) {
	//$dizi= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	$dizi = array( "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" );
	for ( $i = 0; $i <= $uzunluk; $i++ ) {

		echo $dizi[ rand( 0, 35 ) ];
	}
}*/

function listele() {
	global $db;
	$sql = $db->query( "Select * from kullanici", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		echo '<option value="' . $row[ 'kullanici_id' ] . '">' . $row[ 'isim' ] . " " . $row[ 'soyisim' ] . '</option>';

	}
}

function program_listele() {
	global $db;
	$sql = $db->query( "Select * from program", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		echo '<option value="' . $row[ 'program_id' ] . '">' . $row[ 'program_isim' ] . '</option>';
	}

}

function lisans_sayi() {
	global $db;
	$sql = $db->prepare( "SELECT COUNT(*) FROM lisans" );
	$sql->execute();
	$say = $sql->fetchColumn();
	echo $say;

}

function program_sayi() {
	global $db;
	$sql = $db->prepare( "SELECT COUNT(*) FROM program" );
	$sql->execute();
	$say = $sql->fetchColumn();
	echo $say;

}

function kullanici_sayi() {
	global $db;
	$sql = $db->prepare( "SELECT COUNT(*) FROM kullanici" );
	$sql->execute();
	$say = $sql->fetchColumn();
	echo $say;

}

function mailgonder() {
	global $db;
	echo '
Sayın $isim $soyisim
$lisans_bitis Tarihinde $program_isim lisansınızın süresi dolacaktır.
Lisansınızı yeniletmezseniz programı kullanamayacaksınız.
İyi günler.';

}

function kalangun() {
	global $db;
	global $mail;
	//foreach($db->query("SELECT lisans_id, DATEDIFF(lisans_bitis,NOW()) as 'kalan_gun' FROM lisans") as $row){
	//foreach($db->query("SELECT lisans.lisans_id, kullanici.kullanici_id,kullanici.isim,kullanici.soyisim,lisans.lisans_bitis,lisans.lisans_durum, kullanici.eposta, DATEDIFF(lisans_bitis,NOW()) as 'kalan_gun' FROM lisans  INNER JOIN   kullanici on lisans.kullanici_id = kullanici.kullanici_id") as $row)
	$sql = $db->query( "SELECT lisans.lisans_id, kullanici.kullanici_id,kullanici.isim,kullanici.soyisim,lisans.lisans_bitis,lisans.lisans_durum,program.program_isim, kullanici.eposta, DATEDIFF(lisans_bitis,NOW()) as 'kalan_gun' FROM lisans  INNER JOIN   kullanici on lisans.kullanici_id = kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		$kalan = $row[ 'kalan_gun' ];
		$id = $row[ 'lisans_id' ];
		$mailadres = $row[ 'eposta' ];
		$isim = $row[ 'isim' ];
		$soyisim = $row[ 'soyisim' ];
		$lisans_bitis = $row[ 'lisans_bitis' ];
		$program = $row[ 'program_isim' ];
		$durum = $row[ 'lisans_durum' ];
		if ( $kalan <= 0 && $durum != 0 ) {
			$sql = ( "Update lisans set lisans_durum=0 where lisans_id='$id'" );
			$db->exec( $sql );
			if ( $db ) {
	//$body = file_get_contents('lisans.html');
	$body = file_get_contents('http://localhost/lisans/ayar/lisans.html');
	$gelen = ["isim","soyad","lisans_bitis","program"];
    $giden = [$row['isim'],$row[ 'soyisim' ],$row[ 'lisans_bitis' ],$row['program_isim']];

    $body = str_replace($gelen,$giden,$body);
	$mail->addAddress($row['eposta']);
    $mail->isHTML(true);
    $mail->Subject = "Bilgilendirme";
    //$mail->Body = 'Sayın '.$row[ 'isim' ].$row[ 'soyisim' ]." ".$row[ 'lisans_bitis' ]  .' Tarihinde'.$row['program_isim'] .'lisansınızın süresi dolacaktır.Lisansınızı yeniletmezseniz programı kullanamayacaksınız. İyi günler.';
	$mail->Body = $body;
    if ($mail->send())
        echo "Mail gonderimi basarili.";
    else
        echo "Malesef olmadi. HATA : ".$mail->ErrorInfo;

    $mail->clearAddresses();
			}

		}



	}


}
function lisans_olustur($kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum){
	global $db;
global $mail;
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
				//echo'<script>swal("Başarılı!", "Kullanıcı başarıyla kayıt edildi!", "success") </script>';

//$sql = $db->query( "SELECT kullanici.kullanici_id,isim,soyisim,lisans.lisans_bitis,lisans.lisans_id,lisans.lisans_baslangic,lisans.lisans_durum,program_isim from kullanici  INNER JOIN lisans on lisans.kullanici_id =kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id where kullanici_id='$kullanici_id' ", PDO::FETCH_ASSOC );
//foreach ($sql as $row) {

$sql = $db->query( "SELECT kullanici.kullanici_id,kullanici.eposta,isim,soyisim,lisans.lisans_anahtari,lisans.lisans_bitis,lisans.lisans_id,lisans.lisans_baslangic,lisans.lisans_durum,program_isim from kullanici  INNER JOIN lisans on lisans.kullanici_id =kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id where kullanici.kullanici_id='$kullanici_id' ", PDO::FETCH_ASSOC);
	foreach ( $sql as $row ) {
		$a=$row['isim'];
		$b=	$row[ 'soyisim' ];
		$c=$row['lisans_anahtari'];
		$d=	$row[ 'lisans_bitis' ];
			$e=	$row['program_isim'];
		
			}
				$body = file_get_contents('http://localhost/lisans/ayar/kod.html');
				$gelen = ["isim","soyad","abdurrezzak","havalimanı","protestan"];
			    $giden = [$a,$b,$c,$d,$e];

			    $body = str_replace($gelen,$giden,$body);
				$mail->addAddress($row['eposta']);
			    $mail->isHTML(true);
			    $mail->Subject = "Bilgilendirme";
				$mail->Body = $body;
			    if ($mail->send())
			        echo "Mail gonderimi basarili.";
			    else
			        echo "Malesef olmadi. HATA : ".$mail->ErrorInfo;

			    $mail->clearAddresses();
			
		}

			 else {
				echo'<script>swal("HATA!", "Bir Sorun Oluştu!", "error") </script>';
					//$url="/index.php";
				    //header( "Refresh: 3; url=$url" );
			}


}
function lisans_guncelle($id, $kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum){
	global $db;
	/*if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$kullanici_id=$_POST['kullanici'];
	$pid=$_POST['program'];
	$lia=$_POST['lisans'];
	$hwid=$_POST['hwid'];
	$lbt=$_POST['baslangic'];
	$lbitis=$_POST['bitis'];
	$ldurum=$_POST['durum'];*/
		$query=$db->prepare("update  lisans set kullanici_id=?,program_id=?,lisans_anahtari=?,hwid=?,lisans_baslangic=?,lisans_bitis=?,lisans_durum=? where lisans_id=?");
	$insert = $query->execute(array($kullanici_id,$pid,$lia,$hwid,$lbt,$lbitis,$ldurum,$id));
		if ( $insert ) {
				$last_id = $db->lastInsertId();
				echo'<script>swal("Başarılı!", "Kullanıcı başarıyla Güncellendi!", "success") </script>';
				$url="http://localhost/lisans/duzenle.php?id=$id";
				header("location: $url");

			} else {
				echo'<script>swal("HATA!", "Bir Sorun Oluştu!", "error") </script>';

			}
		//}
}
function lisanslari_listele() {
	global $db;
	$sql = $db->query( "SELECT kullanici.kullanici_id,isim,soyisim,lisans.lisans_bitis,lisans.lisans_id,lisans.lisans_baslangic,lisans.lisans_durum,program_isim from kullanici  INNER JOIN lisans on lisans.kullanici_id =kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		$durum = $row[ 'lisans_durum' ];
		$id = $row[ 'lisans_id' ];
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
		$linkg = '<a href="duzenle.php?id='.$id.'">DÜZENLE</a>';
		$linksil = '<a href="" onclick="silfonks()"> SİL </a>';
		echo
	' <tr> <td>' . $row[ 'isim' ] . '</td>
	  <td>' . $row[ 'soyisim' ] . '</td>
	  <td>' . $row[ 'program_isim' ] . '</td>
	  <td>' . $row[ 'lisans_baslangic' ] . '</td>
	  <td>' . $row[ 'lisans_bitis' ] . '</td>
	  <td>' . $durum . '</td>
	 <td>' .$linkg  . $linksil. '</td>'. '<tr>';

	}
	//echo $linksil;
 //<td>' .$linkg  . $linksil. '</td>'. '<tr>';
}

function kullanicilar() {
	global $db;
	$sql = $db->query( "SELECT * from kullanici", PDO::FETCH_ASSOC );
}

function kullanici_listele() {
	global $db;
	$sql = $db->query( "SELECT * From kullanici", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		$id=$row['kullanici_id'];

		$linkg = '<a href="kullaniciduzenle.php?id='.$id.'">DÜZENLE</a>';
		echo
	' <tr> <td>' . $row[ 'isim' ] . '</td>
	  <td>' . $row[ 'soyisim' ] . '</td>
	  <td>' . $row[ 'eposta' ] . '</td>
	  <td>' . $row[ 'uyelik_tarihi' ] . '</td>
	  <td>' . $row[ 'kullanici_tur' ] . '</td>
	  <td>' .$linkg  . '</td>' . '<tr>';
	}
}
?>
