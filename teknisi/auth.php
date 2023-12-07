<?php
	session_start();
	// store scalar value
	$_SESSION['user'];
	// store an array
	if($_SESSION['level'] == 'teknisi') {
		//...
	} else {
		header("location: ../index.php");
	}
?>
