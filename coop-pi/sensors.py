import RPi.GPIO as GPIO
import dht11
import time
import datetime

# initialize GPIO
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.cleanup()

# read data using pin 14
instance = dht11.DHT11(pin=4)

while True:
    result = instance.read()
    if result.is_valid():
        t=open("droplet/temp.php","w")
        t.write(str(float(result.temperature)*9/5+32))
        t.close
        y=open("droplet/humid.php","w")
        y.write(str(float(result.humidity)))
        y.close
        print("Last valid input: " + str(datetime.datetime.now()))
        print("Temperature: %f F" % (float(result.temperature)*9/5+32))
        print("Humidity: %f %%" % float(result.humidity))
        time.sleep(10)
    time.sleep(0.5)
