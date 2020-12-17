<?php
include "x.php";
?>
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