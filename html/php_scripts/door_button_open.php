<?php
@ $fp = fopen("../droplet/door_control.php", 'wb');
if (!$fp)
{
    echo 'Cannot generate message file';
    exit;
}
else
{
	$outputstring  = 'open';
	fwrite($fp, $outputstring);
	Echo "Door opening...";
}
$email = isset($_POST['email']) ? $_POST['email'] : 'system';
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'door_status','open',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
