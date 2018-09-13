<?PHP
$action = isset($_POST['action']) ? $_POST['action'] : null;
@ $fp = fopen("../droplet/circulation_fan_on_off.php", 'wb');
if (!$fp)
{
    echo 'Cannot generate message file';
    exit;
}
else
{
	$outputstring  = $action;
	fwrite($fp, $outputstring);
	echo "Fan mode is set to ".$action;
}
$email = isset($_POST['email']) ? $_POST['email'] : null;
$mysqli = require "connect_to_db.php";
$sql = "INSERT INTO request VALUES ('".$email."',now(),'fan_status','".$action."',NULL);";
$result = $mysqli->query($sql);
$mysqli->close();
?>
