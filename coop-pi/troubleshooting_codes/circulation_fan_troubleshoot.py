# fan stats:
# 0.135 amp at 12.7v per fan
# 0.125 amp at 12v (1.5w) per fan
# r=95ohms

import time
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)

# set up GPIO pins
GPIO.setwarnings(False)
GPIO.setup(16, GPIO.OUT) # PWM

# Reset all the GPIO pins by setting them to LOW
GPIO.output(16, GPIO.LOW) # Set AIN1

print "Reset finished"


fan_on_time = 0

while True:
    GPIO.output(16, GPIO.HIGH) # Set PWMA
    p = GPIO.PWM(16, 50)    # create an object p for PWM on port 24 at 50 Hertz
    p.start(100)
    print "100%"
    time.sleep(2)
    p.ChangeDutyCycle(50)   # change the duty cycle to 50%
    print "50%"
    time.sleep(2)
