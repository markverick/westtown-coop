import time
import RPi.GPIO as GPIO
from subprocess import call

GPIO.setmode(GPIO.BCM)
GPIO.setup(12, GPIO.OUT)
GPIO.setup(16, GPIO.OUT)
GPIO.setup(18, GPIO.OUT)
GPIO.setup(22, GPIO.OUT)
GPIO.setup(23, GPIO.OUT)
GPIO.setup(24, GPIO.OUT)

fan_on_time = 0
waterheater_on_time = 0
door_motor_on_time = 0

#clearing files                                                                 #checked
with open('droplet/fatal_error_log.php', 'w') as the_file:
    the_file.close()
with open('droplet/fan_status.php', 'w') as the_file:
    the_file.close()
with open('droplet/door_status.php', 'w') as the_file:
    the_file.close()
with open('droplet/water_heater_status.php', 'w') as the_file:
    the_file.close()


while True:
    print "This is to shutdown Pi in doomsday scenarios. Safety code."
#-----------------------------check water temp----------------------------------
    try:
        with open('droplet/water_temp.php', 'r') as the_file:
            water_temp = float(the_file.read())
    except:
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read water temperature')

    if water_temp >= 120:                                                       #checked
        try:
            with open('droplet/fatal_error_log.php', 'w') as the_file:
                the_file.write('FATAL ERROR: water heater overheat. (water_temp = ' + str(water_temp) + "F) Raspberry Pi is shut down.")
            with open('droplet/water_heater_status.php', 'w') as the_file:
                the_file.write('FATAL ERROR: overheat')
        except:
            pass
        call('sudo shutdown -h now', shell=True)


#----------------------------waterheater on time--------------------------------
    if waterheater_on_time >= 3600:
        try:
            v=open("droplet/water_heater_relay_command.php","w")
            v.write(str("off"))
            v.close()
        except:
            try:
                with open('droplet/fatal_error_log.php', 'w') as the_file:
                    the_file.write('FATAL ERROR: cannot write into droplet/water_heater_relay_command.php.')
            except:
                pass
        try:
            GPIO.setup(18, GPIO.OUT)
            GPIO.output(18, GPIO.HIGH)
            if str(GPIO.input(18)) == "0":
                try:
                    with open('droplet/fatal_error_log.php', 'w') as the_file:
                        the_file.write('FATAL ERROR: cannot change GPIO status for water heater.')
                except:
                    pass
                call('sudo shutdown now', shell=True)
        except:
            try:
                with open('droplet/fatal_error_log.php', 'w') as the_file:
                    the_file.write('FATAL ERROR: cannot change GPIO status for water heater.')
            except:
                pass
            call('sudo shutdown now', shell=True)
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('FATAL ERROR: water heater overtime')


#------------------------------motor on time------------------------------------
    if door_motor_on_time >= 35:                                                #Tested
        try:
            GPIO.setup(22, GPIO.OUT) # Connected to AIN1
            GPIO.setup(23, GPIO.OUT) # Connected to AIN2
            GPIO.setup(24, GPIO.OUT) # Connected to PWMA (can be ANY GPIO port)
            GPIO.output(22, GPIO.LOW) # Set AIN1
            GPIO.output(23, GPIO.LOW) # Set AIN2
            GPIO.output(24, GPIO.LOW) # Set PWMA
            if str(GPIO.input(22)) == "1" or str(GPIO.input(23)) == "1" or str(GPIO.input(24)) == "1":
                with open('droplet/fatal_error_log.php', 'w') as the_file:
                    the_file.write('FATAL ERROR: cannot change GPIO status for door motor.')

            with open('droplet/door_control.php','w') as the_file:
                the_file.write('off')
            with open('droplet/door_status.php', 'w') as the_file:
                the_file.write('FATAL ERROR: motor overtime')
            with open('droplet/fatal_error_log.php', 'w') as the_file:
                the_file.write('FATAL ERROR: motor overtime')
            print "FATAL ERROR: motor overtime"

        except:
            try:
                with open('droplet/fatal_error_log.php', 'w') as the_file:
                    the_file.write('FATAL ERROR: cannot override door motor control.')
            except:
                pass
            call('sudo shutdown -h now', shell=True)

#-------------------------------fan on time-------------------------------------
    if fan_on_time >= 604800:                                                   #tested
        try:
            GPIO.setup(16, GPIO.OUT) # Connected to PWMB (can be ANY GPIO port)
            GPIO.setup(12, GPIO.OUT) # Connected to BIN1
            GPIO.output(16, GPIO.LOW) # Set PWMB
            GPIO.output(12, GPIO.LOW) # Set BIN1

            v=open("droplet/circulation_fan_speed.php","w")
            v.write(str("0"))
            v.close()

            with open('droplet/fan_status.php', 'w') as the_file:
                the_file.write('FATAL ERROR: fan overtime')

            if str(GPIO.input(12)) == "0" and str(GPIO.input(16)) == "0":
                fan_on_time = 0
        except:
            with open('droplet/fan_status.php', 'w') as the_file:
                the_file.write('cannot override fan control')
