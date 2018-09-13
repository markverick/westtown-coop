<?PHP 
session_start();
	

	if ($_SESSION['role']>=9 && $_SERVER['REQUEST_TIME']-$_SESSION['last_activity']<30) {
		require "../../scripts/table.php";
	}

?>