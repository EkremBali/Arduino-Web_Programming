#include <SPI.h>
#include <MFRC522.h>


String kayitliID[1]; 
bool kayitsizMi; 
int diziIndex = 0;


MFRC522 rfid(10,9);
void setup() {
 
  pinMode(6,OUTPUT); pinMode(7,OUTPUT); pinMode(8,OUTPUT);
  Serial.begin(9600);
  SPI.begin();
  rfid.PCD_Init();
  Serial.println("Kartınızı Okuyucuya Yaklaştırınız...");
}

void loop() {
  
  kayitsizMi = false;
  if(!rfid.PICC_IsNewCardPresent()){
    return;
  }

  if(!rfid.PICC_ReadCardSerial()){
    Serial.println("Kart Okunamıyor");
    return;  
  }

  String kartID="";
  for(byte i=0;i<rfid.uid.size;i++){
      kartID.concat(String(rfid.uid.uidByte[i],DEC));
  }

  kartID.toUpperCase();
  Serial.println("Kart ID: "+kartID);


  for(int i=0;i<1;i++){
    if(kayitliID[i] == kartID){
      Serial.println("Kartınız Siteme Kayıtlı.Girişiniz Sağlanıyor...");
      kayitsizMi = true;
      yetkili();
      return;  
    }
  }

  if(kayitsizMi == false){
      if(diziIndex == 1){
        Serial.println("Sistem Kapasitesi Doldu!!!");
        yetkisiz();  
      }
      else{
        Serial.println("Katı ID'niz Sisteme Kaydedildi.");
        kayitliID[diziIndex] = kartID;
        diziIndex++;  
      }
  }
  

  /*
  if(kartID=="53A67E15"){
    yetkili();
    Serial.println(kartID);
    Serial.println("Yetkili Girişi...");
  }

  else if(kartID=="BC52F437"){
    yetkisiz(); 
    Serial.println(kartID);
    Serial.println("Yetkisiz Giriş...");
  }
  */
}

void yetkili() {

  digitalWrite(6,HIGH);
  for(byte i=0;i<3;i++){
    digitalWrite(8,HIGH);
    delay(100);
    digitalWrite(8,LOW);
    delay(100);
  }
  digitalWrite(6,LOW);
}

void yetkisiz() {

  digitalWrite(7,HIGH);
  digitalWrite(8,HIGH);
  delay(800);
  digitalWrite(8,LOW);
  delay(800);
  digitalWrite(7,LOW);

}
