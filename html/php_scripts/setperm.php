<?php
    $mysqli = require "connect_to_db.php";
	if (!$mysqli) {
	  die('Could not connect '.mysql_error());
	}
    $email_target = isset($_POST['email_target']) ? $_POST['email_target'] : null;
	$rank = isset($_POST['rank']) ? $_POST['rank'] : null;
    $sql = "SELECT 1 from authorized_user where email = '".$email_target."'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $sql = "UPDATE authorized_user SET rank=".$rank." WHERE email = '".$email_target."'";
        echo $sql;
        $result = $mysqli->query($sql);
    }
    else
    {
        $sql = "INSERT INTO authorized_user VALUES ('".$email_target."',".$rank.");";
        echo $sql;
        $result = $mysqli->query($sql);
    }
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $sql = "INSERT INTO request VALUES ('".$email."',now(),'role_status','".$rank."','".$email_target."');";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $mysqli->close();
?>