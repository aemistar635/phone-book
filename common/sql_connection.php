<?php

	$db_link = mysqli_connect('localhost','root','','phone_book');
	session_start();
	
	$userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_roll'] ?? "";

?>