# Hava Kirliliği Uyarı Sistemi
Bu proje bir arkadaşımla geliştirdiğim bitirme projemdir.Web kısmını ben yaptım.Arduino ile ilgili kısım ise ortak çalışmadır.
Proje; solunum yolu hastalarını (astım gibi) etkileyen zararlı gazların tespiti ve bulunduğumuz bölgenin risk analizinin yapılması.Ardından bölgelerin web sayfası ile harita üzerinde gösterilmesi ve bir form eklenerek isteyen kişilerin bilgilerini alarak mail ve yine istenirse SMS ile bilgilendirilmesini kapsamaktadır.

Projenin donanım kısmında Arduino Mega, mq-07 ve mq-135 gaz sensörleri, SD Kart modülü ve SIM808 GSM/GPRS/GPS geliştirme kartı kullanılmıştır.Arduino üzerine bu donanımlar bağlanmış, SIM808 ile konum bilgileri alınarak gaz sensörlerinden gelen bilgiler konum ile beraber SD karta kaydedilmiştir.Ardından bu veriler ile veri tabanında bir tablo oluşturulmuş enlem, boylam, mq-07 ve mq-135 bilgileri bu tabloya kayıt edilmiştir.Böylece Google MAP API ile bu enlem boylama ve hava kirliliği verilerine göre çizim yapılmıştır.

Web sayfasındaki formdan gelen sisteme kayıtlı kişiler için de bir tablo oluşturulmuştur.Burada kişilerin telefon numarası, ismi, mail adresi ve yaşadığı şehir tutulmaktadır.Kişi formu gönderince PHPMailer yardımı ile formda girilen mail adresine bölgelerin durumu hakkında mail iletilmektedir.

Ayrıca son olarak kişi sistemdeki telefon numarasına 'BILGI' yazarak SMS atar ise SIM808 GSM kullanılarak kişiye SMS ile bilgilendirme yapılmaktadır.Arduino klasöründe Arduino için gerekli kodlar, web klasöründe ise web kısmı için gerekli kodlar bulunmaktadır.Web sayfasının görüntüsü aşağıdaki gibidir.

![WEB1](https://github.com/EkremBali/Arduino-Web_Programming/blob/main/Hava%20Kirlili%C4%9Fi%20Uyar%C4%B1%20Sistemi/images/web1.JPG)

![WEB2](https://github.com/EkremBali/Arduino-Web_Programming/blob/main/Hava%20Kirlili%C4%9Fi%20Uyar%C4%B1%20Sistemi/images/web2.JPG)

![WEB3](https://github.com/EkremBali/Arduino-Web_Programming/blob/main/Hava%20Kirlili%C4%9Fi%20Uyar%C4%B1%20Sistemi/images/web3.JPG)
