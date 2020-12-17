<?php include "x.php";
	/*if( $_SESSION[ "login_oldum" ]==false){
header("location:girisyap.php");
}*/
?>

  <div class="row ml-4">
    <div class="card mt-4 ml-4" style="width: 20rem;">
      <div class="card-body bg badge-success">
        <h5 class="card-title">Lisans Sayısı</h5>
        <p class="card-text"><?php lisans_sayi();?></p>
      </div>
    </div>
    <div class="card mt-4 ml-4" style="width: 20rem;">
      <div class="card-body bg badge-info">
        <h5 class="card-title">Program Sayısı</h5>
        <p class="card-text"><?php program_sayi();?></p>
      </div>
    </div>
    <div class="card mt-4 ml-4" style="width: 20rem;">
      <div class="card-body bg badge-warning">
        <h5 class="card-title">Kullanıcı Sayısı</h5>
        <p class="card-text"><?php kullanici_sayi();?></p>
      </div>
    </div>
  </div>
  <div class="jumbotron mt-4 bg-light">
    <h3 class="display-4">Hızlı Lisans Oluştur</h3>
    <!--->KULLANICI OLUŞTUR BÖÜLÜMÜ --->
    <form action="kullaniciolustur.php" method="post">
           <div class="form-row">
        <div class="form-group col-md-6">
          <label for="İsim">İsim</label>
          <input type="text" class="form-control" id="isim" name="isim" placeholder="isim">
        </div>
        <div class="form-group col-md-6">
          <label for="Soyisim">Soyisim</label>
          <input type="text" class="form-control" id="Soyisim" name="soyisim" placeholder="Soyisim">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" class="form-control" id="mail" name="eposta" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Şifre</label>
          <input type="password" class="form-control" id="pass" name="sifre" placeholder="Password">
        </div>
      </div>

      <input type="submit" class="btn btn-primary" name="submit">
    </form>
  </div>
</div>
<?php include"footer.php";?>
