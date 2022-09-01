
<?php

include("baglanti.php");

?>

<!DOCTYPE html>

<html>

  <head>
    <meta name="Onay Formu" content="width=device-width, initial-scale=1">
    <!-- Anasayfa sekmesi için aynı css kodlarını kullanacağımızdan buraya da dahil ediyoruz. -->
    <link rel="stylesheet" href="css/style.css">
    <!-- İkon kütüphanesini eklioruz. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>

    <style>
      body {font-family: Arial, Helvetica, sans-serif;}
      * {box-sizing: border-box;}

      .input-container {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        width: 100%;
        margin-bottom: 15px;
      }

      .ikon2 {
        padding: 10px;
        background: dodgerblue;
        color: white;
        min-width: 50px;
        text-align: center;
      }

      .girisAlani {
        width: 100%;
        padding: 10px;
        outline: none;
      }

      .girisAlani:focus {
        border: 2px solid dodgerblue;
      }

      .buton {
        background-color: dodgerblue;
        color: white;
        padding: 15px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      .buton:hover {
        opacity: 1;
      }

    </style>

  </head>

  <body>

    <section id="menu">
      <div id="logo"></div>
      <nav>
          <a href="index.php"><i class="fas fa-home ikon"></i>Anasayfa</a>
      </nav>
    </section>    

    <div class="form">
      <form action="" style="max-width:500px;margin:auto" method="post">
        <h2>Onay Formu</h2>
        <div class="input-container">
          <i class="fa fa-user ikon2"></i>
          <input class="girisAlani" type="text" placeholder="kart ID" name="kID">
        </div>

        <div class="input-container">
          <i class="fa fa-key ikon2"></i>
          <input class="girisAlani" type="password" placeholder="Parola" name="password">
        </div>

        <div class="input-container">
          <i class="fa fa-question ikon2"></i>
          <input class="girisAlani" type="text" placeholder="Satın Alcağınız Eğitimin Numarasını Giriniz..." name="urun">
        </div>

        <button type="submit" class="buton">Satın Al</button>
      </form>

      <?php

        if($_POST){
          $kartid = $_POST["kID"];
          $sifre = $_POST["password"];
          $urunid = $_POST["urun"];
          $bakiye;
          $urunfiyati;
          $adress;
          $ad;
          $dogruMu = true;


          $bul = "SELECT * FROM kullanicilar where kartID='$kartid' and parola='$sifre'";
          $bulUrun = "SELECT * FROM urunler where urunID='$urunid'";
          $kayit = $baglan->query($bul);
          $kayitUrun = $baglan->query($bulUrun);

          if($kayit->num_rows>0 && $kayitUrun->num_rows>0){

            while($satir = $kayit->fetch_assoc()){
              $bakiye = $satir["bakiye"];
              $ad = $satir["adSoyad"];
              $adress = $satir["adres"];
            }

            while($satirUrun = $kayitUrun->fetch_assoc()){
              $urunfiyati = $satirUrun["urunFiyat"];
            }
          }
          else{
            echo "<script> alert('Yanlış Girdi!!!')</script>";
            $dogruMu = false;
          }

          if($dogruMu){
            if($bakiye >= $urunfiyati){
              $bakiye = $bakiye - $urunfiyati;
              $degistir = "UPDATE kullanicilar SET bakiye='$bakiye'  WHERE kartID='$kartid'";
              $degistiSorgu = $baglan->query($degistir);
              echo '<br>'."Değerli Müşterimiz ".$ad.", siparişiniz ' ".$adress." ' adrese hazır olunca kargolanacaktır.";
            }
            else{
              echo "Yeterli Bakiye Bulunamadı.";
            }
          }
        }
      ?>
    </div>
  </body>
</html>

