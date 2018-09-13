<?php
@ $fp = fopen("../droplet/water_heater_relay_command.php", 'wb');
if (!$fp)
{
    echo '<p><strong>Cannot generate message file</strong></p></body></html>';
    exit;
}
else
{
	$outputstring  = 'off';
	fwrite($fp, $outputstring);
	Echo "Water heater turned off";
}
$email = isset($_POST['email']) ? $_POST['email'] : null;
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'heater_status','turn off',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
