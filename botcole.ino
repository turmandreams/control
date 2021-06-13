#include <ESP8266WiFi.h>

const char* ssid     = "miwifi";
const char* password = "mipass";


WiFiClient client;

int estado=0;

int contador=0;

void cerrarcliente(){
    client.flush();
    client.stop();   
    client.stopAll();  
}


void setup() {

  Serial.begin(115200);
  pinMode(LED_BUILTIN, OUTPUT);
 
  pinMode(13, OUTPUT); 
  pinMode(12, OUTPUT);
  pinMode(14, OUTPUT); 
  pinMode(16, OUTPUT); 


  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) 
  {
    delay(200);
    Serial.print('.');
  }
  
  digitalWrite(LED_BUILTIN, LOW);

  digitalWrite(13,LOW);    
  digitalWrite(12,LOW);    
  digitalWrite(14,LOW);    
  digitalWrite(16,LOW);    

 
}

void loop()
{   

    client.connect("www.turmandreams.es",80);
    
    if(estado==1) {
           digitalWrite(13,HIGH);    
           digitalWrite(12,HIGH);    
           delay(1000);                      
    }else if(estado==2) {
           digitalWrite(13,HIGH);    
           digitalWrite(12,LOW);        
           delay(1000);
    }else if(estado==3) {
           digitalWrite(13,LOW);    
           digitalWrite(12,HIGH);               
           delay(1000);
    }

    digitalWrite(13,LOW);    
    digitalWrite(12,LOW);    

    delay(100);
   
    String dato="";
       
    String peticion="GET /control/index.php?a=0 HTTP/1.1\r\n";
    peticion+="Host: www.turmandreams.es\r\n";
    peticion+="Connection: close\r\n";
    peticion+="User-Agent: test\r\n";
    peticion+="\r\n\r\n";
    
    client.println(peticion);
        
    dato="";
    while(client.connected()) {
      String line = client.readStringUntil('\n');     
      dato+=line; 
      if(dato.indexOf("@")!=-1) { break; }   
    }
    
    //Serial.println(dato);

    int pos=dato.indexOf("@");
    int pos2=dato.indexOf("@",pos+1);

    String valor=dato.substring(pos+1,pos2);

    Serial.println(valor);

    estado=valor.toInt();
    
    cerrarcliente();
       

}

    
