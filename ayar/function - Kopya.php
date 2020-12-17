<?php
include 'baglan.php';

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
				require( "ayar/mail/class.phpmailer.php" );
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
				$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
				$mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
				$mail->Host = "smtp.gmail.com"; // Mail sunucusunun adresi (IP de olabilir)
				$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
				$mail->IsHTML( true );
				$mail->SetLanguage( "tr", "phpmailer/language" );
				$mail->CharSet = "utf-8";
				$mail->Username = ""; // Gönderici adresinizin sunucudaki kullanıcı adı (e-posta adresiniz)
				$mail->Password = "()"; // Mail adresimizin sifresi
				$mail->SetFrom( "", "Adınız Soyadınız" ); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
				$mail->AddAddress($mailadres); // Mailin gönderileceği alıcı adres
				$mail->Subject = "Mesaj Basligi"; // Email konu başlığı
				$mail->Body = "Sayın. $isim $soyisim .$lisans_bitis.' Tarihinde $program lisansınızın süresi dolacaktır.Lisansınızı yeniletmezseniz programı kullanamayacaksınız.İyi günler."; 
				if (!$mail->Send()) {
					echo "Email Gönderim Hatasi: " . $mail->ErrorInfo;
				} else {
					echo "Email Gonderildi";
				}
				$mail->clearAddresses();
			}
		}



	}


}

function lisanslari_listele() {
	global $db;
	$sql = $db->query( "SELECT kullanici.kullanici_id,isim,soyisim,lisans.lisans_bitis,lisans.lisans_baslangic,lisans.lisans_durum,program_isim from kullanici  INNER JOIN lisans on lisans.kullanici_id =kullanici.kullanici_id INNER JOIN program on program.program_id = lisans.program_id", PDO::FETCH_ASSOC );
	foreach ( $sql as $row ) {
		$durum = $row[ 'lisans_durum' ];
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

		echo
			' <tr> <td>' . $row[ 'isim' ] . '</td>
	 <td>' . $row[ 'soyisim' ] . '</td>
	  <td>' . $row[ 'program_isim' ] . '</td>
	  <td>' . $row[ 'lisans_baslangic' ] . '</td>
	  <td>' . $row[ 'lisans_bitis' ] . '</td>
	  <td>' . $durum . '</td>' . '<tr>';


	}
}

function kullanicilar() {
	global $db;
	$sql = $db->query( "SELECT * from kullanici", PDO::FETCH_ASSOC );
}
?>