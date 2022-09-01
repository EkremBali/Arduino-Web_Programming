<!DOCTYPE html>
<html lang="tr">
    <head>

        <meta charset="UTF-8">
        <title>Anasayfa | Eğitim</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Glory:ital,wght@1,300&display=swap" rel="stylesheet">

        
        <link rel="stylesheet" href="owl/owl.carousel.min.css">
        <link rel="stylesheet" href="owl/owl.theme.default.min.css">
    
    </head>

    <body>

        <section id="menu">
            <div id="logo">Eğitim</div>
            <nav>
                <a href=""><i class="fas fa-home ikon"></i>Anasayfa</a>
                <a href="#egitimler"><i class="fas fa-book ikon"></i>Egitimler</a>
            </nav>
        </section>

        <section id="anasayfa">
            <div id="black">
                
            </div>

            <div id="icerik">
                <h2>Eğitim</h2>
                <hr width="450px" align="left">
                <p>
                    Eğitime hoşgeldiniz. Burada kendinizi web programcılığında geliştirebileceğiniz birbirinden farklı eğitimler bulacaksınız.
                    Eğitim menüsünden istediğiniz eğitim setini satın alabilir ve bu dünyaya giriş yapabılırsiniz.İyi çalışmalar.
                </p>
            </div>

        </section>

        <section id="egitimler">
            <div class="container">
                <h3 class="karth3">Eğitimler</h3>

                <div class="owl-carousel owl-theme">

                    <div class="kart item" data-merge=1.5>
                        <img src="img/html.png" alt="" class="img-fluid">
                        <h5 class="karth5">1.HTML5 Eğitim Seti</h5>
                        <p class="kartp">Bu eğitim setinde HTML5 programcılığında temelden başlayarak sizleri ileri seviye bir HTML5 programcısı yapacağız. </p>
                        <br>
                        <p>100 TL</p>
                    </div>

                    <div class="kart item" data-merge=1.5>
                        <img src="img/css.jpg" alt="" class="img-fluid">
                        <h5 class="karth5">2.CSS3 Eğitim Seti</h5>
                        <p class="kartp">Bu eğitim setinde CSS3 programcılığında temelden başlayarak sizleri ileri seviye bir CSS3 programcısı yapacağız.</p>
                        <br>
                        <p>120 TL</p>
                    </div>

                    <div class="kart item" data-merge=1.5>
                        <img src="img/php.jfif" alt="" class="img-fluid">
                        <h5 class="karth5">3.PHP Eğitim Seti</h5>
                        <p class="kartp">Bu eğitim setinde PHP programcılığında temelden başlayarak sizleri ileri seviye bir PHP programcısı yapacağız.</p>
                        <br>
                        <p>250 TL</p>
                    </div>     
                    
                    <div class="kart item" data-merge=1.5>
                        <img src="img/js.png" alt="" class="img-fluid">
                        <h5 class="karth5">4.JavaScript Eğitim Seti</h5>
                        <p class="kartp">Bu eğitim setinde JS programcılığında temelden başlayarak sizleri ileri seviye bir JS programcısı yapacağız.</p>
                        <br>
                        <p>250 TL</p>
                    </div>   

                    <div class="kart item" data-merge=1.5>
                        <img src="img/c.png" alt="" class="img-fluid">
                        <h5 class="karth5">5.C# Eğitim Seti</h5>
                        <p class="kartp">Bu eğitim setinde C# programcılığında temelden başlayarak sizleri ileri seviye bir C# programcısı yapacağız.</p>
                        <br>
                        <p>300 TL</p>
                    </div>   

                </div>

                <br>
                <br>
                <br>
                <a href="panel.php" class="buton">Satın Al</a>
            
            </div>

        </section>

                

        <script
        src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
        crossorigin="anonymous"></script>
        
        <script src="owl/owl.carousel.min.js"></script>
        
        <script src="owl/script.js"></script>
    
    
    </body>

</html>

<?php

include("baglanti.php");

?>