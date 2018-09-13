#The controls for circulation fans are the same as the DC motor control. Voltage is regulated by the same TB6612 chip.

#The DC motor control codes with TB6612 motor controller chip refers to this website: https://howchoo.com/g/mjg5ytzmnjh/controlling-dc-motors-using-your-raspberry-pi
#The Pulse Width Modulation (PWM) codes within the DC motor control codes refers to this website: http://raspi.tv/2013/rpi-gpio-0-5-2a-now-has-software-pwm-how-to-use-it


import time
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)

# set up GPIO pins
GPIO.setwarnings(False)
GPIO.setup(16, GPIO.OUT) # Connected to PWMB (can be ANY GPIO port)
GPIO.setup(12, GPIO.OUT) # Connected to BIN1

# Reset all the GPIO pins by setting them to LOW
GPIO.output(16, GPIO.LOW) # Set PWMB
GPIO.output(12, GPIO.LOW) # Set BIN1
p = GPIO.PWM(16, 500)      # create an object p for PWM on GPIO 16 at 500 Hertz
p.start(0)               # start the PWM on 0 percent duty cycle
print "Reset finished"

fan_on_time = 0

#-----------------------general logic----------------------------
while True:
#1 Check command-------------------------------------------------
    f = open("droplet/circulation_fan_speed.php","r")
    fan_speed=f.read()
    f.close()
    print "fan_speed: " + fan_speed + "%"

    g = open("droplet/circulation_fan_on_off.php","r")
    fan_control_command=g.read()
    g.close()
    print "fan_command: " + fan_control_command

#2 Check temperature---------------------------------------------
    h = open("droplet/temp.php","r")
    temperature = float(h.read())
    h.close()
    print "air_temperature: " + str(temperature) + "F"

#3 Check battery voltage-----------------------------------------
    f = open("droplet/volt.php","r")
    voltage = f.read()
    f.close()
    print "voltage: " + voltage
    voltage = float(voltage)

#5 Check wind speed----------------------------------------------
    f = open("droplet/wind_speed_341.php","r")
    wind_speed_341 = f.read()
    f.close()
    print "wind speed in 341 direction is: " + wind_speed_341
    wind_speed_341 = float(wind_speed_341)

#5 Check how long has fan been on--------------------------------
    print "fan has been on for", fan_on_time, "seconds."

#-----------------------------Main logic loop--------------------
    #0 Low voltage protection and daytime energy dump
    if voltage <= 12.2:
        p.ChangeDutyCycle(0)              # change the duty cycle to 0%
        GPIO.output(12, GPIO.LOW)         # Set BIN1
        fan_on_time = 0
        print "fan is off (low voltage protection)"
        time.sleep(120)

    #I High wind shut down
    elif fan_control_command == "automatic" and wind_speed_341 >= 5:
        p.ChangeDutyCycle(0)              # change the duty cycle to 0%
        GPIO.output(12, GPIO.LOW)         # Set BIN1
        fan_on_time = 0
        print "fan is off (strong wind protection)"
        time.sleep(605)

    #II Fan on automatic
    elif fan_control_command == "automatic":
        if temperature > 80.00:              # threashold temperature
            p.ChangeDutyCycle(100)           # change the duty cycle to 100%
            GPIO.output(12, GPIO.HIGH)       # Set BIN1
            fan_on_time = fan_on_time + 1
            print "Fan is on (automatic), speed at 100%"
            time.sleep(1)
        if temperature <= 80.00:             # threashold temperature
            p.ChangeDutyCycle(0)             # change the duty cycle to 0%
            GPIO.output(12, GPIO.LOW)        # Set BIN1
            fan_on_time = 0
            print "Fan is off (automatic), speed at 100%"
            time.sleep(1)

    #III Fan on manual
    elif fan_control_command == "manual": #and fan_speed != "0":
        if fan_speed == "0":
            p.ChangeDutyCycle(0)             # change the duty cycle to 0%
            GPIO.output(12, GPIO.LOW)        # Set BIN1
            fan_on_time = 0
            print "fan is off"
            time.sleep(1)
        else:
            p.ChangeDutyCycle(int(fan_speed))# change the duty cycle to website input value
            GPIO.output(12, GPIO.HIGH)       # Set BIN1
            fan_on_time = fan_on_time + 1
            print "Fan is on, speed at: " + fan_speed + "%."
            time.sleep(1)

    else:
        p.ChangeDutyCycle(0)                 # change the duty cycle to 0%
        GPIO.output(12, GPIO.LOW)            # Set BIN1
        fan_on_time = 0
        print "unknown error, fan is turned off"
        time.sleep(1)
