# Relay control codes refer to this website: https://howchoo.com/g/m2qwmte5nzk/how-to-use-a-relay-with-a-raspberry-pi

#Setup
import time
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)

heater_on_time = 0

#Main loop
while True:
#Checking water temperature
    f= open("droplet/water_temp.php","r")
    water_temp = f.read()
    f.close()
    print "water temperature: " + water_temp
    water_temp = float(water_temp)

#Checking battery voltage
    f= open("droplet/volt.php","r")
    voltage = f.read()
    f.close()
    print "voltage: " + voltage
    voltage = float(voltage)

#Checking command from the website (the website writes into the following file with javascript)
    f= open("droplet/water_heater_relay_command.php","r")
    water_heater_relay_command=f.read()
    f.close()
    print water_heater_relay_command

#Check how long has fan been on
    print "water heater has been on for", heater_on_time, "seconds."

#-----------------------------Main logic loop-----------------------------------
    #0 Low voltage protection and daytime energy dump
    if voltage <= 12.0:
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.HIGH)
        print "water heater turned off (low voltage protection)"
        time.sleep(10)

    elif voltage > 11.8 and water_temp <= 73 and water_heater_relay_command == "automatic":                                  #80 for use, 140 for testing
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.LOW)
        print "water heater turned on (daytime energy dump)"
        heater_on_time = heater_on_time + 10        
        time.sleep(10)

    #I Stages of the automatic control mode
    elif water_temp <= 70.00 and water_heater_relay_command == "automatic":       #45 for use, 100/120 for testing
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.LOW)
        print "water heater turned on (automatic)"
        heater_on_time = heater_on_time + 10
        time.sleep(10)

    elif water_temp > 70.00 and water_temp <= 72.20 and water_heater_relay_command == "automatic":
        if GPIO.input(18) == 1:
            heater_on_time = heater_on_time + 10
        elif GPIO.input(channel) == 0:
            heater_on_time = 0
        print "intermediate stage: heater left on/off until out of range(80F~100F) (automatic)"
        time.sleep(10)

    elif water_temp > 61.20 and water_heater_relay_command == "automatic":
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.HIGH)
        print "water heater turned off (automatic)"
        heater_on_time = 0
        time.sleep(10)

    #II the next two are manual control mode
    elif water_heater_relay_command == "off":
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.HIGH)
        print "water heater turned off (manual)"
        heater_on_time = 0
        time.sleep(10)

    elif water_heater_relay_command == "on":
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.LOW)
        print "!!Warning: only use when thermometer malfunctions!! water heater turned on (manual)"
        heater_on_time = heater_on_time + 10
        time.sleep(10)
        # This always-on button is disabled (not displayed on website) for safety concerns.

    #III Error message
    else :
        GPIO.setup(18, GPIO.OUT)
        GPIO.output(18, GPIO.HIGH)
        print "website command error and water heater turned off"
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('Python Error')
        heater_on_time = 0
        time.sleep(10)
