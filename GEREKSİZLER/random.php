<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>

</body>
</html>
<?php
$dizi= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$sayi= array (0,1,2,3,4,5,6,7,8,9,);

for($i=1; $i<=24; $i++){
	if($i%5==0 && $i>0){
		echo "-";
	}
echo $sayi[rand(0,9)].$dizi[rand (0,25)];
	//echo $dizi[rand (0,6)];
}

?>