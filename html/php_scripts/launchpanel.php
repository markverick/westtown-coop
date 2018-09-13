
<?PHP 
session_start();
	

	if ($_SESSION['role']=10) {
		require "../../scripts/panel.php";
	}

?>