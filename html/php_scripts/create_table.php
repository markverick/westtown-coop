<?php
	$date = isset($_GET['date']) ? $_GET['date'] : null;
	$mysqli = require "connect_to_db.php";
	$sql="SELECT time, door_status, air_temp, humid, water_temp, voltage, fan_speed, fan_status, heater_status FROM record WHERE time>='".$date." 00:00:00' AND time <= '".$date." 23:59:59'";
	// echo $sql;
	$result = $mysqli->query($sql);
	// WHERE dateadded >= '2012-02-01 00:00:00' AND dateadded <  '2012-11-01 00:00:00'"
	while($row = $result->fetch_assoc()) {
  ?>
  <tr>
    <td><?php echo $row['time']?></td>
    <td><?php echo $row['door_status']?></td>
    <td><?php echo $row['air_temp']?></td>
    <td><?php echo $row['humid']?></td>
    <td><?php echo $row['water_temp']?></td>
    <td><?php echo $row['voltage']?></td>
    <td><?php echo $row['fan_speed']?></td>
    <td><?php echo $row['fan_status']?></td>
    <td><?php echo $row['heater_status']?></td>
  </tr>
  <?php
    }
?>