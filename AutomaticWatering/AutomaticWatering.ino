#include <LiquidCrystal.h>




#define triger 250
//Define the parameters of the flower1
#define triggerValue0 700  //the trigger value of the moisture, the minimum value is 0, means the moisture is 0, the soil is very dry. the maximum value is 1024.


//Define the parameters of the flower2
#define triggerValue1 700  //the trigger value of the moisture




//Define the moisture sensor pins
const int analogInPin0 = A0; 
const int analogInPin1 = A1;


//the value readed from each moisture sensor
int moistureValue0 = 0;        
int moistureValue1 = 0;

//the sum of the 30 times sampling
long int moistureSum0 = 0;   //we need to sampling the moisture 30 times and get its average value, this variable is used to store the sum of the 30 times sampled value
long int moistureSum1 = 0;


//Define the water pump contorl pins
const int pumpAnodePin =  6;      //pin 6 connect to the anode of the pump
const int pumpCathodePin =  7;   //pin 7 connect to the cathode of the pump
const int pumpAnodePin2 =  4;      //pin 6 connect to the anode of the pump
const int pumpCathodePin2 =  5;

LiquidCrystal lcd(12, 11, 9, 8, 3, 2);

void setup()
{
  lcd.begin(16, 2);
  lcd.clear();
  //lcd.print("hello, world!!");
  Serial.begin(9600); 
  pinMode(pumpAnodePin, OUTPUT);
  pinMode(pumpCathodePin, OUTPUT);
  pinMode(pumpAnodePin2, OUTPUT);
  pinMode(pumpCathodePin2, OUTPUT);
} 


void loop() 
{
  moistureSampling();
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Plant 1 level:");
  lcd.setCursor(0,1);
  lcd.print(moistureValue0);
  delay(2000);
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Plant 2 level:");
  lcd.setCursor(0,1);
  lcd.print(moistureValue1);
  delay(2000);
  
  if(moistureValue0 > triggerValue0)
  {
    delay(1000);
    digitalWrite(pumpAnodePin, HIGH);  //the pump start working
    digitalWrite(pumpCathodePin, LOW);
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Plant one");
    lcd.setCursor(0,1);
    lcd.print("watering");
    delay(10000);
    digitalWrite(pumpAnodePin, LOW);  //the pump stops working
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Watering Done");
    digitalWrite(pumpCathodePin, LOW);
    return;
   }
  else if(moistureValue1 > triggerValue1)
   {
    delay(1000);
    digitalWrite(pumpAnodePin2, HIGH);  //the pump start working
    digitalWrite(pumpCathodePin2, LOW);
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Plant two");
    lcd.setCursor(0,1);
    lcd.print("watering");
    delay(12000);
    digitalWrite(pumpAnodePin2, LOW);  //the pump stops working
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Watering Done");
    digitalWrite(pumpCathodePin2, LOW);
    return;
   }
  else
  {
    Serial.print("none");
  }
}

void moistureSampling()// read the value of the soil moisture
{
  for(int i = 0; i < 30; i++)//samping 30 time within 3 seconds
  {
    moistureSum0 = moistureSum0 + analogRead(analogInPin0);  
    moistureSum1 = moistureSum1 + analogRead(analogInPin1);
    delay(100);
  }
  moistureValue0 = moistureSum0 / 30;//get the average value
  moistureValue1 = moistureSum1 / 30;


  // print the results to the serial monitor:
  Serial.print("Moisture0 = " );                       
  Serial.print(moistureValue0);      
  Serial.print("\t Moisture1 = ");      
  Serial.print(moistureValue1);  
  Serial.println(); 
  
  moistureSum0 = 0;//reset the variable
  moistureSum1 = 0;
  delay(4000);     //delay 4 seconds 
}




