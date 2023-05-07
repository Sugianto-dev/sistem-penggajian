<?php
	require "functions.php";
	session_destroy();
	$url = BASE_URL . 'login.php';
    header("Location:$url");	
?>