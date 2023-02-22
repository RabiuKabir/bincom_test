<?php
	$host="localhost";
	$user="root";
	$pass="";
	$db="bincom_test";

	$con = mysqli_connect($host, $user, $pass);

	if (!mysqli_select_db($con, $db)){
		echo 'Error connnecting to the database';
	}	
?>
