#include <SPI.h>
#include <SD.h>

String mq07;
String mq135;

File sdKart;
int pinCS = 53;



unsigned long sdzaman1 = 0;
unsigned long sdzaman2 = 0;

unsigned long zaman1 = 0;
unsigned long zaman2 = 0;


String telefonNo = "5320122937";
String msjGelen;
String msjGiden;
String tarih, enlem, boylam, yil, gun, ay, saat, dakika;


void sim808_Baslangic() 
{
  Serial.println("at komutlar manuel gonderildi");        delay(10);
  Serial3.println("AT+CGNSPWR=1");                        delay(200);
  Serial3.println("AT+CGNSSEQ=RMC");                      delay(200); 
  Serial3.println("AT+CMGF=1");                           delay(200); 
  Serial3.println("AT+CNMi=2,2,0,0,0");                   delay(200);    
  Serial3.println("AT+CMEE=2");                           delay(200);        
  Serial3.println("AT&W");                                delay(200); 
}

void setup()
{

  Serial.begin(9600);               delay(1);
  Serial3.begin(9600);              delay(1);

  pinMode(pinCS,OUTPUT);

  if(SD.begin())
  {
    Serial.println("SD kart hazır.");
  }
  else
  {
    Serial.println("SD kart bulunamadı.");
  }
  
  sim808_Baslangic();
}


void loop()
{
  simOku();
  seriPortOku();

  if (msjGelen != "")
  {
    Serial.println("SIM808 Gelen:  " );
    Serial.println(msjGelen);
    veriKontrol();
    msjGelen = "";
  }
  if (msjGiden != "")
  {
    Serial.print("Bizden Giden: " );
    Serial.println(msjGiden);
    Serial3.print(msjGiden);
    msjGiden = "";
  }

  //onSnBekleme();
  mq135=analogRead(A0);                                                delay(10);
  mq07=analogRead(A1);                                                 delay(10);
  //sdKartYaz();
  
}

void simOku()
{
  zaman1 = millis();
  zaman2 = zaman1;    
  while ((zaman1 - zaman2) < 200)
  {
    zaman1 = millis();
    while (Serial3.available())
    {
      zaman1 = millis();
      zaman2 = zaman1;
      char c = Serial3.read();  
      msjGelen += c; 
    }
  }
  Serial3.flush();
}

void seriPortOku() {
  while (Serial.available())
  {
    char d = Serial.read(); 
    msjGiden += d;
  }
  Serial.flush();
}

void onSnBekleme()
{ 
  sdzaman1 = millis();
  sdzaman2 = sdzaman1;   
  while ((sdzaman1 - sdzaman2) < 20000)
  {
    sdzaman1 = millis();
  }
}

void sdKartYaz()
{
  sdKart = SD.open("data.txt", FILE_WRITE);

  if(sdKart)
  {
    if(konumBul())
    {
      sdKart.print(enlem);
      sdKart.print(" , ");
      sdKart.print(boylam);
      sdKart.print(" , ");
      sdKart.print(mq135);
      sdKart.print(" , ");
      sdKart.println(mq07);
      sdKart.close();
    }
    else{
      Serial.print("Konum Bulunamadı.");
      sdKart.close();  
    }
  }
  else
  {
    Serial.println("Dosya Açılamadı.");  
  }
  delay(100);
}


void veriKontrol()
{
  if (( (msjGelen.indexOf("bilgi")) > -1 || (msjGelen.indexOf("Bilgi"))  > -1 || (msjGelen.indexOf("BILGI"))  > -1 )) 
  {
    telefonNo = msjGelen.substring(10,20);                                  delay(10);
    msjGelen = "";                                                          delay(10);
    return msjGonder();
  }
}

bool konumBul()
{
  Serial.println("GPS Kontrol Ediliyor");
  Serial3.println("AT+CGNSINF");                                           delay(1);
  simOku();

  if (msjGelen != "")
  {
    Serial.println("Konum SIM808 Gelen:  " );
    Serial.println(msjGelen);
  }

  if ((msjGelen.indexOf("+CGNSINF: 1,1,")) > -1 )  
  {
    Serial.println("GPS Aktif Konum Bulundu :");                            delay(10);
    tarih = msjBolme(msjGelen, ',', 2);                                     delay(10);
    yil = tarih.substring(0, 4);                                            delay(10);
    ay = tarih.substring(4, 6);                                             delay(10);
    gun = tarih.substring(6, 8);                                            delay(10);
    saat = tarih.substring(8, 10);                                          delay(10);
    dakika = tarih.substring(10, 12);                                       delay(10);

    enlem = msjBolme(msjGelen, ',', 3);                                     delay(10);
    //enlem = enlem.substring(0, 10);                                         delay(10);

    boylam = msjBolme(msjGelen, ',', 4);                                    delay(10);
    //boylam = boylam.substring(0, 11);                                       delay(10);
    
    msjGelen = "";                                                          delay(10);
    return true;
  }
  else if ((msjGelen.indexOf("+CGNSINF: 1,0,") > -1))
  {
    Serial.println("GPS Aktif Konum Bulunamadi Lutfen Bekleyiniz...");          delay(10);
    msjGelen = ""; 
    return false;
  }
  else if ((msjGelen.indexOf("+CGNSINF: 0,") > -1))
  {
    Serial.println("GPS Kapali Acilacak...");                                   delay(10);
    msjGelen = ""; 
    return false;
  }
  else
  {
    msjGelen = "";                                                              delay(10);
    return false;
  }
}

void msjGonder()
{  

  if (konumBul())  
  {
    
    int s = saat.toInt()+3;
    saat = String(s);
    
    Serial3.print("AT+CMGS=\"+90");
    Serial3.print(telefonNo);
    Serial3.print("\"\r\n");                                                                           delay(50);
    Serial3.println("Konum Linki:");                                                                   delay(10);
    Serial3.println("https://www.google.com/maps/search/?api=1&query=" + enlem + "," + boylam);        delay(10);
    Serial3.println("Tarih :" + gun + "/" + ay + "/" + yil);                                           delay(10);
    Serial3.println("Saat :" + saat + ":" + dakika);                                                   delay(10);   
    Serial3.println("Hava Kirliligi: "+mq135);                                                         delay(10);
    Serial3.println((char)26);                                                                         delay(100);
    Serial3.flush();                                                                                   delay(10);
  }
  else
  {
    Serial.println("Konum Bulunamadı");                                                                delay(10);
  }
}

String msjBolme(String mesaj, char ayirici, int index){

  int bulunan = 0;
  int bas = -1;
  int son = 0;
  int maxIndex = mesaj.length()-1;

  for(int i=0; i<=maxIndex && bulunan<=index; i++){

    if(mesaj.charAt(i) == ayirici || i == maxIndex){
      bulunan++;
      bas = son+1;
      son = (i==maxIndex) ? i+1 : i;      
    }

  }

  return bulunan > index ? mesaj.substring(bas,son) : "";

}
