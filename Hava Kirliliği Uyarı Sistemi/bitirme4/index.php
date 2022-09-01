<?php

include("baglanti.php");

?>

<!DOCTYPE html>

<html lang="tr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">

        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>

        <title>Astım</title>


    </head>

    <body>
        
        <div class="container">

            <header>
                <nav>
                    <a href="#" class="logo">
                        <i class="fas fa-heartbeat"></i>
                    </a>

                    <ul>
                        <li> <a href="#astim-bilgi"> Astım Nedir</a></li>
                        <li> <a href="#map-bilgi"> Haritalar</a></li>
                        <li> <a href="#abone"> Abonelik</a></li>
                    </ul>
                </nav>
            </header>
            

            <div id="astim-bilgi">

                <h1 class="astim-baslik">Astım Nedir?</h1>
                <p class="astim-text">
                    Astım, solunum yollarını tıkayan ve nefes almayı zorlaştıran kronik bir hastalıktır. Astımda, hava yolu etrafındaki düz kaslar, alerjenler, duman, hava kirliliği, soğuk hava veya egzersiz gibi tetikleyicilere yanıt olarak kasılır ve mukus adı verilen yapışkan salgının üretimi artar; bu durum hava yolunun daralmasına neden olur.
                </p>
                <h2 class="astim-yanbaslik">Astım'ı Olmusuz Etkileyen Gazlar</h2>
                <p class="astim-text">
                    Tetikleyici faktörler hava yolu inflamasyonu yerleşmiş astımlı hastalarda akut 
                    ataklara neden olan faktörlerdir. Soba ve fırın yakıtları, kızarmış yağlar, oda 
                    spreyleri, boya ve ciladan kaynaklanan azot oksit, karbon monoksit, karbon dioksit, 
                    sülfür dioksit ve formaldehit gibi gazlar evici hava kirliliği nedenleridir.
                    Isınma ve sanayide kullanılan yakıtlardan ve egzozlardan acığa cıkan sülfürdioksit, ozon, azot oksitler, asit aerosoller
                    ve partiküller dış ortam hava kirliliğine neden olurlar.
                </p>

            </div>

            <div id="map-bilgi">

                <h1 class="map-baslik">Tehlikeli Bölgeler</h1>

                <div id="map"></div>

                <div class="map-text">

                    <p class="kirmizi">
                        Kırmızı Bölgeler<span  style="margin-left: 23px;">: Tehlikeli Bölgeler</span> 
                    </p>
    
                    <p class="turuncu">
                        Turuncu Bölgeler : Dikkatli Olunması Gereken Bölgeler
                    </p>
    
                    <p class="yesil">
                        Yeşil Bölgeler <span style="margin-left: 21px;"> : Temiz Havaya Sahip Bölgeler</span>
                    </p>

                </div>
                

            </div>

            <div id="abone">

                <h1 class="abone-baslik">Abonelik</h1>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="isim">Ad Soyad:</label>
                        <input class="girdi" type="text" id="isim" name="be_isim" placeholder="Ad Soyad Giriniz...">
                    </div>

                    <div class="form-group">
                        <label for="sehir">Şehir:</label>
                        <input class="girdi" type="text" id="sehir" name="be_sehir" placeholder="Yaşadığınız Şehri Giriniz...">
                    </div>

                    <div class="form-group">
                        <label for="tel-no">Telefon Numarası:</label>
                        <input class="girdi" type="text" id="tel-no" name="be_tel" placeholder="Telefon Numaranızı Giriniz...">
                    </div>

                    <div class="form-group">
                        <label for="mail-input">E-Posta:</label>
                        <input class="girdi" type="text" id="mail-input" name="be_mail" placeholder="E-Posta Adresinizi Giriniz...">
                    </div>

                    <button type="submit" class="btn">
                        Gönder
                    </button>

                </form>

                <?php

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';

                    $mail = new PHPMailer();

                    $mail->isSMTP();

                    //SMTP kimlik doğrulamasının kullanılıp kullanılmayacağı. Kullanılması ve ve username ve password'un belirtilesi gerekir.
                    $mail->SMTPAuth = true;
                    $mail->Username = "bali.ekrem16@gmail.com";
                    $mail->Password = "Ekrem.bali16";

                    //TLS şifreleme, SMTP server, port tsl:587 ssl:465. Gmail,outlook-hotmail.
                    $mail->Host = "tls://smtp.gmail.com:587";"tls://smtp.live.com:587";
                    $mail->CharSet = 'UTF-8';

                    $mail->setFrom(address:"bali.ekrem16@gmail.com", name:"Astim-Saglik"); 

                    if($_POST){
                        $isim = $_POST["be_isim"];
                        $sehir = $_POST["be_sehir"];
                        $telefonNo = $_POST["be_tel"];
                        $mail_input = $_POST["be_mail"];

                        $link = "https://www.google.com/maps/search/?api=1&query=";
                        $enlem;
                        $boylam;
                        $grup;
                        $semt;

                        $semtMesaj = "";
                        $tSemtler = [];
                        $kSemtler = [];
                        $tsi = 0; $ksi = 0;

                        if($isim == "" || $sehir == "" || $telefonNo == "" || $mail_input == ""){
                            echo '<br>'."Boş yer bırakılamaz.";
                        }
                        else{
                            $ekle = "INSERT INTO `aboneler` (`ID`, `isim`, `sehir`, `tel_no`, `email`) VALUES (NULL, '$isim', '$sehir', '$telefonNo', '$mail_input')";
                            
                            $baglan->query($ekle);

                            $bul = "SELECT * FROM konumsensor";
                            $kayit = $baglan->query($bul);
                            
                            if($kayit->num_rows>0){

                                while($satir = $kayit->fetch_assoc()){
                                    $enlem = $satir["enlem"];
                                    $boylam = $satir["boylam"];
                                    $grup = $satir["grup"];
                                    $semt = $satir["semt"];

                                    if($grup == 1){
                                        
                                    }
                                    else if($grup == 2){
                                        $tSemtler[$tsi] = '<a href="'.$link."".$enlem.",".$boylam.'">'.$semt.'</a>';
                                        $tsi++;
                                    }
                                    else if($grup == 3){
                                        $kSemtler[$ksi] = '<a href="'.$link."".$enlem.",".$boylam.'">'.$semt.'</a>';
                                        $ksi++;
                                    }
                                } 
                                
                            }
                            else{
                                echo "Veri Tabanı Boş.";
                            }

                            $mail->addAddress(address:$mail_input, name:$isim);

                            $baslangic =  "<h1>Hoşgeldiniz.</h1>
                            <p> Platforma hoşgeldiniz, sağlığınız için elimizden geleni yapıyor, yüksek doğrulukla verileri sizlerle paylaşıyoruz.Marmaris'de astım hastaları için dikkatli olunması gereken ve tehlikeli bölgeler aşağıdaki gibidir: </p>
                            <p> Dikkatli Olunması Gereken Bölgeler:</p>";
                            $tehlikeliString = "<p> Tehlikeli Bölgeler:</p>";
                            $son = "<p> Ayrıca istediğiniz zaman Bilgi yazıp 0544 578 3119 no'lu numaraya SMS atarak, SMS ile bilgilendirilebilirsiniz.</p>";

                            $tSemtSonString = "";

                            for($i = 0; $i < $tsi; $i++){
                                if($tsi - $i == 1){
                                    $tSemtSonString .= $tSemtler[$i];
                                }
                                else{
                                    $tSemtSonString .= $tSemtler[$i]." , ";
                                }
                                
                            }

                            $kSemtSonString = "";

                            for($i = 0; $i < $ksi; $i++){
                                if($ksi - $i == 1){
                                    $kSemtSonString .= $kSemtler[$i];
                                }
                                else{
                                    $kSemtSonString .= $kSemtler[$i]." , ";
                                }
                                
                            }

                            $mesaj = $baslangic."".$tSemtSonString."".$tehlikeliString."".$kSemtSonString.$son;

                            $mail->isHTML(true);
                            $mail->Subject = "Tehlikeli Bolgeler";
                            $mail->Body = $mesaj;

                            

                            if($mail->send()){
                                echo '<div class="mesaj">Mail gönderildi.</div>';
                            }
                            else{
                                echo '<div class="mesaj">Malesef olmadı.</div>';
                            }

                        }

                    }

                ?>

            </div>

            <footer>
                <p>
                    Ekrem Balı - Doğukan Aydoğdu Tarafından Yapılmıştır. 2021
                </p>
            </footer>

       </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMBIbvsRtHYbuoHnatRgCU-SGooliSmK0&callback=initMap&v=weekly" async ></script>
                    
        <script src="script.js"></script>

    </body>

</html>

