<?PHP 
session_start();
	

	if ($_SESSION['role']==10 && $_SERVER['REQUEST_TIME']-$_SESSION['last_activity']<60) {
		require "../../scripts/panelperm.php";
	}

?>