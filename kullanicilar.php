<?php include "x.php";
if($_SESSION[ "kullanici_tur"]!="admin"){
  //echo "HATAA";
  header("location:index.php");
}
?>
<table class="table table-bordered mt-5">
  <thead>
    <tr>
      <th scope="col">İsim</th>
      <th scope="col">Soyisim</th>
      <th scope="col">Eposta</th>
      <th scope="col">Üyelik Tarihi</th>
      <th scope="col">Kullanıcı Tür</th>
      <th scope="col">Düzenle</th>
    </tr>
  </thead>
  <tbody>
   <?php kullanici_listele(); ?>
      </tbody>
</table>
