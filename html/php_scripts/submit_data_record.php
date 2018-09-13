 <?php
$mysqli = require "connect_to_db.php";
// $time = now();

$myfile = fopen("../droplet/door_status.php", "r") or die("Unable to open file!");
$door_status = fread($myfile,filesize("../droplet/door_status.php"));
fclose($myfile);

$myfile = fopen("../droplet/temp.php", "r") or die("Unable to open file!");
$air_temp = (float) fread($myfile,filesize("../droplet/temp.php"));
fclose($myfile);

$myfile = fopen("../droplet/humid.php", "r") or die("Unable to open file!");
$humid = (float) fread($myfile,filesize("../droplet/humid.php"));
fclose($myfile);

$myfile = fopen("../droplet/water_temp.php", "r") or die("Unable to open file!");
$water_temp = (float) fread($myfile,filesize("../droplet/water_temp.php"));
fclose($myfile);

$myfile = fopen("../droplet/volt.php", "r") or die("Unable to open file!");
$voltage = (float) fread($myfile,filesize("../droplet/volt.php"));
fclose($myfile);

$myfile = fopen("../droplet/circulation_fan_speed.php", "r") or die("Unable to open file!");
$fan_speed = (int) fread($myfile,filesize("../droplet/circulation_fan_speed.php"));
fclose($myfile);

$myfile = fopen("../droplet/fan_status.php", "r") or die("Unable to open file!");
$fan_status = fread($myfile,filesize("../droplet/fan_status.php"));
fclose($myfile);

$myfile = fopen("../droplet/water_heater_status.php", "r") or die("Unable to open file!");
$heater_status = fread($myfile,filesize("../droplet/water_heater_status.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_video.php", "r") or die("Unable to open file!");
$video_uptime = fread($myfile,filesize("../droplet/error_video.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_video2.php", "r") or die("Unable to open file!");
$video2_uptime = fread($myfile,filesize("../droplet/error_video2.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_heater.php", "r") or die("Unable to open file!");
$heater_uptime = fread($myfile,filesize("../droplet/error_heater.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_door.php", "r") or die("Unable to open file!");
$door_uptime = fread($myfile,filesize("../droplet/error_door.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_dht11.php", "r") or die("Unable to open file!");
$dht11_uptime = fread($myfile,filesize("../droplet/error_dht11.php"));
fclose($myfile);

$myfile = fopen("../droplet/error_water_sensor.php", "r") or die("Unable to open file!");
$water_sensor_uptime = fread($myfile,filesize("../droplet/error_water_sensor.php"));
fclose($myfile);

$sql = "INSERT INTO record VALUES (".
"now()"
.",".
"\"".$door_status."\""
.",".
$air_temp
.",".
$humid
.",".
$water_temp
.",".
$voltage
.",".
$fan_speed
.",".
"\"".$fan_status."\""
.",".
"\"".$heater_status."\""
.",".
"FROM_UNIXTIME(".$video_uptime.")"
.",".
"FROM_UNIXTIME(".$video2_uptime.")"
.",".
"FROM_UNIXTIME(".$heater_uptime.")"
.",".
"FROM_UNIXTIME(".$door_uptime.")"
.",".
"FROM_UNIXTIME(".$dht11_uptime.")"
.",".
"FROM_UNIXTIME(".$water_sensor_uptime.")"
."); ";

$result = $mysqli->query($sql);
echo $sql;
$mysqli->close();
?> 