<?php
@ $fp = fopen("../droplet/water_heater_relay_command.php", 'wb');
if (!$fp)
{
    echo '<p><strong>Cannot generate message file</strong></p></body></html>';
    exit;
}
else
{
	$outputstring  = 'automatic';
	fwrite($fp, $outputstring);
	Echo "Automatic water heater control started";
}
$email = isset($_POST['email']) ? $_POST['email'] : null;
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'heater_status','turn on',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
