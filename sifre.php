<?php
include"ayar/baglan.php";
include"ayar/function.php";
?>
<!doctype html>
<html>
<head>
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
<form action="" method="post"  class="mt-5 ml-5">
	<div class="row d-flex justify-content-center">
<div class="card" style="width: 50rem;">
 <center> <img  src="http://localhost/lisans/stil/resim/31Gj4aaf4GL._SX425_.jpg" width="200px" height="300px" alt="Card image cap"></center>
  <div class="text-center">
   <div class="card-body">
    <h5 class="card-title"><p>Şifremi Unuttum:</p></h5>
    <p class="card-text"><p>Şifrenizi Sıfırlamak için mail adresinizi giriniz</p></p>
    <div class="form-group">

  <center>  <input type="email"  class="form-control col-8" name="mail" placeholder="Mail adresiniz"></center>
	</div>

   <input type="submit" class="btn btn-primary col-4" name="gndr" value="Gönder">
  </div>
</div>
</div>
</div>




</form>

</body>
</html>
<?php
function sifreureteci(){
 $karakterler = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321";
 $sifre = '';
 for($i=0;$i<8;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 39};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}



if(isset($_POST['gndr'])){
$eposta=$_POST['mail'];
	$sql = $db->prepare( "SELECT COUNT(*) FROM kullanici where eposta='$eposta'" );
	$sql->execute();
	$say = $sql->fetchColumn();


if($say>=1){
	/*$kontrol = $db->prepare( "SELECT COUNT(*) FROM hash where eposta='$eposta'" );
	$kontrol->execute();
	$deger = $sql->fetchColumn();
	if($deger>1){
		echo "Hali hazırda bir mail gönderilmiş.";
	}*/
	$sifre=sifreureteci();
	$query=$db->prepare("insert into hash set eposta=?,gonderilen=?");
	$insert = $query->execute(array($eposta,$sifre));
	$link=hash('sha256',$sifre);
	$link=strtoupper($link);
	$linkk= "http://localhost/lisans/sifremiunuttum.php?v=".$link;

	$body = file_get_contents('http://localhost/lisans/ayar/sifre.html');
	$gelen = ["ulas","abdurrahman"];
    $giden = [$sifre,$linkk];

    $body = str_replace($gelen,$giden,$body);
	$mail->addAddress($eposta);
    $mail->isHTML(true);
    $mail->Subject = "Şifre Sıfırlama";
    //$mail->Body = 'Sayın '.$row[ 'isim' ].$row[ 'soyisim' ]." ".$row[ 'lisans_bitis' ]  .' Tarihinde'.$row['program_isim'] .'lisansınızın süresi dolacaktır.Lisansınızı yeniletmezseniz programı kullanamayacaksınız. İyi günler.';
	$mail->Body = $body;
    if ($mail->send())
        echo "Mail gonderimi basarili.";
    else
        echo "Malesef olmadi. HATA : ".$mail->ErrorInfo;

    $mail->clearAddresses();

}
}

?>
