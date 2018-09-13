<?php
@ $fp = fopen("../droplet/door_control.php", 'wb');
if (!$fp)
{
    echo 'Cannot generate message file';
    exit;
}
else
{
	$outputstring  = 'close';
	fwrite($fp, $outputstring);
	Echo "Door closing...";
}
$email = isset($_POST['email']) ? $_POST['email'] : 'system';
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'door_status','close',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
