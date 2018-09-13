<?php
$speed = isset($_POST['speed']) ? $_POST['speed'] : null;
@ $fp = fopen("../droplet/circulation_fan_speed.php", 'wb');
if (!$fp)
{
    echo 'Cannot generate message file';
    exit;
}
else
{
	$outputstring  = (string)$speed;
	fwrite($fp, $outputstring);
	Echo "Door opening...";
}
$email = isset($_POST['email']) ? $_POST['email'] : null;
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'fan_speed','".$speed."',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
