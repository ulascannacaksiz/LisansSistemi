<style>
body {
overflow-x: hidden;
overflow-y: hidden;


}
.pekle{
	display: block;
  	width: 100%;
	margin-left: 40%;
	margin-top: 5%;
	}
</style>
<?php
include"x.php";

?>
<div class="pekle">
<form action="" method="post">
	<label>Program İsim</label>
	<input type="text" name="program_isim" class="form-control col-md-4">
	<label>Geliştirici</label>
	<select name="gelisitirici" class="form-control col-md-4">
		<option>Seçiniz</option>
		<?php listele();?>
	</select><br>
	<input type="submit" name="submit" value="Gönder" class="btn btn-info">
</form>
</div>
<?php
if(isset($_POST['submit'])){
	$program_isim=$_POST['program_isim'];
	$gelisitirici_id=$_POST['gelisitirici'];
	$query=$db->prepare("insert into program set program_isim=?,gelisitirici_id=?");
	$insert = $query->execute(array($program_isim,$gelisitirici_id));
		if ( $insert ) {
				$last_id = $db->lastInsertId();
				echo'<script>swal("Başarılı!", "Program başarıyla kayıt edildi!", "success") </script>';
				//$url="index.php";
				    
					//header("Refresh:3; url=$url");

			} else {
				echo'<script>swal("HATA!", "Bir Sorun Oluştu!", "error") </script>';
					//$url="/index.php";
				    //header( "Refresh: 3; url=$url" );
			}

}
?>