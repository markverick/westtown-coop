import math
import requests
import time

while True:
    #--------------------------Calling API------------------------------------------
    # Insert API Key after 'APPID=', the API Key is obtained by registering in Open Weather API (free)
    r = requests.get('https://api.openweathermap.org/data/2.5/weather?zip=19382&appid=390c124a1041484f96648a2f998f7713')

    array = r.json()
    array_wind = array["wind"]

    wind_direction = array_wind["deg"]
    wind_speed = array_wind["speed"]

    print (wind_direction, wind_speed)

    #-------------------------------Calculations------------------------------------
    # Coop orientation: 341.0 degrees
    # Equation: v' = cos(341 - wind_direction) * v  (needs to be in radian)
    # Graphical representation: https://www.desmos.com/calculator/xiriumsucp

    wind_speed_in_341_direction = math.cos((341 - wind_direction)*2*math.pi/360) * wind_speed

    file_wind_speed_341 = open("droplet/wind_speed_341.php", "w")
    file_wind_speed_341.write(str(wind_speed_in_341_direction))
    file_wind_speed_341.close()

    print wind_speed_in_341_direction

    time.sleep(3600)
