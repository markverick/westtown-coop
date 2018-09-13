#The DC motor control codes with TB6612 motor controller chip refers to this website: https://howchoo.com/g/mjg5ytzmnjh/controlling-dc-motors-using-your-raspberry-pi
#The Pulse Width Modulation (PWM) codes within the DC motor control codes refers to this website: http://raspi.tv/2013/rpi-gpio-0-5-2a-now-has-software-pwm-how-to-use-it

#The magnetic door sensor codes with AdaFruit Door Sensor refers to this website: https://medium.com/conectric-networks/playing-with-raspberry-pi-door-sensor-fun-ab89ad499964

import time
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)

# set up GPIO pins
GPIO.setwarnings(False)
GPIO.setup(22, GPIO.OUT) # Connected to AIN1
GPIO.setup(23, GPIO.OUT) # Connected to AIN2
GPIO.setup(24, GPIO.OUT) # Connected to PWMA (can be ANY GPIO port)
# GPIO.setup(27, GPIO.OUT) # Connected to STBY

# Reset all the GPIO pins by setting them to LOW
GPIO.output(22, GPIO.LOW) # Set AIN1
GPIO.output(23, GPIO.LOW) # Set AIN2
GPIO.output(24, GPIO.LOW) # Set PWMA
# GPIO.output(27, GPIO.LOW) # Set STBY
print "Reset finished"


motor_on_time = 0

#-----------------------general logic----------------------------
while True:

#1 Check command-------------------------------------------------
    with open('droplet/door_control.php','r') as the_file:
        door_control_command = the_file.read()
    print door_control_command


#2 Check door status (0 is attached, 1 is detached)--------------
    GPIO.setup(21, GPIO.IN, pull_up_down = GPIO.PUD_UP)
    door_upper_sensor_status = GPIO.input(21)
    door_upper_sensor_status = str(door_upper_sensor_status)
    print door_upper_sensor_status

    GPIO.setup(20, GPIO.IN, pull_up_down = GPIO.PUD_UP)
    door_lower_sensor_status = GPIO.input(20)
    door_lower_sensor_status = str(door_lower_sensor_status)
    print door_lower_sensor_status

#3 Automatic motor shut-off--------------------------------------
    #a if the counter is bigger than... then shut off and return error message
    if motor_on_time >= 30:
        GPIO.output(22, GPIO.LOW) # Set AIN1
        GPIO.output(23, GPIO.LOW) # Set AIN2
        GPIO.output(24, GPIO.LOW) # Set PWMA
        # GPIO.output(27, GPIO.LOW) # Set STBY
        v=open("droplet/door_control.php","w")
        v.write(str("off"))
        v.close()
        v=open("droplet/door_status.php","w")
        v.write(str("DOOR JAM!"))
        v.close()
        motor_on_time = 0
        print "Door jam, motor is turned off. Please check at Chicken Coop"

    #b if the counter is smaller than... then keep going to the normal loop below
    elif motor_on_time <= 30:
        print "Motor has been on for", motor_on_time, "seconds."

#4 Main logic loop-----------------------------------------------
        #I Open position
        if door_control_command == "off" and door_upper_sensor_status == "0" and door_lower_sensor_status == "1":
            print "Door is open, no motor action."
            time.sleep(1)

        elif door_control_command == "open" and door_upper_sensor_status == "1" and (door_lower_sensor_status == "0" or "1"):
            GPIO.output(24, GPIO.HIGH) # Set PWMA
            p = GPIO.PWM(24, 50)    # create an object p for PWM on port 24 at 50 Hertz
            GPIO.output(22, GPIO.HIGH) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            motor_on_time = motor_on_time + 0.1
            print "Door is opening."
            time.sleep(.1)

        elif door_control_command == "open" and door_upper_sensor_status == "0" and door_lower_sensor_status == "1":
            time.sleep(.5)
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            # GPIO.output(27, GPIO.LOW) # Set STBY
            v=open("droplet/door_control.php","w")
            v.write(str("off"))
            v.close()
            motor_on_time = 0
            print "Door is opened, motor is turned off."
            time.sleep(1)

        #II Closed position
        elif door_control_command == "off" and door_upper_sensor_status == "1" and door_lower_sensor_status == "0":
            print "Door is closed, no motor action."
            time.sleep(1)

        elif door_control_command == "close" and (door_upper_sensor_status == "0" or "1") and door_lower_sensor_status == "1":
            GPIO.output(24, GPIO.HIGH) # Set PWMA
            p = GPIO.PWM(24, 50)       # create an object p for PWM on port 24 at 50 Hertz
            GPIO.output(22, GPIO.LOW)  # Set AIN1
            GPIO.output(23, GPIO.HIGH) # Set AIN2
            print "Door is closing."
            motor_on_time = motor_on_time + 0.1
            time.sleep(0.1)

        elif door_control_command == "close" and door_upper_sensor_status == "1" and door_lower_sensor_status == "0":
            time.sleep(2)
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            # GPIO.output(27, GPIO.LOW) # Set STBY
            v=open("droplet/door_control.php","w")
            v.write(str("off"))
            v.close()
            motor_on_time = 0
            print "Door is closed, motor is turned off."
            time.sleep(1)

        #III Error messages
        elif door_control_command == "off" and door_upper_sensor_status == "1" and door_lower_sensor_status == "1":
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            # GPIO.output(27, GPIO.LOW) # Set STBY
            v=open("droplet/door_status.php","w")
            v.write(str("DOOR JAM!"))
            v.close()
            motor_on_time = 0
            print "Door jam, motor is off. Please check at Chicken Coop."
            time.sleep(1)

        elif motor_on_time >= 5 and door_control_command == "close" and door_upper_sensor_status == "0":
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            # GPIO.output(27, GPIO.LOW) # Set STBY
            v=open("droplet/door_status.php","w")
            v.write(str("DOOR JAM!"))
            v.close()
            motor_on_time = 0
            print "Door pully cord is rewound during closing: clockwise and counterclockwise switched. Please check at Chicken Coop. Motor is turned off. Rewind back by holding down 'open.'"

        else:
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            # GPIO.output(27, GPIO.LOW) # Set STBY
            v=open("droplet/door_control.php","w")
            v.write(str("off"))
            v.close()
            v=open("droplet/door_status.php","w")
            v.write(str("ERROR: door_control.py"))
            v.close()
            motor_on_time = 0
            print "Unknown error. Motor is turned off"
            time.sleep(1)
