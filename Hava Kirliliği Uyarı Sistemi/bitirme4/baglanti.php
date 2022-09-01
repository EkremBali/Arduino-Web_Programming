<?php

$vt_sunucu="127.0.0.1";
$vt_kullanici="root";
$vt_sifre="";
$vt_adi="abonebilgileri";

//veritabanına bağlanma komutu
$baglan = new mysqli($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);
$new = mysqli_set_charset($baglan,"utf8");

//bağlanamadıysak:
if($baglan->connect_error){
    die("Veritabanu bağlantı işlemi başarısız.".$baglan->connect_error);
}

?>