<?php
include 'ayar/baglan.php';
//$sl=$db->query("SELECT * FROM lisans",PDO::FETCH_ASSOC);
$sql=$db->query("SELECT DATEDIFF(lisans_bitis,NOW()) FROM lisans",PDO::FETCH_ASSOC);
foreach($db->query("SELECT lisans_id, DATEDIFF(lisans_bitis,NOW()) as 'kalan_gun' FROM lisans") as $row){
	//echo $row['kalan_gun']."id= ".$row['lisans_id']."<br>";
		$kalan=$row['kalan_gun'];
	$id=$row['lisans_id'];
		if($kalan<=0){
			$sql=("Update lisans set lisans_durum=0 where lisans_id='$id'");
			$db->exec($sql);
		}
	
}




?>