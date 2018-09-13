<?php

session_start();



	$mysqli = require "connect_to_db.php";
	if (!$mysqli) {
	  die('Could not connect '.mysql_error());
	}
	$email = isset($_POST['email']) ? $_POST['email'] : null;
    $sql = "SELECT * FROM authorized_user WHERE email='".$email."'";
    // echo $sql;
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $row=mysqli_fetch_row($result);
        echo $row[1];
		$_SESSION['role']=$row[1];
		$_SESSION['last_activity']=$_SERVER['REQUEST_TIME'];
        // if($row[1] > 0)
        //     echo "success";
        // else
        //     echo "failure";
    } else {
        $sql = "INSERT INTO authorized_user VALUES ('".$email."',0);";
        $result = $mysqli->query($sql);
		$_SESSION['role']=0;
        echo "0";
    }
    $sql = "INSERT INTO session VALUES ('".$email."',now());";
    $result = $mysqli->query($sql);
    $mysqli->close();
?>