#-------------------------------------------------------------------------------
#-------------------------------------------------------------------------------

    time.sleep(1)

#--------------------------reading gpio and status------------------------------
#-----------------------setting default values to error-------------------------
    gpio12='3'
    gpio16='3'
    gpio18='3'
    gpio22='3'
    gpio23='3'
    gpio24='3'

# ---------------------------------------fan------------------------------------
    try:
        gpio12 = str(GPIO.input(12))
        gpio16 = str(GPIO.input(16))
    except:
        with open('droplet/fan_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')

#---------------------------------waterheater relay-----------------------------
    try:
        gpio18 = str(GPIO.input(18))
    except:
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')

#------------------------------------door motor---------------------------------
    try:
        gpio22 = str(GPIO.input(22))
        gpio23 = str(GPIO.input(23))
        gpio24 = str(GPIO.input(24))
    except:
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')

#----------------------door status (0 is attached, 1 is detached)---------------
    GPIO.setup(21, GPIO.IN, pull_up_down = GPIO.PUD_UP)
    door_upper_sensor_status = GPIO.input(21)
    door_upper_sensor_status = str(door_upper_sensor_status)

    GPIO.setup(20, GPIO.IN, pull_up_down = GPIO.PUD_UP)
    door_lower_sensor_status = GPIO.input(20)
    door_lower_sensor_status = str(door_lower_sensor_status)


#-----------------------------reading status------------------------------------
    try:                                                                        #checked
        with open('droplet/water_heater_status.php', 'r') as the_file:
            water_heater_status = the_file.read()
    except:
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('cannot read status')
    try:
        with open('droplet/door_status.php', 'r') as the_file:
            door_status = the_file.read()
    except:
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('cannot read status')
    try:
        with open('droplet/fan_status.php', 'r') as the_file:
            fan_status = the_file.read()
    except:
        with open('droplet/fan_status.php', 'w') as the_file:
            the_file.write('cannot read status')

#--------------------------------printing---------------------------------------#checked
    try:
        print "-----------------------start here------------------------"
        print "GPIO18 (waterheater relay: 0 is on, 1 is off): " + gpio18
        print "GPIO12 (fan BIN1): " + gpio12
        print "GPIO16 (fan PWMB): " + gpio16
        print "GPIO22 (door AIN1): " + gpio22
        print "GPIO23 (door AIN2): " + gpio23
        print "GPIO24 (door PWMA): " + gpio24
        print "---------------------------------------------------------"
        print "water heater status: " + str(water_heater_status)
        print "door status: " + str(door_status)
        print "fan status: " + str(fan_status)
        print "---------------------------------------------------------"
        print "fan has been on for: " + str(fan_on_time) + " s."
        print "water heater has been on for: " + str(waterheater_on_time) + " s."
        print "door motor has been on for: " + str(door_motor_on_time) + " s."
    except:
        pass
#-------------------------------------------------------------------------------
#-------------------------------------------------------------------------------

#----------------------------writing to files-----------------------------------#checked
    # waterheater
    if water_heater_status == "FATAL ERROR: water heater overtime" and gpio18 == "1":
        pass
    elif gpio18 == "0":
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('On - Automatic')
        waterheater_on_time = waterheater_on_time + 1
    elif gpio18 == "1":
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('Off')
        waterheater_on_time = 0
    else:
        with open('droplet/water_heater_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')
        waterheater_on_time = 0

    # fan
    if fan_status == "FATAL ERROR: fan overtime" and gpio12 == "0":
        pass
    elif gpio12 == "0":
        with open('droplet/fan_status.php', 'w') as the_file:
            the_file.write('Off')
        fan_on_time = 0
    elif gpio12 == "1":
        with open('droplet/fan_status.php', 'w') as the_file:
            the_file.write('On')
        fan_on_time = fan_on_time + 1
    else:
        with open('droplet/fan_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')
        fan_on_time = 0

    # door
    if door_status == "FATAL ERROR: motor overtime" and gpio22 == "0" and gpio23 == "0":
        pass
    elif gpio22 == "0" and gpio23 == "1":
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('Closing!')
        door_motor_on_time = door_motor_on_time + 1
    elif gpio22 == "1" and gpio23 == "0":
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('Opening!')
        door_motor_on_time = door_motor_on_time + 1
    elif gpio22 == "0" and gpio23 == "0" and door_upper_sensor_status == "1" and door_lower_sensor_status == "0":
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('Closed')
        door_motor_on_time = 0
    elif gpio22 == "0" and gpio23 == "0" and door_upper_sensor_status == "0" and door_lower_sensor_status == "1":
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('Open')
        door_motor_on_time = 0
    else:
        with open('droplet/door_status.php', 'w') as the_file:
            the_file.write('ERROR: cannot read GPIO')
        door_motor_on_time = 0
