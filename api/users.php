<?php
	session_start();
	include_once 'config.php';

	$outgoing_id = $_SESSION['unique_id'];
	$sql = mysqli_query($conn, "SELECT * FROM Users WHERE NOT unique_id = {$outgoing_id}");
	$output = '';

	if (mysqli_num_rows($sql) == 1) {
		$output .= 'No users are available';
	}
	else {
		include 'data.php';
	}
	echo $output;
?>